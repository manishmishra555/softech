/*
**@File
**Common function which used in entire framework
*/

var RestUrl = document.URL.replace(SITE_URL,''); 
var RepeatedJobQueue = new Array();
var JobQueueHandle;

function showLoader(){$(".loader-gif").show();}
function hideLoader(){$(".loader-gif").hide();}
function showCloseControl(){$(".modal-footer").show();}
function hodeCloseControl(){$(".modal-footer").hide();}
function showMsg(msg){$("#loader-msg").html(msg).show();}
function hideMsg(){$("#loader-msg").html('').hide();}
/*submit form via ajax*/ 
function submitForm(formobj){
var successCalback = $(formobj).attr("success-callback");
$.ajax({ 
   type: 'post',dataType:"html",cache:false,url: $(formobj).attr("action"),data:$(formobj).serialize(),beforeSend: function(){
	  /*disable submit button*/
	  showLoader();
	  hodeCloseControl();
	  showMsg("Processing your request please wait");
	  $('#myModal').modal({backdrop:'static'});
	},complete: function(){},
      success: function(response){
	  hideLoader();
	  showCloseControl();
	  showMsg(response);
	  /*call the success callback function*/
	   if(successCalback!=''){
		 window[successCalback](response);
	   }
	}
   });
return false;
}

/*get query string by name*/
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
/*get only text*/
function getText(string){
return string.replace(/[^a-zA-Z0-9]/g, '');	
}
$(function(){
 activateCurrentMenu();   
 if($(".popover-top").size()>=1){$(".popover-top").popover({placement : 'top',trigger:'hover'});}
 if($(".popover-right").size()>=1){$(".popover-right").popover({placement : 'right',trigger:'hover'});}
 if($(".popover-bottom").size()>=1){$(".popover-bottom").popover({placement : 'bottom',trigger:'hover'});}
 if($(".popover-left").size()>=1){$(".popover-left").popover({ placement : 'left',trigger:'hover'});}
 
 /*implementing footer action in record listing*/
   if($("ul.footer-action li").size()>=1){
	  $("ul.footer-action li a").click(function(){
        var actionName = $(this).attr('action-name');												
		/*set which action is clicked*/
		  $(this).parents("form").find("input[name='action']").val(actionName);
        /*atleast 1 checkbox must be checked*/
		  var validationFlag = true;
		  if($(this).parents("form").find("input[type='checkbox']:checked").size()<=0){
		     /*destroy previous created model*/
			 validationFlag = false;
			 if($('#footer-action-notification-window')){$('#footer-action-notification-window').remove();}
			 ModelHeader  = '<h4 id="myModalLabel"><strong>Notice!</strong></h4>';
             ModelBody    = '<div class="alert alert-error">Please select atleast one record to proceed.</div>';
			 modelFooter  = '<div class="modal-footer"><button class="btn btn-danger" data-dismiss="modal">Close</button></div>';
             notification = getNotificationWindow('footer-action-notification-window',ModelHeader,ModelBody,modelFooter);
			 $("body").append(notification);
             $('#footer-action-notification-window').modal({backdrop:'static'});
			 return false;
		  }
		/*Check for delete action*/  
		  if(actionName == 'delete' && validationFlag){
			 validationFlag = false;
			 if($('#delete-action-notification')){$('#delete-action-notification').remove();}
			 ModelHeader  = '<h4 id="myModalLabel"><strong>Notice!</strong></h4>';
             ModelBody    = '<div class="alert alert-error">Are you sure to delete?.</div>';
			 modelFooter  = '<div class="modal-footer"><input type="submit" value="Proceed" class="btn btn-primary">';
			 modelFooter+= '<button class="btn btn-danger" data-dismiss="modal">Close</button></div>';
             notification = getNotificationWindow('delete-action-notification',ModelHeader,ModelBody,modelFooter);
			 $(this).parents("form").append(notification);
             $('#delete-action-notification').modal({backdrop:'static'});
			  return false;
		  }
		  
		  if(validationFlag){$(this).parents("form").submit();}
	  })
   }
 
});

function deleteConfirmation(thisobj){
	
	/*make checkbox selected*/
	if($('#delete-confirmation')){$('#delete-confirmation').remove();}
	ModelHeader  = '<h4 id="myModalLabel"><strong>Notice!</strong></h4>';
    ModelBody    = '<div class="alert alert-error">Are you sure to delete?.</div>';
	modelFooter  = '<div class="modal-footer"><a class="btn btn-primary" href="'+$(thisobj).attr('delete-url')+'">Proceed</a>';
	modelFooter+= '<button class="btn btn-danger" data-dismiss="modal">Close</button></div>';
    notification = getNotificationWindow('delete-confirmation',ModelHeader,ModelBody,modelFooter);
	$(thisobj).parents("form").append(notification);
    $('#delete-confirmation').modal({backdrop:'static'});
	return false;
}

