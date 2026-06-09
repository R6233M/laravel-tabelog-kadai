<?php
namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

// 管理者アカウント2つ目を作成
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // $admin = new Admin();
        // $admin->email = 'admin@example.com';
        // $admin->password = Hash::make('nagoyameshi');
        // $admin->save();

        Admin::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['password' => Hash::make('nagoyameshi')]
        );

        Admin::firstOrCreate(
            ['email' => 'review@example.com'],
            ['password' => Hash::make('review123')]
        );
    }
}