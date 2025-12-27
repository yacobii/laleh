<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $mehdi = User::create(['name' => 'mehdi', 'address' => 'vanak sq, aftab, mahtab brje sefid, no 13, zang 15, vahed 8', 'postal' => '31485191', 'city' => 'pardis', 'ostan' => 'tehran', 'mobile' => '09122380343', 'email' => 'mehdi9500@yahoo.com', 'password' => Hash::make('987412300')]);
        $admin = User::create(['name' => 'admin', 'address' => 'Iran - Tehran-Shiraz-Esfahan-Tabriz-Yazad, ...', 'postal' => '31485191', 'city' => 'Mshahad', 'ostan' => 'Yazd', 'mobile' => '09122380344', 'email' => 'admin-website@yahoo.com', 'password' => Hash::make('ADMIN@9874123')]);
        Role::create(['name' => 'super']);
        Permission::create(['name' => 'admin']);
        $mehdi->assignRole('super');
        $admin->givePermissionTo('admin');

    }
}
