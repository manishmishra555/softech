$(document).ready(function() {
	'use strict';
 });

function jsUcfirst(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function dateformat(date,format){
  var date= new Date(date);
  var dd = date.getDate();
  var mm = date.getMonth()+1; 
  var yyyy = date.getFullYear();
  var hh = date.getHours();
  var ii = date.getMinutes();
  var ss = date.getSeconds();
  if(format=='dd-mm-yyyy'){
    return dd+'-'+mm+'-'+yyyy;
  }else if(format=='dd-mm-yyyy hh:ii:ss'){ 
  	 return dd+'-'+mm+'-'+yyyy+' '+hh+':'+ii+':'+ss;
  }
}

function notify(msg,from, align, icon, type, animIn, animOut){
		$.notify({
			icon: icon,
			title: '',
			message: msg,
			url: ''
		},{
			element: 'body',
			type: type,
			allow_dismiss: true,
			placement: {
				from: from,
				align: align
			},
			offset: {
				x: 20,
				y: 20
			},
			spacing: 10,
			z_index: 1031,
			delay: 2500,
			timer: 1000,
			url_target: '_blank',
			mouse_over: false,
			animate: {
				enter: animIn,
				exit: animOut
			},
			template:   '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
			'<span data-notify="icon"></span> ' +
			'<span data-notify="title">{1}</span> ' +
			'<span data-notify="message">{2}</span>' +
			'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
			'</div>' +
			'<a href="{3}" target="{4}" data-notify="url"></a>' +
			'<button type="button" aria-hidden="true" data-notify="dismiss" class="alert--notify__close">Close</button>' +
			'</div>'
		});
	}
	
 			 
function formRequest_ajax(form_id,form_data,URL,method_name,redirect_page_name){
'use strict';	
$.ajax({
		url: URL,
		type: 'POST',
		data: form_data,
		cache:false,
		success: function(response) {
			var jObj=JSON.parse(response);
			hash=jObj.hash;
			$("form input[name='"+jObj.token+"']").val(jObj.hash);
			if(method_name===''){
			  default_method(jObj,redirect_page_name);	
			}else{
			 // Call custom functions
			 window[method_name](jObj, redirect_page_name);	
			}      
		}
   });	
}

//Success processor
function default_method(jObj,redirect_page_name){
'use strict';
 	if (jObj.status === "success"){ 
	     var msg=jObj.msg;
	     notify(msg,'top', 'right', 'fa fa-comments', 'inverse', 'animated fadeInUp', 'animated fadeOutUp');
 		 if(redirect_page_name===''){
			location.href = CURRENT_URL;
		 }else{
			location.href = redirect_page_name; 
		}
	} else if(jObj.status==='haserror'){
		alert(jObj.error);
	} 	
}
//subbrands base on brand product page
$('#add_new_product').on('change','#brand',function(){
	var controller=$(this).attr("data-control");
	var brandid=$(this).val();
	var option_sel = '<option>Select Sub Brand</option>';
    $.ajax({
		type: 'POST',
		url: SITE_URL+controller+'/search',
		data: {searchkey:brandid},
		cache: false,
		success: function(data){
			//console.log(data);
			var jObj=JSON.parse(data);
			if(jObj.data.length>0){
				for(var i=0;i<jObj.data.length;i++)
			  	{
			  		option_sel += '<option value="'+jObj.data[i].id+'">'+jObj.data[i].sub_brand_name+'</option>';
				}
			}
			$('#add_new_product #subbrand').html(option_sel);
		}
	}); 
});
// Remove record
$('#list_search_result').on('click','a#remove',function(){
	"use strict";
	var id=$(this).attr('data-id');
	var controller=$(this).attr('data-control');
	swal({
		title: 'Are you sure?',
		text: 'You want to delete this data!',
		type: 'warning',
		showCancelButton: true,
		buttonsStyling: false,
		confirmButtonClass: 'btn btn-danger',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonClass: 'btn btn-secondary'
	}).then(function(){
		
		$.ajax({
				type: 'POST',
				url: SITE_URL+controller+'/delete',
				data: {id:id,hash_token:hash},
				cache: false,
				success: function(data){
					console.log(data);
					 var jObj=JSON.parse(data);
					 
					 hash=jObj.hash;
					 if(jObj.status=="success"){
					 swal({
						title: 'Record has been deleted successfully',
 						type: 'success',
						buttonsStyling: false,
						confirmButtonClass: 'btn btn-primary'
					  });
					  setTimeout(function() { window.location.href = CURRENT_URL;}, 2000);
					 }else if(jObj.status=="haserror"){
					 	alert("Something went wrong :( Contact Website Admin.");
					 }

				  }
				});
 		
	});
});

//Status Update
$("#list_search_result").on('change','.toggle-switch__checkbox',function() {
    "use strict";
	var msg='';
	var msg_type='';
	var id=$(this).attr('data-id');
    var status=$(this).val();
	var controller=$(this).attr("data-control");
    $.ajax({
		type: 'POST',
		url: SITE_URL+controller+'/status',
		data: {id:id,status:status,hash_token:hash},
		cache: false,
		success: function(data){
			console.log(data);
			 var jObj=JSON.parse(data);
			 hash=jObj.hash;
			 $("input[name='"+jObj.token+"']").val(jObj.hash);
			 if(jObj.status==="success"){
			   msg="Status has been updated successfully";
			   $('.toggle-switch__checkbox').val(jObj.status_changed);
			   msg_type='success';
			   //$(this).attr('checked',true);
			 }else{
			   msg="Something went wrong :( Please try again later"; 
			   msg_type='error';
			 }
			 swal({
				title: msg,
				type: msg_type,
				buttonsStyling: false,
				confirmButtonClass: 'btn btn-primary'
			  });
			  /*setTimeout(function() {
			  window.location.href = CURRENT_URL;}, 1000);*/
			}
	}); 
});


$("#add_new_productmaterial,#add_new_productshape,#add_new_productsize,#add_new_afterbefore,#add_new_gallery,form#add_new_client,form#add_new_pagesmeta,form#add_new_testimonial,form#add_new_category,form#add_new_blog,form#add_new_author,form#add_new_blogcategory,form#add_new_banner,form#add_new_country,form#add_new_city,form#add_new_user,form#add_new_group,form#add_new_module,#add_new_website_settings").on('submit', function(e){
	"use strict";
    e.preventDefault();
    /*if (CKEDITOR.instances) {
       for(var name in CKEDITOR.instances){
         CKEDITOR.instances[name].updateElement();
    	}
    }*/
	var form_id=$(this).attr('id'); 
	var controller=$(this).attr('data-controller');
 	var req_url=$(this).attr('action');
	var form_data =$(this).serialize();	 
	//var form_data=new FormData($(this)[0]);
	var method_name='';
	var redirect_page_name=SITE_URL+controller;
 	formRequest_ajax(form_id,form_data,req_url,method_name,redirect_page_name); 
});


$("#add_new_productcolor").on('submit', function(e){
	"use strict";
    e.preventDefault();
    /*if (CKEDITOR.instances) {
       for(var name in CKEDITOR.instances){
         CKEDITOR.instances[name].updateElement();
    	}
    }*/
    var color_type = $('#color_type').val();
    var color_val = $('#productcolor_value2').val();
    if(color_type == 'dual' && color_val == ''){
    	alert('Please Select Color Value 2');
    }else{
		var form_id=$(this).attr('id'); 
		var controller=$(this).attr('data-controller');
	 	var req_url=$(this).attr('action');
		var form_data =$(this).serialize();	 
		//var form_data=new FormData($(this)[0]);
		var method_name='';
		var redirect_page_name=SITE_URL+controller;
	 	formRequest_ajax(form_id,form_data,req_url,method_name,redirect_page_name); 
	 }
});

//Editor form submit
$("form#add_new_faq,form#add_new_career,form#add_new_team,form#add_new_pages,form#add_news").on('submit', function(e){
	"use strict";
    e.preventDefault();
     
    for(var name in CKEDITOR.instances){
     CKEDITOR.instances[name].updateElement();
	}

	var form_id=$(this).attr('id'); 
	var controller=$(this).attr('data-controller');
 	var req_url=$(this).attr('action');
	var form_data =$(this).serialize();	 
	//var form_data=new FormData($(this)[0]);
	var method_name='';
	var redirect_page_name=SITE_URL+controller;
 	formRequest_ajax(form_id,form_data,req_url,method_name,redirect_page_name); 
});
  

$(function() {
"use strict";	
    $('#list_searchkey').bind('keyup change', function() {
	   var controller=$(this).attr('data-control');
	   var platform=$(this).attr('data-platform');
	   var searchkey=$(this).val();
	   var forms_id=$(this).attr('data-forms_id');
	   searchlist(searchkey,controller,forms_id,platform);
	});
});

function searchlist(searchkey,controller,forms_id,platform){
'use strict';
$.ajax({
		url: SITE_URL+controller+"/search",
		type: 'POST',
		data: {searchkey:searchkey,hash_token:hash,platform:platform},
		cache:false,
		success: function(response) {
			var jObj=JSON.parse(response);
 			console.log(controller+"SearchResult");
			hash=jObj.hash;
			$("form input[name='"+jObj.token+"']").val(jObj.hash);
 			window[controller+"SearchResult"](jObj);	
 		}
   });	
}


function usersSearchResult(jObj){
 'use strict';
 var data=jObj.data;
 var rows=''; 
 if(data.length>0){
  for(var i=0;i<data.length;i++)
  {
	var select_status='';  
	var title='';
	rows+='<tr>';
	rows+='<th scope="row">'+(i+1)+'</th>';
	rows+='<td>'+data[i].username+'</td>';
	rows+='<td>'+data[i].name+'</td>';
 	rows+='<td>'+data[i].email+'</td>';	
	rows+='<td>'+data[i].last_login+'</td>';	
	rows+='<td><div class="form-group"><div class="toggle-switch">';
	if(data[i].status==="1"){ select_status="checked"; title="Active";}else{ select_status=''; title="Inactive";}
 	rows+='<input class="toggle-switch__checkbox" type="checkbox" '+select_status+' value="'+data[i].status+'" data-id="'+data[i].id+'" data-control="users" id="status'+data[i].id+'" title="'+title+'">';
    rows+='<i class="toggle-switch__helper"></i></div></div></td>';
	rows+='<td><div class="btn-groups">'; 
	rows+='<a href="'+SITE_URL+'users/edit/'+data[i].id+'" class="btn btn-primary waves-effect">Edit</a>'; 
    rows+='<a href="'+SITE_URL+'users/delete/'+data[i].id+'" class="btn btn-danger waves-effect">remove</a>'; 
	rows+='</div></td>';
	rows+='</tr>';  
  }
 }else{
    rows+='<tr><td colspan="5" align="center">No record found.</td></tr>';	 
 }
 $("#list_search_result").html(rows);	
}


//Add new Country
 function countrySearchResult(jObj){
 'use strict';
 var data=jObj.data;
 var rows=''; 
 if(data.length>0){
  for(var i=0;i<data.length;i++)
  {
	var select_status='';  
	var title='';
	rows+='<tr>';
	rows+='<th scope="row">'+(i+1)+'</th>';
	rows+='<td>'+data[i].name+'</td>';
 	rows+='<td><div class="form-group"><div class="toggle-switch">';
	if(data[i].status==='active'){ select_status="checked"; title="Active";}else{ select_status=''; title="Inactive";}
 	rows+='<input class="toggle-switch__checkbox" type="checkbox" '+select_status+' value="'+data[i].status+'" data-id="'+data[i].id+'" data-control="country" id="status'+data[i].id+'" title="'+title+'">';
    rows+='<i class="toggle-switch__helper"></i></div></div></td>';
	rows+='<td><div class="btn-groups">'; 
	rows+='<a href="'+SITE_URL+'country/edit/'+data[i].id+'" class="btn btn-primary waves-effect">Edit</a>'; 
    rows+='<a href="#" class="btn btn-danger waves-effect" id="remove" data-id="'+data[i].id+'" data-control="country">Remove</a>'; 
	rows+='</div></td>';
	rows+='</tr>';  
  }
 }else{
    rows+='<tr><td colspan="5" align="center">No record found.</td></tr>';	 
 }
 $("#list_search_result").html(rows);	
}


//Add new Nationality
function nationalitySearchResult(jObj){
 'use strict';
 var data=jObj.data;
 var rows=''; 
 if(data.length>0){
  for(var i=0;i<data.length;i++)
  {
	var select_status='';  
	var title='';
	rows+='<tr>';
	rows+='<th scope="row">'+(i+1)+'</th>';
	rows+='<td>'+data[i].name+'</td>';
 	rows+='<td><div class="form-group"><div class="toggle-switch">';
	if(data[i].status==='active'){ select_status="checked"; title="Active";}else{ select_status=''; title="Inactive";}
 	rows+='<input class="toggle-switch__checkbox" type="checkbox" '+select_status+' value="'+data[i].status+'" data-id="'+data[i].id+'" data-control="nationality" id="status'+data[i].id+'" title="'+title+'">';
    rows+='<i class="toggle-switch__helper"></i></div></div></td>';
	rows+='<td><div class="btn-groups">'; 
	rows+='<a href="'+SITE_URL+'nationality/edit/'+data[i].id+'" class="btn btn-primary waves-effect">Edit</a>'; 
    rows+='<a href="#" class="btn btn-danger waves-effect" id="remove" data-id="'+data[i].id+'" data-control="nationality">Remove</a>'; 
	rows+='</div></td>';
	rows+='</tr>';  
  }
 }else{
    rows+='<tr><td colspan="5" align="center">No record found.</td></tr>';	 
 }
 $("#list_search_result").html(rows);	
}


//Add new City 
function citySearchResult(jObj){
 'use strict';
 var data=jObj.data;
 var rows=''; 
 if(data.length>0){
  for(var i=0;i<data.length;i++)
  {
	var select_status='';  
	var title='';
	rows+='<tr>';
	rows+='<th scope="row">'+(i+1)+'</th>';
	rows+='<td>'+data[i].name+'</td>';
 	rows+='<td><div class="form-group"><div class="toggle-switch">';
	if(data[i].status==='active'){ select_status="checked"; title="Active";}else{ select_status=''; title="Inactive";}
 	rows+='<input class="toggle-switch__checkbox" type="checkbox" '+select_status+' value="'+data[i].status+'" data-id="'+data[i].id+'" data-control="city" id="status'+data[i].id+'" title="'+title+'">';
    rows+='<i class="toggle-switch__helper"></i></div></div></td>';
	rows+='<td><div class="btn-groups">'; 
	rows+='<a href="'+SITE_URL+'city/edit/'+data[i].id+'" class="btn btn-primary waves-effect">Edit</a>'; 
    rows+='<a href="#" class="btn btn-danger waves-effect" id="remove" data-id="'+data[i].id+'" data-control="city">Remove</a>'; 
	rows+='</div></td>';
	rows+='</tr>';  
  }
 }else{
    rows+='<tr><td colspan="5" align="center">No record found.</td></tr>';	 
 }
 $("#list_search_result").html(rows);	
}
 


$(function() {
"use strict";	
    $('#module_code').bind('blur', function() {
	   var controller='modules';
	   var forms_id=$(this).closest("form").attr('id');
	   var module_code=$(this).val();
	   if(module_code!=''){
       $.ajax({
		url: SITE_URL+controller+"/listMethods",
		type: 'POST',
		data: {module_code:module_code,hash_token:hash},
		cache:false,
		success: function(response) {
			var jObj=JSON.parse(response);
			hash=jObj.hash;
			$("#"+forms_id+" input[name='"+jObj.token+"']").val(jObj.hash);
			var droplist=jObj.data;
			var ol='';
 			if(jObj.status==='success')
			{        
			  if(droplist.length>0){
				for(var i=0;i<droplist.length;i++){
 				  ol+='<option value="'+droplist[i]+'">'+droplist[i]+'</option>';
				} 
				var a = $(".select2-parent")[0] ? $(".select2-parent") : $("body"); 
				  $(".roles").html(ol).select2({
					dropdownAutoWidth: !0,
					width: "100%",
					dropdownParent: a
				});
			  }
			}else if(jObj.status==='haserror')
			{
			 alert(jObj.error);
			} 
 		}
      });	
     }
	});
});


$(function() {
"use strict";	
    $('#country_id').bind('change blur', function() {
	  	var country_id=$(this).val();
 		if(country_id!==''){
		var forms_id=$(this).closest("form").attr('id');	
		  $.ajax({
			url: SITE_URL+"city/cityByCountry",
			type: 'POST',
			data: {country_id:country_id,hash_token:hash},
			cache:false,
			success: function(response) {
			var jObj=JSON.parse(response);
			hash=jObj.hash;
			$("#"+forms_id+" input[name='"+jObj.token+"']").val(jObj.hash);
			var droplist=jObj.data;
			var ol='';
 			if(jObj.status==='success')
			{        
			  if(droplist.length>0){
				for(var i=0;i<droplist.length;i++){
 				  ol+='<option value="'+droplist[i].id+'">'+droplist[i].name+'</option>';
				} 
				var a = $(".select2-parent")[0] ? $(".select2-parent") : $("body"); 
				$("#city_id").html(ol).select2({
					dropdownAutoWidth: !0,
					width: "100%",
					dropdownParent: a
				});
			  }
			}else if(jObj.status==='haserror')
			{
			 alert(jObj.error);
			} 
 		}
       
		  });
		}
	});
});
 
 

 

$('input[type=radio][name=menu_type]').change(function () {
	if (this.value == 0) {
		$("#subcategoryblock").css('display', 'none');
	}
	else if (this.value == 1) {
		$("#subcategoryblock").css('display', 'block');
	}
});

$('#list_search_result').on('click', 'button.view_enquiry', function () {
	"use strict";
	var id = $(this).attr('data-id');
	$.ajax({
		url: SITE_URL + "enquiries/enqdetails",
		type: 'POST',
		data: { id: id, hash_token: hash },
		cache: false,
		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				var data = jObj.data;

				if (data.length > 0) {
					$("#patient_name").html(data[0].patient_name);
					$("#hospital_name").html(data[0].hospital_name);
					$("#email").html(data[0].email);
					$("#phone").html(data[0].phone);
					$("#age").html(data[0].age);
					$("#gender").html(data[0].gender);
					$("#comments").html(data[0].comments);
					var file_name = '<a href="' + data[0].file_path + '" target="_blank">' + data[0].file_name+'</a>'
					$("#file_path").html(file_name);
					$("#date_added").html(data[0].date_added);

				}

			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
			}

		}
	});
});


