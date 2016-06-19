<?php

use App\Association;
use App\User;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {
        Association::truncate();
        Association::create(['name' => 'core.no_association', 'president_id' => '1']);
        // Create Martin
        $aikem_presidente = factory(User::class)->create(
            ['name' => 'AIKEM_President',
                'email' => 'aikem@kendozone.com',
                'role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT'),
                'password' => bcrypt('aikem'),
                'verified' => 1,
                'country_id' => 484,
                'federation_id' => 37,
                'association_id' => 7, // FK Check unactive
            ]);

        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo y Artes Marciales Afines del Distrito Federal, A.C.', 'president_id' => '1', 'address' => '', 'phone' => '55 17 63 48 59', 'state' => 'Distrito Federal']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo del Estado de Nuevo León, A.C.	', 'president_id' => '1', 'address' => '', 'phone' => '811 486 0071', 'state' => 'Nuevo Léon']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo del Estado de Veracruz, A.C.', 'president_id' => '1', 'address' => '', 'phone' => '(229) 9374231', 'state' => 'Veracruz']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo Iaido y Jodo del Estado de Coahuila, A.C.', 'president_id' => '1', 'address' => '', 'phone' => '(871) 7292971', 'state' => 'Coahuila']);
        Association::create(['federation_id'=> 37,'name' => 'ASOCIACION DE KENSHI DEL ESTADO DE PUEBLA, A.C.', 'president_id' => '1', 'address' => '', 'phone' => '', 'state' => 'Puebla']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación Mexiquense de Kendo, A.C.', 'president_id' => $aikem_presidente->id, 'address' => '', 'phone' => '(55) 13011905', 'state' => 'Estado de México']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo de la Universidad Autónoma de México', 'president_id' => '1', 'address' => '', 'phone' => '', 'state' => 'Distrito Federal']);
        Association::create(['federation_id'=> 37,'name' => 'Grupo de Kendo del Estado de Chihuahua', 'president_id' => '1', 'address' => '', 'phone' => '(614) 4820716', 'state' => 'Chihuahua']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Iaido y Kendo de Querétaro', 'president_id' => '1', 'address' => '', 'phone' => '', 'state' => 'Querétaro']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo, Iaido y Jodo de Jalisco TenKen Ryuu AC', 'president_id' => '1', 'address' => '', 'phone' => '(044) 33 3393-6164', 'state' => 'Jalisco']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Iaido y Kendo del Instituto Politécnico Nacional', 'president_id' => '1', 'address' => '', 'phone' => '(044) 55-24-95-95-15', 'state' => 'Distrito Federal']);
        Association::create(['federation_id'=> 37,'name' => 'Grupo de Kendo del Estado de San Luis Potosí', 'president_id' => '1', 'address' => '', 'phone' => '', 'state' => 'San Luis Pótosi']);
        Association::create(['federation_id'=> 37,'name' => 'Asociación de Kendo del Estado de Morelos', 'president_id' => '1', 'address' => '', 'phone' => '045-777-303-1202', 'state' => 'Morelos']);
        Association::create(['federation_id'=> 37,'name' => 'ASOCIACIÓN ESTATAL DE KENDO E IAIDO DE AGUASCALIENTES, A.C.', 'president_id' => '1', 'address' => '', 'phone' => '4492094939', 'state' => 'Aguascalientes']);

        factory(Association::class, 5)->create(['federation_id' => 3]);
        factory(Association::class, 5)->create();


        $this->command->info('Associations Seeded!');
    }
}
