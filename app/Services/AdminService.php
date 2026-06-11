<?php

namespace App\Services;

use App\Models\Collection;
use Illuminate\Support\Carbon;
use App\Services\CompanyStatsService;
use App\Models\Company;

class AdminService
{
    /**
     * Récupère toutes les collectes passées dont les résultats ne sont pas complets.
     * Inclut les détails de la collecte et de l'entreprise liée.
     *
     * @return array
     */
    public static function getCollectionsToClose(): array
    {
        $toClose = Collection::with('company') // Charge la relation 'company' de la table companies
            ->where('day_end', '<', Carbon::now()) // Filtre sur les dates passées
            ->where(function ($query) {
                // Filtre si l'un des deux (ou les deux) champs est resté NULL en BDD
                $query->whereNull('nb_registered')
                    ->orWhereNull('nb_blood_pouch');
            })
            ->get();

        // Convertit la collection Eloquent (avec sa relation) en tableau pour le frontend
        return $toClose->toArray();
    }

    /**
     * Récupère toutes les collectes à venir (futures).
     * Inclut les détails de la collecte et de l'entreprise liée.
     *
     * @return array
     */
    public static function getCollectionsToCome(): array
    {
        return Collection::with('company') // Charge la relation de l'entreprise
            ->where('day_end', '>', Carbon::now()) // Filtre sur les dates futures
            ->orderBy('day_start', 'asc') // Trie de la plus proche à la plus lointaine
            ->get()
            ->toArray();
    }

    /**
     * Récupère toutes les collectes de l'année en cours.
     * Inclut les détails de la collecte et de l'entreprise liée.
     *
     * @return array
     */
    public static function getCurrentYearCollections(): array
    {
        return Collection::with('company') // Charge l'entreprise liée
            ->whereYear('day_start', Carbon::now()->year) // Filtre sur l'année en cours (ex: 2026)
            ->orderBy('day_start', 'asc') // Tri chronologique
            ->get()
            ->toArray();
    }

    /**
     * Calcule le taux de participation moyen global de l'année en cours,
     * ainsi que les 5 entreprises ayant le plus petit ratio.
     *
     * @return array
     */
    public static function getParticipationRatio(): array
    {
        // 1. Récupère toutes les collectes closes de l'année en cours
        $collections = Collection::with('company')
            ->whereYear('day_start', \Carbon\Carbon::now()->year) //
            ->whereNotNull('nb_registered') //
            ->whereNotNull('nb_blood_pouch') //
            ->where('nb_employee', '>', 0) // Sécurité division par zéro
            ->get();

        // Si aucune collecte n'est close, on retourne des valeurs vides pour éviter les erreurs
        if ($collections->isEmpty()) {
            return [
                'globalAverage' => 0,
                'lowestCompanies' => []
            ];
        }

        // 2. Calcul du taux de participation moyen de TOUTES les collectes confondues
        $globalAverage = $collections->avg(function ($collection) {
            return $collection->nb_blood_pouch / $collection->nb_employee; //
        });

        // 3. Calcul des moyennes par entreprise pour déterminer le "Flop 5"
        $lowestCompanies = $collections->groupBy('company_id')->map(function ($companyCollections) {
            $company = $companyCollections->first()->company;

            $averageRatio = $companyCollections->avg(function ($collection) {
                return $collection->nb_blood_pouch / $collection->nb_employee; //
            });

            return [
                'company' => $company ? $company->toArray() : null,
                'ratio'   => round($averageRatio, 4),
            ];
        })
            ->sortBy('ratio')
            ->take(5)
            ->values()
            ->all();

        // 4. On retourne le tout dans le tableau final 'participationRatio'
        return [
            'globalAverage'   => $globalAverage, // Le taux moyen global de l'année
            'lowestCompanies' => $lowestCompanies          // Les 5 moins bons élèves
        ];
    }

    /**
     * Calcule le taux de rigueur moyen global (poches de sang / inscrits) de l'année en cours,
     * ainsi que les 5 entreprises ayant le plus petit ratio.
     *
     * @return array
     */
    public static function getRigorRatio(): array
    {
        // 1. Récupère toutes les collectes closes de l'année en cours
        $collections = Collection::with('company')
            ->whereYear('day_start', \Carbon\Carbon::now()->year)
            ->whereNotNull('nb_registered')
            ->whereNotNull('nb_blood_pouch')
            ->get();

        // Si aucune collecte n'est close, on évite les erreurs
        if ($collections->isEmpty()) {
            return [
                'globalAverage' => 0,
                'lowestCompanies' => []
            ];
        }

        // 2. Calcul du taux de rigueur moyen de TOUTES les collectes confondues
        $globalAverage = $collections->avg(function ($collection) {
            return $collection->nb_blood_pouch / $collection->nb_registered;
        });

        // 3. Calcul des moyennes par entreprise pour déterminer le "Flop 5"
        $lowestCompanies = $collections->groupBy('company_id')->map(function ($companyCollections) {
            $company = $companyCollections->first()->company;

            $averageRatio = $companyCollections->avg(function ($collection) {
                return $collection->nb_blood_pouch / $collection->nb_registered;
            });

            return [
                'company' => $company ? $company->toArray() : null,
                'ratio'   => round($averageRatio, 4),
            ];
        })
            ->sortBy('ratio')
            ->take(5)
            ->values()
            ->all();

        // 4. Retourne la structure identique à participationRatio
        return [
            'globalAverage'   => round($globalAverage, 4), // Taux de rigueur global annuel
            'lowestCompanies' => $lowestCompanies          // Les 5 ratios les plus faibles
        ];
    }

