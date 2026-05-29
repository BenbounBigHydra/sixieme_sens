<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // EPFL
        // - Ambassador jusqu'en 2023 : gagnant (2020→2023 = 4 ans consécutifs)
        // - Ambassador jusqu'en 2025 : battu par HEIG-VD (trou en 2024)
        // - Gold 2023 : gagnant
        // - Gold 2025 : battu par HEIG-VD
        // - Conviction 2023 : gagnant
        // - Label 2026 : oui
        // =====================================================================
        $epflSlug = Str::slug('EPFL');
        $epfl = DB::table('companies')->insertGetId([
            'name'       => 'EPFL',
            'slug'       => $epflSlug,
            'logo'       => "images/companies_logo/{$epflSlug}.png",
            'color'      => 'FF0000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('collections')->insert([
            // 2020 - deux collectes
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2020, 2, 5)->startOfDay(),
                'end'            => Carbon::create(2020, 2, 5)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 900,
                'nb_registered'  => 250,
                'nb_blood_pouch' => 200,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2020, 9, 15)->startOfDay(),
                'end'            => Carbon::create(2020, 9, 15)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Bâtiment BC',
                'nb_employee'    => 910,
                'nb_registered'  => 240,
                'nb_blood_pouch' => 195,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2021 - deux collectes
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2021, 3, 18)->startOfDay(),
                'end'            => Carbon::create(2021, 3, 18)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 950,
                'nb_registered'  => 270,
                'nb_blood_pouch' => 220,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2021, 10, 6)->startOfDay(),
                'end'            => Carbon::create(2021, 10, 6)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Bâtiment BC',
                'nb_employee'    => 960,
                'nb_registered'  => 260,
                'nb_blood_pouch' => 215,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2022 - deux collectes
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2022, 4, 7)->startOfDay(),
                'end'            => Carbon::create(2022, 4, 7)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 980,
                'nb_registered'  => 290,
                'nb_blood_pouch' => 245,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2022, 11, 3)->startOfDay(),
                'end'            => Carbon::create(2022, 11, 3)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Bâtiment BC',
                'nb_employee'    => 990,
                'nb_registered'  => 280,
                'nb_blood_pouch' => 240,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2023 - deux collectes, meilleur gold et conviction
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2023, 3, 14)->startOfDay(),
                'end'            => Carbon::create(2023, 3, 14)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 1000,
                'nb_registered'  => 430,
                'nb_blood_pouch' => 420, // gold 420/1000=0.42, conviction 420/430=0.977 → gagnants 2023
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2023, 9, 20)->startOfDay(),
                'end'            => Carbon::create(2023, 9, 20)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Bâtiment BC',
                'nb_employee'    => 1010,
                'nb_registered'  => 380,
                'nb_blood_pouch' => 350,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // TROU 2024 → casse la série pour ambassador 2025
            // 2025 - deux collectes
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2025, 4, 20)->startOfDay(),
                'end'            => Carbon::create(2025, 4, 20)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 1100,
                'nb_registered'  => 400,
                'nb_blood_pouch' => 300, // gold 300/1100=0.27 → battu par HEIG-VD
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2025, 10, 8)->startOfDay(),
                'end'            => Carbon::create(2025, 10, 8)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Bâtiment BC',
                'nb_employee'    => 1110,
                'nb_registered'  => 380,
                'nb_blood_pouch' => 290,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2026 clôturée → label
            [
                'company_id'     => $epfl,
                'start'          => Carbon::create(2026, 2, 10)->startOfDay(),
                'end'            => Carbon::create(2026, 2, 10)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 1100,
                'nb_registered'  => 350,
                'nb_blood_pouch' => 290,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2026 future
            [
                'company_id'     => $epfl,
                'start'          => Carbon::now()->addMonths(2)->startOfDay(),
                'end'            => Carbon::now()->addMonths(2)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Rolex Learning Center',
                'nb_employee'    => 1200,
                'nb_registered'  => null,
                'nb_blood_pouch' => null,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);


        // =====================================================================
        // HEIG-VD
        // - Ambassador jusqu'en 2023 : battu par EPFL (2021→2023 = 3 ans vs 4)
        // - Ambassador jusqu'en 2025 : gagnant (2021→2025 = 5 ans consécutifs)
        // - Gold 2022 : gagnant
        // - Gold 2025 : gagnant
        // - Conviction 2022 : gagnant
        // - Label 2026 : oui
        // =====================================================================
        $heigSlug = Str::slug('HEIG-VD');
        $heig = DB::table('companies')->insertGetId([
            'name'       => 'HEIG-VD',
            'slug'       => $heigSlug,
            'logo'       => "images/companies_logo/{$heigSlug}.png",
            'color'      => '0000FF',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('collections')->insert([
            // 2021 - deux collectes
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2021, 5, 12)->startOfDay(),
                'end'            => Carbon::create(2021, 5, 12)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus HEIG-VD',
                'nb_employee'    => 700,
                'nb_registered'  => 180,
                'nb_blood_pouch' => 140,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2021, 11, 24)->startOfDay(),
                'end'            => Carbon::create(2021, 11, 24)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Salle polyvalente',
                'nb_employee'    => 710,
                'nb_registered'  => 170,
                'nb_blood_pouch' => 135,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2022 - deux collectes, meilleur gold et conviction
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2022, 4, 6)->startOfDay(),
                'end'            => Carbon::create(2022, 4, 6)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus HEIG-VD',
                'nb_employee'    => 740,
                'nb_registered'  => 380,
                'nb_blood_pouch' => 370, // gold 370/740=0.5, conviction 370/380=0.974 → gagnants 2022
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2022, 10, 19)->startOfDay(),
                'end'            => Carbon::create(2022, 10, 19)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Salle polyvalente',
                'nb_employee'    => 750,
                'nb_registered'  => 360,
                'nb_blood_pouch' => 340,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2023 - deux collectes
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2023, 4, 19)->startOfDay(),
                'end'            => Carbon::create(2023, 4, 19)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus HEIG-VD',
                'nb_employee'    => 800,
                'nb_registered'  => 210,
                'nb_blood_pouch' => 175, // battu par EPFL en gold 2023
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2023, 10, 11)->startOfDay(),
                'end'            => Carbon::create(2023, 10, 11)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Salle polyvalente',
                'nb_employee'    => 810,
                'nb_registered'  => 200,
                'nb_blood_pouch' => 165,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2024 - deux collectes
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2024, 3, 14)->startOfDay(),
                'end'            => Carbon::create(2024, 3, 14)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus HEIG-VD',
                'nb_employee'    => 830,
                'nb_registered'  => 220,
                'nb_blood_pouch' => 190,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2024, 10, 3)->startOfDay(),
                'end'            => Carbon::create(2024, 10, 3)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Salle polyvalente',
                'nb_employee'    => 840,
                'nb_registered'  => 230,
                'nb_blood_pouch' => 200,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2025 - deux collectes, meilleur gold
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2025, 5, 22)->startOfDay(),
                'end'            => Carbon::create(2025, 5, 22)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus HEIG-VD',
                'nb_employee'    => 850,
                'nb_registered'  => 400,
                'nb_blood_pouch' => 380, // gold 380/850=0.447 → gagnant 2025
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2025, 11, 6)->startOfDay(),
                'end'            => Carbon::create(2025, 11, 6)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Salle polyvalente',
                'nb_employee'    => 860,
                'nb_registered'  => 410,
                'nb_blood_pouch' => 360,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2026 clôturée → label
            [
                'company_id'     => $heig,
                'start'          => Carbon::create(2026, 3, 5)->startOfDay(),
                'end'            => Carbon::create(2026, 3, 5)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus HEIG-VD',
                'nb_employee'    => 870,
                'nb_registered'  => 230,
                'nb_blood_pouch' => 210,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);


        // =====================================================================
        // UNIL
        // - Ambassador jusqu'en 2025 : battu par HEIG-VD (2022→2025 = 4 ans vs 5)
        // - Gold 2020 : gagnant
        // - Gold 2021 : gagnant
        // - Gold 2024 : gagnant
        // - Conviction 2020 : gagnant
        // - Conviction 2024 : gagnant
        // - Label 2026 : oui
        // =====================================================================
        $unilSlug = Str::slug('UNIL');
        $unil = DB::table('companies')->insertGetId([
            'name'       => 'UNIL',
            'slug'       => $unilSlug,
            'logo'       => "images/companies_logo/{$unilSlug}.png",
            'color'      => '00AA44',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('collections')->insert([
            // 2020 - deux collectes, meilleur gold et conviction
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2020, 3, 11)->startOfDay(),
                'end'            => Carbon::create(2020, 3, 11)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 1800,
                'nb_registered'  => 490,
                'nb_blood_pouch' => 480, // gold 480/1800=0.267, conviction 480/490=0.98 → gagnants 2020
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2020, 10, 21)->startOfDay(),
                'end'            => Carbon::create(2020, 10, 21)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Amphimax',
                'nb_employee'    => 1820,
                'nb_registered'  => 460,
                'nb_blood_pouch' => 430,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2021 - deux collectes, meilleur gold
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2021, 4, 14)->startOfDay(),
                'end'            => Carbon::create(2021, 4, 14)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 1850,
                'nb_registered'  => 470,
                'nb_blood_pouch' => 460, // gold 460/1850=0.249 → gagnant 2021
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2021, 11, 9)->startOfDay(),
                'end'            => Carbon::create(2021, 11, 9)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Amphimax',
                'nb_employee'    => 1870,
                'nb_registered'  => 450,
                'nb_blood_pouch' => 410,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2022 - deux collectes
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2022, 5, 3)->startOfDay(),
                'end'            => Carbon::create(2022, 5, 3)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 2000,
                'nb_registered'  => 400,
                'nb_blood_pouch' => 280,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2022, 11, 17)->startOfDay(),
                'end'            => Carbon::create(2022, 11, 17)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Amphimax',
                'nb_employee'    => 2010,
                'nb_registered'  => 390,
                'nb_blood_pouch' => 270,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2023 - deux collectes
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2023, 6, 14)->startOfDay(),
                'end'            => Carbon::create(2023, 6, 14)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 2050,
                'nb_registered'  => 410,
                'nb_blood_pouch' => 290,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2023, 11, 22)->startOfDay(),
                'end'            => Carbon::create(2023, 11, 22)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Amphimax',
                'nb_employee'    => 2060,
                'nb_registered'  => 400,
                'nb_blood_pouch' => 280,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2024 - deux collectes, meilleur gold et conviction
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2024, 4, 22)->startOfDay(),
                'end'            => Carbon::create(2024, 4, 22)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 2100,
                'nb_registered'  => 500,
                'nb_blood_pouch' => 490, // gold 490/2100=0.233, conviction 490/500=0.98 → gagnants 2024
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2024, 11, 18)->startOfDay(),
                'end'            => Carbon::create(2024, 11, 18)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Amphimax',
                'nb_employee'    => 2110,
                'nb_registered'  => 480,
                'nb_blood_pouch' => 420,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2025 - deux collectes
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2025, 3, 25)->startOfDay(),
                'end'            => Carbon::create(2025, 3, 25)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 2200,
                'nb_registered'  => 490,
                'nb_blood_pouch' => 320, // battu par HEIG-VD en gold 2025
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2025, 9, 10)->startOfDay(),
                'end'            => Carbon::create(2025, 9, 10)->endOfDay(),
                'time_start'     => '09:00:00',
                'time_end'       => '16:00:00',
                'location'       => 'Amphimax',
                'nb_employee'    => 2210,
                'nb_registered'  => 470,
                'nb_blood_pouch' => 310,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2026 clôturée → label
            [
                'company_id'     => $unil,
                'start'          => Carbon::create(2026, 4, 2)->startOfDay(),
                'end'            => Carbon::create(2026, 4, 2)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Campus Dorigny',
                'nb_employee'    => 2200,
                'nb_registered'  => 460,
                'nb_blood_pouch' => 400,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);


        // =====================================================================
        // NESTLE
        // - Ambassador : exclu (seulement 2024, 2025 = 2 ans, battu par HEIG-VD)
        // - Gold 2025 : battu par HEIG-VD
        // - Conviction 2025 : gagnant (390/400 = 0.975)
        // - Conviction 2021 : gagnant (départage)
        // - Label 2026 : oui
        // =====================================================================
        $nestleSlug = Str::slug('Nestle');
        $nestle = DB::table('companies')->insertGetId([
            'name'       => 'Nestlé',
            'slug'       => $nestleSlug,
            'logo'       => "images/companies_logo/{$nestleSlug}.png",
            'color'      => 'FFAA00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('collections')->insert([
            // 2021 - meilleur conviction de l'année (départage)
            [
                'company_id'     => $nestle,
                'start'          => Carbon::create(2021, 6, 17)->startOfDay(),
                'end'            => Carbon::create(2021, 6, 17)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Nestlé HQ Vevey',
                'nb_employee'    => 4800,
                'nb_registered'  => 410,
                'nb_blood_pouch' => 408, // conviction 408/410=0.995 → gagnant 2021
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2024
            [
                'company_id'     => $nestle,
                'start'          => Carbon::create(2024, 5, 9)->startOfDay(),
                'end'            => Carbon::create(2024, 5, 9)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Nestlé HQ Vevey',
                'nb_employee'    => 4900,
                'nb_registered'  => 380,
                'nb_blood_pouch' => 300,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2025 - meilleur conviction
            [
                'company_id'     => $nestle,
                'start'          => Carbon::create(2025, 7, 3)->startOfDay(),
                'end'            => Carbon::create(2025, 7, 3)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Nestlé HQ Vevey',
                'nb_employee'    => 5000,
                'nb_registered'  => 400,
                'nb_blood_pouch' => 390, // conviction 390/400=0.975 → gagnant 2025
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            // 2026 clôturée → label
            [
                'company_id'     => $nestle,
                'start'          => Carbon::create(2026, 1, 20)->startOfDay(),
                'end'            => Carbon::create(2026, 1, 20)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Nestlé HQ Vevey',
                'nb_employee'    => 5100,
                'nb_registered'  => 820,
                'nb_blood_pouch' => 610,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);


        // =====================================================================
        // SWISSCOM
        // - Ambassador : exclu (collecte 2026 seulement non clôturée)
        // - Tous trophées : exclu
        // - Label 2026 : non → collecte non clôturée
        // =====================================================================
        $swisscomSlug = Str::slug('Swisscom');
        $swisscom = DB::table('companies')->insertGetId([
            'name'       => 'Swisscom',
            'slug'       => $swisscomSlug,
            'logo'       => "images/companies_logo/{$swisscomSlug}.png",
            'color'      => '0099CC',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('collections')->insert([
            // 2026 passée mais non clôturée → pas de label
            [
                'company_id'     => $swisscom,
                'start'          => Carbon::create(2026, 2, 28)->startOfDay(),
                'end'            => Carbon::create(2026, 2, 28)->endOfDay(),
                'time_start'     => '08:00:00',
                'time_end'       => '17:00:00',
                'location'       => 'Swisscom Campus Berne',
                'nb_employee'    => 3100,
                'nb_registered'  => null,
                'nb_blood_pouch' => null,
                'onedoc_link'    => null,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);
    }
}

// =============================================================================
// Année         Ambassador            Gold                    Conviction
// 2020          —                     UNIL                    UNIL
// 2021          —                     UNIL                    Nestlé
// 2022          UNIL                  HEIG-VD                 HEIG-VD
// 2023          UNIL                  EPFL                    EPFL
// 2024          UNIL                  HEIG-VD                 UNIL
// 2025          UNIL                  HEIG-VD                 Nestlé
//
// Label 2026    —                     EPFL, HEIG-VD, UNIL, Nestlé  —
// =============================================================================
