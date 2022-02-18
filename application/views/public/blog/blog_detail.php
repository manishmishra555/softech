<?php $post = $post[0];$blog_categ = $blog_categ[0]; ?>
<style>
    .simple-article h1, .h1{
        line-height: 10px;
    }
    .embed-responsive-16by9{
        padding-bottom: 45%;
    }
</style>
<div class="section padding-top padding-bottom-med white-background">
	<br><br><br><br><br><br><br><br><br><br><br><br>
	<div class="blog-pages-wrapper smaller-blog-wrapper">
	    <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="simple-article size-1 grey uppercase col-xs-b10"><?php echo date("d M Y", strtotime($post->date_added)); ?></div>
                            <h1 class="h3 col-xs-b5 col-sm-b30"><?= $post->blog_title ?></h1>
                        </div>
                        <div class="col-sm-4 col-sm-text-right">
                            <div class="blog-comments"><a class="color" href="#"><?= $blog_categ->bcat_name ?></a></div>
                        </div>
                    </div>
                    <div class="simple-article size-2">
                        <?php $PImages = json_decode($post->image_fids);
				$image = $this->media->getThumbPathById($PImages[0], '900x411'); ?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <img alt="" src="<?= $image; ?>">
                        </div>
                        <?= $post->blog_post ?>
                    </div>
                    <div class="empty-space col-xs-b30"></div>
                    <!--<div class="row">
                        <div class="col-sm-6 col-xs-b15 col-sm-b0">
                            <div class="tags light clearfix">
                                <span class="title">tags:</span>
                                <a class="tag">headphoness</a>
                                <a class="tag">accessories</a>
                                <a class="tag">new</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-text-right">
                            <div class="follow light">
                                <span class="title">share:</span>
                                <a class="entry" href="#"><i class="fa fa-facebook"></i></a>
                                <a class="entry" href="#"><i class="fa fa-twitter"></i></a>
                                <a class="entry" href="#"><i class="fa fa-linkedin"></i></a>
                                <a class="entry" href="#"><i class="fa fa-google-plus"></i></a>
                                <a class="entry" href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>-->

                    <div class="empty-space col-xs-b35 col-md-b70"></div>

                    <div class="simple-article size-3 grey uppercase col-xs-b5">related posts</div>
                    <div class="h3">something interesting too</div>
                    <div class="title-underline left"><span></span></div>
                    <div class="empty-space col-xs-b35"></div>

                    <div class="row">
                        <?php if(count($latest)>0){?>
						<?php foreach ($latest as $data) {
									$PImages = json_decode($data->image_fids);
									$image = $this->media->getThumbPathById($PImages[0], '300x137'); ?>
                        <div class="col-sm-6 col-xs-b30 col-sm-b0">
                            <div class="icon-description-shortcode style-2">
                                <a href="<?php echo site_url('blog/' . $data->url_slug);?>" class="image-icon simple-mouseover rounded-image">
                                    <img class="image-thumbnail rounded-image" src="<?= $image;?>" alt="<?php echo $data->blog_title; ?>" />
                                </a>
                                <div class="content">
                                    <h6 class="title h6"><a href="<?php echo site_url('blog/' . $data->url_slug);?>"><?php echo $data->blog_title; ?></a></h6>
                                    <div class="subtitle simple-article size-1 grey uppercase col-xs-b10"><?= date('F j, Y',strtotime($data->date_added));?></a></div>
                                
                                    <a class="button size-1 style-3" href="<?php echo site_url('blog/' . $data->url_slug);?>">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                            <span class="text">learn more</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
					 <?php } ?>
                        
                    </div>

                    <div class="empty-space col-xs-b35 col-md-b70"></div>

                </div>
                <div class="col-md-3">
                    <div class="single-line-form">
                        <input class="simple-input small" type="text" value="" placeholder="Enter keyword">
                        <div class="submit-icon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="submit"/>
                        </div>
                    </div>
                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b10">categories</div>
                    <ul class="categories-menu alignleft">
                      <?php if(count($allcateg)>0){
						 foreach ($allcateg as $data_c) { ?>
						    
                        <li>
                            <a href="#"><?= $data_c->bcat_name; ?></a>
                            <div class="toggle"></div>
                            
                        </li>
						<?php }
                        } ?>
                        
                    </ul>


                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <!--<div class="h4 col-xs-b25">Popular Tags</div>-->
                    <!--<div class="tags light clearfix">-->
                    <!--    <a class="tag">headphoness</a>-->
                    <!--    <a class="tag">accessories</a>-->
                    <!--    <a class="tag">new</a>-->
                    <!--    <a class="tag">wireless</a>-->
                    <!--    <a class="tag">cables</a>-->
                    <!--    <a class="tag">devices</a>-->
                    <!--    <a class="tag">gadgets</a>-->
                    <!--    <a class="tag">brands</a>-->
                    <!--    <a class="tag">replacements</a>-->
                    <!--    <a class="tag">cases</a>-->
                    <!--    <a class="tag">cables</a>-->
                    <!--    <a class="tag">professional</a>-->
                    <!--</div>-->


                </div>
            </div>
        </div>
        
        

	</div>	
	
</div>