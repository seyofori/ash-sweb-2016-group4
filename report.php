
<html>
<?php






//might be redundant
if(isset($_GET['hello'])){
  runMyFunction();
}


function runMyFunction(){
  $myfile = fopen("report.txt", "w") or die("Unable to open file!");
  $txt = "John Doe\n";
  fwrite($myfile, $txt);
  $txt = "Jane Doe\n";
  fwrite($myfile, $txt);
  fclose($myfile);
}




  function getDrugs($filter=false){
		$strQuery="select drugID, drugName, quantity, supplierID, drugType from drugs ";
			// $strQuery="select * from users";
		if($filter!=false){
			$strQuery=$strQuery . " where $filter";
		}
		return $this->query($strQuery);
	}


  //He has this as a capital leter TOOLS which is different form drugs verify this.
  function getTools($filter=false){
    $strQuery="select toolID, toolName, quantity, supplierID, toolType from Tools ";
      // $strQuery="select * from users";
    if($filter!=false){
      $strQuery=$strQuery . " where $filter";
    }
    return $this->query($strQuery);
  }


 <a href ='report.php?hello=true'>Generate</a>
</html>
