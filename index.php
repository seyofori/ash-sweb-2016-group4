<html>
  <head>
    <title>login</title>
  </head>

  <body>
    <!--Form to collect information to login-->
    <form action="" method="GET" onsubmit='validate()'>
      <div>Username: <input type="text" name="username" value=""/></div>
      <div>Password: <input type="password" name="password" value=""/></div>
      <input type="submit" name="Login">

      <?php
      //Included the user class
        include_once("users.php");

      //Created a user object
        $user = new users();

        if(!isset($_REQUEST['username'])){
          exit();		//if no data, exit
        }

        //Stores the users information
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];

        //Calls the login methods
        $verify=$user->login($username,$password);

        //Displays the whether user exists or not
        if($verify==false){
          echo"user does not exist";
        }
        else{
          echo "verified";
        header("Location:homepage.php?userType={$verify["userType"]}");
        exit();
        }
      ?>
    </form>

  </body>
</html>
