<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
