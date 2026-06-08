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
            'capacity'       => 'required|integer|min:0|gte:nb_employee',
            'nb_registered'  => 'required|integer|min:0',
            'nb_blood_pouch' => 'required|integer|min:0|lte:nb_registered',
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