$('#enquiry_reply').on('submit', function (e) {
	"use strict";
	e.preventDefault();
 
	var form_data = $(this).serialize();
	$.ajax({
		url: SITE_URL + 'enquiries/replyenquiry',
		type: 'POST',
  		data: form_data,
 		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status === "success") {
				swal({
					title: 'Message sent successfully',
					type: 'success',
					buttonsStyling: false,
					confirmButtonClass: 'btn btn-primary'
				});
				//setTimeout(function() { window.location.href = CURRENT_URL;}, 2000);
			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
				//$('#infomsg1').delay(3000).fadeOut();	
			}
		}
	});
});

$('#list_search_result').on('click', 'button.viewapplicant', function () {
	"use strict";
	var id = $(this).attr('data-id');
  	$.ajax({
		url: SITE_URL + "career/applicantdetails",
		type: 'POST',
		data: { applicant_id: id, hash_token: hash },
		cache: false,
		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				var data = jObj.data;

				if (data.length > 0) {

					$("#applicant_name").html(data[0].applicant_name);
					$("#hospital_name").html(data[0].hospital_name);
					$("#email").html(data[0].email);
					$("#phone").html(data[0].phone);
					$("#additional_information").html(data[0].additional_information);
					var file_name = '<a href="' + data[0].file_path + '" target="_blank">View/Download File</a>'
					$("#file_path").html(file_name);
					$("#date_added").html(data[0].date_added);
				}

			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
			}

		}
	});
});

