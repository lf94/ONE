<?php
class CommentTableSeeder extends Seeder {
    public function run() {
        $faker = Faker\Factory::create();
       
       for($i = 0; $i < 10; $i++) 
        Comment::create(array(
        "user_id" => 1,
        "post_id" => 1,
        "message" => $faker->text(50)
        ));
    }
}

?>