<?php


namespace Database\Seeders;


use Spatie\Permission\Models\Role;

class RoleSeeder
{
     public function run()
     {
         $role = Role::create(['name' => 'author']);
         $role2 = Role::create(['name' => 'developer']);
     }
}
