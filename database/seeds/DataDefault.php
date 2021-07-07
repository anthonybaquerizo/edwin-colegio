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
        (new \App\UserType())->fill([
                'name' => 'Administrador',
            ])->save();
        (new \App\UserType())->fill([
                'name' => 'Profesor',
            ])->save();
        (new \App\UserType())->fill([
                'name' => 'Alumno',
            ])->save();
        // Usuario administrador
        (new \App\User())->fill([
                'user_type_id' => 1,
                'username' => 'administrador',
                'email' => 'admin@dominio.com',
                'password' => bcrypt('123456'),
            ])->save();
        (new \App\UserInfo())->fill([
                'user_id' => 1,
                'dni' => '00000000',
                'names' => 'Administrador',
                'last_name' => null,
                'phone' => null,
                'gender' => 'M',
            ])->save();
        // Cursos Grados
        (new \App\CourseGrade())->fill([
            'id' => 1,
            'name' => 'Primaria',
            'status' => 1,
        ])->save();
        (new \App\CourseGrade())->fill([
            'id' => 2,
            'name' => 'Secundaria',
            'status' => 1,
        ])->save();
        // Curso Seccion
        (new \App\CourseSection())->fill([
            'id' => 1,
            'name' => '1° Grado - A',
            'pavilion' => 'A',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 2,
            'name' => '1° Grado - B',
            'pavilion' => 'B',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 3,
            'name' => '2° Grado - A',
            'pavilion' => 'A',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 4,
            'name' => '2° Grado - B',
            'pavilion' => 'B',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 5,
            'name' => '3° Grado - A',
            'pavilion' => 'A',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 6,
            'name' => '3° Grado - B',
            'pavilion' => 'B',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 7,
            'name' => '4° Grado - A',
            'pavilion' => 'A',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 8,
            'name' => '4° Grado - B',
            'pavilion' => 'B',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 9,
            'name' => '5° Grado - A',
            'pavilion' => 'A',
            'number' => 1,
            'status' => 1,
        ])->save();
        (new \App\CourseSection())->fill([
            'id' => 10,
            'name' => '5° Grado - B',
            'pavilion' => 'B',
            'number' => 1,
            'status' => 1,
        ])->save();
        // Cursos Periodo
        (new \App\CoursePeriod())->fill([
            'id' => 1,
            'name' => '201812',
            'year' => 2018,
            'quantity' => 12,
            'status' => 0,
        ])->save();
        (new \App\CoursePeriod())->fill([
            'id' => 2,
            'name' => '201912',
            'year' => 2019,
            'quantity' => 12,
            'status' => 0,
        ])->save();
        (new \App\CoursePeriod())->fill([
            'id' => 3,
            'name' => '202012',
            'year' => 2020,
            'quantity' => 12,
            'status' => 0,
        ])->save();
        (new \App\CoursePeriod())->fill([
            'id' => 4,
            'name' => '202112',
            'year' => 2021,
            'quantity' => 12,
            'status' => 1,
        ])->save();

    }
}
