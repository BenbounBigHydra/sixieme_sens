<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Nettoyage préalable pour éviter les duplications
        // DB::table('collections')->truncate();
        // DB::table('companies')->truncate();
        // DB::table('users')->truncate();

        DB::table('users')->insert([
            'email'      => 'admin@hug.ch',
            'password'   => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $onedoc = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ&pp=ygUIcmlja3JvbGw%3D';

        // =====================================================================
        // DEFINITION DES ENTREPRISES (Toutes configurées à min. 1000 employés)
        // =====================================================================
        $companiesData = [
            'EPFL'        => ['color' => 'FF0000', 'ext' => 'png', 'loc' => 'Rolex Learning Center'],
            'HEIG-VD'     => ['color' => '0000FF', 'ext' => 'png', 'loc' => 'Campus HEIG-VD'],
            'UNIL'        => ['color' => '00AA44', 'ext' => 'png', 'loc' => 'Campus Dorigny'],
            'Nestlé'      => ['color' => 'FFAA00', 'ext' => 'png', 'loc' => 'Nestlé HQ Vevey'],
            'Swisscom'    => ['color' => '0099CC', 'ext' => 'png', 'loc' => 'Swisscom Campus Berne'],
            'BCGE'        => ['color' => '1A365D', 'ext' => 'png', 'loc' => 'Siège Genève'],
            'Benevity'    => ['color' => 'E53E3E', 'ext' => 'png', 'loc' => 'Bureaux Genève'],
            'Breitling'   => ['color' => 'D69E2E', 'ext' => 'png', 'loc' => 'Ateliers Grenchen'],
            'Capco'       => ['color' => '000000', 'ext' => 'png', 'loc' => 'Espace Co-working'],
            'Celanese'    => ['color' => '2B6CB0', 'ext' => 'png', 'loc' => 'Site industriel'],
            'Coop'        => ['color' => 'DD6B20', 'ext' => 'png', 'loc' => 'Centre Logistique'],
            'Croix-Rouge' => ['color' => 'E53E3E', 'ext' => 'png', 'loc' => 'Centrale Berne'],
            'Datatonic'   => ['color' => '319795', 'ext' => 'png', 'loc' => 'Tech Hub'],
            'Edwards Lifesciences' => ['color' => '4A5568', 'ext' => 'png', 'loc' => 'Campus Nyon'],
            'Fortil'      => ['color' => '233758', 'ext' => 'png', 'loc' => 'Bureaux Lausanne'],
            'Migros'      => ['color' => 'ED8936', 'ext' => 'png', 'loc' => 'Administration Centrale'],
            'Nespresso'   => ['color' => '1A1A1A', 'ext' => 'png', 'loc' => 'Centre Avenches'],
            'Rolex'       => ['color' => '22543D', 'ext' => 'png', 'loc' => 'Site Acacias'],
            'Seedstar'    => ['color' => '4C51BF', 'ext' => 'png', 'loc' => 'Espace Innovation'],
            'Toblerone'   => ['color' => 'ECC94B', 'ext' => 'png', 'loc' => 'Usine Berne'],
            'UBS'         => ['color' => 'A0AEC0', 'ext' => 'png', 'loc' => 'UBS Centre Zurich'],
            'Unilabs'     => ['color' => '3182CE', 'ext' => 'png', 'loc' => 'Laboratoire Central'],
            'Verysell'    => ['color' => '805AD5', 'ext' => 'webp', 'loc' => 'Bureaux Nyon'],
        ];

        // =====================================================================
        // LES COLLECTES MANUELLES REPRISES (Ajustées si incohérences de base)
        // =====================================================================
        $manualCollections = [
            'EPFL' => [
                ['date' => '2020-02-05', 'registered' => 250, 'pouches' => 200, 'capacity' => 300],
                ['date' => '2020-09-15', 'registered' => 240, 'pouches' => 195, 'capacity' => 310],
                ['date' => '2021-03-18', 'registered' => 270, 'pouches' => 220, 'capacity' => 320],
                ['date' => '2021-10-06', 'registered' => 260, 'pouches' => 215, 'capacity' => 330],
                ['date' => '2022-04-07', 'registered' => 290, 'pouches' => 245, 'capacity' => 340],
                ['date' => '2022-11-03', 'registered' => 280, 'pouches' => 240, 'capacity' => 350],
                ['date' => '2023-03-14', 'registered' => 430, 'pouches' => 420, 'capacity' => 500],
                ['date' => '2023-09-20', 'registered' => 380, 'pouches' => 350, 'capacity' => 510],
                ['date' => '2025-04-20', 'registered' => 400, 'pouches' => 300, 'capacity' => 600],
                ['date' => '2025-10-08', 'registered' => 380, 'pouches' => 290, 'capacity' => 400],
                ['date' => '2026-02-10', 'registered' => 350, 'pouches' => 290, 'capacity' => 410],
            ],
            'HEIG-VD' => [
                ['date' => '2021-05-12', 'registered' => 180, 'pouches' => 140, 'capacity' => 300],
                ['date' => '2021-11-24', 'registered' => 170, 'pouches' => 135, 'capacity' => 300],
                ['date' => '2022-04-06', 'registered' => 380, 'pouches' => 370, 'capacity' => 400],
                ['date' => '2022-10-19', 'registered' => 360, 'pouches' => 340, 'capacity' => 450],
                ['date' => '2023-04-19', 'registered' => 210, 'pouches' => 175, 'capacity' => 300],
                ['date' => '2023-10-11', 'registered' => 200, 'pouches' => 165, 'capacity' => 300],
                ['date' => '2024-03-14', 'registered' => 220, 'pouches' => 190, 'capacity' => 300],
                ['date' => '2024-10-03', 'registered' => 230, 'pouches' => 200, 'capacity' => 300],
                ['date' => '2025-05-22', 'registered' => 400, 'pouches' => 380, 'capacity' => 400],
                ['date' => '2025-11-06', 'registered' => 410, 'pouches' => 360, 'capacity' => 450],
                ['date' => '2026-03-05', 'registered' => 230, 'pouches' => 210, 'capacity' => 450],
            ],
            'UNIL' => [
                ['date' => '2020-03-11', 'registered' => 490, 'pouches' => 480, 'capacity' => 600],
                ['date' => '2020-10-21', 'registered' => 460, 'pouches' => 430, 'capacity' => 580],
                ['date' => '2021-04-14', 'registered' => 470, 'pouches' => 460, 'capacity' => 600],
                ['date' => '2021-11-09', 'registered' => 450, 'pouches' => 410, 'capacity' => 600],
                ['date' => '2022-05-03', 'registered' => 400, 'pouches' => 280, 'capacity' => 600],
                ['date' => '2022-11-17', 'registered' => 390, 'pouches' => 270, 'capacity' => 600],
                ['date' => '2023-06-14', 'registered' => 410, 'pouches' => 290, 'capacity' => 650],
                ['date' => '2023-11-22', 'registered' => 400, 'pouches' => 280, 'capacity' => 650],
                ['date' => '2024-04-22', 'registered' => 500, 'pouches' => 490, 'capacity' => 700],
                ['date' => '2024-11-18', 'registered' => 480, 'pouches' => 420, 'capacity' => 700],
                ['date' => '2025-03-25', 'registered' => 490, 'pouches' => 320, 'capacity' => 700],
                ['date' => '2025-09-10', 'registered' => 470, 'pouches' => 310, 'capacity' => 700],
                ['date' => '2026-04-02', 'registered' => 460, 'pouches' => 400, 'capacity' => 700],
            ],
            'Nestlé' => [
                ['date' => '2021-06-17', 'registered' => 410, 'pouches' => 408, 'capacity' => 500],
                ['date' => '2024-05-09', 'registered' => 380, 'pouches' => 300, 'capacity' => 400],
                ['date' => '2025-07-03', 'registered' => 400, 'pouches' => 390, 'capacity' => 500],
                ['date' => '2026-01-20', 'registered' => 820, 'pouches' => 610, 'capacity' => 1000],
            ],
            'Swisscom' => [
                ['date' => '2026-02-28', 'registered' => null, 'pouches' => null, 'capacity' => 800],
            ],
            'BCGE' => [
                ['date' => '2023-05-10', 'registered' => 120, 'pouches' => 105, 'capacity' => 150],
                ['date' => '2025-06-12', 'registered' => 140, 'pouches' => 115, 'capacity' => 160],
            ],
            'Benevity' => [
                ['date' => '2024-09-18', 'registered' => 75, 'pouches' => 68, 'capacity' => 80],
            ],
            'Breitling' => [
                ['date' => '2022-10-05', 'registered' => 180, 'pouches' => 160, 'capacity' => 200],
            ],
            'Capco' => [
                ['date' => '2024-03-22', 'registered' => 42, 'pouches' => 38, 'capacity' => 50],
            ],
            'Celanese' => [
                ['date' => '2023-11-14', 'registered' => 95, 'pouches' => 88, 'capacity' => 120],
            ],
            'Coop' => [
                ['date' => '2021-08-24', 'registered' => 710, 'pouches' => 640, 'capacity' => 800],
                ['date' => '2025-02-17', 'registered' => 820, 'pouches' => 780, 'capacity' => 950],
            ],
            'Croix-Rouge' => [
                ['date' => '2020-06-14', 'registered' => 290, 'pouches' => 285, 'capacity' => 300],
                ['date' => '2024-06-14', 'registered' => 340, 'pouches' => 332, 'capacity' => 350],
            ],
            'Datatonic' => [
                ['date' => '2025-11-04', 'registered' => 38, 'pouches' => 35, 'capacity' => 40],
            ],
            'Edwards Lifesciences' => [
                ['date' => '2023-03-28', 'registered' => 160, 'pouches' => 142, 'capacity' => 180],
            ],
            'Fortil' => [
                ['date' => '2024-10-24', 'registered' => 39, 'pouches' => 34, 'capacity' => 45],
            ],
            'Migros' => [
                ['date' => '2022-06-21', 'registered' => 810, 'pouches' => 720, 'capacity' => 900],
                ['date' => '2025-05-14', 'registered' => 880, 'pouches' => 810, 'capacity' => 950],
            ],
            'Nespresso' => [
                ['date' => '2023-11-07', 'registered' => 350, 'pouches' => 310, 'capacity' => 400],
            ],
            'Rolex' => [
                ['date' => '2020-11-19', 'registered' => 460, 'pouches' => 410, 'capacity' => 500],
                ['date' => '2024-04-16', 'registered' => 510, 'pouches' => 475, 'capacity' => 550],
            ],
            'Seedstar' => [
                ['date' => '2023-07-12', 'registered' => 25, 'pouches' => 22, 'capacity' => 30],
                ['date' => '2024-07-12', 'registered' => 25, 'pouches' => 22, 'capacity' => 30],
                ['date' => '2026-07-12', 'registered' => null, 'pouches' => null, 'capacity' => 30],
            ],
            'Toblerone' => [
                ['date' => '2022-03-15', 'registered' => 90, 'pouches' => 84, 'capacity' => 110],
                ['date' => '2025-03-15', 'registered' => 90, 'pouches' => 84, 'capacity' => 110],
            ],
            'UBS' => [
                ['date' => '2021-10-12', 'registered' => 620, 'pouches' => 540, 'capacity' => 700],
                ['date' => '2024-11-20', 'registered' => 690, 'pouches' => 615, 'capacity' => 750],
                ['date' => '2025-11-20', 'registered' => 690, 'pouches' => 615, 'capacity' => 750],
                ['date' => '2026-11-20', 'registered' => null, 'pouches' => null, 'capacity' => 750], // Fin 2026 -> futur
            ],
            'Unilabs' => [
                ['date' => '2023-09-05', 'registered' => 220, 'pouches' => 205, 'capacity' => 250],
            ],
            'Verysell' => [
                ['date' => '2024-03-11', 'registered' => 21, 'pouches' => 19, 'capacity' => 25],
                ['date' => '2025-03-11', 'registered' => 21, 'pouches' => 19, 'capacity' => 25],
                ['date' => '2026-03-11', 'registered' => 21, 'pouches' => 19, 'capacity' => 25],
            ]
        ];

        $now = Carbon::now();

        // =====================================================================
        // BOUCLE D'INSERTION ET GENERATION DYNAMIQUE
        // =====================================================================
        foreach ($companiesData as $name => $meta) {
            $slug = Str::slug($name);

            $companyId = DB::table('companies')->insertGetId([
                'name'       => $name,
                'slug'       => $slug,
                'logo'       => "images/companies_logo/{$slug}.{$meta['ext']}",
                'color'      => $meta['color'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $insertedDates = [];
            $hasRecentCollection = false;

            // 1. Insertion des collectes manuelles prédéfinies
            if (isset($manualCollections[$name])) {
                foreach ($manualCollections[$name] as $col) {
                    $date = Carbon::parse($col['date']);
                    $insertedDates[] = $date->format('Y-m-d');

                    if ($date->year === 2025 || $date->year === 2026) {
                        $hasRecentCollection = true;
                    }

                    // Forcer la cohérence si la date est dans le futur
                    $isFutureOrCurrent = $date->isAfter($now) || $date->isSameDay($now);
                    $registered = $isFutureOrCurrent ? rand(10, $col['capacity']) : $col['registered'];
                    $pouches = $isFutureOrCurrent ? null : $col['pouches'];

                    DB::table('collections')->insert([
                        'company_id'     => $companyId,
                        'day_start'      => $date->copy()->startOfDay(),
                        'day_end'        => $date->copy()->endOfDay(),
                        'hour_start'     => '08:00:00',
                        'hour_end'       => '17:00:00',
                        'location'       => $meta['loc'],
                        'nb_employee'    => rand(1000, 2500), // Règle : minimum 1000 employés
                        'capacity'       => $col['capacity'],
                        'nb_registered'  => $registered,
                        'nb_blood_pouch' => $pouches,
                        'onedoc_link'    => $onedoc,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ]);
                }
            }

            // 2. Sécurité : Garantie d'au moins une collecte en 2025-2026 si manquante
            if (!$hasRecentCollection) {
                $forcedYear = rand(2025, 2026);
                $forcedDate = Carbon::create($forcedYear, rand(1, 12), rand(1, 28));
                $insertedDates[] = $forcedDate->format('Y-m-d');

                $isFutureOrCurrent = $forcedDate->isAfter($now) || $forcedDate->isSameDay($now);
                $capacity = rand(150, 400);
                $registered = rand(50, $capacity);

                DB::table('collections')->insert([
                    'company_id'     => $companyId,
                    'day_start'      => $forcedDate->copy()->startOfDay(),
                    'day_end'        => $forcedDate->copy()->endOfDay(),
                    'hour_start'     => '08:30:00',
                    'hour_end'       => '16:30:00',
                    'location'       => $meta['loc'],
                    'nb_employee'    => rand(1000, 2000),
                    'capacity'       => $capacity,
                    'nb_registered'  => $registered,
                    'nb_blood_pouch' => $isFutureOrCurrent ? null : rand(20, $registered),
                    'onedoc_link'    => $onedoc,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]);
            }

            // 3. Compléter automatiquement pour atteindre MINIMUM 10 collectes
            $currentCount = count($insertedDates);
            while ($currentCount < 10) {
                $genYear = rand(2020, 2026);
                $genDate = Carbon::create($genYear, rand(1, 12), rand(1, 28));
                $genDateStr = $genDate->format('Y-m-d');

                if (!in_array($genDateStr, $insertedDates)) {
                    $insertedDates[] = $genDateStr;
                    $currentCount++;

                    $isFutureOrCurrent = $genDate->isAfter($now) || $genDate->isSameDay($now);
                    $capacity = rand(200, 500);
                    $registered = rand(80, $capacity); // Ne peut jamais dépasser la capacité
                    $pouches = $isFutureOrCurrent ? null : rand(40, $registered); // Jamais supérieur aux inscrits, null si futur

                    DB::table('collections')->insert([
                        'company_id'     => $companyId,
                        'day_start'      => $genDate->copy()->startOfDay(),
                        'day_end'        => $genDate->copy()->endOfDay(),
                        'hour_start'     => '08:00:00',
                        'hour_end'       => '17:00:00',
                        'location'       => $meta['loc'],
                        'nb_employee'    => rand(1000, 3000),
                        'capacity'       => $capacity,
                        'nb_registered'  => $registered,
                        'nb_blood_pouch' => $pouches,
                        'onedoc_link'    => $onedoc,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ]);
                }
            }

            // 4. RAJOUT SPÉCIFIQUE : Collecte en cours à HEIG-VD (08.06.2026 au 12.06.2026)
            if ($name === 'HEIG-VD') {
                DB::table('collections')->insert([
                    'company_id'     => $companyId,
                    'day_start'      => Carbon::create(2026, 6, 8)->startOfDay(),
                    'day_end'        => Carbon::create(2026, 6, 12)->endOfDay(),
                    'hour_start'     => '08:00:00',
                    'hour_end'       => '17:00:00',
                    'location'       => 'Aula Campus Cheseaux',
                    'nb_employee'    => 1200,
                    'capacity'       => 500,
                    'nb_registered'  => null,
                    'nb_blood_pouch' => null,
                    'onedoc_link'    => $onedoc,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]);
            }
        }
    }
}