    /**
     * Récupère la liste de toutes les entreprises avec leurs compteurs de collectes
     * ainsi que la liste de leurs trophées et labels obtenus.
     *
     * @return array
     */
    public static function getCompaniesListing(): array
    {
        $now = Carbon::now();

        // 1. Récupération de toutes les entreprises avec le compte ciblé des collectes
        $companies = Company::with('collections')
            ->withCount([
                'collections as to_come_count' => function ($query) use ($now) {
                    $query->where('day_start', '>', $now);
                },
                'collections as ongoing_count' => function ($query) use ($now) {
                    $query->where('day_start', '<=', $now)
                        ->where('day_end', '>=', $now);
                },
                'collections as to_close_count' => function ($query) use ($now) {
                    $query->where('day_end', '<', $now)
                        ->where(function ($q) {
                            $q->whereNull('nb_registered')->orWhereNull('nb_blood_pouch');
                        });
                },
                'collections as past_count' => function ($query) use ($now) {
                    $query->where('day_end', '<', $now)
                        ->whereNotNull('nb_registered')
                        ->whereNotNull('nb_blood_pouch');
                }
            ])
            ->orderBy('name', 'asc')
            ->get();

        // 2. Transformation des données selon le format optimal demandé
        return $companies->map(function (Company $company) use ($now) {

            $awardsData = CompanyStatsService::getCompanyAwards($company);

            $trophies = [];
            $labels = [];

            if (is_array($awardsData)) {
                foreach ($awardsData as $year => $rewards) {
                    // 1. Structure Trophées : Groupés par année [Année => ['type1', 'type2']]
                    if (!empty($rewards['gold'])) {
                        $trophies[$year][] = 'gold';
                    }
                    if (!empty($rewards['conviction'])) {
                        $trophies[$year][] = 'conviction';
                    }
                    if (!empty($rewards['ambassador'])) {
                        $trophies[$year][] = 'ambassador';
                    }

                    // 2. Structure Labels : Tableau plat d'années [2020, 2021, ...]
                    if (!empty($rewards['label'])) {
                        $labels[] = (int) $year;
                    }
                }
            }

            $participation = 0;
            $rigueur = 0;

            $pastCollections = $company->collections->filter(function ($c) {
                return !is_null($c->nb_registered) && !is_null($c->nb_blood_pouch) && $c->nb_employee > 0;
            });

            if ($pastCollections->count() > 0) {
                $participation = $pastCollections->avg(function ($c) {
                    return $c->nb_blood_pouch / $c->nb_employee;
                });
                $rigueur = $pastCollections->avg(function ($c) {
                    return $c->nb_registered > 0 ? ($c->nb_blood_pouch / $c->nb_registered) : 0;
                });
            }

            $lastCollection = $company->collections->where('day_start', '<', $now)->sortByDesc('day_start')->first();

            // Retour du tableau final nettoyé
            return [
                'id'          => $company->id,
                'name'        => $company->name,
                'slug'        => $company->slug,
                'logo'        => $company->logo,
                'color'       => $company->color,
                'sector'      => $company->sector,
                'employee_count' => $company->employee_count,
                'contact_name' => $company->contact_name,
                'contact_phone' => $company->contact_phone,
                'contact_email' => $company->contact_email,
                'is_labelled' => $company->is_labelled,
                'trophies_count' => $company->trophies_count,
                'last_collection_date' => $lastCollection ? $lastCollection->day_start->format('d.m.Y') : null,
                'collections_total' => $company->collections->count(),
                'collections' => [ // Renommé 'stats' en 'collections'
                    'to_come'  => $company->to_come_count,
                    'to_close' => $company->to_close_count,
                    'past'     => $company->past_count,
                    'ongoing'  => $company->ongoing_count,
                ],
                'participation' => round($participation, 4),
                'rigueur'       => round($rigueur, 4),
                'trophies'    => $trophies, // Objet associatif { "2023": ["gold", "conviction"] }
                'labels'      => $labels,   // Tableau plat [2020, 2021, 2022]
            ];
        })->toArray();
    }

    public static function getCollectionsByStatus(int $year = null): ?array
    {
        $now = Carbon::now();
        $year = $year ?? Carbon::now()->year;

        $collections = Collection::with('company')
            ->whereYear('day_start', $year)
            ->orderBy('day_start', 'asc')
            ->get();

        // Collectes à clore (passées + incomplètes)
        $toClose = $collections->filter(function ($collection) use ($now) {
            $isPast = Carbon::parse($collection->day_end)->isPast();
            $isIncomplete = is_null($collection->nb_registered) || is_null($collection->nb_blood_pouch);

            return $isPast && $isIncomplete;
        })->values()->toArray();

        // Collectes en cours (day_start <= aujourd'hui <= day_end)
        $ongoing = $collections->filter(function ($collection) use ($now) {
            return Carbon::parse($collection->day_start)->isPast()
                && Carbon::parse($collection->day_end)->isFuture();
        })->values()->toArray();

        // Collectes à venir (day_start dans le futur)
        $toCome = $collections->filter(function ($collection) use ($now) {
            return Carbon::parse($collection->day_start)->isFuture();
        })->values()->toArray();

        // Collectes passées (passées + complètes)
        $past = $collections->filter(function ($collection) use ($now) {
            $isPast = Carbon::parse($collection->day_end)->isPast();
            $isComplete = !is_null($collection->nb_registered) && !is_null($collection->nb_blood_pouch);

            return $isPast && $isComplete;
        })->values()->toArray();

        return [
            'to_close' => $toClose,
            'ongoing'  => $ongoing,
            'to_come'  => $toCome,
            'past'     => $past,
        ];
    }
}
