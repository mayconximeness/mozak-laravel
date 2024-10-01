<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'uuid_code' => Str::uuid(),
                'owner_id' => 3,
                'name' => 'Evento de Tecnologia',
                'description' => 'Um grande evento sobre tecnologia.',
                'address' => 'Avenida Principal, 123',
                'complement' => 'Sala 101',
                'zipcode' => '12345-678',
                'number' => '123',
                'city' => 'São Paulo',
                'state' => 'SP',
                'starts_at' => now()->addDays(10),
                'ends_at' => now()->addDays(12),
                'max_subscription' => 100,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid_code' => Str::uuid(),
                'owner_id' => 4,
                'name' => 'Workshop de Design',
                'description' => 'Workshop focado em design de interfaces.',
                'address' => 'Rua dos Designers, 456',
                'complement' => 'Prédio 2',
                'zipcode' => '87654-321',
                'number' => '456',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'starts_at' => now()->addDays(20),
                'ends_at' => now()->addDays(22),
                'max_subscription' => 50,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
