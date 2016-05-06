<?php

use App\Federation;
use App\User;
use Illuminate\Database\Seeder;

class FederationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {

        Federation::truncate();
        Federation::create(['name' => 'The British Kendo Association', 'president_id' => '1', 'address' => '113 Vibart Road, Yardley, Birmingham, B26 2AB, UK', 'phone' => '32-2-672-8342', 'country_id' => 826,'website' => 'www.kendo.org.uk']); //  BKAchair@britishkendoassociation.com
        Federation::create(['name' => 'Comite National de Kendo/FFJDA', 'president_id' => '1', 'address' => '21-25 avenue de la Porte de Chatillon 75014 Paris Cedex 14, France', 'phone' => '33-140-52-1681', 'country_id' => 250,'website' => ' www.cnkendo-dr.com']); //  kendo@ffjudo.com
        Federation::create(['name' => 'Kendo Section, Swedish Budo & Martial Arts Federation', 'president_id' => '1', 'address' => 'C/O Mr. Iask Rubensson, Torsvagen 13, 19267 SOLLENTUNA, Sweden, B26 2AB, UK', 'phone' => '46-70-786-1622', 'country_id' => 752,'website' => 'www.kendoforbundet.se']); //  president@kendoforbundet.se
        Federation::create(['name' => 'All Belgium Kendo Federation', 'president_id' => '1', 'address' => 'c/o Mr. Daniel Delepiere, Bosbessenlaan 6, B-3090, Overijse, Belgium', 'phone' => '32-476-960-072', 'country_id' => '56','website' => 'www.abkfevents.be']); // president@abkf.be
        Federation::create(['name' => 'Nederlandse Kendo Renmei', 'president_id' => '1', 'address' => 'C/O Mr.K.Hattum, Hoofdstraat 187, 3114 GD Schiedam, Netherlands', 'phone' => '31-1044191631', 'country_id' => '528','website' => ' www.nkr.nl']); // k.vanhattum@nkr.nl
        Federation::create(['name' => 'Swiss Kendo and Iaido, SJV/FSJ', 'president_id' => '1', 'address' => 'Swiss Kendo & Iaido, CH-1004, Lausanne, Switzerland', 'phone' => '41-21-6489102', 'country_id' => '756','website' => 'www.kendo.ch']); //president@kendo.ch
        Federation::create(['name' => 'Deutscher Kendobund e. V. (DKenB)', 'president_id' => '1', 'address' => 'C/O Mr. Detlef Viebranz, Im Buchholzfelde 3 30966 Hemmingen, Germany', 'phone' => '49-511-2330963', 'country_id' => '276','website' => 'www.dkenb.de']); // praesident@dkenb.de
        Federation::create(['name' => 'Royal Spanish Judo Federation and Associated Sports', 'president_id' => '1', 'address' => 'C/ Ferraz, 16-7 Izq, 28008, Madrid, Spain', 'phone' => '34-91-559-4958', 'country_id' => '724','website' => 'www.rfejudo.com  ']); //info@rfejudo.com
        Federation::create(['name' => 'Austrian Kendo Association', 'president_id' => '1', 'address' => 'c/o Mr. Harald Hofer Markfeldgasse 4/5・A-2380, Perchtoldsdorf, Austria', 'phone' => '43-1-86-55-022', 'country_id' => '40','website' => 'http://www.kendo-austria.at ']); //president@kendo-austria.at
        Federation::create(['name' => 'Norwegian Kendo Committee  -Norweigan Martial Arts Federation', 'president_id' => '1', 'address' => 'C/O Mr. Joakim Kosmo Tiriltunga 54, 1259, Oslo, Norway', 'phone' => '47-480-49369', 'country_id' => '578','website' => '']); // nkf-kendo@kampsport.no
        Federation::create(['name' => 'Danish Kendo Federation', 'president_id' => '1', 'address' => 'C/O David A. Mwaipaya  Carl Blochs Vej 99 5230 Odense M Denmark', 'phone' => '45-22-45-60-81', 'country_id' => '208','website' => 'www.kendo-dkf.dk ']); //president@kendo-dkf.dk
        Federation::create(['name' => 'Finnish Kendo Association', 'president_id' => '1', 'address' => 'c/o Mr. Mika Kankainen, Puikkaritie 4 B 1  90520 Oulu, Finland', 'phone' => '358--40-3010-331', 'country_id' => '246','website' => 'Finnish Kendo Association']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //
        Federation::create(['name' => '', 'president_id' => '1', 'address' => '', 'phone' => '', 'country_id' => '','website' => '']); //

        for ($i = 0; $i < 5; $i++) {

            $president = factory(User::class)->create(
                ['role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT'),
                    'password' => bcrypt('111111'),
                    'verified' => 1,]);
            factory(Federation::class)->create(['president_id' => $president->id]);
        }


    }
}
