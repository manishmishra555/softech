<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>Manage Media Gallery</title>
<!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
 <!-- The main CSS file -->
<link href="<?php echo ADMIN_ASSETS_PATH; ?>imagecss/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo ADMIN_ASSETS_PATH; ?>imagecss/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="<?php echo ADMIN_ASSETS_PATH; ?>imagecss/media-style.css" rel="stylesheet" />
<link href="<?php echo ADMIN_ASSETS_PATH; ?>imagecss/tab.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ADMIN_ASSETS_PATH; ?>imagecss/style.css" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>var SITE_URL = "<?php echo MAINSITE_MADMIN_URL; ?>";</script>
</head>
<body style="margin:15px auto;padding-top: 15px;">

<div class="container" style="width:97%;margin:0 auto;">
    <ul class="tabs">
        <li id="oTab1"><a href="#tab1">Upload New Media</a></li>
		<li id="oTab3"><a href="#tab3">Upload Via URL</a></li>
        <li id="oTab2"><a href="#tab2">Uploaded Media</a></li>
    </ul>
	
    <div class="tab_container">
        <div id="tab1" class="tab_content">
            <!--<form id="upload" method="post" action="<?php //echo MAINSITE_MADMIN_URL.'media/upload/'; ?>" enctype="multipart/form-data">-->
            <?php
			$attributes = array('id' => 'upload','enctype'=>'multipart/form-data');
			 echo form_open( MAINSITE_MADMIN_URL.'media/upload/',$attributes); ?>
 			  <div id="drop"> Drop Here <br><a>Browse</a>
				<input type="file" name="media" multiple />
			  </div>
			  <ul>
				<!-- The file uploads will be shown here -->
			  </ul>
          <?php echo form_close(); ?>
        </div>
        <div id="tab2" class="tab_content black-bckg">
            <?php //$this->load->view('sysadmin/media/gallery'); ?>
            <form id="gallery-form" name="gallery-form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            </form>
        </div>
		<div id="tab3" class="tab_content">
            <?php $this->load->view('sysadmin/media/upload-via-url'); ?>
        </div>
    </div>
</div>

<div id="overlay" onClick="$(this).fadeOut();" style="cursor:pointer;" title="Click To Close">
  <div id="overlay-content" style="left:8%; width:80%; background:none;"><div id="msg"></div></div>
  <div id="model" style="background:#333;">&nbsp;<span class="popup-close" title="click to close">&times;</span></div>
</div>

<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/bootstrap.min.js"></script>
<!-- JavaScript Includes -->
<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/jquery.ui.widget.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/jquery.iframe-transport.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/script.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH;?>imagejs/common.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	//On Click Event
	$("ul.tabs li").click(function() {
	   /*change the url*/
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	/*implementing url based tab*/
	  RestUrl = document.URL.replace(SITE_URL,''); 
      if(RestUrl.indexOf('#')>0){
	   chunkUrl = RestUrl.split('#');
	   if(chunkUrl[1]!=''){
	     $("li#"+chunkUrl[1]).trigger("click");
	   }
	  }

   /*get media gallery*/ 
    getMediaGallery();
	
});


function getMediaGallery(){
$.ajax({ 
   type: 'post',
   dataType:"html",
   cache:false,
   url: '<?php echo MAINSITE_MADMIN_URL.'media/gallery'; ?>', 
   data: $("#gallery-form").serialize(),
   beforeSend: function(){},
   success: function(data){
     $("#tab2").html(data);
   }
   });
	   return false;
}
</script>
<!-- Only used for the demos. Please ignore and remove. -->
</body>
</html>
