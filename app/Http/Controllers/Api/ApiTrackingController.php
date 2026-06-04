<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Services\TrackingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiTrackingController extends Controller
{
    public function __construct(private TrackingService $tracker) {}

    public function trackOnedocClick(Request $request, int $collection_id): JsonResponse
    {
        $collection = Collection::findOrFail($collection_id);

        $response = response()->json(['success' => true]);

        if ($this->tracker->isNewOnedocClick($request, $collection_id)) {
            $collection->increment('onedoc_click_count');
            $response = $this->tracker->attachOnedocCookie($response, $collection_id);
        }

        return $response;
    }
}
