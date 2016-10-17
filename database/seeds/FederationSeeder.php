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
        $this->command->info('Federations Seeding!');
        Federation::truncate();
        // Create Maya
        $fmk_president = factory(User::class)->create(
            ['name' => 'FMK',
                'email' => 'fmk@kendozone.com',
                'role_id' => Config::get('constants.ROLE_FEDERATION_PRESIDENT'),
                'password' => bcrypt('fmk'),
                'country_id' => 484,
                'federation_id' => 36, // FK Check unactive
                'verified' => 1]);

        
        // Europa
        Federation::create(['name' => 'The British Kendo Association', 'president_id' =>null, 'address' => '113 Vibart Road, Yardley, Birmingham, B26 2AB, UK', 'phone' => '32-2-672-8342', 'country_id' => 826, 'website' => 'www.kendo.org.uk','email' =>'BKAchair@britishkendoassociation.com']); //
        Federation::create(['name' => 'Comite National de Kendo/FFJDA', 'president_id' =>null, 'address' => '21-25 avenue de la Porte de Chatillon 75014 Paris Cedex 14, France', 'phone' => '33-140-52-1681', 'country_id' => 250, 'website' => ' www.cnkendo-dr.com','email' =>'kendo@ffjudo.com']); //
        Federation::create(['name' => 'Kendo Section, Swedish Budo & Martial Arts Federation', 'president_id' =>null, 'address' => 'C/O Mr. Iask Rubensson, Torsvagen 13, 19267 SOLLENTUNA, Sweden, B26 2AB, UK', 'phone' => '46-70-786-1622', 'country_id' => 752, 'website' => 'www.kendoforbundet.se','email' =>'president@kendoforbundet.se']); //
        Federation::create(['name' => 'All Belgium Kendo Federation', 'president_id' =>null, 'address' => 'c/o Mr. Daniel Delepiere, Bosbessenlaan 6, B-3090, Overijse, Belgium', 'phone' => '32-476-960-072', 'country_id' => '56', 'website' => 'www.abkfevents.be','email' =>'president@abkf.be']); //
        Federation::create(['name' => 'Nederlandse Kendo Renmei', 'president_id' =>null, 'address' => 'C/O Mr.K.Hattum, Hoofdstraat 187, 3114 GD Schiedam, Netherlands', 'phone' => '31-1044191631', 'country_id' => '528', 'website' => ' www.nkr.nl','email' =>'k.vanhattum@nkr.nl']); //
        Federation::create(['name' => 'Swiss Kendo and Iaido, SJV/FSJ', 'president_id' =>null, 'address' => 'Swiss Kendo & Iaido, CH-1004, Lausanne, Switzerland', 'phone' => '41-21-6489102', 'country_id' => '756', 'website' => 'www.kendo.ch','email' =>'president@kendo.ch']); //
        Federation::create(['name' => 'Deutscher Kendobund e. V. (DKenB)', 'president_id' =>null, 'address' => 'C/O Mr. Detlef Viebranz, Im Buchholzfelde 3 30966 Hemmingen, Germany', 'phone' => '49-511-2330963', 'country_id' => '276', 'website' => 'www.dkenb.de','email' =>'praesident@dkenb.de']); //
        Federation::create(['name' => 'Royal Spanish Judo Federation and Associated Sports', 'president_id' =>null, 'address' => 'C/ Ferraz, 16-7 Izq, 28008, Madrid, Spain', 'phone' => '34-91-559-4958', 'country_id' => '724', 'website' => 'www.rfejudo.com  ','email' =>'info@rfejudo.com']); //
        Federation::create(['name' => 'Austrian Kendo Association', 'president_id' =>null, 'address' => 'c/o Mr. Harald Hofer Markfeldgasse 4/5・A-2380, Perchtoldsdorf, Austria', 'phone' => '43-1-86-55-022', 'country_id' => '40', 'website' => 'http://www.kendo-austria.at ','email' =>'president@kendo-austria.at']); //
        Federation::create(['name' => 'Norwegian Kendo Committee  -Norweigan Martial Arts Federation', 'president_id' =>null, 'address' => 'C/O Mr. Joakim Kosmo Tiriltunga 54, 1259, Oslo, Norway', 'phone' => '47-480-49369', 'country_id' => '578', 'website' => '','email' =>'nkf-kendo@kampsport.no']); //
        Federation::create(['name' => 'Danish Kendo Federation', 'president_id' =>null, 'address' => 'C/O David A. Mwaipaya  Carl Blochs Vej 99 5230 Odense M Denmark', 'phone' => '45-22-45-60-81', 'country_id' => '208', 'website' => 'www.kendo-dkf.dk ','email' =>'president@kendo-dkf.dk']); //
        Federation::create(['name' => 'Finnish Kendo Association', 'president_id' =>null, 'address' => 'c/o Mr. Mika Kankainen, Puikkaritie 4 B 1  90520 Oulu, Finland', 'phone' => '358--40-3010-331', 'country_id' => '246', 'website' => 'Finnish Kendo Association','email' =>'mika.kankainen@fka.fi']); //
        Federation::create(['name' => 'Confederazione Italiana Kendo', 'president_id' =>null, 'address' => 'C.P.38 Angera (Va), Italy', 'phone' => '39-02-700591227', 'country_id' => '380', 'website' => 'www.kendo-cik.it','email' =>'presidente@kendo-cik.it']); //
        Federation::create(['name' => 'Hungarian Kendo, Iaido & Jodo Federation', 'president_id' =>null, 'address' => 'H-1073 Budapest,Dob u. 80. I. 12, Hungary', 'phone' => '36-1-342-0034', 'country_id' => '348', 'website' => 'www.kendo.hu','email' =>'office@kendo.hu']); //
        Federation::create(['name' => 'Polish Kendo Federation', 'president_id' =>null, 'address' => ' (Head Office) PL-91-463 Lodz, Zgierska 73, pok. 410, Poland', 'phone' => '48-42-2536-153', 'country_id' => '616', 'website' => ' www.kendo.pl','email' =>'kendo@kendo.pl']); //
        Federation::create(['name' => 'Serbian Kendo Federation', 'president_id' =>null, 'address' => 'c/o Mr. Milos Pavlovic, Serbian Kendo Federation, Makedonska 28/2, 11000, Beograd, Serbia', 'phone' => '381-11-3035044', 'country_id' => '688', 'website' => 'www.kendo.rs','email' =>'president@kendo.rs']); //
        Federation::create(['name' => 'Czech Kendo Federation', 'president_id' =>null, 'address' => 'c/o Mr. Tomas Jelen, Dvoristska 1244 19800 Praha 9, Czech Republic', 'phone' => '420-737444231', 'country_id' => '203', 'website' => 'www.czech-kendo.cz','email' =>'info@czech-kendo.cz']); //
        Federation::create(['name' => 'The Romanian Kendo Department, Federation of Contact Martial Arts', 'president_id' =>null, 'address' => 'Baba Novac Street, no. 3, bl. S2, sc. 2, ap. 57, District 3, 031633, Bucharest, Romania', 'phone' => '40-743-224-131', 'country_id' => '642', 'website' => 'www.kendo-romania.ro','email' =>'sorinmahika@gmail.com']); //
        Federation::create(['name' => 'Shobukai Kendo Luxembourg', 'president_id' =>null, 'address' => 'FLAM C/O Mr. Dias de Carvalho Romaniga (KENDO)  52, route dePetange L-4645 Niederkorn, Luxembourg', 'phone' => '352-691-632-169', 'country_id' => '442', 'website' => 'www.shobukai.lu','email' =>'shobukai.kendo@gmail.com']); //
        Federation::create(['name' => 'Russian Kendo Federation', 'president_id' =>null, 'address' => 'Proezd Kadomtseva, d. 17, kv.16, RU-129128, Moscow, Russia', 'phone' => '7-916-118-7949', 'country_id' => '643', 'website' => 'www.kendo-russia.ru','email' =>'aloev@yandex.ru']); //
        Federation::create(['name' => 'Associacao Portuguesa de Kendo', 'president_id' =>null, 'address' => 'Alameda dos Oceanos, Lote 3.13.03c-4A, 1990-207 Lisboa-Poltugal', 'phone' => '351-919851862', 'country_id' => '620', 'website' => 'www.kendo.pt','email' =>'presidente@kendo.pt']); //
        Federation::create(['name' => 'Kendo na h-Eireann', 'president_id' =>null, 'address' => 'C/O Kathryn CASSIDY,  27 The Wheat Barn Baker\'s Yard North Portland Street, Dublin 1, Ireland', 'phone' => '353-85-1432065', 'country_id' => '372', 'website' => 'www.irishkendofederation.org','email' =>'secretary@irishkendofederation.org']); //
        Federation::create(['name' => 'Federacio Andorrana de Kendo', 'president_id' =>null, 'address' => 'Centre Esportiu Serradells, Carretera de la Comella s/n, AD500 Andorra la Vella, Principat d\'Andorra', 'phone' => '376-362979', 'country_id' => '20', 'website' => 'www.kendo-andorra.org','email' =>'office@kendo.bg']); //
        Federation::create(['name' => 'Bulgarian Kendo Federation', 'president_id' =>null, 'address' => 'JK Hadji Dimitar Zlatitsa St., bl. 138, ent. 3, floor 3, apt. 48, Sofia 1510, Bulgaria', 'phone' => '359-29457180', 'country_id' => '100', 'website' => 'www.kendo.bg','email' =>'office@kendo.bg ']); //
        Federation::create(['name' => 'Hellenic Kendo Iaido Naginata Federation', 'president_id' =>null, 'address' => 'C/O Mr. I Papadimitriou, Ierolochiton 63, GR-38334, Volos, P,C, Greece', 'phone' => '30-242-1063079 / 30-242-1034880', 'country_id' => '300', 'website' => '','email' =>'kendohellas@gmail.com']); //
        Federation::create(['name' => 'Israel Kendo & Budo Federation', 'president_id' =>null, 'address' => 'P.O.Box 171 Ein Sarid Israel', 'phone' => '972-54-4443312', 'country_id' => '376', 'website' => '','email' =>'pashkasan80@gmail.com']); //
        Federation::create(['name' => 'Montenagrian Kendo Federation', 'president_id' =>null, 'address' => 'C/O Mr. Djuro Stojanovic, Boska Buhe 39, 81000 Podgorica, Montenegro', 'phone' => '382-6901-0346', 'country_id' => '499', 'website' => '','email' =>'miras.sljivancanin@gmail.com']); //
        Federation::create(['name' => 'Latvian Kendo Federation', 'president_id' =>null, 'address' => 'Malnavas Street 18-34, LV 1057, Riga Latvia', 'phone' => '371-29217637', 'country_id' => '428', 'website' => '','email' =>'KWON@APOLLO.LV']); //
        Federation::create(['name' => 'Lithuanian Kendo Association', 'president_id' =>null, 'address' => 'Poloko g. 11-10, 01204 Vilnius, Lithuania', 'phone' => '370-650-19680', 'country_id' => '440', 'website' => 'www.kendo-lka.lt','email' =>'president@kendo-lka.lt']); //
        Federation::create(['name' => 'Croatian Kendo Assosiation', 'president_id' =>null, 'address' => 'Sestinski dol 8 b, 10000 Zagreb, Croatia', 'phone' => '385-1-33 67 219', 'country_id' => '191', 'website' => 'http://www.kendo.hr','email' =>'office@kendo.hr']); //
        Federation::create(['name' => 'Kendo zveza Slovenije/Kendo Federation of Slovenia', 'president_id' =>null, 'address' => 'Topolsica 27, SI-3326 Topolsica Slovenia', 'phone' => '386-40-629-622', 'country_id' => '705', 'website' => 'http://www.kendo-zveza.si','email' =>'kzs.predsednik@gmail.com']); //
        Federation::create(['name' => 'Turkish Kendo Association', 'president_id' =>null, 'address' => 'Uzuncair Sok. Detay Apt. No:14 D:6, Uskudar-Acibadem Istanbul-Turkey 34660', 'phone' => '90-5322139862', 'country_id' => '792', 'website' => '','email' =>'turkiyekendo@yahoo.com']); //
        // America
        Federation::create(['name' => 'All United States Kendo Federation', 'president_id' =>null, 'address' => 'C/O Mr. Yoshiteru TAGAWA, AUSKF president, 41444 Fawn Trail, Novi, Michigan, 48375-4813 USA', 'phone' => '1-248-349-5377', 'country_id' => '840', 'website' => 'www.AUSKF.INFO','email' =>'duketagawa@gmail.com']); //
        Federation::create(['name' => 'Hawaii Kendo Federation', 'president_id' =>null, 'address' => 'c/o Ms. Kathleen Nekomoto 775 Kinalau place #2006 Honolulu, Hawaii 96813', 'phone' => '1-808-551-9892', 'country_id' => '840', 'website' => 'www.hawaiikendo.com','email' =>'kathleenn0326@gmail.com']); //
        Federation::create(['name' => 'Canadian Kendo Federation', 'president_id' =>null, 'address' => '65,Saint-Paul Street west, Apt 610 Montreal, QC, Canada H2Y 3S5', 'phone' => '1-514-844-469', 'country_id' => '124', 'website' => 'http://kendo-canada.com/','email' =>'ckfoffice@kendo-canada.com']); //
        Federation::create(['name' => 'Mexican Kendo Federation', 'president_id' => $fmk_president->id, 'address' => 'C/O Mr. Ing. Jesus Maya Martinez, President, Mexican Kendo Federation Av. Rio Churrubusco puerta 9 , entre Anily Viaducto Rio de la Piedad, col. Magdalena Mixihuca, Iztacalco, 08010, Mexico D.F, Mexico', 'phone' => '52-4455-4339-0414', 'country_id' => '484', 'website' => 'www.kendo.mx','email' =>'jesus.maya@gmail.com']); //
        Federation::create(['name' => 'Brazilian Kendo Confederation', 'president_id' =>null, 'address' => 'c/o Mr. C.Kogima, Rua Monsenhor Basillo Pereira, 271 Parque Jabaquara- Sao Paulo- Brazil, 04343-090', 'phone' => '55-11-9-5584-6291', 'country_id' => '76', 'website' => 'www.cbkendo.esp.br','email' =>'cbkendo@uol.com.br']); //
        Federation::create(['name' => 'Federacion Argentina de Kendo', 'president_id' =>null, 'address' => 'Mr. Francisco SCARAMELLINI, Quintana 1740 CP 3400 Corrientes Argentina', 'phone' => '54-379-4427362', 'country_id' => '32', 'website' => 'www.kendoargentina.org','email' =>'fak.kendo@hotmail.com']); //
        Federation::create(['name' => 'Federacion Venezolana de Kendo', 'president_id' =>null, 'address' => 'Mr. Ariel Pintos, Calle Cuyuni, Quinta Maral, Colinas de Bello Monte, Caracas 1051, Venezuela, Sur America', 'phone' => '58-212-7533226', 'country_id' => '862', 'website' => 'www.fvkendo.com','email' =>'arielpintos7@gmail.com']); //
        Federation::create(['name' => 'Kendo Aruba/Bun Bu Itchi ', 'president_id' =>null, 'address' => 'c/o Mr. S. A. Velasquez, Mazurka 13, Cunucu Abao, Aruba (Dutch Caribbean)', 'phone' => '297-5-873974', 'country_id' => '533', 'website' => 'www.kendoaruba.com','email' =>'Kendoaru@setarnet.aw']); //
        Federation::create(['name' => 'Chilean Kendo Federation', 'president_id' =>null, 'address' => 'Avenida Providencia 2528, local 210. Providencia, Santiago, Chile, 7510007', 'phone' => '56-09-8755-3369', 'country_id' => '152', 'website' => 'www.kendo.cl','email' =>'kendochile@gmail.com']); //
        Federation::create(['name' => 'Federation Dominicana de Kendo', 'president_id' =>null, 'address' => 'Calle Caonabo 66 Edificio Raycarlos 102 Gazcue, Santo Domingo, Dominican Republic', 'phone' => '809-224-0457', 'country_id' => '214', 'website' => 'www.cbnintl.com','email' =>'osturla@yahoo.com']); //
        Federation::create(['name' => 'Asociacion Ecuatoriana de Kendo', 'president_id' =>null, 'address' => 'P.O.Box 17-07-9024, Quito,Ecuador', 'phone' => '593-2-2431-285', 'country_id' => '218', 'website' => 'http://kendoecuador.org','email' =>'fernando.benavides@idimafiltros.net']); //
        // Africa
        Federation::create(['name' => 'South African Kendo Federation', 'president_id' =>null, 'address' => 'P.O. BOX 785577, Sandton, Johanesburg, South Africa, 2146', 'phone' => '27-82-389-9098', 'country_id' => '710', 'website' => 'www.sakf.co.za','email' =>'info@sakf.co.za']); //
        //Oceania
        Federation::create(['name' => 'Australian Kendo Renmei Incorporated', 'president_id' =>null, 'address' => ' PO Box 353, North Carlton, VIC 3054, Australia', 'phone' => '-', 'country_id' => '36', 'website' => 'www.kendoaustralia.asn.au','email' =>'akrpresident@kendoaustralia.asn.au ']); //
        Federation::create(['name' => 'New Zealand Kendo Federation', 'president_id' =>null, 'address' => '82a Bay Rd., St. Heliers, Aukland, New Zealand', 'phone' => '64-21-274-2415', 'country_id' => '554', 'website' => 'www.kendo.org.nz','email' =>'grahams@north21.co.nz']); //





    }
}
