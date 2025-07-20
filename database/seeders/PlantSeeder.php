<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plants = [
            [
                'name' => 'Alocasia Amazonica',
                'price' => 25.00,
                'description' => 'A stunning plant with arrow-shaped leaves and striking veins.',
                'stock' => 10,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Large-Alocasia-Amazonica_Large_Growpot_Variant.jpg?v=1724770876&width=990',
                'plant_family_id' => 1,
            ],
            [
                'name' => 'Monstera Deliciosa',
                'price' => 30.00,
                'description' => 'A popular houseplant known for its large, split leaves.',
                'stock' => 15,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Large-Monstera-Deliciosa_Large_Agnes-White_Variant.jpg?v=1747168856&width=990',
                'plant_family_id' => 1,
            ],
            [
                'name' => 'Fiddle Leaf Fig',
                'price' => 40.00,
                'description' => 'A trendy plant with large, glossy, and vibrant leaves.',
                'stock' => 5,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Large-Faux-Fiddle_Large_Pallas_Cream_Variant_048fd8ae-a257-414f-bd7a-beb40e6a58dc.jpg?v=1730992807&width=990',
                'plant_family_id' => 2,
            ],
            [
                'name' => 'Snake Plant',
                'price' => 20.00,
                'description' => 'A hardy, low-maintenance plant known for thriving on neglect and its tall, striking leaves.',
                'stock' => 20,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sil_Medium-Sansevieria-Silver-Flame_Medium_Growpot_Variant.jpg?v=1741284438&width=990',
                'plant_family_id' => 3,
            ],
            [
                'name' => 'Spider Plant',
                'price' => 15.00,
                'description' => 'An easy-to-care-for plant with arching leaves and baby plants.',
                'stock' => 25,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Small-Spider-Plant_Small_Bryant_Cream_Variant.jpg?v=1741034221&width=990',
                'plant_family_id' => 3,
            ],
            [
                'name' => 'Peace Lily',
                'price' => 18.00,
                'description' => 'A beautiful plant with white flowers and air-purifying qualities.',
                'stock' => 12,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Medium-Peace_Lily_Medium_Isabella_Rose-Gold_Variant.jpg?v=1747167964&width=990',
                'plant_family_id' => 1,
            ],
            [
                'name' => 'Pothos',
                'price' => 12.00,
                'description' => 'A versatile trailing plant that can thrive in various conditions.',
                'stock' => 30,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Small-Pothos-Marble-Queen_Small_Westcott_Black_Variant.jpg?v=1747148752&width=990',
                'plant_family_id' => 1,
            ],
            [
                'name' => 'Bird of Paradise',
                'price' => 50.00,
                'description' => 'A tropical plant with large leaves and striking flowers.',
                'stock' => 4,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Large-Bird-of-Paradise_Large_Agnes-White_Variant_b36f6505-d22e-4981-8493-134800fbeba4.jpg?v=1743441684&width=990',
                'plant_family_id' => 4,
            ],
            [
                'name' => 'Rubber Plant',
                'price' => 28.00,
                'description' => 'A popular houseplant with large, dark green leaves.',
                'stock' => 10,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Medium-Peperomia-Obtusifolia_Medium_Isabella_Dusty-Rose_Variant.jpg?v=1746111538&width=990',
                'plant_family_id' => 2,
            ],
            [
                'name' => 'Dracaena',
                'price' => 35.00,
                'description' => 'A diverse group of plants with striking foliage.',
                'stock' => 7,
                'image_url' => 'https://www.thesill.com/cdn/shop/files/the-sill_Large-Dracaena-Warneckii_Large_Isabella_Almond_Variant.jpg?v=1743452130&width=990',
                'plant_family_id' => 3,
            ],
        ];

        foreach ($plants as $plant) {
            DB::table('plants')->insert(array_merge(
                $plant,
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ));
        }
    }
}   