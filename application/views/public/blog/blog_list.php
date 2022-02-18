<style>
    .section .section-title {
        margin-bottom: 40px;
    }
    .section .section-title h2 {
        text-transform: capitalize;
        font-size: 28px;
    }
    .post {
        margin-bottom: 40px;
    }
    .post .post-img {
    display: block;
    -webkit-transition: 0.2s opacity;
    transition: 0.2s opacity;    border: 1px solid #eaeaea;
}
.post .post-img > img {
    width: 100%;
}
.post .post-meta {
    margin-top: 15px;
}
.post-meta .post-category.cat-2 {
    background-color: #ff8700;
}
.post-meta .post-category {
    font-size: 13px;
    text-transform: uppercase;
    padding: 3px 10px;
    font-weight: 600;
    border-radius: 2px;
    margin-right: 15px;
    color: #FFF;
    background-color: #212631;
    -webkit-transition: 0.2s opacity;
    transition: 0.2s opacity;
}
.post-meta .post-date {
    font-size: 13px;
    font-weight: 600;
}
.post .post-title {
    font-size: 18px;margin-top: 15px;
    margin-bottom: 0px;
}
.post .post-title a {
    font-weight: 600;
    color: #343434;
    text-decoration: none;
}

</style>
<div class="container products_conts">
	<div class="empty-space col-xs-b15 col-sm-b30"></div>
	<div class="breadcrumbs">
		<a href="<?php echo site_url(); ?>">Home</a>
		<a href="#">Blog</a>
	</div>
	<div class="empty-space col-xs-b15 col-sm-b50 col-md-b50"></div>
	<div class="section section-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>Featured Posts</h2>
                    </div>
                </div>
                <?php if (count($blogs) > 0) {
							foreach ($blogs as $data) {
								$PImages = json_decode($data->image_fids);
 							    $image = $this->media->getThumbPathById($PImages[0], '300x137');
						?>
                <div class="col-md-4">
                    <div class="post">
                        <a class="post-img" href="<?php echo site_url('blog/' . $data->url_slug); ?>"><img src="<?= $image; ?>" alt=""></a>
                        <div class="post-body">
                            <div class="post-meta">
                                <!--<a class="post-category cat-2" href="#">JavaScript</a>-->
                                <span class="post-date"><?= date('F j, Y', strtotime($data->date_added)); ?></span>
                            </div>
                            <h3 class="post-title"><a href="<?php echo site_url('blog/' . $data->url_slug); ?>"><?php echo $data->blog_title; ?></a></h3>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>