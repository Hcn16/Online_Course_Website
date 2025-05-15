<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run(): void
    {
        DB::table("roles")->insert([
            ['name' => 'admin', 'description_name' =>'Quản trị hệ thống'],
            ['name' => 'guest', 'description_name' =>'Người dùng'],
            ['name' => 'developer', 'description_name' =>'Phát triển hệ thống'],
            ['name' => 'content', 'description_name' =>'Chỉnh sửa nội dung'],

        ]);
    }
}
