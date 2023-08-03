<?php

 require_once('db.php');

    // if ($con){
    //     echo "Successfully created Connection";
    // }


   $name = $email = $password = $gender = "";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name     = user_input($_POST["name"]);
      $email    = user_input($_POST["email"]);
      $password = user_input($_POST["password"]);
      $gender   = user_input($_POST["gender"]);

    // if(isset($password)){
    //   echo '<p style="color:green;font-weight:bold;"> Yes!! Password is Set </p>';
    // }else{
    //   exit();
    //   // die();
    // }
    // chek to see that no value is empty
    if(!empty($name) && !empty($gender) && !empty($password) && !empty($email)){
      // echo $name.'<br/>'; 
      // echo $email . '<br/>';
      // echo $password . '<br/>';
      // echo $gender ;
      $password = sha1(md5(md5($password))); // hash the password
      // creating record in the database
      $sql   = "INSERT INTO `user_info`(`name`, `email`, `gender`, `password`) VALUES ('$name', '$email', '$gender', '$password')";
      $query = $con->query($sql);
      // checfk if the query succeded 
      if($query){
         echo "Successfully created a new user :".$password.' Count '.strlen($password);
      }else{
        echo "Failed to create a Record  :".$con->error;
      }

    }else{
      echo '<p style="color:red;font-weight:bold;"> All Fields are reuired!! </p>';
    }

  }


  function user_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>