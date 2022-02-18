
<div class="block">
          <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Upload image via URL</div>
          </div>
          <div class="block-content collapse in">
            <div class="span11">
              <div class="well">
                <form success-callback="image_uploaded_via_url" action="<?php echo MAINSITE_MADMIN_URL.'media/upload_via_url'; ?>" method="post" 
				onsubmit="return submitForm(this);">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <input type="hidden" value="yes">
                  <div class=" row-fluid">
                    <div class="span12">
					<div class="control-group">
                        <label class="control-label" for="cat_name">Image Url</label>
                        <div class="controls">
                          <input type="text" class="span11" id="image_url" name="url" onfocus="this.value=''" placeholder="image URl here">
						  <span class="help-inline">
						  <i class="icon-question-sign popover-bottom" data-toggle="popover" title="" 
						  data-content="Url of image which you want to upload.It must be valid file extension like(jpeg,jpg,png,gif)" data-original-title="URL:">
						  </i></span>
                        </div>
                      </div>
                    </div>
                  </div>	
				  <div class=" row-fluid">
				  <div class="span3">
                      <div class="control-group">
                        <div class="controls">
                         <input type="submit" name="submit" value="Upload" class="btn btn-success btn-large btn-block">
                        </div>
                      </div>
                    </div>
				  </div>			  
                </form>
              </div>
            </div>
          </div>
        </div>
		<script>
		function image_uploaded_via_url(response){
	     getMediaGallery();
        }

		  //function submitForm(){
		  // alert("callback called");
		   //return false;
		  //}
		</script>
		<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" backdrop="static">
  <div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
    <h3 id="myModalLabel">Loading...</h3>
  </div>
  <div class="modal-body">
    <p><img src="<?php echo ADMIN_ASSETS_PATH;?>img/loader.gif" class="loader-gif"/><span class="help-inline">&nbsp;</span>
	<span id="loader-msg">&nbsp;</span></p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
    <!--<button class="btn btn-primary">Save changes</button>-->
  </div>
</div>