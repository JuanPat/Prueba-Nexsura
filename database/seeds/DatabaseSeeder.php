<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Areas*/

        DB::table('areas')->insert([
            'nombre' => 'Administrativa y Financiera',
        ]);

        DB::table('areas')->insert([
            'nombre' => 'Ingeniería',
        ]);

        DB::table('areas')->insert([
            'nombre' => 'Desarrollo de Negocio',
        ]);

        DB::table('areas')->insert([
            'nombre' => 'Proyectos',
        ]);

        DB::table('areas')->insert([
            'nombre' => 'Servicios',
        ]);

        DB::table('areas')->insert([
            'nombre' => 'Calidad',
        ]);

        /*Rols*/

        DB::table('rols')->insert([
            'nombre' => 'Desarrollador',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Analista',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Tester',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Diseñador',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Profesional PMO',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Profesional de servicios',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Auxiliar administrativo',
        ]);

        DB::table('rols')->insert([
            'nombre' => 'Codirector',
        ]);

        /*Empleado*/
        DB::table('empleados')->insert([
            'nombre' => 'Pedro Pérez',
            'email' => 'pperez@example.co',
            'sexo' => 'm',
            'area_id' => 5,
            'boletin' => 1,
            'descripcion' => 'Hola mundo',
        ]);

        DB::table('empleado_rols')->insert([
            'empleado_id' => 1,
            'rol_id' => 1
        ]);
    }
}
