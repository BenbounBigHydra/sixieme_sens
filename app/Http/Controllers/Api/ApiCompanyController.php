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
            'name'           => 'required|string|unique:companies,name',
            'logo'           => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'color'          => 'nullable|string',
            'sector'         => 'nullable|string',
            'employee_count' => 'nullable|integer',
            'contact_name'   => 'nullable|string',
            'contact_phone'  => 'nullable|string',
            'contact_email'  => 'nullable|email',
            'is_labelled'    => 'boolean',
            'trophies_count' => 'nullable|integer',
        ], [
            'name.required'          => 'Le nom de l\'entreprise est obligatoire.',
            'name.string'            => 'Le nom de l\'entreprise doit être une chaîne de caractères.',
            'name.unique'            => 'Ce nom d\'entreprise est déjà utilisé.',

            'logo.file'              => 'Le logo doit être un fichier.',
            'logo.mimes'             => 'Le logo doit être au format JPG, JPEG, PNG, SVG ou WEBP.',
            'logo.max'               => 'Le logo ne doit pas dépasser 2 Mo.',

            'color.string'           => 'La couleur doit être une chaîne de caractères.',
            'sector.string'          => 'Le secteur doit être une chaîne de caractères.',

            'employee_count.integer' => 'Le nombre d\'employés doit être un nombre entier.',

            'contact_name.string'    => 'Le nom du contact doit être une chaîne de caractères.',
            'contact_phone.string'   => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'contact_email.email'    => 'L\'adresse email du contact n\'est pas valide.',

            'is_labelled.boolean'    => 'Le champ "labellisé" doit être vrai ou faux.',

            'trophies_count.integer' => 'Le nombre de trophées doit être un nombre entier.',
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
            'name'           => 'sometimes|string|unique:companies,name,' . $id,
            'logo'           => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'color'          => 'nullable|string',
            'sector'         => 'nullable|string',
            'employee_count' => 'nullable|integer',
            'contact_name'   => 'nullable|string',
            'contact_phone'  => 'nullable|string',
            'contact_email'  => 'nullable|email',
            'is_labelled'    => 'boolean',
            'trophies_count' => 'nullable|integer',
        ], [
            'name.string'            => 'Le nom de l\'entreprise doit être une chaîne de caractères.',
            'name.unique'            => 'Ce nom d\'entreprise est déjà utilisé par une autre entreprise.',

            'logo.file'              => 'Le logo doit être un fichier.',
            'logo.mimes'             => 'Le logo doit être au format JPG, JPEG, PNG, SVG ou WEBP.',
            'logo.max'               => 'Le logo ne doit pas dépasser 2 Mo.',

            'color.string'           => 'La couleur doit être une chaîne de caractères.',
            'sector.string'          => 'Le secteur doit être une chaîne de caractères.',

            'employee_count.integer' => 'Le nombre d\'employés doit être un nombre entier.',

            'contact_name.string'    => 'Le nom du contact doit être une chaîne de caractères.',
            'contact_phone.string'   => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'contact_email.email'    => 'L\'adresse email du contact n\'est pas valide.',

            'is_labelled.boolean'    => 'Le champ "labellisé" doit être vrai ou faux.',

            'trophies_count.integer' => 'Le nombre de trophées doit être un nombre entier.',
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
