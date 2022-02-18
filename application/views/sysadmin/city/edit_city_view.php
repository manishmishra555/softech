<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content__inner">
  <header class="content__title">
    <h1><?php echo $page_title;?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $city=$city[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('name',set_value('name',$city->name,false),'class="form-control" id="city_name"');?> <?php echo form_label('City name','city_name');?> <?php echo form_error('name');?> <i class="form-group__bar"></i> </div>
        </div>
         <div class="col-sm-6">
         <?php echo form_label('Country','country');?> 
          <div class="form-group form-group--select">
             <div class="select">
                <?php 
				$options=array();
				$options['']='Select Country';
				if(count($country)>0){ 
				       foreach($country as $c){
						   $options[$c->id]=$c->country_name;
					   }
					$selected_country=$city->country_id;
				  }?>
                <?php echo form_dropdown('country', $options,$selected_country,'class="form-control" id="country"');?>
                 
                </div>
            </div>
         </div>
      </div>

      <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"><?php echo form_input('url_slug',set_value('url_slug',$city->url_slug,false),'class="form-control" id="url_slug"');?>
              <?php echo form_label('Base URL','url_slug');?><i class="form-group__bar"></i>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('h1_tag',set_value('h1_tag',$city->h1_tag,false),'class="form-control" id="h1_tag"');?>
              <?php echo form_label('H1 Tag','h1_tag');?><i class="form-group__bar"></i>
            </div>
          </div>          
        </div>

        <div class="row">
            <div class="col-sm-12">
            <div class="form-group form-group--float"><?php echo form_input('meta_title',set_value('meta_title',$city->meta_title,false),'class="form-control" id="meta_title"');?>
              <?php echo form_label('Meta Title','meta_title');?><i class="form-group__bar"></i>
            </div>
          </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Meta Description</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="meta_desc" id="meta_desc" placeholder="Write here...."><?= $city->meta_desc;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Additional Meta Tags</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="additional_tag" id="additional_tag" placeholder="Write here...."><?= $city->additional_tag;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('sort_order',set_value('sort_order',$city->sort_order),'class="form-control" id="sort_order"');?>
              <?php echo form_label('Sort Order','sort_order');?><i class="form-group__bar"></i>
            </div>
          </div>
        </div>

      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($city->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($city->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
      <br>
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('city_id',set_value('city_id',$city->id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/city').'\'"');?> </div>
      </div>
      <?php echo form_close();?> </div>
  </div>
</div>
