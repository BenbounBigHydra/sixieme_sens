<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Collection;
use Illuminate\Support\Carbon;

class CompanyStatsService
{
    // Somme de toutes les collectes passées
    public static function getNbCollections(): int
    {
        return Collection::where('day_end', '<', now())->count();
    }

    // Somme de toutes les entreprises partenaires
    public static function getNbCompanies(): int
    {
        return Company::count();
    }

    public static function getGoldWinnerData(int $year = null): ?array
    {
        $year = $year ?? Carbon::now()->subYear()->year;

        $companies = Company::with(['collections' => function ($query) use ($year) {
            $query->whereYear('day_start', $year)
                ->where('day_end', '<', now())
                ->where('nb_employee', '>', 0);
        }])->get();

        $scores = $companies->map(function ($company) {
            $totalRatio     = $company->collections->sum(fn($c) => $c->nb_blood_pouch / $c->nb_employee);
            $totalBloodPouch = $company->collections->sum('nb_blood_pouch');
            $totalEmployee  = $company->collections->sum('nb_employee');

            return [
                'name'             => $company->name,
                'ratio'            => $totalRatio,
                'nb_blood_pouch'   => $totalBloodPouch,
                'nb_employee'      => $totalEmployee,
            ];
        })->filter(fn($s) => $s['ratio'] > 0);

        return $scores->sortByDesc('ratio')
            ->sortByDesc(fn($s, $key) => [$s['ratio'], $s['nb_blood_pouch']])
            ->first() ?? null;
    }

    public static function getGoldWinner(int $year = null): ?string
    {
        return self::getGoldWinnerData($year)['name'] ?? null;
    }

    // Entreprise ayant organisé au moins une collecte le plus d'années consécutives (min 2 ans)
    public static function getAmbassadorData(int $year = null): ?array
    {
        $year = $year ?? Carbon::now()->subYear()->year;

        $companies = Company::with(['collections' => function ($query) use ($year) {
            $query->where('day_end', '<', now())
                ->whereYear('day_start', '<=', $year);
        }])
            ->whereHas('collections', function ($query) use ($year) {
                $query->where('day_end', '<', now())
                    ->whereYear('day_start', $year);
            })
            ->get();

        $scores = $companies->map(function ($company) {
            $years = $company->collections
                ->map(fn($c) => Carbon::parse($c->day_start)->year)
                ->unique()
                ->sort()
                ->values();

            // Calcul des années consécutives
            $maxConsecutive     = 1;
            $currentConsecutive = 1;
            for ($i = 1; $i < $years->count(); $i++) {
                if ($years[$i] === $years[$i - 1] + 1) {
                    $currentConsecutive++;
                    $maxConsecutive = max($maxConsecutive, $currentConsecutive);
                } else {
                    $currentConsecutive = 1;
                }
            }

            $avgRatio       = $company->collections->where('nb_employee', '>', 0)
                ->avg(fn($c) => $c->nb_blood_pouch / $c->nb_employee) ?? 0;
            $totalBloodPouch = $company->collections->sum('nb_blood_pouch');

            return [
                'name'             => $company->name,
                'consecutive'      => $maxConsecutive >= 2 ? $maxConsecutive : 0,
                'avg_ratio'        => $avgRatio,
                'nb_blood_pouch'   => $totalBloodPouch,
                'nb_employee'      => $company->collections->sum('nb_employee'),
            ];
        })->filter(fn($s) => $s['consecutive'] >= 2);

        return $scores->sortByDesc('consecutive')
            ->sortByDesc('avg_ratio')
            ->sortByDesc('nb_blood_pouch')
            ->first() ?? null;
    }

    public static function getAmbassador(int $year = null): ?string
    {
        return self::getAmbassadorData($year)['name'] ?? null;
    }

    // Entreprise avec le meilleur ratio nb_blood_pouch/nb_registered sur une collecte l'année dernière
    public static function getConvictionData(int $year = null): ?array
    {
        $year = $year ?? Carbon::now()->subYear()->year;

        $collections = Collection::with('company')
            ->whereYear('day_start', $year)
            ->where('nb_registered', '>', 0)
            ->get();

        if ($collections->isEmpty()) {
            return null;
        }

        $best = $collections
            ->map(fn($c) => [
                'name'  => $c->company->name,
                'ratio' => $c->nb_blood_pouch / $c->nb_registered,
                'nb_blood_pouch' => $c->nb_blood_pouch,
                'nb_employee' => $c->nb_employee,
            ])
            ->sortByDesc('ratio')
            ->first();

        return $best ?? null;
    }

    public static function getConviction(int $year = null): ?string
    {
        return self::getConvictionData($year)['name'] ?? null;
    }

    // Entreprises labellisées sur l'année choisie (par défaut l'année en cours)
    public static function getLabelledCompanies(int $year = null): mixed
    {
        $year = $year ?? Carbon::now()->year;

        return Company::whereHas('collections', function ($query) use ($year) {
            $query->whereYear('day_start', $year)
                ->whereNotNull('nb_registered')
                ->whereNotNull('nb_blood_pouch');
        })->get();
    }

    public static function getCompanyAwards(Company $company): array
    {
        // Récupère toutes les années où l'entreprise a eu une collecte clôturée
        $years = $company->collections()
            ->where('day_end', '<', now())
            ->get()
            ->map(fn($c) => Carbon::parse($c->day_end)->year)
            ->unique()
            ->sort()
            ->values();

        $awards = [];

        foreach ($years as $year) {
            $awards[$year] = [
                'gold'       => self::getGoldWinner($year) === $company->name,
                'conviction' => self::getConviction($year) === $company->name,
                'ambassador' => self::getAmbassador($year) === $company->name,
                'label'      => self::getLabelledCompanies($year)->contains('name', $company->name),
            ];
        }

        return $awards;
    }

    // KPI 1 : Taux d'occupation = nb_registered / capacity
    public static function getOccupancyRate(Collection $collection): ?float
    {
        return $collection->nb_registered / $collection->capacity;
    }

    // KPI 2 : Taux d'inscription non éligible = 1 - (nb_blood_pouch / nb_registered)
    public static function getNonEligibleRate(Collection $collection): ?float
    {
        if (!$collection->nb_registered || $collection->nb_registered === 0) {
            return null;
        }

        return 1 - ($collection->nb_blood_pouch / $collection->nb_registered);
    }

    // KPI 3 : Taux de visite cobrandé = visitor_count / nb_employee
    public static function getCobrandVisitRate(Collection $collection): ?float
    {
        return $collection->visitor_count / $collection->nb_employee;
    }

    // KPI 4 : Taux de visite OneDoc = onedoc_click_count / visitor_count
    public static function getOnedocVisitRate(Collection $collection): ?float
    {
        if (!$collection->visitor_count || $collection->visitor_count === 0) {
            return null;
        }

        return $collection->onedoc_click_count / $collection->visitor_count;
    }

    // Tous les KPIs pour toutes les collectes d'une entreprise
    public static function getAllKpisForCompany(Company $company): array
    {
        return $company->collections()
            ->orderBy('day_start')
            ->get()
            ->map(fn($collection) => [
                'collection_id'     => $collection->id,
                'occupancy_rate'    => self::getOccupancyRate($collection),
                'non_eligible_rate' => self::getNonEligibleRate($collection),
                'cobrand_visit_rate' => self::getCobrandVisitRate($collection),
                'onedoc_visit_rate' => self::getOnedocVisitRate($collection),
            ])
            ->toArray();
    }
}
