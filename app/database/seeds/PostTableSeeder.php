<?php
class PostTableSeeder extends Seeder {
    public function run() {
        Post::create(array(
        "user_id" => 1,
        "privacy_setting" => "global",
        "title" => "who am i",
        "message" => "i am george"
        ));
        Post::create(array(
        "user_id" => 1,
        "privacy_setting" => "global",
        "title" => "who am i????",
        "message" => "i am GEORGE"
        ));
        Post::create(array(
        "user_id" => 1,
        "privacy_setting" => "private",
        "title" => "who are you",
        "message" => "not george"
        ));
        Post::create(array(
        "user_id" => 2,
        "privacy_setting" => "friends",
        "title" => "who am i for a third time",
        "message" => "i am maybe someone"
        ));
    }
}

?>