$('#list_search_result').on('click', 'button.view_enquiry', function () {
	"use strict";
	var id = $(this).attr('data-id');
	$.ajax({
		url: SITE_URL + "enquiries/enqdetails",
		type: 'POST',
		data: { id: id, hash_token: hash },
		cache: false,
		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				var data = jObj.data;

				if (data.length > 0) {
					$("#name").html(data[0].name);
					$("#phone").html(data[0].phone);
					$("#email").html(data[0].email);
					$("#message").html(data[0].message);
 				}

			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
			}

		}
	});
});

$('#list_search_result').on('click', 'button#viewcareerenquiry', function () {
	"use strict";
	var id = $(this).attr('data-id');
	$.ajax({
		url: SITE_URL + "careerenquiries/enqdetails",
		type: 'POST',
		data: { id: id, hash_token: hash },
		cache: false,
		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				var data = jObj.data;

				if (data.length > 0) {
					$("#name").html(data[0].name);
					$("#phone").html(data[0].phone);
					$("#email").html(data[0].email);
					$("#currentcity").html(data[0].currentcity);
					$("#designation").html(data[0].designation);
					$("#currentctc").html(data[0].currentctc);
					$("#currentcompany").html(data[0].currentcompany);
					$("#file_url").html('<a href="' + data[0].file_url+'" download>Download File</a>');

				}

			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
			}

		}
	});
});

