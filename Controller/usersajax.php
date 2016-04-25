<?php
	//check command
	if(!isset($_REQUEST['cmd'])){
		echo "cmd is not provided";
		exit();
	}
	/*get command*/
	$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			editUserName();		//if cmd=1 the call delete
			break;
    case 2:
      editFirstName();
      break;
		case 3:
			editLastName();
			break;
		case 4:
		  deleteUser();
		  break;
		case 5:
			addNewUser();
			break;
		case 6:
			login();
			break;
		case 7:
			addNewDrug();
			break;
		case 8:
			addNewTool();
			break;
		case 9:
			addNewSupplier();
			break;
		default:
			echo "wrong cmd";	//change to json message
			break;
	}


  function editUserName(){
    include_once("../Model/users.php");

		if(!isset($_REQUEST['uc'])){
			echo"No user information";
		}
		$usercode=$_REQUEST['uc'];
		$username=$_REQUEST['username'];

		$user = new users();

		$verify = $user->editName(1,$username,$usercode);
		if($verify==true){
			echo"User Changed";
		}
		else{
			echo"User not changed";
		}
  }

	function editFirstName(){
    include_once("../Model/users.php");

		if(!isset($_REQUEST['uc'])){
			echo"No user information";
		}
		$usercode=$_REQUEST['uc'];
		$firstname=$_REQUEST['firstname'];

		$user = new users();

		$verify = $user->editName(2,$firstname,$usercode);
		if($verify==true){
			echo"User Changed";
		}
		else{
			echo"User not changed";
		}
  }

	function editLastName(){
		include_once("../Model/users.php");

		if(!isset($_REQUEST['uc'])){
			echo"No user information";
		}
		$usercode=$_REQUEST['uc'];
		$lastname=$_REQUEST['lastname'];

		$user = new users();

		$verify = $user->editName(3,$lastname,$usercode);
		if($verify==true){
			echo"User Changed";
		}
		else{
			echo"User not changed";
		}
	}

	  function deleteUser(){
	    if(!isset($_REQUEST['uc'])){
	      echo "usercode is not given";
	      exit();
	    }

	    $Id=$_REQUEST['uc'];
	    include("../Model/users.php");
	    $user=new users();
	    //delete the user
	    if($user->deleteUser($Id)){
	      echo "User deleted";
	    }else{
	      echo "User was not deleted.";
	    }
	  }

		function addNewUser(){
			include("../Model/users.php");
			$user=new users();
			if(!isset($_REQUEST['username'])){
				echo "User info not given";
				exit();
			}

			$username=$_REQUEST['username'];
			$firstname=$_REQUEST['firstname'];
			$lastname=$_REQUEST['lastname'];
			$password=$_REQUEST['password'];
			$email=$_REQUEST['email'];
			$type=$_REQUEST['type'];

			$verify=$user->addNewUser($username,$firstname,$lastname,$password,$email,$type);
			if($verify==false){
				echo'{"result":0,"message":"User not added"}';
			}
			else{
				echo'{"result":1,"message":"User added"}';
			}
		}

		function login(){
			include("../Model/users.php");
			$username=$_REQUEST['username'];
			$password=$_REQUEST['password'];
			$user = new users();

			$verify = $user->login($username,$password);

			if($verify==false){
				$ans= $user->getEmail($username);
				$ans=$user->fetch();
				if($ans!=false){
					$array = array('result'=>0,'message'=>'Please enter the right password','email'=>$ans["email"]);
					echo json_encode($array);
				}
				else{
					echo '{"result":0,"message":"Wrong User information"}';
				}

			}
			else{
				session_start();
				$_SESSION['user']=$verify;
				echo'{"result":1,"message":"Welcome to the AIS"}';
			}

		}

		function addNewDrug(){
				include("../Model/drugs.php");
				$drug=new drugs();
				if(!isset($_REQUEST['drugname'])){
					echo "drugId not given";
					exit();
				}
				$drugname=$_REQUEST['drugname'];
				$drugquantity=$_REQUEST['drugquantity'];
				$drugsupplier=$_REQUEST['drugsupplier'];
				$drugtype=$_REQUEST['drugtype'];
				$verify=$drug->addDrug($drugname,$drugquantity,$drugsupplier,1,"Drugs");
				if($verify==false){
					echo'{"result":0,"message":"Drug not added"}';
				}
				else{
					echo'{"result":1,"message":"Drug added"}';
				}
			}

		function addNewTool(){
			include("../Model/tools.php");
			$tool=new tools();
			if(!isset($_REQUEST['toolname'])){
				echo "Tool ID is not given";
				exit();
			}
			$toolname=$_REQUEST['toolname'];
			$toolquantity=$_REQUEST['toolquantity'];
			$toolsupplier=$_REQUEST['toolsupplier'];
			$verify=$tool->addTool($toolname,$toolquantity,$toolsupplier,"Tools","Tools");
			if($verify==false){
				echo'{"result":0,"message":"Tool not added"}';
			}
			else{
				echo'{"result":1,"message":"Tool added"}';
			}
		}


		function addNewSupplier(){
			include("../Model/suppliers.php");
			$suppliers=new suppliers();
			if(!isset($_REQUEST['suppliername'])){
				echo "Supplier ID is not given";
				exit();
			}
			$suppliername=$_REQUEST['suppliername'];
			$supplierlocation=$_REQUEST['supplierlocation'];
			$verify=$suppliers->addSuppliers($suppliername,$supplierlocation);
			if($verify==false){
				echo'{"result":0,"message":"Supplier not added"}';
			}
			else{
				echo'{"result":1,"message":"Supplier added"}';
			}
		}
?>
