<?php 
function message($msg) {
	?>
	
	<script>alert("<?php echo $msg;?>");</script>
	<?php
}


if (isset($_POST['saveProCode'])) {
	if(isset($_POST['eProCodeTxt'])) {
		if($_POST['eProCodeTxt']=="test1234") {
				message("basardi");
		}
	}
	
}

class LeadAdminPanel{
	var $img;
	var $url;
	function LeadAdminPanel() {
		$this->img = plugin_dir_url(__FILE__).'img/';
		$this->url= plugin_dir_url(__FILE__);
	}
}

$leadAdmin = new LeadAdminPanel();



?>

<div class="container-fluid adminPanel">
	<div id="header">
	
		<img src="<?php echo $leadAdmin->img; ?>logo.jpg" id="eLogo">
	</div>
	<ul class="breadcrumb" id="eProductInfo">
		<li>Product Information:Lorem ipsum dolor sit amet, consectetur
			adipiscing elit. Nam dignissim odio gravida elit fringilla ut
			imperdiet ante scelerisque. In accumsan magna ut lorem congue ornare.
			Sed euismod fermentum est, eu venenatis quam aliquam et. Donec
			pretium neque lacus, eu faucibus velit. Cras pharetra massa nunc.<span
			class="divider">/</span>
		</li>
	</ul>
	<div class="row-fluid" id="eBody">
		<div class="span4">
			<!--Sidebar content-->
			<div id="upgradeTodayLink">
				<a href="http://www.sandigital.net/rsimplepl_plugin" target="_blank">Upgrade
					Today</a>
			</div>
			
				<fieldset>
						<input type="text" placeholder="Enter Pro Code" id="eProCodeTxt" name="eProCodeTxt">
					
						<button  class="btn btn-primary savebtn" height="30" onclick='saveProCode("<?php echo($leadAdmin->url); ?>insertProCode.php");' >Save</button>
				</fieldset>
				
							Note: Configurate Your Theme CSS</br>
							
							1. If you want to change input text style, change CSS of input[type='text'] or CSS class of ".lead_generation_input"</br>
							2. If you want to change input textarea style, change CSS of input[type='textarea'] or CSS class of ".lead_generation_textarea"</br>
							3. If you want to change button style, change CSS of button or CSS class of ".lead_generation_button"</br>
								
		</div>
		<div class="span3">
			<!--Sidebar content-->

		</div>
		<div class="span2" id="eBanner">

			<div class="eAdvert">
				<a href="#" class="thumbnail"> <img data-src="holder.js/300x200"
					alt="300x200" style="width: 300px; height: 200px;"
					src="<?php echo $leadAdmin->img; ?>banner300.jpg">
				</a>
			</div>
			<div class="eAdvert">
				<a href="#" class="thumbnail"> <img data-src="holder.js/300x200"
					alt="300x200" style="width: 300px; height: 200px;"
					src="<?php echo $leadAdmin->img; ?>banner300.jpg">
				</a>
			</div>
			<div class="eAdvert">

				<a href="#" class="thumbnail"> <img data-src="holder.js/300x200"
					alt="300x200" style="width: 300px; height: 200px;"
					src="<?php echo $leadAdmin->img; ?>banner300.jpg">
				</a>
			</div>
			</ul>
		</div>
	</div>
</div>