$('#list_search_result').on('click', 'button#viewproductenquiry', function () {
	"use strict";
	var id = $(this).attr('data-id');
	$.ajax({
		url: SITE_URL + "productenquiries/enqdetails",
		type: 'POST',
		data: { id: id, hash_token: hash },
		cache: false,
		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				var data = jObj.data;

				if (data.length > 0) {
					$("#name").html(data[0].name);
					$("#phone").html(data[0].phone);
					$("#email").html(data[0].email);
					$("#message").html(data[0].message);
					$("#qty").html(data[0].qty);
 					$("#proname").html('<a href="' + data[0].purl + '" target="_blank">' + data[0].proname+'</a>');

				}

			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
			}

		}
	});
});
function customersSearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td>' + data[i].name + '</td>';
			rows += '<td>' + data[i].email + '</td>';
			rows += '<td>' + data[i].mobile + '</td>';

  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'customers/edit/' + data[i].customers_id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="' + data[i].customers_id + '" data-control="customers" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="5" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}
function productsizeSearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td>' + data[i].product_size + '</td>';

  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'productsize/edit/' + data[i].id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="' + data[i].id + '" data-control="productsize" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="5" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}
function productmaterialSearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td>' + data[i].material_name + '</td>';

  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'productmaterial/edit/' + data[i].id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="' + data[i].id + '" data-control="productmaterial" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="5" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}
function productcolorSearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td>' + data[i].productcolor_name + '</td>';
			rows += '<td>' + data[i].color_type + '</td>';
			rows += '<td>' + data[i].bg_color + '</td>';

  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'productcolor/edit/' + data[i].color_id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="' + data[i].color_id + '" data-control="productcolor" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="5" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}
function brandSearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td>' + data[i].brand_name + '</td>';

			rows += '<td>' + data[i].featured + '</td>';
  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'brand/edit/' + data[i].id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="' + data[i].id + '" data-control="brand" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="5" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}
function categorySearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td>' + data[i].category_name + '</td>';

			rows += '<td>' + data[i].featured + '</td>';
  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'category/edit/' + data[i].cat_id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="' + data[i].cat_id + '" data-control="category" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="5" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}
function productSearchResult(jObj) {
	'use strict';
	var data = jObj.data;
	var rows = '';
	if (data.length > 0) {
		for (var i = 0; i < data.length; i++) {
			var select_status = '';
			var title = '';
			rows += '<tr>';
			rows += '<th scope="row">' + (i + 1) + '</th>';
			rows += '<td><img src="'+ data[i].pimage + '" alt="'+ data[i].product_name + '"></td>';
			rows += '<td>' + data[i].product_name + '</td>';

			rows += '<td>' + data[i].catalogue_id + '</td>';
			rows += '<td>' + data[i].sku + '</td>';
			rows += '<td>' + data[i].price + '</td>';
			rows += '<td>' + data[i].platform + '</td>';
  			rows += '<td><div class="form-group"><div class="toggle-switch">';
			if (data[i].status === "active") { select_status = "checked"; title = "Active"; } else { select_status = ''; title = "Inactive"; }
			rows += '<input class="toggle-switch__checkbox" type="checkbox" ' + select_status + ' value="' + data[i].status + '" data-id="' + data[i].id + '" data-control="product" id="status' + data[i].id + '" title="' + title + '">';
			rows += '<i class="toggle-switch__helper"></i></div></div></td>';
			rows += '<td><div class="btn-groups">';
			rows += '<a href="' + SITE_URL + 'product/edit/' + data[i].id + '" class="btn btn-primary waves-effect">Edit</a>';
			rows += '<a href="#" id="remove" data-id="'+data[i].id+'" data-control="product" class="btn btn-danger waves-effect">remove</a>';
			rows += '</div></td>';
			rows += '</tr>';
		}
	} else {
		rows += '<tr><td colspan="8" align="center">No record found.</td></tr>';
	}
	$("#list_search_result").html(rows);
}


