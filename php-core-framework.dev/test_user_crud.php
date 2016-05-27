<?php

require_once 'app_config.php';

$faker = Faker\Factory::create();

echo "<p>".$session->flash('msgs')."</p>";

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
$siteLog->write("A New User created");
$session->set('msgs','A New User created');


/* READ */
echo "<p> READ ALL RECORD </p>";
//$dataUserList = User::find('all');
$dataUserList = User::all();
//print_r($dataUserList);
foreach($dataUserList as $dataUser){
	echo "".$dataUser->id." = ".$dataUser->email."<br>";
}


/* READ */
echo "<p> READ BY RECORD ID </p>";
$dataUser = User::find($dataNewUser->id);
//print_r($dataUser);
echo "New User Email: ".$dataUser->email;

/* READ */
echo "<p> READ FIRST </p>";
$dataUser = User::first();
//print_r($dataUser);
echo "FIRST User Email: ".$dataUser->email;

/* READ */
echo "<p> READ LAST </p>";
$dataUser = User::last();
//print_r($dataUser);
echo "LAST User Email ".$dataUser->email;

/* UPDATE */
echo "<p> UPDATE WHERE </p>";
$dataUser = User::find(5);
$dataUser->email = $faker->freeEmail;
$dataUser->save();
echo "UPDATED EEMAIL =  ".$dataUser->email;

/* DELETE */
//echo "<p> DELETE WHERE </p>";
//$dataUser = User::find(12);
//$dataUser->delete();

