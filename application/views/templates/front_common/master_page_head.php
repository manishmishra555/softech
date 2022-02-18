<!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  	<title><?php if (isset($page_title)) {echo $page_title;	} ?></title>
	<meta name="description" content="<?php if (isset($meta_desc)) {echo $meta_desc; } ?>">
	<meta name="author" content="">
	<?php if (isset($additional_meta)) {
			echo html_entity_decode($additional_meta);	
		} ?>

  
<!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	 
    <!-- CSS
	============================================ -->
<link href="https://fonts.googleapis.com/css?family=Questrial|Raleway:700,900" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <link href="<?php echo FRONT_ASSETS_PATH; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo FRONT_ASSETS_PATH; ?>css/bootstrap.extension.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo FRONT_ASSETS_PATH; ?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo FRONT_ASSETS_PATH; ?>css/swiper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo FRONT_ASSETS_PATH; ?>css/sumoselect.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo FRONT_ASSETS_PATH; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        .bg_top .swiper-slide{
            background-size: contain;background-repeat: no-repeat;
        }
        .logged_in_block{
            padding: unset !important;
            width: 170px !important;
        }
        .logged_in_block ul li{
            padding: 10px;font-size: 14px;
        }
        .myaccount-tab-content {
            border: 1px solid #e5e5e5;
            padding: 30px;
        }
        .tab-content {
            width: 100%;
        }
        .tab-content .tab-pane.active {
            height: auto;
            visibility: visible;
            opacity: 1;
            overflow: visible;
        }
        .edit_btn_uinfo {
            color: #009fff !important;
            font-size: 12px;
            text-decoration: underline;
        }
        .top_conts a{
            color: #de5b50;font-size: 13px;
        }
        .myaccount-tab-content h4{
            color: #202020;
            font-weight: 600;
            line-height: 32px;
            font-size: 20px;
        }
        .myaccount-tab-content h6{
            color: #202020;
            font-weight: 600;
            line-height: 25px;
            font-size: 15px;margin-top: unset;
        }
        .pg_usr_content{
            margin: 15% 0;
        }
        .box_show_align {
            margin-bottom: 10px;
        }
        .box_show_align {
            padding: 5px 10px;
        }
        .btn_option {
            color: black;
            width: 15px;
            position: absolute;
            top: -70px;
            right: 0;
        }
        .drop_menus .dropdown-menu{
            float: right;
            width: 160px;
            left: unset;
            right: 0;
            top: -35px;            
        }
        .drop_menus .dropdown-menu p{
            border-bottom: 1px solid #e9e6e6;
            padding: 6px;
        }
        .account-page-area .myaccount-tab-trigger li a {
            display: block;
            background: #151515;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 600;
            padding: 10px 20px;
        }
        .template-color-1 .account-page-area .myaccount-tab-trigger li a.active {
            background: #a8741a;
            color: #ffffff;
        }
        .login_conts{
            margin: 13% auto;
            display: block;
            box-shadow: unset;border: 1px solid #efefef;
        }
        .products_conts{
            margin: 10% auto;
            display: block;
        }
        .swipe_bg .container-fluid{
            padding:unset;
        }
        .swipe_bg img{
            width:100%;
        }
        .register_block .step2,.register_block .step3,.register_block .step4{
            display: none;
        }
        #addresslist hr{
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .adr_blocks{
            display: none;
        }
        .alert_erss,.alert_sucsss{
            display: none;
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            margin: auto;
            z-index: 99999;
            text-align: center;
            background: #414141;
            color: white;
            width: 400px;
            border-radius: unset;
            opacity: 0.9;
        }
        .product-small-preview-entry img{
            width:100%;
        }
        .brand_block .product-shortcode h6{
            margin-top: 7%;
            text-align: center;
        }
        .brand_title{
            text-align: center;
        }
        .chk_color .lbl_color{
            position: absolute;
            left: 60px;cursor: pointer;
        }
        .no-product{
            text-align: center;
            background-color: #fbfbfb;
            padding: 2%;
            color: black !IMPORTANT;
            margin: 10% 0;
        }
        .btn_middle {
            float: unset;
            width: fit-content;
            margin: 0 auto;
            display: block;
        }
        .btn_middle .button{
            margin: 0 auto;
            display: block;
        }
        .brand_block_home .preview img{
                width: auto !important;
                height: 100% !important;
        }
        .brand_block_home .preview{
            padding: 0px !important;
            height: 130px !important;
        }
        .brand_block_home .swiper-button-prev.swiper-button-disabled, .brand_block_home .swiper-button-next.swiper-button-disabled{
            display: none;
        }
        #logo{
            display: block;
        }
        #logo img{
            margin: 0px auto;
            display: block;
            max-height: 100%;
            width: auto;
        }
        .mob_cart{
            display: none;
        }
        .bg_top .swiper-button-prev, .bg_top .swiper-button-next{
            top: 60%;
        }
        .brands_blocks .gallery-grid-item{
            height: 150px;
            padding: 10px;
            width: 170px;
        }
        .brands_blocks .grid-item.w33 .gallery-grid-item{
            width: 100%;padding: 10px !important;height: 240px;
        }
        .brands_blocks .grid-item.w33 .gallery-grid-item:hover{
            background-color: #e6e6e6;
        }
        .pros_page .simple-article.size-1{
            display: inline-block;
        }
        .search_product_bar{
            margin-left: 25% !important;
        }
        .resultSearch {

    position: absolute;

    width: 100%;

    max-width: 870px;

    cursor: pointer;

    overflow-y: auto;

    max-height: 400px;

    box-sizing: border-box;

    z-index: 1001;padding: unset;

    overflow-y: scroll;
    background-color: #fff;
    border: 1px solid #ddd;

}

