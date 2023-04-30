<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $roleArray = ['Admin', 'Student', 'Teacher'];
        foreach ($roleArray as  $value) {
            Role::create([
                'role_name'=>$value,
                'status'=> true,
                'slug'=>Str::slug($value),
            ]);
        }
        // for ($i = 1; $i <= 10; $i++) {
        //     $isUserCreated = User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => bcrypt($faker->password),

        //     ]);
        //     if($isUserCreated){
        //         $isProfileCreated = $isUserCreated->profile()->create([
        //             'gender' => 'Male',
        //             'dob' => $faker->date,
        //             'blood_group' => 'B+',
        //             'religion' => 'Hindu',
        //         ]);
        //     }
        //     $isStudentRole = Role::where('role_name', 'Student')->get();
        //     $isUserCreated = $isUserCreated->roles()->attach($isStudentRole);
        // }
        $isUserCreated = User::create([
            'name' => 'Subhajit Saha',
            'email' => 'ssaha@gmail.com',
            'password' => bcrypt('Test@1234'),
        ]);
        if($isUserCreated){
            $isProfileCreated = $isUserCreated->profile()->create([
                'phone' => '7003041433',
                'address' => 'kolkata',
                'blood_group' => 'B+',
                'gender' => 'Male',
                'religion' => 'Hindu',
                'dob' => '2023-01-01',
                'picture' => '1676103631myfile.jpg',
            ]);
        }
        $isAdminRole = Role::where('role_name', 'Admin')->get();
        $isUserCreated = $isUserCreated->roles()->attach($isAdminRole);
    }
}
