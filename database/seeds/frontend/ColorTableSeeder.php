<?php

use App\Models\Color\Color;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $colors = [
            [
                'id' => '2b5b3e83-fd79-406c-a890-0b4b6e4936f2',
                'code' => 'CERULEAN',
                'color' => '#00B0E8',
            ],
            [
                'id' => '87a434f9-5472-4a75-97c2-b7c21397b99f',
                'code' => 'APPLE',
                'color' => '#61BE40',
            ],
            [
                'id' => 'ab0a06ee-734f-4aca-8941-b5125488bdfb',
                'code' => 'AMETHYST',
                'color' => '#9850C9',
            ],
            [
                'id' => 'd17b8d05-741d-4938-a27d-917beb209022',
                'code' => 'CRUSTA',
                'color' => '#FF7F2A',
            ],
            [
                'id' => '5bed9d7c-3949-4a21-a4b8-0186e1db10e2',
                'code' => 'PACIFIC BLUE',
                'color' => '#00A9C4',
            ],
            [
                'id' => '983f5c86-54ea-45b8-b7b9-882ef02e5a5f',
                'code' => 'CARIBBEAN GREEN',
                'color' => '#00E59F',
            ],
            [
                'id' => '48dd1bf8-50aa-46e8-bf53-0da87782a3a4',
                'code' => 'WHITE',
                'color' => '#FFFFFF',
            ],
            [
                'id' => 'f54828e9-f595-4617-81f6-bf1fe3b51f02',
                'code' => 'LIGHTNING YELLOW',
                'color' => '#FFCB1E',
            ],
            [
                'id' => 'b69a78db-7720-4074-9ade-bbec378f80a5',
                'code' => 'ROBINS EGG BLUE',
                'color' => '#00D5DC',
            ],
            [
                'id' => '69504c67-cdd9-4ae7-9f76-942125ef53ad',
                'code' => 'HEATHER',
                'color' => '#B2BECA',
            ],
            [
                'id' => '68d33625-b68d-4dcf-9991-f2a05c22c5eb',
                'code' => 'GRENADIER',
                'color' => '#DC3C00',
            ],
            [
                'id' => 'c293f51f-045d-4f45-a81e-834d4b8f37c8',
                'code' => 'TORCH RED',
                'color' => '#F90052',
            ]
        ];

        foreach ($colors as $color) {
            try {
                Color::create(['id' => $color['id']], $color);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
