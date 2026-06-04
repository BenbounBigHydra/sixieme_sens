<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrackingService
{
    /**
     * Vérifie si ce visiteur a déjà été compté pour cette collection.
     */
    public function isNewVisitor(Request $request, int $collectionId): bool
    {
        return !$request->cookie($this->cookieKey($collectionId));
    }

    /**
     * Attache le cookie de tracking à une response.
     */
    public function attachCookie(mixed $response, int $collectionId): mixed
    {
        return $response->cookie(
            $this->cookieKey($collectionId),
            '1',
            60 * 24 * 30,
            null,
            null,
            false,
            true
        );
    }

    public function isNewOnedocClick(Request $request, int $collectionId): bool
    {
        return !$request->cookie('clicked_onedoc_' . $collectionId);
    }

    public function attachOnedocCookie(mixed $response, int $collectionId): mixed
    {
        return $response->cookie(
            'clicked_onedoc_' . $collectionId,
            '1',
            60 * 24 * 30,
            null,
            null,
            false,
            true
        );
    }

    private function cookieKey(int $collectionId): string
    {
        return 'visited_collection_' . $collectionId;
    }
}
