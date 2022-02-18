 

<div class="section half-height">
				
	<div class="parallax-blog-pages" style="background-position: 50% 0px;"></div>
	
	<div class="hero-wrap-pages" style="opacity: 1;">
		<div class="container">
			<div class="twelve columns">
				<h2>Blog</h2>
 			</div>
		</div>
	</div>					
</div>
<div class="section white-background">
<?php if (count($blogs) > 0) { ?>
	<div class="blog-pages-wrapper smaller-blog-wrapper">
		<?php foreach ($blogs as $data) {
									$PImages = json_decode($data->image_fids);
									$image = $this->media->getThumbPathById($PImages[0], '900x411'); ?>
			<div class="blog-pages-wrap-box full-standard photo">
				<div class="blog-box-2">
					<a href="<?php echo site_url('blog/' . $data->url_slug);?>" class="animsition-link"><img src="<?= $image;?>" alt="<?php echo $data->blog_title; ?>"></a> 
					<a href="<?php echo site_url('blog/' . $data->url_slug);?>" class="animsition-link"><?php echo $data->blog_title; ?></a>
					<div class="subtext"><?= date('F j, Y',strtotime($data->date_added));?></div>
					<p><?php echo $data->blog_brief; ?></p>
					<div class="link-to-post">
						<a href="<?php echo site_url('blog/' . $data->url_slug);?>" class="animsition-link">read more</a>
					</div>
				</div>
			</div>
			<?php } ?>
	</div>	
	 
<?php } ?>	
</div>		
			
			
			 
					
	<div class="clear"></div>
<!-- 		
	<div class="section padding-top-bottom-small white-background">	
		<div class="container">
			<div class="twelve columns blog-nav">
				<nav role="navigation">
					<ul class="cd-pagination animated-buttons custom-icons">
						<li class="button-pag"><a href="#0"><i>prev</i></a></li>
						<li><a href="#0">1</a></li>
						<li><a href="#0">2</a></li>
						<li><a class="current" href="#0">3</a></li>
						<li><a href="#0">4</a></li>
						<li><span>...</span></li>
						<li><a href="#0">20</a></li>
						<li class="button-pag"><a href="#0"><i>next</i></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div> -->