<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
        DB::table('usuarios')->insert(['nombre' => 'Administrador', 'usuario' => 'admin', 'password' => bcrypt('admin123'), 'tipo' => 'administrador', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }

}