//View Order Details

$('#list_search_result').on('click', 'button.view_order', function () {
	"use strict";
	var id = $(this).attr('data-order_id');
	var invoice_no = $(this).attr('data-invoiceno');

	$.ajax({
		url: SITE_URL + "orders/orderdetails",
		type: 'POST',
		data: {
			id: id,
			hash_token: hash
		},
		cache: false,
		success: function (response) {
			console.log(response);
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				var list = jObj.itemlist;
 				var ht = '';
				 
				$("#customer_name").html(jObj.customer_name);

				$("#order_date").html(jObj.order_date);
				$("#total_items").html(jObj.total_items);
				$("#mobile").html(jObj.mobile);

				$("#email").html(jObj.email);
				$("#message").html(jObj.message);
				$("#company").html(jObj.company);

				$("#order_subtotal").html('₹' + jObj.order_subtotal);
				$("#total_amount").html('₹' + jObj.total_amount);

				/* if (jObj.order_status == 0) {
					var amcht = '<span class="badge badge-pill badge-info">Active</span>';
				} else {
					var amcht = '<span class="badge badge-pill badge-danger">Expired</span>';
				} */
 

				if (list.length > 0) {
					for (var i = 0; i < list.length; i++) {
						ht += '<tr>';
						ht += '<td>' + list[i].item_name + '</td>';
						ht += '<td>₹' + list[i].price + '</td>';
						ht += '<td>' + list[i].item_qnty + '</td>';
						ht += '<td>' + list[i].gst + '%</td>';
						ht += '<td>₹' + list[i].item_subtotal + '</td>';
						ht += '</tr>';
					}
					$("#itemlist").html(ht);
				}


			} else if (jObj.status === 'error') {
				alert(jObj.msg);
			}



		}

	});
});

