<?php
//  class Operations{
if(isset($_REQUEST['cmd'])){
	$cmd = $_REQUEST['cmd'];

	switch($cmd){
		case 1:
		getDrugs();
		break;
		case 2:
		getTools();
		break;
		case 3:
		getSuppliers();
		break;
		case 5:
		editDrugName();
		break;
		case 6:
		editDrugQuantity();
		break;
		case  7:
		editToolName();
		break;
		case  8:
		editToolQuantity();
		break;
		case  9:
		editSupplierName();
		break;
		case  10:
		editSupplierLocation();
		break;
		case 11:
		searchDrugs();
		break;
		case 12:
		searchTools();
		break;
		case 13:
		searchSuppliers();
		break;
		case 14:
		addNewDrug();
		break;
		case 15:
		addNewSupplier();
		break;
		case 16:
		addNewTool();
		break;
		default:
		echo "nothing selected";


	}
}

function editSupplierLocation(){
	include_once("../Model/suppliers.php");
	$supplier = new Suppliers();
	$suppliercode = $_REQUEST['sc'];
	$supplierLocation = $_REQUEST['SupplierLocation'];
	$query="update suppliers set supplierLocation='$supplierLocation' where suppliersId=$suppliercode";
	$result=$supplier->query($query);

	echo '{"result":"success","message":"it is done"}';
	echo $query;
	if($result){echo " query success";
		return true;
	}else{
		return false;
	}


}



function editSupplierName(){
	include_once("../Model/suppliers.php");
	$supplier = new Suppliers();
	$suppliercode = $_REQUEST['sc'];
	$supplierName = $_REQUEST['SupplierName'];
	$query="update suppliers set supplierName='$supplierName' where suppliersId=$suppliercode";
	$result=$supplier->query($query);

	echo '{"result":"success","message":"it is done"}';
	echo $query;
	if($result){echo " query success";
		return true;
	}else{
		return false;
	}


}

function editToolQuantity(){
	include_once("../Model/tools.php");
	$tool = new Tools();
	$toolcode = $_REQUEST['tc'];
	$toolQuantity = $_REQUEST['Toolquantity'];
	$query="update tools set Quantity='$toolQuantity' where toolId=$toolcode";
	$result=$tool->query($query);

	echo '{"result":"success","message":"it is done"}';
	echo $query;
	if($result){echo " query success";
		return true;
	}else{
		return false;
	}
}
function  editToolName(){
	include_once("../Model/tools.php");
	$tool = new Tools();
	$toolcode = $_REQUEST['tc'];
	$toolName = $_REQUEST['Toolname'];
	$query="update tools set toolName='$toolName' where toolId=$toolcode";
	$result=$tool->query($query);

	echo '{"result":"success","message":"it is done"}';
	echo $query;
	if($result){echo " query success";
		return true;
	}else{
		return false;
	}


}
function editDrugName(){
	include_once("../Model/drugs.php");
	$drug = new drugs();
	$drugcode = $_REQUEST['dc'];
	$drugName = $_REQUEST['Drugname'];
	$query="update drugs set drugName='$drugName' where drugId=$drugcode";
	$result=$drug->query($query);

	echo '{"result":"success","message":"it is done"}';
	if($result){echo " query success";
		return true;
	}else{
		return false;
	}
}

function editDrugQuantity(){
	include_once("../Model/drugs.php");
	$drug = new drugs();
	$drugcode = $_REQUEST['dc'];
	$drugQuantity = $_REQUEST['DrugQuantity'];
	$query="update drugs set Quantity='$drugQuantity' where drugId=$drugcode";
	$result=$drug->query($query);

	echo '{"result":"success","message":"it is done"}';
	echo $query;
	if($result){echo " query success";
		return true;
	}else{
		return false;
	}
}
function getDrugs(){
	$success="";
	include_once("../Model/drugs.php");
	$drug = new drugs();
	$drug->connect();
	$result= $drug->getDrugs();
	$row = $drug->fetch();
	$data = array();
	while($row!=false){
		$success=true;
		$data[]=$row;
		$row=$drug->fetch();
	}
	echo json_encode($data);
	return true;
}

function getTools(){
	$success="";
	include_once("../Model/tools.php");
	$tool = new Tools();
	$tool->connect();
	$result= $tool->getTools();
	$row = $tool->fetch();
	$data = array();
	while($row!=false){
		$success=true;
		$data[]=$row;
		$row=$tool->fetch();
	}
	echo json_encode($data);
	return $success;
}

function getSuppliers(){
	$success="";
	include_once("../Model/suppliers.php");
	$supplier = new Suppliers();
	$supplier->connect();
	$result= $supplier->getSuppliers();
	$row = $supplier->fetch();
	$data = array();
	while($row!=false){
		$success=true;
		$data[]=$row;
		$row=$supplier->fetch();
	}
	echo json_encode($data);
	return $success;
}

function searchSuppliers(){
	include_once("../Model/suppliers.php");
	$filter = $_REQUEST['searchtxt'];
	$supp = new suppliers();
	$supp->connect();
	$result=$supp->searchSuppliers($filter);
	$row=$supp->fetch();
	$data = array();

	while ($row!=false){
		$data[]=$row;
		$row=$supp->fetch();
	}
	echo json_encode($data);
}

function searchTools(){
	include_once("../Model/tools.php");
	$filter = $_REQUEST['searchtxt'];
	$tool = new tools();
	$tool->connect();
	$result=$tool->searchTools($filter);
	$row=$tool->fetch();
	$data = array();

	while ($row!=false){
		$data[]=$row;
		$row=$tool->fetch();
	}
	echo json_encode($data);
}

function searchDrugs(){
	include_once("../Model/drugs.php");
	$filter = $_REQUEST['searchtxt'];
	$drug = new drugs();
	$drug->connect();
	$result=$drug->searchDrugs($filter);
	$row=$drug->fetch();
	$data = array();

	while ($row!=false){
		$data[]=$row;
		$row=$drug->fetch();
	}
	echo json_encode($data);
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
	$drugtype=$_REQUEST['drugType'];
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
