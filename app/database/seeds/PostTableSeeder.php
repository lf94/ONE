<?php
class PostTableSeeder extends Seeder {
    public function run() {
        $faker = Faker\Factory::create();
        
        for($j = 1; $j <= 10; $j++) {
            $posts = $faker->numberBetween(0,15);
            for($i = 0; $i < $posts; $i++) {
                Post::create([
                "user_id" => $j,
                "privacy_setting" => $faker->randomElement(['global','friends','private']),
                "title" => $faker->sentence(3),
                "message" => $faker->text(200)
                ]);
            }
        }
    }
}

?>