$('#list_search_result').on('click', 'button.update_order_status', function () {
	"use strict";
	var id = $(this).attr('data-order_id');
	var invoice_no = $(this).attr('data-invoiceno');

	$.ajax({
		url: SITE_URL + "orders/orderdetails",
		type: 'POST',
		data: {
			id: id,
			hash_token: hash
		},
		cache: false,
		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status == 'success') {
				//var list = jObj.itemlist;

				$('#o_order_id').val(id);
				$("#o_customer_name").html(jObj.customer_name);				
				$("#o_order_status").html(jObj.order_status);
				$("#o_order_date").html(jObj.order_date);
				$("#o_total_items").html(jObj.total_items);
				$("#o_promocode").html(jObj.promocode);
				$("#o_shipping_address").html(jObj.shipping_address);
				$("#o_mobile").html(jObj.mobile);
				$("#o_order_total").html('₹' + jObj.total_amount);
 				$("#invoice_no").html(invoice_no);

			} else if (jObj.status === 'error') {
				alert(jObj.msg);
			}



		}

	});
});



$('#order_status_form').on('submit', function (e) {
	"use strict";
	e.preventDefault();
 
	var form_data = $(this).serialize();
	$.ajax({
		url: SITE_URL + 'orders/updateorder',
		type: 'POST',
  		data: form_data,
 		success: function (response) {
			var jObj = JSON.parse(response);
			hash = jObj.hash;
			//$("form input[name='" + jObj.token + "']").val(jObj.hash);
			if (jObj.status === "success") {
				swal({
					title: 'Order status updated successfully',
					type: 'success',
					buttonsStyling: false,
					confirmButtonClass: 'btn btn-primary'
				});
				setTimeout(function() { window.location.href = CURRENT_URL;}, 2000);
			} else if (jObj.status === 'haserror') {
				alert(jObj.error);
 			}
		}
	});
});


$('#color_type').on('change', function() {
	if (this.value == 'sinlge') {
	  $('.color_2').css('display','none');
	}
	if (this.value == 'dual') {
	  $('.color_2').css('display','block');
	}
});