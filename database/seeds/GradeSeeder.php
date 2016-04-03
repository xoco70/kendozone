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
        Grade::create(['name' => 'core.without_grade','order' => 0]);
        Grade::create(['name' => "7 Kyu",'order' => 1]);
        Grade::create(['name' => "6 Kyu",'order' => 2]);
        Grade::create(['name' => "5 Kyu",'order' => 3]);
        Grade::create(['name' => "4 Kyu",'order' => 4]);
        Grade::create(['name' => "3 Kyu",'order' => 5]);
        Grade::create(['name' => "2 Kyu",'order' => 6]);
        Grade::create(['name' => "1 Kyu",'order' => 7]);
        Grade::create(['name' => "1 Dan",'order' => 8]);
        Grade::create(['name' => "2 Dan",'order' => 9]);
        Grade::create(['name' => "3 Dan",'order' => 10]);
        Grade::create(['name' => "4 Dan",'order' => 11]);
        Grade::create(['name' => "5 Dan",'order' => 12]);
        Grade::create(['name' => "6 Dan",'order' => 13]);
        Grade::create(['name' => "7 Dan",'order' => 14]);
        Grade::create(['name' => "8 Dan",'order' => 15]);


    }
}
