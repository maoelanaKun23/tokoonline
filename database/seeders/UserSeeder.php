<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Yusuf',
            'email' => 'email@example.com',
            'password' => Hash::make('123456'),
            'status' => 'active',
            'role' => 'user',
            'hp' => '0987654321',
            'foto' => null,
        ]);
    }
}
