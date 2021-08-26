<?php

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $user = User::create([
            'name'      =>  'Admin',
            'email'     =>  'admin@hrms.com',
            'password' => bcrypt('admin123')
        ]);

        $user->assignRole('admin');
    }
}
