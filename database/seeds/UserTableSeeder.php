<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\user;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name','employee')->first();
        $role_manager  = Role::where('name', 'admin')->first();
       	$role_saler = Role::where('name', 'saler')->first();

       	$employee = new User();
       $employee->name = 'son1';
       $employee->email = 'son1@example.com';
       $employee->password = bcrypt('123456');
       $employee->save();
       $employee->roles()->attach($role_employee);

       $saler = new User();
       $saler->name = 'son2';
       $saler->email = 'son2@example.com';
       $saler->password = bcrypt('123456');
       $saler->save();
       $saler->roles()->attach($role_saler);

       $manager = new User();
       $manager->name = 'son3';
       $manager->email = 'son3@example.com';
       $manager->password = bcrypt('123456');
       $manager->save();
       $manager->roles()->attach($role_manager);
    }
}
