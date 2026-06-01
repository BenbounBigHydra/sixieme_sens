<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collection;
use App\Services\CompanyStatsService;


class VitrinController extends Controller
{
    public function home()
    {
        $year = \Illuminate\Support\Carbon::now()->subYear()->year;

        $data = [
            'year'           => $year,
            'nb_collections' => CompanyStatsService::getNbCollections(),
            'nb_companies'   => CompanyStatsService::getNbCompanies(),
            'winner'         => [
                'gold'       => CompanyStatsService::getGoldWinner($year),
                'ambassador' => CompanyStatsService::getAmbassador($year),
                'conviction' => CompanyStatsService::getConviction($year),
            ],
        ];

        return view('vitrin.home', ['initialData' => json_encode($data)]);
    }

    public function trophies()
    {
        $years = range(2025, 2020);
        $palmares = [];

        foreach ($years as $y) {
            $palmares[$y] = [
                'gold' => CompanyStatsService::getGoldWinnerData($y),
                'ambassador' => CompanyStatsService::getAmbassadorData($y),
                'conviction' => CompanyStatsService::getConvictionData($y),
            ];
        }

        $data = [
            'palmares' => $palmares,
        ];

        return view('vitrin.trophies', ['initialData' => json_encode($data)]);
    }

    public function label()
    {
        $companies = CompanyStatsService::getLabelledCompanies();

        $data = $companies->map(fn($company) => [
            'name'   => $company->name,
            'logo'   => $company->logo,
            // 'color'  => $company->color,
            'awards' => CompanyStatsService::getCompanyAwards($company),
        ]);

        return view('vitrin.label', ['initialData' => json_encode($data)]);
    }

    public function companies()
    {
        $companies = \App\Models\Company::all();

        $data = $companies->map(fn($company) => [
            'name'   => $company->name,
            'logo'   => $company->logo,
            // 'color'  => $company->color,
            'awards' => CompanyStatsService::getCompanyAwards($company),
        ]);

        return view('vitrin.companies', ['initialData' => json_encode($data)]);
    }

    public function contact()
    {
        return view('vitrin.contact');
    }
}
