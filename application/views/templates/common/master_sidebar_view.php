<aside class="sidebar">
  <div class="scrollbar-inner">
    <div class="user">
      <div class="user__info" data-toggle="dropdown"> <img class="user__img" src="<?php echo ADMIN_ASSETS_PATH; ?>demo/img/profile-pics/4.jpg" alt="">
        <div>
          <div class="user__name"><?php print_r($this->ion_auth->user()->row()->username); ?></div>
          <div class="user__email"><?php print_r($this->ion_auth->user()->row()->email); ?></div>
        </div>
      </div>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">View Profile</a>
        <a class="dropdown-item" href="<?php echo site_url('sysadmin/website_settings'); ?>">Settings</a>
        <a class="dropdown-item" href="<?php echo site_url('sysadmin/login/logout'); ?>">Logout</a> </div>
    </div> 
    <ul class="navigation">
      <li class="@@indexactive"><a href="<?php echo site_url('sysadmin/dashboard'); ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
      <!-- <li class="@@banneractive"><a href="<?php echo site_url('sysadmin/banner'); ?>"><i class="zmdi zmdi-collection-image"></i> Banner</a></li> -->

      <li class="@@banneractive"><a href="<?php echo site_url('sysadmin/category'); ?>"><i class="zmdi zmdi-view-list"></i> Category</a></li>
  

      <li class="navigation__sub @@variantsactive"> <a href="#"><img class="flaticon_img" src="<?php echo ADMIN_ASSETS_PATH; ?>img/icons/brands-icon.png"> Brands</a>
        <ul>

        <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/brand'); ?>"><i class="zmdi zmdi-arrow-right"></i> All Brands</a></li>
      <!-- <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/subbrands'); ?>"><i class="zmdi zmdi-arrow-right"></i> All Sub Brands</a></li>
      <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/blog'); ?>"><i class="zmdi zmdi-pin"></i> Blog Comment</a></li> -->

        </ul>
      </li>

      <li class="@@banneractive"><a href="<?php echo site_url('sysadmin/product'); ?>"><img class="flaticon_img" src="<?php echo ADMIN_ASSETS_PATH; ?>img/icons/product.png"> Products</a></li>
     
      <li class="navigation__sub @@variantsactive"> <a href="#"><i class="zmdi zmdi-amazon"></i> Amazon</a>
        <ul>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/amazon/dashboard'); ?>"><i class="zmdi zmdi-arrow-right"></i> Dashboard</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/amazon/products'); ?>"><i class="zmdi zmdi-arrow-right"></i> All Products</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/amazon/orders'); ?>"><i class="zmdi zmdi-arrow-right"></i> Orders</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/amazon/returns'); ?>"><i class="zmdi zmdi-arrow-right"></i> Returns</a></li>
        </ul>
      </li>

      <li class="navigation__sub @@variantsactive"> <a href="#"><img class="flaticon_img" src="<?php echo ADMIN_ASSETS_PATH; ?>img/icons/flipkart-logo.png"> Flipkart</a>
        <ul>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/flipkart/dashboard'); ?>"><i class="zmdi zmdi-arrow-right"></i> Dashboard</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/flipkart/products'); ?>"><i class="zmdi zmdi-arrow-right"></i> All Products</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/flipkart/orders'); ?>"><i class="zmdi zmdi-arrow-right"></i> Orders</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/flipkart/returns'); ?>"><i class="zmdi zmdi-arrow-right"></i> Returns</a></li>
        </ul>
      </li>

      <li class="navigation__sub @@variantsactive"> <a href="#"><img class="flaticon_img" src="<?php echo ADMIN_ASSETS_PATH; ?>img/icons/meesho-icons.png"> Meesho</a>
        <ul>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/meesho/dashboard'); ?>"><i class="zmdi zmdi-arrow-right"></i> Dashboard</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/meesho/products'); ?>"><i class="zmdi zmdi-arrow-right"></i> All Products</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/meesho/orders'); ?>"><i class="zmdi zmdi-arrow-right"></i> Orders</a></li>
          <li class="@@teamactive"><a href="<?php echo site_url('sysadmin/meesho/returns'); ?>"><i class="zmdi zmdi-arrow-right"></i> Returns</a></li>
        </ul>
      </li>

      

<!--       <li class="@@pagesactive"><a href="<?php //echo site_url('sysadmin/careerenquiries'); ?>"><i class="zmdi zmdi-pin"></i>Career Enquiries</a></li>
      <li class="@@pagesactive"><a href="<?php //echo site_url('sysadmin/enquiries'); ?>"><i class="zmdi zmdi-pin"></i>Contact Enquiries</a></li> -->



      <!-- <li class="@@pagesmetaactive"><a href="<?php //echo site_url('sysadmin/pagesmeta'); ?>"><i class="zmdi zmdi-pin"></i> Pages Meta Tag</a></li> -->
      <?php /* if ($this->ion_auth->in_group('admin')) { ?>
        <li class="navigation__sub @@variantsactive"> <a href="#"><i class="zmdi zmdi-view-stream"></i> Groups & Users</a>
          <ul>
            <li class="@@modulesactive"><a href="<?php echo site_url('sysadmin/modules'); ?>"><i class="zmdi zmdi-view-module"></i> Modules</a></li>
            <li class="@@groupsactive"><a href="<?php echo site_url('sysadmin/groups'); ?>"><i class="zmdi zmdi-accounts-alt"></i> Groups</a></li>
            <li class="@@usersactive"><a href="<?php echo site_url('sysadmin/users'); ?>"><i class="zmdi zmdi-accounts-list-alt"></i> Users</a></li>
          </ul>
        </li>
      <?php } */ ?>
    </ul>
  </div>
</aside>


<?php /* ?>
<aside class="sidebar">
  <div class="scrollbar-inner">
    <div class="user">
      <div class="user__info" data-toggle="dropdown"> <img class="user__img" src="<?php echo ADMIN_ASSETS_PATH; ?>demo/img/profile-pics/8.jpg" alt="">
        <div>
          <div class="user__name"><?php print_r($this->ion_auth->user()->row()->username); ?></div>
          <div class="user__email"><?php print_r($this->ion_auth->user()->row()->email); ?></div>
        </div>
      </div>
      <div class="dropdown-menu">
         <a class="dropdown-item" href="<?php echo site_url('website_settings'); ?>">Settings</a>
        <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a> </div>
    </div>
    <ul class="navigation">
      <?php
      $menu_items = $this->session->userdata('menu_items');
      $sub_items = array();
      foreach ($menu_items as $code => $name) {
        if (count($name) > 1) { ?>
          <li class="navigation__sub @@variantsactive"> <a href="#"><i class="zmdi zmdi-view-list-alt"></i> <?= $code; ?></a>
            <ul>
              <?php
              for ($i = 0; $i < sizeof($name); $i++) {
                if (in_array($name[$i], $sub_items)) { } else { ?>
                  <?php
                  $m = explode("~", $name[$i]);
                  $module_code = $m[0];
                  $module_name = $m[1];
                  array_push($sub_items, $name[$i]); ?>
                  <li class="@@itemsactive"><a href="<?php echo site_url($module_code); ?>"><i class="zmdi zmdi-view-stream"></i> <?= $module_name; ?></a></li>
                <?php }  ?>

              <?php } ?>
            </ul>
          </li>
        <?php } else if ($code == "commonaccess") { } else { ?>
          <li class="@@indexactive"><a href="<?php echo site_url($code); ?>"><i class="zmdi zmdi-view-stream"></i> <?= $name; ?></a></li>
        <?php }
      }
      ?>

       
    </ul>
  </div>
</aside>
<?php */ ?>