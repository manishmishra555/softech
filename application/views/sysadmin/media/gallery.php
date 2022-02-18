<?php ?>
<?php $comma_string = array();
    if(count($medias)){ 
        foreach($medias as $media){
            $comma_string[] = $media->fid;
        }
    }
    $comma_separated = implode(",", $comma_string);
?>
<!--<link rel="stylesheet" href="css/checkbox.css" />-->

               <input type="hidden" class="hiddnImgid" value="">
<form action="" name="galery" method="post" onsubmit="return deleteMediaFile(this);" id="gallery-form" autocomplete="off">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div id="media-action">
    <input type="submit" class="btn btn-danger" name="delete" value="Delete" title="delete selected media"/>
    <a id="inser-galery-media" class="btn btn-success" title="insert selected media" href="javascript:">&nbsp;&nbsp;&nbsp;Insert&nbsp;&nbsp;&nbsp;</a> <a href="javascript:" class="btn btn-primary" title="cancel action" onclick="parent.jq.fancybox.close();">&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>&nbsp; <span>
    <input type="text" name="search" onkeyup="searchMedia(this);" id="search-media" placeholder="Search Media by typing media name" style="display:inline;width:40%;padding-left:10px;"/>
    </span> <span class="btn btn-primary"  id="display-checked" style="padding:5px 3px;margin-right:2px;" title="Display only checked media" onclick="applyCheckFilter('checked');">&nbsp;Checked&nbsp;</span> <span class="btn btn-primary"  id="display-checked" style="padding:5px 3px;margin-right:2px;" title="Display only unchecked media" onclick="applyCheckFilter('unchecked');">&nbsp;Unchecked&nbsp;</span> <span class="btn btn-primary"  id="display-checked" style="padding:5px 3px;margin-right:2px;" title="Display all media" onclick="applyCheckFilter('all');">&nbsp;&nbsp;All&nbsp;&nbsp;</span> <span style="color:#fff;">Total <strong id="total-files"><?php echo $mediasT[0]->total; ?></strong> Files</span> </div>
  <div id="media-galery-container">
    <input type="hidden" name="formsubmit" value="yes" />
    <?php if(count($medias)){ $index=0;$checked = '';?>
    <?php foreach($medias as $media){?>
    <?php if(isset($_POST['formsubmit']) && !empty($_POST['fid'])){$checked = in_array($media->fid,$_POST['fid'])?'Checked':'Not';} ?>
    <div class="media-box" id="media-box-<?php echo $media->fid; ?>" title="<?php echo strtolower($media->orignal_name); ?>">
      <div class="inner-media-box squaredOne">
        <input class="media-delete-btn" type="checkbox" <?php echo $checked; ?> id="squaredOne" name="fid[]" value="<?php echo $media->fid; ?>" />
        <label for="squaredOne"></label>
        <img src="<?php echo $model_obj->getThumbPathByFilename($media->file_name,'195x115'); ?>" /> </div>
    </div>
    <?php } ?>
    <?php }else{ ?>
    No Media Uploaded.
    <?php } ?>
    <div style="clear:both; height:20px;">&nbsp;</div>
  </div>
</form>
<script>
 var chkFlag = false;
 $("input[type='checkbox'].media-delete-btn").change(function() {
    //console.log($(this).val());
 });
 $("input[type='checkbox'].media-delete-btn").change(function() {
    var checked = $(this).val();
    var chkd = $('.hiddnImgid').val();
    $('.hiddnImgid').val(chkd+','+checked);
  });
 $("#inser-galery-media").on('click', function() {
 instanceName = $('body').attr('id');
var arr_c = $('.hiddnImgid').val();
    console.log(arr_c);
if(instanceName){
  var htmlToInsert = '';
 var array = arr_c.split(",");
 //var array = arr_c.slice(1).split(",");
 
  for(var i = 0; i < array.length; i++){
       /*change input name*/
     $('#media-box-'+array[i]).find("input").attr("name",instanceName+"[]").attr("type","hidden");
     $('#media-box-'+array[i]).find(".inner-media-box").append('<?php echo $model_obj->getDeleteMediaBtn(); ?>');
       htmlToInsert+= $('#media-box-'+array[i]).html();
  }
  if(htmlToInsert !=''){
    $('div#'+instanceName, window.parent.document).html(htmlToInsert);
    parent.jq.fancybox.close();
  }
}
});

 function deleteMediaFile(formobj){
   if($("input[type='checkbox'].media-delete-btn:checked").size()<=0){alert("Please select media first to delete.");return false;}
   if(confirm("Are you want to delete these image(s).")){

$.ajax({ 
    type: 'post',
    dataType:"json",
    cache:false,
    url: '<?php echo MAINSITE_MADMIN_URL.'media/delete/'; ?>', 
   data: $(formobj).serialize(),
   success: function(data){
    if(data.status=='success'){
      total_files = $("#total-files").text();
    total_files = parseInt(total_files);
    $("#total-files").text(total_files-data.total);
    $(data.fid).fadeOut("slow",function(){$(this).remove();});
    }else if(data.status=='error'){
      $("#overlay").show();
      $("#msg").html(data.msg);
     }
    else{
      alert("something went wrong please try again latar.");
    }

  }

   });

     return false;

   }

   return false;

 }

 

function searchMedia(searchtext){

 searchtext = searchtext.value;

 if(searchtext!=''){

    $(".media-box").hide();

  $("#total-files").text($(".media-box[title*='"+searchtext+"']").size());

  $(".media-box[title*='"+searchtext+"']").show();

  

 }else{

   if($(".media-box").is(":hidden")){

    $("#total-files").text($(".media-box").size());

  $(".media-box").fadeIn("slow");

   }

 }

}



function applyCheckFilter(action){

 switch(action){

  case 'checked':

    chkFlag = "checked";

    $(".media-box").hide();

  $("#total-files").text($("input[type=checkbox].media-delete-btn:checked").size());

  $("input[type=checkbox].media-delete-btn:checked").parents(".media-box").fadeIn("slow");

  break;

  case 'unchecked':

   chkFlag = "unchecked";

   $(".media-box").hide();

   $("#total-files").text($("input[type=checkbox].media-delete-btn:not(:checked)").size());

   $("input[type=checkbox].media-delete-btn:not(:checked)").parents(".media-box").fadeIn("slow");

  break;

   case 'all':

   $("#total-files").text($(".media-box").size());

   $(".media-box").fadeIn("slow");

  break;

  

 }



}



/*bind restiction for single and multiple select*/

$(function(){

 $("input[type=checkbox].media-delete-btn").click(function(event){

   multipleSelect = $('body').attr('multiple-select');

   totalSelect = parseInt($("input[type=checkbox].media-delete-btn:checked").size());

   if(multipleSelect == 'false'){

   if(totalSelect>1){

     alert("Only single image can be selected.");

     $(this).removeAttr("checked");

     event.preventdefault();

   }

   }else{

    limit =  $('body').attr('limit');

    if(limit!='unlimited'){

    limit = parseInt(limit);

    if(totalSelect>limit){

     alert("Only "+limit+" image(s) can be selected.");

     $(this).removeAttr("checked");

     event.preventdefault();

    }

  }

   }

 

 });

});



/*make check box stylish*/

function customCheckbox(checkboxName){

        var checkBox = $('input[name="'+ checkboxName +'"]');

        $(checkBox).each(function(){

            $(this).wrap( "<span class='custom-checkbox'></span>" );

            if($(this).is(':checked')){

                $(this).parent().addClass("selected");

            }

        });

        $(checkBox).click(function(){

            $(this).parent().toggleClass("selected");

        });

}

</script>