<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Sitren\User::create(["name"=>"Super Admin","email"=>"superadmin@gmail.com","password"=>\Hash::make("superadmin"),"level"=>"admin"]);

    }
}
