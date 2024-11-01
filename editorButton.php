<?php 

$Lead_Generation_Pro = false;
$Lead_Generation_Option = "LeadGenOpt";
$options = get_option($Lead_Generation_Option );
if (is_array($options)) {
	$ispro = $options['pro'];
	if($ispro==true) {
		$Lead_Generation_Pro = true;
	}
}

//init
function init(){

	$pluginURL 			= plugin_dir_url(__FILE__);
	//register style
	wp_register_style('bootstrapStyle',$pluginURL.'bootstrap.min.css');
	wp_register_style('leadGenStyle', $pluginURL.'style.css');
	wp_register_style('jgrowlStyle', $pluginURL.'jGrowl-master/jquery.jgrowl.css');

	//register script
	wp_register_script('bootstrap', $pluginURL.'bootstrap.min.js');
	wp_register_script('button', $pluginURL.'button.js');
	wp_register_script('jgrowl', $pluginURL.'jGrowl-master/jquery.jgrowl.js',array('jquery'),'1.7');

}

function loadScript()  {
	wp_enqueue_style('bootstrapStyle');
	wp_enqueue_style('leadGenStyle');
	wp_enqueue_style('jgrowlStyle');

	//include script
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jgrowl');
	wp_enqueue_script('button');

}




class LeadGenerationEditorButton {
	var $path;
	function LeadGenerationEditorButton() {
		$this->path = plugin_dir_url(__FILE__);
	}
}
$editorButton = new LeadGenerationEditorButton();
init();
loadScript();
?>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">X</button>
		<h3 id="myModalLabel">Create Lead Generation</h3>
	</div>
	<div class="modal-body">

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span6">
					<!--Sidebar content-->
					<fieldset>
			    	<legend class="header_lg">Form Attributes</legend>
					<input type="checkbox" id="eNameCheckBox" checked>First Name <!-- <input type="text" class="input-mini"
						placeholder="0" id="eNameOrder"> --></br> <input type="checkbox" id="eLastNameCheckBox"> Last
					Name <!-- <input type="text" class="input-mini" placeholder="1"
						id="eSurNameOrder"> -->
						
						<?php if($Lead_Generation_Pro) {?>
						</br> <input type="checkbox" id="eAdressCheckBox"> Adress <!-- <input
						type="text" class="input-mini" placeholder="2" id="eAdresOrder"> --></br>
					<input type="checkbox" id="eCityCheckBox"> City <!-- <input type="text" class="input-mini"
						placeholder="3" id="eCityOrder"> --></br> <input type="checkbox" id="eState"> State
					<!-- <input type="text" class="input-mini" placeholder="4"
						id="eStateOrder"> --></br> <input type="checkbox" id="eZipCheckBox"> Zip <!-- <input
						type="text" class="input-mini" placeholder="5" id="eZipOrder"> --></br>
					<input type="checkbox" id="ePhoneCheckBox"> Phone <!-- <input type="text" class="input-mini"
						placeholder="6" id="ePhoneOrder"> --></br> <input type="checkbox" id="eFaxCheckBox"> Fax <!-- <input
						type="text" class="input-mini" placeholder="7" id="eFaxOrder"> --></br>
					<input type="checkbox" id="eEmailCheckBox"> Email <!-- <input type="text" class="input-mini"
						placeholder="8" id="eEmailOrder"> --></br> <input type="checkbox" id="eCompanyCheckBox">
					Company <!-- <input type="text" class="input-mini" placeholder="9"
						id="eCompanyOrder"> --></br> <input type="checkbox" id="eRoleCheckBox"> Role at Company <!-- <input
						type="text" class="input-mini" placeholder="10" id="eRoleOrder"> --></br>
					<input type="checkbox" id="eEmpCheckBox"> Number Of Employes <!-- <input type="text"
						class="input-mini" placeholder="11" id="eNumberOfEmpOrder"> --></br> <input
						type="checkbox" id="eWebSiteCheckBox"> Website <!-- <input type="text" class="input-mini"
						placeholder="12" id="eWebsiteOrder"> --></br> <input type="checkbox" id="eFreeCheckBox">
					Free Form <!-- <input type="text" class="input-mini" placeholder="13"
						id="eFreeFormOrder"> -->
						
						
		
						<?php }	?>
						</fieldset>
							
				</div>
				<div class="span6">
					<!--Body content-->
					<?php if($Lead_Generation_Pro) {?>
						<fieldset>
				    		<legend class="header_lg">Layout</legend>
							<div class="btn-group" data-toggle="buttons-checkbox">
							  <button type="button" class="btn btn-primary" id="lg_portrait">Portrait</button>
							  <button type="button" class="btn" id="lg_landscape">Landscape</button>
							</div>
							<script>
							var lg_portrait = document.getElementById('lg_portrait');
							var lg_landscape = document.getElementById('lg_landscape');
							var lg_layout = "portrait";
							lg_portrait.onclick = function() {
								lg_layout = "portrait";
								lg_portrait.className = "btn btn-primary";
								lg_landscape.className = "btn"; 
							};
			
							lg_landscape.onclick = function() {
								lg_layout = "landscape";
								lg_landscape.className = "btn btn-primary";
								lg_portrait.className = "btn";
							};
							
							</script>
						</fieldset>			
					<?php }	?>
					<fieldset>
						<legend class="header_lg">Action Button</legend>
			
						<input type="text" class="input-medium"
							placeholder="Action Button Text" id="eSubmitBtnText" value="Submit"
							<?php if(!$Lead_Generation_Pro) { echo("disabled");}?>>
					</fieldset>
							
				</div>
			</div>
		</div>






	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" onclick="rGenerateLeadButtonClick()">Save
			changes</button>
	</div>
</div>
