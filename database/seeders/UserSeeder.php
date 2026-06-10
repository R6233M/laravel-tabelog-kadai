<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ダミーユーザー
        // User::factory()->count(100)->create();

        // 課題レビュー用アカウント
        User::firstOrCreate(
            ['email' => 'review-user@example.com'],
            [
                'name' => 'レビュー担当',
                'kana' => 'レビュータントウ',
                'password' => Hash::make('review123'),
                'postal_code' => '1000001',
                'address' => '東京都千代田区',
                'phone_number' => '09012345678',
                'birthday' => '1990-01-01',
                'occupation' => 'Reviewer',
                'email_verified_at' => now(),
            ]
        );
    }    
}
