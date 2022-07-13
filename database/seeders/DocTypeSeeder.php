<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doc_types')->insert(['title' => 'Входящие документы']);
        DB::table('doc_types')->insert(['title' => 'Исходящие документы']);
        DB::table('doc_types')->insert(['title' => 'Приказы']);
        DB::table('doc_types')->insert(['title' => 'Служебные записки']);
        DB::table('doc_types')->insert(['title' => 'Договоры']);
    }
}
