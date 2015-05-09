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
        User::create(array(
            "email" => "craig@c.com",
            "fullname" => "craiger oleary",
            "date_of_birth" => (new DateTime("2011-10-16")),
            "profile_image" => "",
            "password" => Hash::make("a")
        ));
    }
}

?>