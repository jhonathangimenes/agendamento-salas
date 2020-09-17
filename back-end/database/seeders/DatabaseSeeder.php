<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createSector();
        $this->createType();
        $this->createAdmin();
        $this->createLocation();
        $this->createRoom();
    }

    public function createSector()
    {
        DB::table('sectors')->insert([
            'name' => 'Administrativo',
        ]);
    }

    public function createType()
    {
        DB::table('types')->insert([
            'name' => 'Master',
        ]);

        DB::table('types')->insert([
            'name' => 'Comum',
        ]);
    }

    public function createAdmin()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin',
            'phone' => '9999999999',
            'password' => Hash::make('admin'),
            'sector_id' => 1,
            'type_id' => 1
        ]);
    }

    public function createLocation()
    {
        for($i = 1; $i <= 3; $i++) {
            DB::table('locations')->insert([
                'name' => 'Predio '.$i,
            ]);
        }
    }

    public function createRoom()
    {
        for($i = 1; $i <= 3; $i++) {
            for($j = 1; $j <= 3; $j++) {
                DB::table('rooms')->insert([
                    'name' => 'Sala '.$j,
                    'location_id' => $i,
                ]);
            }
        }
    }
}
