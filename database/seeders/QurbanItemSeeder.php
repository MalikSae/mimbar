<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QurbanItem;

class QurbanItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'type' => 'kambing',
                'name' => 'Kambing Reguler',
                'price' => 3000000,
                'description' => 'Kambing dengan bobot standar untuk ibadah qurban.',
                'weight_info' => '25-30 kg',
                'is_available' => true,
                'sort_order' => 1,
            ],
            [
                'type' => 'kambing',
                'name' => 'Kambing Premium',
                'price' => 4500000,
                'description' => 'Kambing pilihan dengan bobot lebih besar dan kualitas terbaik.',
                'weight_info' => '35-40 kg',
                'is_available' => true,
                'sort_order' => 2,
            ],
            [
                'type' => 'sapi_saham',
                'name' => '1/7 Sapi (Saham)',
                'price' => 3500000,
                'description' => 'Patungan qurban sapi untuk 1 orang (shohibul).',
                'weight_info' => 'Estimasi 250-300 kg (Total Sapi)',
                'is_available' => true,
                'sort_order' => 3,
            ],
            [
                'type' => 'sapi_penuh',
                'name' => 'Sapi Reguler (Penuh)',
                'price' => 24500000,
                'description' => 'Satu ekor sapi utuh untuk ibadah qurban.',
                'weight_info' => '250-300 kg',
                'is_available' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            QurbanItem::create($item);
        }
    }
}
