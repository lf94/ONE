<?php
class UserTableSeeder extends Seeder {
    public function run() {
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < 10; $i += 1) { 
            User::create(array(
                "email" => $faker->email,
                "fullname" => $faker->name,
                "date_of_birth" => $faker->dateTime,
                "profile_image" => "",
                "password" => Hash::make("a")
            ));
        }
    }
}

?>