<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::insert('INSERT INTO professions(title) VALUES (:title)', [
        //     'title' => 'Diseñador de Interfaces'
        //     ]);
        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador BackEnd'
        // ]);

        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador FronEnd'
        // ]);

        // DB::table('professions')->insert([
        //     'title' => 'Desarrollador Web'
        // ]);

        Profession::create([
            'title' => 'Desarrollador BackEnd'
        ]);
        Profession::create([
            'title' => 'Desarrollador FronEnd'
        ]);
        Profession::create([
            'title' => 'Desarrollador Web'
        ]);

        factory(Profession::class, 9)->create();
    }
}
