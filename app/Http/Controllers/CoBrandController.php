<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collection;
use App\Services\CompanyStatsService;


class CoBrandController extends Controller
{
    public function home(string $company_name, int $collection_id)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();
        $collection = Collection::where('id', $collection_id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        if ($this->checkOpenCollection($collection)) {
            return redirect()->route('cobrand.closed', ['company_name' => $company->slug]);
        }

        $initialData = json_encode(['collection' => $collection, 'company' =>  $company]);

        return view('cobrand.home', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    public function infos(string $company_name, int $collection_id)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();
        $collection = Collection::where('id', $collection_id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        if ($this->checkOpenCollection($collection)) {
            return redirect()->route('cobrand.closed', ['company_name' => $company->slug]);
        }

        $initialData = json_encode(['collection' => $collection, 'company' =>  $company]);

        return view('cobrand.infos', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    public function quizz(string $company_name, int $collection_id)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();
        $collection = Collection::where('id', $collection_id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        if ($this->checkOpenCollection($collection)) {
            return redirect()->route('cobrand.closed', ['company_name' => $company->slug]);
        }

        $initialData = json_encode([
            'onedoc_link' => $collection->onedoc_link,
            'company' => $company,
            'collection' => $collection
        ]);

        return view('cobrand.quizz', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    public function closed(string $company_name)
    {
        $company = Company::where('slug', $company_name)->firstOrFail();

        $collection = Collection::where('company_id', $company->id)
            ->where('day_end', '>', now())
            ->orderBy('day_start', 'asc')
            ->first();

        if ($collection) {
            $initialData = json_encode(['url' => $company_name . '/' . $collection->id, 'company' => $company]);
        } else {
            $initialData = json_encode(['url' => null, 'company' => $company]);
        }

        return view('cobrand.closed', [
            'companyName' => $company['name'],
            'initialData' => $initialData,
        ]);
    }

    private function checkOpenCollection(Collection $collection): bool
    {
        return $collection->day_end < now();
    }
}
