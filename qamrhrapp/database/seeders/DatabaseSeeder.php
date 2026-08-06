<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    User::create([
      'name' => 'John',
      'l_name' => 'Doe',
      'phone_number' => '1234567890',
      'email' => 'john@example.com',
      'password' => bcrypt('password'),
    ]);

    User::create([
      'name' => 'Jane',
      'l_name' => 'Smith',
      'phone_number' => '9876543210',
      'email' => 'jane@example.com',
      'password' => bcrypt('password'),
    ]);

    User::create([
      'name' => 'Alice',
      'l_name' => 'Johnson',
      'phone_number' => '5555555555',
      'email' => 'alice@example.com',
      'password' => bcrypt('password'),
    ]);
  }
}
