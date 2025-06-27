<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'email@example.com'],
            [
                'name' => 'Yusuf',
                'password' => Hash::make('123456'),
                'status' => 'active',
                'role' => 'user',
                'phone_number' => '0987654321',
                'photo' => null,                 
            ]
        );
    }
}
