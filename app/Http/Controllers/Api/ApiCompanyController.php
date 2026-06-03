<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Company;
use Illuminate\Support\Str;
use App\Services\CompanyStatsService;
use App\Services\AdminService;

use Illuminate\Http\Request;

class ApiCompanyController extends Controller
{
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return response()->json($company);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|unique:companies,name',
            'logo'  => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'color' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time()
                . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/companies_logo'), $filename);
            $validated['logo'] = 'images/companies_logo/' . $filename;
        }

        $company = Company::create($validated);

        return response()->json($company, 201);
    }


    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'name'  => 'sometimes|string|unique:companies,name,' . $id,
            'logo'  => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'color' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            // Supprime l'ancien logo s'il existe
            if ($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }

            $file = $request->file('logo');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time()
                . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/companies_logo'), $filename);
            $validated['logo'] = 'images/companies_logo/' . $filename;
        }

        $company->update($validated);

        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json(null, 204);
    }
}
