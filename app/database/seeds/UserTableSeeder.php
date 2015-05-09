<?php
class UserTableSeeder extends Seeder {
    public function run() {
        User::create(array(
            "email" => "george@g.com",
            "fullname" => "george mcgee",
            "date_of_birth" => (new DateTime("2014-12-10")),
            "profile_image" => "",
            "password" => Hash::make("a")
        ));
    }
}

?>