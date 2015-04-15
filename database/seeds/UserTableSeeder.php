<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use App\Models\User\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();


		foreach(range(1, 3) as $index)
		{
			User::create([

                'name'=> $faker->word.$index,
                'email'=> $faker->email,
                'password'=>'secret'


			]);
		}
	}

}
