<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Company;
use Illuminate\Support\Str;
use App\Services\CompanyStatsService;
use App\Services\AdminService;

use Illuminate\Http\Request;

class ApiCollectionController extends Controller
{
    public function show(int $id)
    {
        $collection = Collection::findOrFail($id)->load('company');
        return response()->json($collection);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id'     => 'required|exists:companies,id',
            'day_start'      => 'required|date|after:today',
            'day_end'        => 'required|date|after_or_equal:day_start',
            'location'       => 'required|string',
            'hour_start'     => 'required|date_format:H:i:s',
            'hour_end'       => 'required|date_format:H:i:s|after:hour_start',
            'capacity'       => 'required|integer|min:0',
            'nb_employee'    => 'required|integer|min:0',
            'onedoc_link'    => 'required|url',
        ], [
            'company_id.required'    => 'L\'entreprise est obligatoire.',
            'company_id.exists'      => 'L\'entreprise sélectionnée n\'existe pas.',

            'day_start.required'     => 'La date de début est obligatoire.',
            'day_start.date'         => 'La date de début n\'est pas une date valide.',
            'day_start.after'        => 'La date de début doit être postérieure à aujourd\'hui.',

            'day_end.required'       => 'La date de fin est obligatoire.',
            'day_end.date'           => 'La date de fin n\'est pas une date valide.',
            'day_end.after_or_equal' => 'La date de fin doit être égale ou postérieure à la date de début.',

            'location.required'      => 'Le lieu est obligatoire.',
            'location.string'        => 'Le lieu doit être une chaîne de caractères.',

            'hour_start.required'    => 'L\'heure de début est obligatoire.',
            'hour_start.date_format' => 'L\'heure de début doit être au format HH:MM:SS.',

            'hour_end.required'      => 'L\'heure de fin est obligatoire.',
            'hour_end.date_format'   => 'L\'heure de fin doit être au format HH:MM:SS.',
            'hour_end.after'         => 'L\'heure de fin doit être postérieure à l\'heure de début.',

            'capacity.required'      => 'La capacité est obligatoire.',
            'capacity.integer'       => 'La capacité doit être un nombre entier.',
            'capacity.min'           => 'La capacité ne peut pas être négative.',

            'nb_employee.required'   => 'Le nombre d\'employés est obligatoire.',
            'nb_employee.integer'    => 'Le nombre d\'employés doit être un nombre entier.',
            'nb_employee.min'        => 'Le nombre d\'employés ne peut pas être négatif.',

            'onedoc_link.required'   => 'Le lien OneDoc est obligatoire.',
            'onedoc_link.url'        => 'Le lien OneDoc doit être une URL valide (ex: https://...).',
        ]);

        $collection = Collection::create($validated);

        return response()->json($collection, 201);
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);

        $validated = $request->validate([
            'company_id'     => 'sometimes|exists:companies,id',
            'day_start'      => 'sometimes|date|after:today',
            'day_end'        => 'sometimes|date|after_or_equal:day_start',
            'location'       => 'sometimes|string',
            'hour_start'     => 'sometimes|date_format:H:i:s',
            'hour_end'       => 'sometimes|date_format:H:i:s|after:hour_start',
            'capacity'       => 'sometimes|integer|min:0',
            'nb_employee'    => 'sometimes|integer|min:0',
            'onedoc_link'    => 'sometimes|url',
        ], [
            'company_id.exists'      => 'L\'entreprise sélectionnée n\'existe pas.',

            'day_start.date'         => 'La date de début n\'est pas une date valide.',
            'day_start.after'        => 'La date de début doit être postérieure à aujourd\'hui.',

            'day_end.date'           => 'La date de fin n\'est pas une date valide.',
            'day_end.after_or_equal' => 'La date de fin doit être égale ou postérieure à la date de début.',

            'location.string'        => 'Le lieu doit être une chaîne de caractères.',

            'hour_start.date_format' => 'L\'heure de début doit être au format HH:MM:SS.',

            'hour_end.date_format'   => 'L\'heure de fin doit être au format HH:MM:SS.',
            'hour_end.after'         => 'L\'heure de fin doit être postérieure à l\'heure de début.',

            'capacity.integer'       => 'La capacité doit être un nombre entier.',
            'capacity.min'           => 'La capacité ne peut pas être négative.',

            'nb_employee.integer'    => 'Le nombre d\'employés doit être un nombre entier.',
            'nb_employee.min'        => 'Le nombre d\'employés ne peut pas être négatif.',

            'onedoc_link.url'        => 'Le lien OneDoc doit être une URL valide (ex: https://...).',
        ]);

        $collection->update($validated);

        return response()->json($collection);
    }

    public function destroy(int $id)
    {
        $collection = Collection::findOrFail($id);
        $collection->delete();

        return response()->json(null, 204);
    }

    public function close(Request $request, int $id)
    {
        $collection = Collection::findOrFail($id);

        if ($collection->day_end->isFuture()) {
            return response()->json(['error' => 'La collecte n\'est pas encore terminée.'], 422);
        }

        $validated = $request->validate([
            'nb_registered'  => ['required', 'integer', 'min:0', 'max:' . $collection->capacity],
            'nb_blood_pouch' => 'required|integer|min:0|lte:nb_registered',
        ], [
            'nb_registered.required'   => 'Le nombre d\'inscrits est obligatoire.',
            'nb_registered.integer'    => 'Le nombre d\'inscrits doit être un nombre entier.',
            'nb_registered.min'        => 'Le nombre d\'inscrits ne peut pas être négatif.',
            'nb_registered.max'        => 'Le nombre d\'inscrits ne peut pas dépasser la capacité de la collecte (' . $collection->capacity . ').',

            'nb_blood_pouch.required'  => 'Le nombre de poches de sang est obligatoire.',
            'nb_blood_pouch.integer'   => 'Le nombre de poches de sang doit être un nombre entier.',
            'nb_blood_pouch.min'       => 'Le nombre de poches de sang ne peut pas être négatif.',
            'nb_blood_pouch.lte'       => 'Le nombre de poches de sang ne peut pas dépasser le nombre d\'inscrits.',
        ]);

        $collection->update($validated);

        return response()->json($collection);
    }

    public function index($year = null)
    {
        $collections = AdminService::getCollectionsByStatus($year);

        return response()->json($collections);
    }
}
