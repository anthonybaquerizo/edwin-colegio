<?php

use Illuminate\Database\Seeder;

class DataDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tipos de Usuario
        (new \App\UserType())
            ->fill([
                'name' => 'Administrador',
            ])->save();
        (new \App\UserType())
            ->fill([
                'name' => 'Profesor',
            ])->save();
        (new \App\UserType())
            ->fill([
                'name' => 'Alumno',
            ])->save();
        // Usuario administrador
        (new \App\User())
            ->fill([
                'user_type_id' => 1,
                'username' => 'administrador',
                'email' => 'admin@dominio.com',
                'password' => bcrypt('123456'),
            ])->save();
        (new \App\UserInfo())
            ->fill([
                'user_id' => 1,
                'dni' => '00000000',
                'names' => 'Administrador',
                'last_name' => null,
                'phone' => null,
            ])->save();
    }
}
