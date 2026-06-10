<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Collection;
use App\Services\CompanyStatsService;
use App\Services\AdminService;
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
            'availableYears' => CompanyStatsService::getActivesYears(),
            'collections' => AdminService::getCollectionsByStatus(),
            'companies' => Company::select('id', 'name')->orderBy('name', 'asc')->get(),
        ];

        // dd($data);

        return view('admin.collections', ['initialData' => json_encode($data)]);
    }

    public function companies()
    {
        $data = [
            'companies' => AdminService::getCompaniesListing(),
        ];

        return view('admin.companies', ['initialData' => json_encode($data)]);
    }

    public function result()
    {
        $year = request()->query('year', Carbon::now()->year);

        $companies = Company::with('collections')->get();

        $kpis = $companies->mapWithKeys(fn($company) => [
            $company->id => [
                'name' => $company->name,
                'kpis' => CompanyStatsService::getAllKpisForCompany($company, $year),
            ]
        ]);

        $data = [
            'availableYears' => CompanyStatsService::getActivesYears(),
            'gold'       => CompanyStatsService::getGoldWinnerData($year),
            'ambassador' => CompanyStatsService::getAmbassadorData($year),
            'conviction' => CompanyStatsService::getConvictionData($year),
            'kpis'       => $kpis,
        ];

        // dd($data);

        return view('admin.result', ['initialData' => json_encode($data)]);
    }
}
