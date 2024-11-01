<?php
function ajax_lead_generation_insertDB() {
	
	if (isset($_POST['eSubmit'])) {
		$name = getValue('ename');
	
		$elastname= getValue('elastname');
	
		$eadress= getValue('eadress');
		$ecity= getValue('ecity');
		$estate= getValue('estate');
		$ezip= getValue('ezip');
		$efax= getValue('efax');
		$eemail= getValue('eemail');
		$ephone= getValue('ephone');
	
		$ecompamy= getValue('ecompamy');
		$erole= getValue('erole');
		$eemp= getValue('eemp');
		$ewebsite= getValue('ewebsite');
		$eform= getValue('eform');
		insertNewRecord($name, $elastname, $ecity, $estate, $ezip, $ephone, $efax, $eemail, $ecompamy, $erole, $eemp, $ewebsite, $eform);
	}
	
}

function getValue($value) {
	if(isset($_POST[$value])) {
		return $_POST[$value];
	}
	return '';
}


function insertNewRecord($name ,$lastname ,$city,$state,$zip,$phone,$fax,$email,$company,$roleOfComp,$numOfEmp,$website,$freeForm) {
	global $wpdb;
	$table_name = $wpdb->prefix . "eesirik_lead_generation";
	$wpdb->insert( $table_name, array(  'name' => $name , 'lastname' => $lastname, 'city' =>$city, 'state' =>$state, 'zip' =>$zip, 'phone' =>$phone, 'fax' =>$fax , 'email' => $email, 'company' =>$company , 'roleOfComp' =>$roleOfComp , 'numOfEmp' =>$numOfEmp ,'website' =>$website,'freeForm' =>$freeForm ) );
}


?>