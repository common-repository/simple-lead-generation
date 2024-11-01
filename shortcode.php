<?php 
class LeadGenerationShortCode {
	var $path;
	var $field;
	var $btnTxt;
	var $layout;
	var $table_name;
	function LeadGenerationShortCode($var) {
		$this->path = plugin_dir_url(__FILE__);
		$this->btnTxt = $var['btn'];
		$this->layout = $var['layout'];
		$this->field= explode(",", $var['field']);
		
		
	}
	
	function insertNewRecord($name ,$lastname ,$city,$state,$zip,$phone,$fax,$email,$company,$roleOfComp,$numOfEmp,$website,$freeForm) {
		global $wpdb;
		$this->table_name = $wpdb->prefix . "eesirik_lead_generation";
		$wpdb->insert( $this->table_name, array(  'name' => $name , 'lastname' => $lastname, 'city' =>$city, 'state' =>$state, 'zip' =>$zip, 'phone' =>$phone, 'fax' =>$fax , 'email' => $email, 'company' =>$company , 'roleOfComp' =>$roleOfComp , 'numOfEmp' =>$numOfEmp ,'website' =>$website,'freeForm' =>$freeForm ) );
	}
	
	
	function generate() {
		//include_once 'insertDB.php';
		
		
		wp_register_script('jgrowl', $this->path.'jGrowl-master/jquery.jgrowl.js',array('jquery'),'1.7');
		wp_register_script('bootstrap-prettify', $this->path.'js/assets/prettify.js');
		wp_register_script('bootstrap-phone-format', $this->path.'js/assets/bootstrap-formhelpers-phone.format.js');
		wp_register_script('bootstrap-phone', $this->path.'js/assets/bootstrap-formhelpers-phone.js');
		
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jgrowl');
		wp_enqueue_script('bootstrap-prettify');
		wp_enqueue_script('bootstrap-phone-format');
		wp_enqueue_script('bootstrap-phone');
		
		$rtr = "
		<script type=\"text/javascript\">
			var ajaxurl = \"". admin_url('admin-ajax.php')."\";
			function submitLeadGenerationForm() {
				var eNameOrder=getLeadGenerationFormValue('eNameOrder');
				var eSurNameOrder=getLeadGenerationFormValue('eSurNameOrder');
				var eAdresOrder=getLeadGenerationFormValue('eAdresOrder');
				var eCityOrder=getLeadGenerationFormValue('eCityOrder');
				var eStateOrder=getLeadGenerationFormValue('eStateOrder');
				var eZipOrder=getLeadGenerationFormValue('eZipOrder');
				var ePhoneOrder=getLeadGenerationFormValue('ePhoneOrder');
				var eFaxOrder=getLeadGenerationFormValue('eFaxOrder');
				var eEmailOrder=getLeadGenerationFormValue('eEmailOrder');
				var eCompanyOrder=getLeadGenerationFormValue('eCompanyOrder');
				var eRoleOrder=getLeadGenerationFormValue('eRoleOrder');
				var eNumberOfEmpOrder=getLeadGenerationFormValue('eNumberOfEmpOrder');
				var eWebsiteOrder=getLeadGenerationFormValue('eWebsiteOrder');
				var eFreeFormOrder=getLeadGenerationFormValue('eFreeFormOrder');

				var dataString = \"action=lead_generation_inserdb&eSubmit=insert&ename=\"+eNameOrder+\"&elastname=\"+eSurNameOrder+\"&eadress=\"+eAdresOrder+\"&ecity=\"+eCityOrder+\"&estate=\"+eStateOrder+\"&ezip=\"+eZipOrder+\"&efax=\"+eFaxOrder+\"&eemail=\"+eEmailOrder+\"&ephone=\"+ePhoneOrder+\"&ecompamy=\"+eCompanyOrder+\"&erole=\"+eRoleOrder+\"&eemp=\"+eNumberOfEmpOrder+\"&ewebsite=\"+eWebsiteOrder+\"&eform=\"+eFreeFormOrder; 
				jQuery(document).ready(function () {
					jQuery.post(
							   ajaxurl, 
							   dataString, 
							   function(response){
								   
								   
					
							   }
							);
				
				});
			}

			function getLeadGenerationFormValue(id) {
				var element =document.getElementById(id);
				if(element!=null) {
					return element.value;
				}
				return null;
				
			}


		</script>
		<form>";
		
			  
			   
			  		$c = count($this->field);
			  		for($i = 0 ; $i<$c;$i++) {
						$f = $this->field[$i];
						
						if($f == "name") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"First Name\" id=\"eNameOrder\" name=\"ename\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "lastname") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Last Name\" id=\"eSurNameOrder\" name=\"elastname\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "adress") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Adress\" id=\"eAdresOrder\" name=\"eadress\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							}
						}else if($f == "city") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"City\" id=\"eCityOrder\" name=\"ecity\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "state") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"State\" id=\"eStateOrder\" name=\"estate\" maxlength=2 size=2>";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "zip") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Zip\" id=\"eZipOrder\" name=\"ezip\" maxlength=10 size=10>";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "phone") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input bfh-phone\" placeholder=\"Phone\" id=\"ePhoneOrder\" name=\"ephone\" data-country=\"US\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "fax") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input bfh-phone\" placeholder=\"Fax\" id=\"eFaxOrder\" name=\"efax\" data-country=\"US\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "email") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Email\" id=\"eEmailOrder\" name=\"eemail\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "company") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Company\" id=\"eCompanyOrder\" name=\"ecompamy\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "roleOfComp") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Role at Company\" id=\"eRoleOrder\" name=\"erole\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "numberEmp") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Number Of Employes\" id=\"eNumberOfEmpOrder\" name=\"eemp\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "website") {
							$rtr .= "<input type=\"text\" class=\"lead_generation_input\" placeholder=\"Website\" id=\"eWebsiteOrder\" name=\"ewebsite\">";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}else if($f == "freeForm") {
							$rtr .= "<textarea rows=\"3\" class=\"lead_generation_textarea\"  id=\"eFreeFormOrder\" name=\"eform\"></textarea>";
							if($this->layout=="portrait") {
								$rtr .="</br>";
							} 
						}

					}
			  
			  
			  
			  
			   
			  
			  $rtr .="</form><button type=\"submit\" class=\"lead_generation_button\" name=\"eSubmit\"\" value=\"eSubmit\" style=\"margin-bottom:11px;\" onclick=\"submitLeadGenerationForm();\" \">".$this->btnTxt."</button>";
		
		
		
		return $rtr;
	}
	
}
?>


