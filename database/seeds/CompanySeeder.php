<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Admin',
            'email' => 'hello@54gene.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
