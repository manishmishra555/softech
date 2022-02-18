
	<!-- Begin Footer Area -->
	<footer>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-xs-b30 col-md-b0">
                            <img src="<?php echo FRONT_ASSETS_PATH; ?>images/menu/logo/logo-1.png" alt="" />
                            <div class="empty-space col-xs-b20"></div>
                            <div class="simple-article size-2 light fulltransparent">Offering the best optical frames and sunglasses to our pan India client base with a trust on quality.</div>
                            <div class="empty-space col-xs-b20"></div>
                           
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-b30 col-md-b0">
                            <h6 class="h6 light">quick links</h6>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="footer-column-links">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="<?= site_url('/') ?>">home</a> 
                                        <a href="<?= site_url('about/') ?>">about us</a>
                                        <a href="<?= site_url('product/') ?>">products</a>
                                        <a href="<?= site_url('brand/') ?>">Brands</a>
                                        <a href="<?= site_url('blog/') ?>">blog</a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="<?= site_url('privacy-policy/') ?>">Privacy Policy</a>
                                        <a href="<?php echo site_url('/login') ?>">login</a>
                                        <a href="<?= site_url('contact/') ?>">contact</a>
                                        <a href="<?= site_url('careers/') ?>">Careers</a>
                                        <!-- <a href="#">offers</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear visible-sm"></div>
                        
                        <div class="col-sm-6 col-md-3">
                            <h6 class="h6 light">Brands</h6>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="tags clearfix">
                                <?php 
                                $brand_foot = $this->db->order_by('sort_no', 'ASC')->get_where('tbl_brand',array('status ' => 'active'))->result();
                                // echo $this->db->last_query();
                                    foreach ($brand_foot as $key) { ?>
                                        <a href="<?= site_url('brands/'.$key->url_slug) ?>" class="tag"><?= $key->brand_name; ?></a>
                                   <?php  } ?>
                                
                           
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-b30 col-sm-b0">
                            <h6 class="h6 light">Reach Us</h6>
                            <div class="empty-space col-xs-b20"></div>
                             <div class="footer-contact phone"><i class="fa fa-mobile" aria-hidden="true"></i> contact us: <a href="tel:<?= $this->dbsettings->PHONE; ?>"><?= $this->dbsettings->PHONE; ?></a></div>
                            <div class="footer-contact"><i class="fa fa-envelope-o" aria-hidden="true"></i> email: <a href="mailto:<?= $this->dbsettings->ENQUIRY_EMAIL; ?>"><?= $this->dbsettings->ENQUIRY_EMAIL; ?></a></div>
                            <div class="footer-contact"><i class="fa fa-map-marker" aria-hidden="true"></i> address: <a href="#"><?= $this->dbsettings->OFFICE_ADDRESS; ?></a></div>
                            <div class="footer-contact"><i class="fa fa-map-marker" aria-hidden="true"></i> Timings: <a href="#"><?= $this->dbsettings->TIMING; ?></a></div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-lg-8 col-xs-text-center col-lg-text-left col-xs-b20 col-lg-b0">
                            <div class="copyright">&copy; 2021 All rights reserved. <a href="" target="_blank">Galorebay Optix India</a></div>
                            <div class="follow">
                                <a class="entry" href="<?= $this->dbsettings->FACEBOOK_LINK; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="entry" href="<?= $this->dbsettings->INSTAGRAM_LINK; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-text-center col-lg-text-right">
                            <div class="copyright">Powered by. <a href="" target="_blank"><img src="https://www.doorsstudio.com/images/doors-logo.svg"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->