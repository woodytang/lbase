<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use App\Models\Post\Post;
use App\Models\User\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
        $users = User::lists('id');

		foreach(range(1, 50) as $index)
		{
			Post::create([

                'title'=>$faker->sentence(),
                'content'=>$faker->paragraph(),
                'user_id'=>$faker->randomElement($users)

			]);
		}
	}

}
