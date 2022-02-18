	<!-- TOP SECTION
================================================== -->

<section class="page-section black-section bg-overlay-light-alfa20 innerpage-heading-1 parallax-3" data-background="">
				
	<div class="container">
		<div class="sixteen columns">
			<div class="page-heading ph-left">
				<h2 class="hs3 sm-bottom20 fontalt4 color-white"><?= "FAQ's";?></h2>
				<!-- <h3 class="hs1 fw400 fontalt4 lp2 color-white">We are design and branding agency</h3>	 -->
			</div>						
		</div>
	</div>		
	
</section>	
<section class="section grey-section sp-top-bottom20">
	<div class="container">
		<div class="breadcrumbs breadcrumbs-left">
			<a href="<?= site_url();?>">Home</a>&nbsp;/&nbsp;<span>FAQ's</span>
        </div>
	</div>
</section>


<section class="page-section white-section sp-top-bottom50">
				<div class="container">					
					<div class="sixteen columns">		
					  <?php if(count($faq)>0){ ?>				
						<div class="accordion">			
						   <?php 
						   $i=0;
						   foreach($faq as $f){
						   	     if($i==0){ $class="acc_active";}else{ $class="";}?>		
							<div class="accordion_in  <?= $class;?>">
								<div class="acc_head black-section"><?= $f->faq_title;?></div>
								<div class="acc_content white-section">
								<p><?= $f->faq_desc;?></p>
								</div>
							</div>
							<?php $i++;} ?>
 						</div>
						<?php } ?>
					</div>
 					
				</div>
</section>

 