<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    // Can't make it work for now
    public function run()
    {
        //Empty the Grade table
//        DB::table('Grade')->delete();
        Grade::truncate();
        Grade::create(['id' => '1','name' => "7 Kyu",'order' => 1]);
        Grade::create(['id' => '2','name' => "6 Kyu",'order' => 2]);
        Grade::create(['id' => '3','name' => "5 Kyu",'order' => 3]);
        Grade::create(['id' => '4','name' => "4 Kyu",'order' => 4]);
        Grade::create(['id' => '5','name' => "3 Kyu",'order' => 5]);
        Grade::create(['id' => '6','name' => "2 Kyu",'order' => 6]);
        Grade::create(['id' => '7','name' => "1 Kyu",'order' => 7]);
        Grade::create(['id' => '8','name' => "1 Dan",'order' => 8]);
        Grade::create(['id' => '9','name' => "2 Dan",'order' => 9]);
        Grade::create(['id' => '10','name' => "3 Dan",'order' => 10]);
        Grade::create(['id' => '11','name' => "4 Dan",'order' => 11]);
        Grade::create(['id' => '12','name' => "5 Dan",'order' => 12]);
        Grade::create(['id' => '13','name' => "6 Dan",'order' => 13]);
        Grade::create(['id' => '14','name' => "7 Dan",'order' => 14]);
        Grade::create(['id' => '15','name' => "8 Dan",'order' => 15]);

    }
}
