<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productTypes = [
            [
                'name' => 'Screen/LCD Assembly',
                'slug' => 'screen-lcd-assembly',
                'description' => 'Complete LCD screen assemblies with digitizer',
                'is_active' => true,
            ],
            [
                'name' => 'OLED Assembly',
                'slug' => 'oled-assembly',
                'description' => 'Premium OLED screen assemblies',
                'is_active' => true,
            ],
            [
                'name' => 'Battery',
                'slug' => 'battery',
                'description' => 'Replacement batteries for mobile devices',
                'is_active' => true,
            ],
            [
                'name' => 'Charging Port/Flex Cable',
                'slug' => 'charging-port-flex-cable',
                'description' => 'Charging ports and flex cables',
                'is_active' => true,
            ],
            [
                'name' => 'Back Glass/Housing',
                'slug' => 'back-glass-housing',
                'description' => 'Back glass panels and device housings',
                'is_active' => true,
            ],
            [
                'name' => 'Camera Lens',
                'slug' => 'camera-lens',
                'description' => 'Replacement camera lenses and covers',
                'is_active' => true,
            ],
            [
                'name' => 'Speaker/Earpiece',
                'slug' => 'speaker-earpiece',
                'description' => 'Speakers and earpiece components',
                'is_active' => true,
            ],
            [
                'name' => 'Buttons/Switches',
                'slug' => 'buttons-switches',
                'description' => 'Power buttons, volume buttons, and switches',
                'is_active' => true,
            ],
            [
                'name' => 'Antenna/Signal',
                'slug' => 'antenna-signal',
                'description' => 'Antenna flex cables and signal components',
                'is_active' => true,
            ],
            [
                'name' => 'Sensors',
                'slug' => 'sensors',
                'description' => 'Proximity sensors, light sensors, and other sensor components',
                'is_active' => true,
            ],
        ];

        foreach ($productTypes as $productType) {
            ProductType::create($productType);
        }
    }
}
