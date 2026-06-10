<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyStatsService;
use Illuminate\Support\Carbon;
use App\Models\Company;

class ApiRewardsController extends Controller
{
    public function winner($year = null)
    {
        $now = Carbon::now();

        if ($year === null) {
            $offset = $now->month === 1 ? 2 : 1;
            $year = $now->year - $offset;
        } else {
            $year = (int) $year;
        }

        if ($now->month === 1 && $year === $now->year - 1) {
            return   response()->json("En janvier, l'annee {$year} n'est pas encore disponible.");
        } elseif ($year === $now->year) {
            return response()->json("L'annee {$year} n'est pas encore disponible.");
        }

        $data = [
            'winner'         => [
                'gold'       => CompanyStatsService::getGoldWinner($year),
                'ambassador' => CompanyStatsService::getAmbassador($year),
                'conviction' => CompanyStatsService::getConviction($year),
            ],
        ];

        return response()->json($data);
    }

    public function labelledCompanies($year = null)
    {
        $companies = CompanyStatsService::getLabelledCompanies($year);

        $data = $companies->map(fn($company) => [
            'name'   => $company->name,
            'logo'   => $company->logo,
            'awards' => CompanyStatsService::getCompanyAwards($company),
        ]);

        return response()->json($data);
    }

    public function result($year)
    {
        $companies = Company::with('collections')->get();

        $kpis = $companies->mapWithKeys(fn($company) => [
            $company->id => [
                'name' => $company->name,
                'kpis' => CompanyStatsService::getAllKpisForCompany($company, $year),
            ]
        ]);

        $data = [
            'gold'       => CompanyStatsService::getGoldWinnerData($year),
            'ambassador' => CompanyStatsService::getAmbassadorData($year),
            'conviction' => CompanyStatsService::getConvictionData($year),
            'kpis'       => $kpis,
        ];

        return response()->json($data);
    }
}
