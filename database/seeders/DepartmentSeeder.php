<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = [
            'Human Resources',
            'Finance',
            'Marketing',
            'IT & Support',
            'Research & Development'
        ];


        foreach ($departments as $dept) {
            $data = Department::insert([
                'name' => $dept,
                'description' =>$dept,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
