<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collection;
use App\Services\CompanyStatsService;
use Illuminate\Support\Carbon;

class VitrinController extends Controller
{
    public function home()
    {
        $year = Carbon::now()->subYear()->year;

        $year = (Carbon::now()->month === 1) ? $year - 1 : $year;

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
        $years = CompanyStatsService::getTrophiedYears();

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
        $now = Carbon::now();

        $companies = CompanyStatsService::getLabelledCompanies($now->year)
            ->merge(CompanyStatsService::getLabelledCompanies($now->year - 1))
            ->unique('name');

        $data = $companies->map(fn($company) => [
            'name'   => $company['name'],
            'logo'   => $company['logo'],
            // 'awards' => CompanyStatsService::getCompanyAwards($company),
        ]);

        return view('vitrin.label', ['initialData' => json_encode($data)]);
    }

    public function companies()
    {
        $years = CompanyStatsService::getActivesYears();

        $data = [];

        foreach ($years as $year) {
            $labelled = CompanyStatsService::getLabelledCompanies($year);
            $hasTrophies = in_array($year, CompanyStatsService::getTrophiedYears());

            $data[$year] = $labelled->map(fn($company) => [
                'name'       => $company['name'],
                'logo'       => $company['logo'],
                'gold'       => $hasTrophies && CompanyStatsService::getGoldWinner($year) === $company['name'],
                'conviction' => $hasTrophies && CompanyStatsService::getConviction($year) === $company['name'],
                'ambassador' => $hasTrophies && CompanyStatsService::getAmbassador($year) === $company['name'],
            ])->values();
        }

        return view('vitrin.companies', ['initialData' => json_encode($data)]);
    }

    public function quizz()
    {
        return view('vitrin.quizz');
    }

    public function contact()
    {
        return view('vitrin.contact');
    }

    public function mentions()
    {
        return view('vitrin.mentions', ['hideHeaderFooter' => true]);
    }

    public function politique()
    {
        return view('vitrin.politique', ['hideHeaderFooter' => true]);
    }

    public function cookies()
    {
        return view('vitrin.cookies', ['hideHeaderFooter' => true]);
    }
}
