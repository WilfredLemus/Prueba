<?php

use App\User;
use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $professions = DB::select('SELECT id FROM professions WHERE title = ? LIMIT 0,1', ['Desarrollador BackEnd']);
        // $professions = DB::table('professions')->select('id')->take(1)->get();
        // $profession = DB::table('professions')->select('id')->first();
        // $professionID = DB::table('professions')->where('title', 'Desarrollador BackEnd')->value('id');

        // $professionID = DB::table('professions')->whereTitle('Desarrollador BackEnd')->value('id');
        // DB::table('users')->insert([
        //     'name' => 'Wilfred Lemus',
        //     'email' => 'wilfred@gmail.com',
        //     'password' => bcrypt('passDificil'),
        //     'profession_id' => $professionID
        // ]);

        // User::create([
        //     'name' => 'Wilfred Lemus',
        //     'email' => 'wilfred@gmail.com',
        //     'password' => bcrypt('passDificil'),
        //     'profession_id' => $professionID,
        //     'is_admin' => true
        // ]);
        $professionID = Profession::where('title', 'Desarrollador BackEnd')->value('id');

        factory(User::class)->create([
            'name' => 'Wilfred Lemus',
            'email' => 'wilfred@gmail.com',
            'password' => bcrypt('passDificil'),
            'profession_id' => $professionID,
            'is_admin' => true
        ]);

        factory(User::class)->create([
            'profession_id' => $professionID
        ]);

        factory(User::class, 10)->create();
    }
}
