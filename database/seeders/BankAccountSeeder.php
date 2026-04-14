<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankAccount;

class BankAccountSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [
            [
                'bank_name'      => 'Bank Syariah Indonesia (BSI)',
                'account_number' => '7773007777',
                'account_holder' => 'Yayasan Mimbar Al-Tauhid',
                'is_active'      => true,
                'sort_order'     => 1,
            ],
            [
                'bank_name'      => 'Bank Rakyat Indonesia (BRI)',
                'account_number' => '0123456789',
                'account_holder' => 'Yayasan Mimbar Al-Tauhid',
                'is_active'      => true,
                'sort_order'     => 2,
            ],
            [
                'bank_name'      => 'Bank Central Asia (BCA)',
                'account_number' => '1234567890',
                'account_holder' => 'Yayasan Mimbar Al-Tauhid',
                'is_active'      => true,
                'sort_order'     => 3,
            ],
        ];

        foreach ($banks as $bank) {
            BankAccount::create($bank);
        }
    }
}
