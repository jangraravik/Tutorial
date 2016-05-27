<?php


require_once 'app_config.php';


$faker = Faker\Factory::create();

/*
// More Example
// https://github.com/fzaninotto/Faker#installation

for ($i=0; $i < 10; $i++) {
  echo "First Name = ".$faker->firstName($gender = null|'male'|'female')."<br>";
  echo "Last Name = ".$faker->lastName."<br>";
  echo "Date of birth = ".$faker->date($format = 'Y-m-d', $max = 'now')."<br>";
  echo "Gender = ".$faker->title($gender = null|'male'|'female')."<br>";  
  echo "Job = ".$faker->jobTitle."<br>";
  echo "Email = ".$faker->freeEmail."<br>";
  echo "Phone = ".$faker->e164PhoneNumber."<br>";  
  echo "Username = ".$faker->userName."<br>";  
  echo "Password = ".$faker->password."<br>";
  echo "Country = ".$faker->country."<br>";
  echo "City = ".$faker->city."<br>";
  echo "Place = ".$faker->streetAddress."<br>";
  echo "Zip Code = ".$faker->postcode."<br>";
  echo "Website = ".$faker->domainName."<br>";
  echo "Date of Joining = ".$faker->date($format = 'Y-m-d', $max = 'now')."<br>";
  echo "Active Status = ".$faker->boolean($chanceOfGettingTrue = 80)."<br>";
  echo "<hr>";
}
*/

/* CREATE */
echo "<p> CREARE NEW RECORD </p>";
$dataNewUser = User::create([
  "fname"=>$faker->firstName($gender = null|'male'|'female'),
  "lname"=>$faker->lastName,
  "dob"=>$faker->date($format = 'Y-m-d', $max = 'now'),
  "gender"=>$faker->title($gender = null|'male'|'female'),  
  "job"=>$faker->jobTitle,
  "email"=>$faker->freeEmail,
  "phone"=>$faker->e164PhoneNumber,  
  "username"=>$faker->userName,  
  "password"=>$faker->password,
  "country"=>$faker->country,
  "city"=>$faker->city,
  "place"=>$faker->streetAddress,
  "zip"=>$faker->postcode,
  "website"=>$faker->domainName,
  "doj"=>$faker->date($format = 'Y-m-d', $max = 'now'),
  "is_active"=>$faker->boolean($chanceOfGettingTrue = 80)
]);
//print_r($dataNewUser);
echo "New User id = ". $dataNewUser->id;