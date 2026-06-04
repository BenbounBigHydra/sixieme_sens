<?php

namespace App\Http\Controllers\Middleware;

use App\Services\TrackingService;
use App\Models\Collection;
use Closure;
use Illuminate\Http\Request;

class TrackCollectionVisit
{
    public function __construct(private TrackingService $tracker) {}

    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        $id = (int) $request->route('collection_id');

        if ($id && $this->tracker->isNewVisitor($request, (int) $id)) {
            Collection::where('id', $id)->increment('visitor_count');
            $response = $this->tracker->attachCookie($response, $id);
        }

        return $response;
    }
}
