<?php

namespace App\Services;

use App\Models\Collection;
use Carbon\Carbon;

class AdminService
{
    /**
     * Récupère toutes les collectes passées dont les résultats ne sont pas complets.
     * Inclut les détails de la collecte et de l'entreprise liée.
     *
     * @return array
     */
    public static function getCollectionsToClose(): array
    {
        $toClose = Collection::with('company') // Charge la relation 'company' de la table companies
            ->where('day_end', '<', Carbon::now()) // Filtre sur les dates passées
            ->where(function ($query) {
                // Filtre si l'un des deux (ou les deux) champs est resté NULL en BDD
                $query->whereNull('nb_registered')
                      ->orWhereNull('nb_blood_pouch');
            })
            ->get();

        // Convertit la collection Eloquent (avec sa relation) en tableau pour le frontend
        return $toClose->toArray();
    }

    /**
     * Récupère toutes les collectes à venir (futures).
     * Inclut les détails de la collecte et de l'entreprise liée.
     *
     * @return array
     */
    public static function getCollectionsToCome(): array
    {
        return Collection::with('company') // Charge la relation de l'entreprise
            ->where('day_end', '>', Carbon::now()) // Filtre sur les dates futures
            ->orderBy('day_start', 'asc') // Trie de la plus proche à la plus lointaine
            ->get()
            ->toArray();
    }

    /**
     * Récupère toutes les collectes de l'année en cours.
     * Inclut les détails de la collecte et de l'entreprise liée.
     *
     * @return array
     */
    public static function getCurrentYearCollections(): array
    {
        return Collection::with('company') // Charge l'entreprise liée
            ->whereYear('day_start', Carbon::now()->year) // Filtre sur l'année en cours (ex: 2026)
            ->orderBy('day_start', 'asc') // Tri chronologique
            ->get()
            ->toArray();
    }

    /**
     * Calcule le taux de participation moyen global de l'année en cours,
     * ainsi que les 5 entreprises ayant le plus petit ratio.
     *
     * @return array
     */
    public static function getParticipationRatio(): array
    {
        // 1. Récupère toutes les collectes closes de l'année en cours
        $collections = Collection::with('company')
            ->whereYear('day_start', \Carbon\Carbon::now()->year) //
            ->whereNotNull('nb_registered') //
            ->whereNotNull('nb_blood_pouch') //
            ->where('nb_employee', '>', 0) // Sécurité division par zéro
            ->get();

        // Si aucune collecte n'est close, on retourne des valeurs vides pour éviter les erreurs
        if ($collections->isEmpty()) {
            return [
                'globalAverage' => 0,
                'lowestCompanies' => []
            ];
        }

        // 2. Calcul du taux de participation moyen de TOUTES les collectes confondues
        $globalAverage = $collections->avg(function ($collection) {
            return $collection->nb_blood_pouch / $collection->nb_employee; //
        });

        // 3. Calcul des moyennes par entreprise pour déterminer le "Flop 5"
        $lowestCompanies = $collections->groupBy('company_id')->map(function ($companyCollections) {
            $company = $companyCollections->first()->company;

            $averageRatio = $companyCollections->avg(function ($collection) {
                return $collection->nb_blood_pouch / $collection->nb_employee; //
            });

            return [
                'company' => $company ? $company->toArray() : null,
                'ratio'   => round($averageRatio, 4),
            ];
        })
        ->sortBy('ratio')
        ->take(5)
        ->values()
        ->all();

        // 4. On retourne le tout dans le tableau final 'participationRatio'
        return [
            'globalAverage'   => $globalAverage, // Le taux moyen global de l'année
            'lowestCompanies' => $lowestCompanies          // Les 5 moins bons élèves
        ];
    }

    /**
     * Calcule le taux de rigueur moyen global (poches de sang / inscrits) de l'année en cours,
     * ainsi que les 5 entreprises ayant le plus petit ratio.
     *
     * @return array
     */
    public static function getRigorRatio(): array
    {
        // 1. Récupère toutes les collectes closes de l'année en cours
        $collections = Collection::with('company')
            ->whereYear('day_start', \Carbon\Carbon::now()->year)
            ->whereNotNull('nb_registered')
            ->whereNotNull('nb_blood_pouch')
            ->get();

        // Si aucune collecte n'est close, on évite les erreurs
        if ($collections->isEmpty()) {
            return [
                'globalAverage' => 0,
                'lowestCompanies' => []
            ];
        }

        // 2. Calcul du taux de rigueur moyen de TOUTES les collectes confondues
        $globalAverage = $collections->avg(function ($collection) {
            return $collection->nb_blood_pouch / $collection->nb_registered;
        });

        // 3. Calcul des moyennes par entreprise pour déterminer le "Flop 5"
        $lowestCompanies = $collections->groupBy('company_id')->map(function ($companyCollections) {
            $company = $companyCollections->first()->company;

            $averageRatio = $companyCollections->avg(function ($collection) {
                return $collection->nb_blood_pouch / $collection->nb_registered;
            });

            return [
                'company' => $company ? $company->toArray() : null,
                'ratio'   => round($averageRatio, 4),
            ];
        })
        ->sortBy('ratio')
        ->take(5)
        ->values()
        ->all();

        // 4. Retourne la structure identique à participationRatio
        return [
            'globalAverage'   => round($globalAverage, 4), // Taux de rigueur global annuel
            'lowestCompanies' => $lowestCompanies          // Les 5 ratios les plus faibles
        ];
    }
}
