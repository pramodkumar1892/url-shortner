<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShortLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('short_links')->insert([
            'code' => 'AbcXyz',
            'link' => 'http://testdomain1.com',
            'hits' => 10,
        ]);
    }
}
