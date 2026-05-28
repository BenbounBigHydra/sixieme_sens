<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collection;
use App\Services\CompanyStatsService;


class VitrinController extends Controller
{
    public function home()
    {
        $data = [
            'nb_collections' => CompanyStatsService::getNbCollections(),
            'nb_companies'   => CompanyStatsService::getNbCompanies(),
            'winner'         => [
                'gold'       => CompanyStatsService::getGoldWinner(),
                'ambassador' => CompanyStatsService::getAmbassador(),
                'conviction' => CompanyStatsService::getConviction(),
            ],
        ];

        return view('vitrin.home', ['initialData' => json_encode($data)]);
    }

    public function trophies()
    {
        $data = [
            // 'nb_collections' => CompanyStatsService::getNbCollections(),
            // 'nb_companies'   => CompanyStatsService::getNbCompanies(),
            'winner'         => [
                'gold'       => CompanyStatsService::getGoldWinner(),
                'ambassador' => CompanyStatsService::getAmbassador(),
                'conviction' => CompanyStatsService::getConviction(),
            ],
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
        $companies = CompanyStatsService::getLabelledCompanies();

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
