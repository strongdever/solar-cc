<?php

namespace Database\Seeders;

use App\Models\Term;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $term = new Term();
        $bank = new Bank();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();

        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'uuid'                           => 'Admin',
                'name'                           => '鹿島',
                'company'                        => '株式会社ニンニンドットコム',
                'zipcode'                        => '151-0072',
                'address1'                       => '東京都渋谷区幡ケ谷',
                'address2'                       => '東京都渋谷区幡谷',
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make('password'),
                'token'                          => substr(md5(rand(0, 9) . $seededAdminEmail . time()), 0, 32),
                'activated'                      => true,
                'signup_confirmation_ip_address' => '127.0.0.1',
                'admin_ip_address'               => '127.0.0.1',
            ]);

            $user->term()->save($term);
            $user->bank()->save($bank);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed test user
        $user = User::where('email', '=', 'user@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'uuid'                           => 'User',
                'name'                           => '松田',
                'company'                        => '株式会社ニンニンドットコム',
                'zipcode'                        => '151-0072',
                'address1'                       => '東京都渋谷区幡ケ谷',
                'address2'                       => '東京都渋谷区幡谷',
                'email'                          => 'user@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => substr(md5(rand(0, 9) . 'user@user.com' . time()), 0, 32),
                'activated'                      => true,
                'signup_ip_address'              => '127.0.0.1',
                'signup_confirmation_ip_address' => '127.0.0.1',
            ]);

            $user->term()->save(new Term());
            $user->bank()->save(new Bank());
            $user->attachRole($userRole);
            $user->save();
        }
        
    }
}
