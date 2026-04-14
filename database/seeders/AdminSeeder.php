<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name'     => 'Administrator Mimbar',
            'email'    => 'admin@mimbar.or.id',
            'password' => Hash::make('mimbar2025'),
        ]);
    }
}
