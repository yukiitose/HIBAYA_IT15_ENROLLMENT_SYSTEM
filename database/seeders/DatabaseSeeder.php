<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create(['name'=>'Admin User','email'=>'admin@school.edu','password'=>Hash::make('password')]);
        $this->command->info('✓ Admin: admin@school.edu / password');
        $this->call([StudentSeeder::class, CourseSeeder::class, SchoolDaySeeder::class]);
    }
}