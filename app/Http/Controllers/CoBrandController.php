<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collection;
use App\Services\CompanyStatsService;


class CoBrandController extends Controller
{
    public function home($company_name, $collection_id)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();
        $collection = Collection::findOrFail($collection_id);

        $this->checkOpenCollection($collection);

        $initialData = json_encode(['collection' => $collection, 'company' =>  $company]);

        return view('cobrand.home', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    public function infos($company_name, $collection_id)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();
        $collection = Collection::findOrFail($collection_id);

        $this->checkOpenCollection($collection);

        $initialData = json_encode(['collection' => $collection, 'company' =>  $company]);

        return view('cobrand.home', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    public function quizz($company_name, $collection_id)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();

        $collection = Collection::findOrFail($collection_id);

        $this->checkOpenCollection($collection);

        $initialData = json_encode(['onedoc_link' => $collection->onedoc_link]);

        return view('cobrand.home', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    private function checkOpenCollection(Collection $collection)
    {
        if ($collection->end < now()) {
            abort(404);
        }
    }
}
