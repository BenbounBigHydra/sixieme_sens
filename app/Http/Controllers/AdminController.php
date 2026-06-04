<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Collection;
use App\services\CompanyStatsService;
use App\services\AdminService;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'toClose' => AdminService::getCollectionsToClose(),
            'toCome' => AdminService::getCollectionsToCome(),
            'currentYearCollections' => AdminService::getCurrentYearCollections(),
            'participationRatio' => AdminService::getParticipationRatio(),
            'rigorRatio' => AdminService::getRigorRatio(),
        ];

        return view('admin.dashboard', ['initialData' => json_encode($data)]);
    }

    public function collections()
    {
        $data = [
            'collections' => AdminService::getCollectionsByStatus(),
        ];

        return view('admin.collections', ['initialData' => json_encode($data)]);
    }

    public function companies()
    {
        $data = [
            'companies' => AdminService::getCompaniesListing(),
        ];

        return view('admin.companies', ['initialData' => json_encode($data)]);
    }

    public function leaderboard()
    {
        $year = request()->query('year', Carbon::now()->year);

        $companies = Company::with('collections')->get();

        $kpis = $companies->mapWithKeys(fn($company) => [
            $company->id => [
                'name' => $company->name,
                'kpis' => CompanyStatsService::getAllKpisForCompany($company),
            ]
        ]);

        $data = [
            'gold'       => CompanyStatsService::getGoldWinnerData($year),
            'ambassador' => CompanyStatsService::getAmbassadorData($year),
            'conviction' => CompanyStatsService::getConvictionData($year),
            'kpis'       => $kpis,
        ];

        return view('admin.leaderboard', ['initialData' => json_encode($data)]);
    }

    public function editorialContent()
    {
        $data = [
            //Todo : Récupérer les données nécessaires pour la page du contenu éditorial
        ];

        return view('admin.editorialContent', ['initialData' => json_encode($data)]);
    }
}