.resultSearch p{
    text-align: left;
    padding-left: 10px;color: #cccbcb;
}

.resultSearch::-webkit-scrollbar {

    display: none;

}

.resultSearch {

    display: none;

  -ms-overflow-style: none;  

  scrollbar-width: none;

}

.resultSearch .list-group-item{

    width: 100%;padding: unset;border: none;

}

.resultSearch .list-group-item .img_list,.resultSearch .list-group-item .pro_list_info{

    display: inline-block;float: left;

}

.resultSearch .list-group-item .pro_list_info{

    padding-left: 10px;

    padding-top: 5px;
width: 100%;
    padding: 8px;
}



.resultSearch .list-group-item .pro_list_info p{

    font-size: 12px;color: black;margin: unset;letter-spacing: 1px;

}

.shop-cate li .collapse li{

}

.shop-detail .slides li img{

    width: 60%;

    margin: 0 auto;

    display: block !important;

}

.resultSearch .list-group-item .pro_list_info .text-muted{

    font-weight: 600;text-align: left;

}
.pagination.pag_all{
    border: none;
    justify-content: center;
    width: 100%;
    display: flex;
}
.pagination.pag_all li{
    padding: 0 5px;
}
.pagination.pag_all li a{
    color: #848484;
    width: 40px;
    line-height: 38px;
    height: 40px;
    border-radius: 5px;
    padding: unset;
}
.pagination.pag_all .pagination-prev{
    left: 0;
    position: absolute;
}
.pagination.pag_all .pagination-next{
    right: 0;
    position: absolute;
}
.pagination.pag_all .pagination-prev a,.pagination.pag_all .pagination-next a{
    width: 80px;
    border-radius: 30px;
}
.pag_all>.active>a, .pag_all>.active>a:focus, .pag_all>.active>a:hover, .pag_all>.active>span, .pag_all>.active>span:focus, .pag_all>.active>span:hover{
    background-color: #234272;
    border-color: #234272;
    color: white !important;
}
.filter_categ{
    height: 190px;
    overflow: auto;
    padding: 10px;border-right: 1px solid #f9f9f9;
}
.products_conts .col-md-pull-9{
    border-right: 1px solid #f9f9f9;
}

::-webkit-scrollbar {

    width: 5px;

    height: 7px;

  }

  ::-webkit-scrollbar-button {

    width: 0px;

    height: 0px;

  }

  ::-webkit-scrollbar-thumb {

    background: #525965;

    border: 0px none #ffffff;

    border-radius: 0px;

  }

  ::-webkit-scrollbar-thumb:hover {

    background: #525965;

  }

  ::-webkit-scrollbar-thumb:active {

    background: #525965;

  }

  ::-webkit-scrollbar-track {

    background: transparent;

    border: 0px none #ffffff;

    border-radius: 50px;

  }

  ::-webkit-scrollbar-track:hover {

    background: transparent;

  }

  ::-webkit-scrollbar-track:active {

    background: transparent;

  }

  ::-webkit-scrollbar-corner {

    background: transparent;

  }

