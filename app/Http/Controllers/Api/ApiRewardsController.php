<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyStatsService;

class ApiRewardsController extends Controller
{
    public function winner($year = null)
    {
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
            // 'color'  => $company->color,
            'awards' => CompanyStatsService::getCompanyAwards($company),
        ]);

        return response()->json($data);
    }
}
