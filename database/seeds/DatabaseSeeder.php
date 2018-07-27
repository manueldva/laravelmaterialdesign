<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrador',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'userType' => 'ADMINISTRATOR',
        ]);

        DB::table('users')->insert([
            'name' => 'administrador2',
            'username' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('admin'),
            'userType' => 'ADMINISTRATOR',
        ]);
        
        DB::table('users')->insert([
            'name' => 'administrador3',
            'username' => 'admin3',
            'email' => 'admin3@admin.com',
            'password' => bcrypt('admin'),
            'userType' => 'ADMINISTRATOR',
        ]);
        
        DB::table('users')->insert([
            'name' => 'administrador4',
            'username' => 'admin4',
            'email' => 'admin4@admin.com',
            'password' => bcrypt('admin'),
            'userType' => 'ADMINISTRATOR',
        ]);
        
        DB::table('users')->insert([
            'name' => 'administrador5',
            'username' => 'admin5',
            'email' => 'admin5@admin.com',
            'password' => bcrypt('admin'),
            'userType' => 'ADMINISTRATOR',
        ]);


        // $this->call(UsersTableSeeder::class);
    }
}
