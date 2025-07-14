<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plant_families = [
           [
               'id' => 1,
               'name' => 'Araceae',
               'description' => 'A diverse family of plants known for their ornamental foliage and tropical appeal. Many are popular houseplants, such as the Peace Lily and Monstera.'
           ],
           [
               'id' => 2,
               'name' => 'Moraceae',
               'description' => 'A family of plants that includes large, woody species, often with thick, leathery leaves. Examples include the Rubber Plant and Fiddle Leaf Fig.'
           ],
           [
               'id' => 3,
               'name' => 'Asparagaceae',
               'description' => 'A family of plants that includes many hardy and easy-to-care-for houseplants, such as Snake Plants, Spider Plants, and Dracaena.'
           ],
           [
               'id' => 4,
               'name' => 'Strelitziaceae',
               'description' => 'A family that includes the iconic Bird of Paradise, known for its large, striking flowers and bold foliage, native to tropical regions.'
           ],
        ];
           foreach ($plant_families as $family) {
            DB::table('plant_families')->insert([
                'id' => $family['id'],
                'name' => $family['name'],
                'description' => $family['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
     }   
}