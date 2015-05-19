<?php
class FriendTableSeeder extends Seeder {
    public function run() {
        Friend::create(array(
            "user_id" => 1,
            "friend_id" => 2
        ));
        Friend::create(array(
            "user_id" => 2,
            "friend_id" => 1
        ));
        Friend::create(array(
            "user_id" => 1,
            "friend_id" => 3
        ));
        Friend::create(array(
            "user_id" => 3,
            "friend_id" => 1
        ));
        Friend::create(array(
            "user_id" => 4,
            "friend_id" => 1
        ));
        Friend::create(array(
            "user_id" => 1,
            "friend_id" => 4
        ));
    }
}

?>