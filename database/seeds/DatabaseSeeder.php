<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
		$this->call('CategoryTableSeeder');
	}

}

class CategoryTableSeeder extends Seeder{

	public function run()
	{
		DB::table('categories')->delete();

		for($i = 0; $i < 276; $i++)
		{
			$faker = Faker\Factory::create();
			Category::create(['name' => $faker->sentence]);
		}
	}
}

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();

		User::create(['name' => 'Vedovelli', 'email' => 'fabio@vedovelli.com.br', 'password' => Hash::make('123456')]);

		$faker = Faker\Factory::create();

		for($i = 0; $i < 100; $i++)
		{
			User::create([
				'name' => $faker->firstName,
				'email' => $faker->email,
				'password' => Hash::make($faker->word)]);
		}
	}
}