.gallery_pros{
    padding: 15px !important;
    text-align: center;background-color: #f7f7f7;
}
.gallery_pros .gallery-title{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.gallery_pros .gallery-title .h5{
    font-weight: 700;
    color: #444242;font-size: 18px;
}

.gallery_pros .gallery-title h5{
    font-size: 16px;
}
.container_check {
  display: inline-block;
    position: relative;
    padding-left: 25px;
    margin: 13px 0;
    cursor: pointer;
    margin-right: 25px;
    font-size: 12px;
    line-height: 23px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.container_check input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
  border-radius: 50%;
}

.container_check:hover input ~ .checkmark {
  background-color: #ccc;
}

.container_check input:checked ~ .checkmark {
  background-color: #234272;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.container_check input:checked ~ .checkmark:after {
  display: block;
}
.phone_mob,.mob_top_bar{
    display:none !important;
}
        @media only screen and (max-width: 768px) {
            .hamburger-icon {
                width: 25px;
                height: 32px;
            }
            .text-center h2{
                font-size: 4vw;
            }
            .mob_top_bar{
                display:block !important;
            }
            .phone_mob{
                display:inline-block !important;
            }
            .cols_mob_logo{
                width: 48%;
            }
            .div_pros_inf .col-xs-b40{
                width:50%;display:inline-block;
            }
            .cols_mob_links{
                width: 48%;text-align: right !important;
            }
            .cols_mob_links .header-bottom-icon{
                font-size: 17px;
                width: 30px;float: right;
            }
            .bg_top .swipe_bg{
                margin-top: 0px;height: 180px !important;
            }
            .product-shortcode.style-1.big{
                border: 1px solid #e6e3e3;    padding: 0px 30px 5px 30px;
            }
            header{
                position: relative;
            }
            .swiper-slide{
                width: 100% !important;
            }
            .products_conts{
                margin: unset;
            }
            .swiper-container-autoheight, .swiper-container-autoheight .swiper-slide{
                height: 180px;
            }
            .grid-item.w33 {
                width: 45%;
            }
            .gallery-grid-item .gallery-title{
                display:block;padding: 45px 0;
            }
            .brands_blocks .grid-item.w33 .gallery-grid-item{
                height:172px;
            }
            .bg_top .swiper-container {
                margin-top: unset !important;
            }
            .brand_block_home .brand_blk {
                border: 1px #ece8e8 solid;
                width: 49%;
                display: inline-block;
            }
            .header-bottom {
                height: auto;
            }
            .mob_cart{
                display: block;
            }
            .slide_nearbanner{
                margin-bottom: 50px;
            }
            .product-shortcode.style-1 .preview{
                padding: 7px;
                height: 100%;
                margin-bottom: unset !important;
            }
            .bg_banner{
                background-size: contain;
            }
            .product-shortcode.style-1 .preview img{
                    width: 100%;
                    height: 100%;
                    margin: 0 auto;
                    display: block;
            }
            .header-empty-space{
                height: unset;
            }
            .breadcrumbs{
                margin-top: unset;
            }
            .logged_in_block{
                opacity:1 !important;right: 0px !important;display:none;
            }
            
            .modal_slider .pos-center{
                    width: 60%;
                    
            }
            #swiper_modal{
                padding-right: unset;
            }
            #swiper_modal .modal-dialog{
                margin:unset;height: 100%;
            }
            #swiper_modal .modal-content{
                margin: -3px;height: 100%;
            } 
            #swiper_modal .modal-body{
                padding: unset;
            }
            #swiper_modal .swiper-button-prev{
                left: 0px !important;
            }
            #swiper_modal .swiper-button-next{
                right: 0px !important;
            }
            .product-big-preview-entry img{
                width: auto;
                height: 100%;
                margin: 0 auto !important;
                margin-left: auto;
                display: block;
                padding: 7%;
                margin-left: unset !important;
            }
            .header-top a, .header-top a .fa, .header-top a b{
                font-size: 2.5vw;
            }
            .header-top .entry.phone_mob .fa{
                font-size: 3vw !important;
                margin-right: 5px !important;
                margin-bottom: 3px;
            }
            .btn_prevs,.btn_nxts{
                display:inline-block;
            }
            .btn_nxts{
                float:right;
            }
            .resend_otp{
                text-align: right;
                padding-right: 10px;
                width: 100%;
            }
            .resend_otp a{
                text-decoration: underline;
            }
            .search_product_bar {
                margin-left: unset !important;
            }
            .login_conts {
                margin: 0% auto;
            }
            .alert{
                margin:unset;
            }
        }

        .fancybox-slide--image{
            background-color: #fff;
        }
        .brand_block_home .brand_blk{
            border: 1px #ece8e8 solid;
        }
        .brand_block_home .product-shortcode.style-1.big{
            border: none !important;
        }

        .brand_block_home .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          width: 90%;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 999; 
        }
        .brand_block_home .dropdown-content.open {
            display: block;
        }

        .brand_block_home .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        .brand_block_home .dropdown-content a:hover{
            background-color:#dadada;
        }
        .bg_top .swiper-container{
            margin-top: 150px;
        }
        .checkmark{
            border-radius: unset;
        }
        .checkmark:after{
            content: "✓";
            position: absolute;
            color: white;
            left: 5px;
        }
        .footer-contact.phone a{
            font-size:15px;
        }
    </style>