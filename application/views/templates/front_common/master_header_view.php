  <?php $page=$this->uri->segment(1);
         if(empty($page) || $page=="home"){  
            $this->load->view('templates/front_common/master_menu');?>
         <?php }else { ?>
          <div class="header-wrap">
              <?php $this->load->view('templates/front_common/master_menu');?>
          </div>
         <?php } ?>
  <!-- Header -->
     
   <!-- Header ends -->