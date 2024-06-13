<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'نام سایت',
            'description' => 'این یک سایت خوب است',
            'keywords' => 'سایت',
            'logo' => 'logo.png',
            'icon' => 'icon.ico'
        ]);
    }
}
