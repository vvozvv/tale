<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
     public function run()
     {
         $role = Role::create(['name' => 'author']);
         $role2 = Role::create(['name' => 'developer']);
     }
}
