function saveProCode(url) {
	var proCodeTxt = document.getElementById("eProCodeTxt");
	/*$.get(url+"?pro="+proCodeTxt.value, function(data) {
			
		});*/
	
	
	var dataString = 'action=lead_generation_inserProCode&pro=' +proCodeTxt.value;
	jQuery(document).ready(function () {
		jQuery.post(
			   ajaxurl, 
			   dataString, 
			   function(data){
				   $.jGrowl("Pro Code is "+proCodeTxt.value+" url"+url+" data "+data);
					  	   
				   
				   //var div = document.getElementById("eesirik_key_result");
				   //div.innerHTML = response;
			   }
			);
	});
	

	
	
}
var rEd;
function rSimpleButtonClick(ed) {
	jQuery(document).ready(function () {
		jQuery( '#myModal' ).modal('show');
	});
	rEd = ed;
}
function rGenerateLeadButtonClick() {
	
	var name = rFindGenerateLeadCheckBox("eNameCheckBox");
	var lastname = rFindGenerateLeadCheckBox("eLastNameCheckBox");
	var adress = rFindGenerateLeadCheckBox("eAdressCheckBox");
	var city = rFindGenerateLeadCheckBox("eCityCheckBox");
	var state = rFindGenerateLeadCheckBox("eState");
	var zip= rFindGenerateLeadCheckBox("eZipCheckBox");
	var phone= rFindGenerateLeadCheckBox("ePhoneCheckBox");
	var fax= rFindGenerateLeadCheckBox("eFaxCheckBox");
	var mail= rFindGenerateLeadCheckBox("eEmailCheckBox");
	var company= rFindGenerateLeadCheckBox("eCompanyCheckBox");
	var role= rFindGenerateLeadCheckBox("eRoleCheckBox");
	var emp= rFindGenerateLeadCheckBox("eEmpCheckBox");
	var website= rFindGenerateLeadCheckBox("eWebSiteCheckBox");
	var freecheck= rFindGenerateLeadCheckBox("eFreeCheckBox");
	
	var str = "1";
	str+=rFindGenerateLeadAddCheckBox(name,"name");
	str+=rFindGenerateLeadAddCheckBox(lastname,"lastname");
	str+=rFindGenerateLeadAddCheckBox(adress,"adress");
	str+=rFindGenerateLeadAddCheckBox(city,"city");
	str+=rFindGenerateLeadAddCheckBox(state,"state");
	str+=rFindGenerateLeadAddCheckBox(zip,"zip");
	str+=rFindGenerateLeadAddCheckBox(phone,"phone");
	str+=rFindGenerateLeadAddCheckBox(fax,"fax");
	str+=rFindGenerateLeadAddCheckBox(mail,"email");
	str+=rFindGenerateLeadAddCheckBox(company,"company");
	str+=rFindGenerateLeadAddCheckBox(role,"roleOfComp");
	str+=rFindGenerateLeadAddCheckBox(emp,"numberEmp");
	str+=rFindGenerateLeadAddCheckBox(website,"website");
	str+=rFindGenerateLeadAddCheckBox(freecheck,"freeForm");

	var sbmt = document.getElementById('eSubmitBtnText');
	rEd.execCommand('mceInsertContent', false, '[leadGenEditorShortCode field="'+str+'" btn="'+sbmt.value+'" layout="'+lg_layout+'"]');
}
function rFindGenerateLeadAddCheckBox(check,name) {
	if(check == true) {
		return ","+name;
	}
	return "";
	
}
function rFindGenerateLeadCheckBox(id) {
	var el = document.getElementById(id);
	if(el != null) {
		return el.checked;
	}else {
		return false;
	}
}