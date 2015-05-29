<?php
class FriendTableSeeder extends Seeder {
    public function run() {
        for($i = 1; $i < 10; $i++) {
            for($j = 1; $j < 10; $j++) {
                if($i == $j) {
                    continue;
                }
                Friend::create(array( 'user_id' => $i, 'friend_id' => $j ));
            }
        }
    }
}

?>