/*make current menu active*/
function activateCurrentMenu(){
	controllerAction = RestUrl;
    if(controllerAction.indexOf('/')>0){
	   /*remove hash from url*/
	   if(RestUrl.indexOf('#')>0){controllerAction = RestUrl.substring(0, RestUrl.indexOf('#'));}
	   chunkUrl = controllerAction.split('/');
	   if(chunkUrl[0]!=''){
	     $("#sidebar>ul>li#"+chunkUrl[0].toLowerCase()).addClass("active");
		 $("ul.topnav>li#"+chunkUrl[0].toLowerCase()).addClass("active");
		 
	   }
	}
	else if(controllerAction.indexOf('?')>=0){
		 Controler = getText(getParameterByName('url'));
		 if($("#sidebar>ul>li#"+Controler.toLowerCase()).size()>=1){$("#sidebar>ul>li#"+Controler.toLowerCase()).addClass("active");}
		 if($("ul.topnav>li#"+Controler.toLowerCase()).size()>=1){$("ul.topnav>li#"+Controler.toLowerCase()).addClass("active");}
		}
	else{
		 
		if(controllerAction.indexOf('#')>=0){controllerAction = RestUrl.substring(0, RestUrl.indexOf('#'));}
		$("#sidebar>ul>li#"+controllerAction.toLowerCase()).addClass("active");
		$("ul.topnav>li#"+controllerAction.toLowerCase()).addClass("active");
	  }
		
}

/*make tab active via url*/
function makeTabActiveViaURL(){
if(RestUrl.indexOf('#')>0){
 chunkUrl = RestUrl.split('#');
 $('#tab a').removeClass('active');
 $('#tab a[href="#'+chunkUrl[1].toLowerCase()+'"]').addClass("active").tab('show');
 }	
}

/*check and uncheck all checkboxes*/
function checkall(objForm){
 len = objForm.elements.length;
	for( i=0 ; i<len ; i++){
		if (objForm.elements[i].type=='checkbox'){
		  if($(objForm.elements[i]).is(':visible')){
		    if($(objForm.elements[i]).hasClass("uniform_on")){$(objForm.elements[i]).click();}
		    else{objForm.elements[i].checked=objForm.check_all.checked;}
		 }
	   } 
	 }
}

function getModelWindow(modelId,ModelHeader,ModelBody){
 var ModelWin = '<div id="'+modelId+'" remote="" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">';
     ModelWin+= '<div class="modal-header">';
	 ModelWin+= ModelHeader;
	 ModelWin+= '</div>';
	 ModelWin+= '<div class="modal-body">';
	 ModelWin+= '<p>'+ModelBody+'</p>';
	 ModelWin+= '</div>';
	 ModelWin+= '</div>';
	 return ModelWin;
}

function getNotificationWindow(modelId,ModelHeader,ModelBody,modelFooter){
    var modelHTML = $(getModelWindow(modelId,ModelHeader,ModelBody));
	modelHTML.find(".modal-body").after(modelFooter);
	return modelHTML;
}


/*prototype to unset value form array*/
Array.prototype.unset = function(value) {
    if(this.indexOf(value) != -1) { // Make sure the value exists
        return this.splice(this.indexOf(value), 1);
    }   
}
/*Main function to perform repeated job*/
function callReapetedJob(){
  if(RepeatedJobQueue.length>=1){
   var index;
    for	(index = 0; index < RepeatedJobQueue.length; index++) {
      window[RepeatedJobQueue[index]]();
    }
  }
}
/*Add job to job queue and return job id*/
function addJobToQueue(JobName){
  jobId = TotalJobInQueue();
  RepeatedJobQueue[jobId] = JobName;
  return jobId;
}
/**
*remove job from job queue via job id
*it is recomended function to remove job
*It is faster than removeJobFromQueueByJobName
**/
function removeJobFromQueueByJobId(jobId){
 return RepeatedJobQueue.splice(jobId, 1);
}
/**
*remove job from job queue via job name
**/
function removeJobFromQueueByJobName(jobName){
 return RepeatedJobQueue.unset(jobName);
}
/**
*Return total job in job queue
**/
function TotalJobInQueue(){
	return RepeatedJobQueue.length;
}
/**
*Initialize the job queue
*Interval time is 1 second
**/
function invokeJobQueue(){
 JobQueueHandle = setInterval(function(){callReapetedJob()},10000);	
}
/**
*it stop the job queue
**/
function stopExecutingJobQueue(){
 clearInterval(JobQueueHandle);
}
/**/
invokeJobQueue();