<!-- mega menu -->
<?php $page = $this->uri->segment(1);
  if(!empty($page)){
	 $menuclass="grey-menu-background section-shadow menu-section";
 }else{
	 $menuclass="dark-menu-background menu-section floating-menu";
 }
$cart = getCart();
?>
<header>
            <div class="header-top">
                <div class="content-margins">
                    <div class="row">
                        <div class="col-md-5 hidden-xs hidden-sm top_conts">
                            <div class="entry"><b>contact us:</b> <a href="tel:<?= $this->dbsettings->PHONE; ?>"><?= $this->dbsettings->PHONE; ?></a></div>
                            <div class="entry"><b>email:</b> <a href="mailto:<?= $this->dbsettings->ENQUIRY_EMAIL; ?>"><?= $this->dbsettings->ENQUIRY_EMAIL; ?></a></div>
                        </div>
                        <div class="col-md-7 col-md-text-right">

                            <?php if($this->session->has_userdata('userId')){ 
                                            
                            $user_id = $this->session->userdata('userId');
                            $customers = $this->customers_model->selectdata("*", array('id' => $user_id), "ORDER BY id DESC LIMIT 1");
                            
                            $customer_name=$customers[0]->name;
                            ?>

                            <div class="entry hidden-xs hidden-sm cart">
                                <a href="#">
                                    <b class="hidden-xs">Welcome <b><?php echo $customer_name; ?></b></b>
                                   
                                </a>
                                <div class="cart-toggle hidden-sm hidden-sm logged_in_block">
                                    <div class="cart-overflow">
                                        <ul>
                                            <li class="position-relative"><a href="<?= site_url('user/info');?>">My Account</a></li>
                                                <li><a href="<?php echo site_url('user/logout') ?>">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mob_top_bar">
                                <div class="entry phone_mob">
                                <a href="#" class="open_drop">
                                    <b>Welcome <?php echo $customer_name; ?></b>
                                   
                                </a>
                                <div class="cart-toggle hidden-sm hidden-sm logged_in_block">
                                    <div class="cart-overflow">
                                        <ul>
                                            <li class="position-relative"><a href="<?= site_url('user/info');?>">My Account</a></li>
                                                <li><a href="<?php echo site_url('user/logout') ?>">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                                <div class="entry phone_mob"><a href="tel:<?= $this->dbsettings->PHONE; ?>"><i class="fa fa-phone" style="font-size: 17px;margin-right: 5px;" aria-hidden="true"></i><?= $this->dbsettings->PHONE; ?></a></div>
                            </div>
                        <?php }else{ ?>

                            <div class="entry"><a href="<?php echo site_url('/login') ?>"><b>Opticians login</b></a>&nbsp; or &nbsp;<a href="<?php echo site_url('/register') ?>"><b>register</b></a></div>
                            <div class="entry phone_mob"><a href="tel:<?= $this->dbsettings->PHONE; ?>"><i class="fa fa-phone" style="font-size: 17px;margin-right: 5px;" aria-hidden="true"></i><?= $this->dbsettings->PHONE; ?></a></div>

                        <?php } ?>
                           
                            <?php $this->load->view('templates/front_common/master_head_cart'); ?>
                            <div class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="content-margins">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 cols_mob_logo">
                            <a id="logo" href="<?= site_url('');?>">
                                        <img src="<?php echo FRONT_ASSETS_PATH; ?>images/menu/logo/logo-2.png" alt="Header Logo">
                                    </a>

                        </div>
                        <div class="col-xs-12 col-sm-12 cols_mob_links">
                            <div class="nav-wrapper">
                                <div class="nav-close-layer"></div>
                                <nav> 
                                    <ul>
                                        <li class="<?php if($page == 'home'){ echo 'active'; } ?>">
                                            <a href="<?= site_url('/') ?>">Home</a>
                                        </li>
                                        <li class="<?php if($page == 'about'){ echo 'active'; } ?>">
                                            <a href="<?= site_url('about/') ?>">about us</a>
                                        </li>
                                        <li class="<?php if($page == 'product'){ echo 'active'; } ?>">
                                            <a href="<?= site_url('product/') ?>">products</a>
                                        </li>
                                        <li class="<?php if($page == 'brand'){ echo 'active'; } ?>">
                                            <a href="<?= site_url('brand/') ?>">Brands</a>
                                            <div class="menu-toggle"></div>
                                            <ul>
                                                <?php 
                                                    $brand_head = $this->db->order_by('sort_no', 'ASC')->get_where('tbl_brand',array('status ' => 'active'))->result();
                                                    // echo $this->db->last_query();
                                                        foreach ($brand_head as $key) { ?>
                                                            <li>
                                                            <a href="<?= site_url('brands/'.$key->url_slug) ?>"><?= $key->brand_name; ?></a>
                                                            <?php
                                                                $subbrand_head = $this->db->order_by('id', 'DESC')->get_where('tbl_subbrands',array('status ' => 'active','brand_name ' => $key->id))->result(); ?>
                                                                    <div class="menu-toggle"></div>
                                                                    <ul>
                                                                        <?php  foreach ($subbrand_head as $key1) { ?>
                                                                        <li><a href="<?= site_url('brands/'.$key1->url_slug) ?>"><?= $key1->sub_brand_name; ?></a></li>
                                                                    <?php } ?>
                                                                    </ul>
                                                            
                                                        </li>
                                                <?php  } ?>
                                                
                                            </ul>
                                        </li>
                                        <li class="<?php if($page == 'blog'){ echo 'active'; } ?>">
                                            <a href="<?= site_url('blog/') ?>">blog</a>
                                        </li>
                                        <li class="<?php if($page == 'contact'){ echo 'active'; } ?>">
                                            <a href="<?= site_url('contact/') ?>">Contact Us</a>
                                        </li>

                                    
                                    </ul>
                                    <div class="navigation-title">
                                        Navigation
                                        <div class="hamburger-icon active">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                            <div class="header-bottom-icon toggle-search"><i class="fa fa-search" aria-hidden="true"></i></div>
                            
                            <div class="header-bottom-icon visible-rd mob_cart">
                                <a href="<?= site_url('viewcart/') ?>" style="color:black;">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <span class="cart-label"><?= $cart['total_items']; ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="header-search-wrapper">
                        <div class="header-search-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 search_product_bar">
                                        <form>
                                            <div class="search-submit">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                <input type="submit"/>
                                            </div>
                                            <input class="simple-input style-1 searchItem" type="text" placeholder="Enter keyword" />
                                        </form>
                                        <ul class="resultSearch">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="button-close"></div>
                        </div>
                    </div>
                </div>
            </div>

        </header>











<!-- <nav class="section-menu-fixed cbp-af-header <?//= $menuclass;?>">
		<div class="container">
			<div class="twelve columns">
			
		
			
			
			
			</div>
		</div>
	</nav> -->


    <div class="alert alert-success alert-dismissible alert_sucsss">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="data_ad"></span>
    </div>

    <div class="alert alert-danger alert-dismissible alert_erss">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="data_ad"></span>
    </div>