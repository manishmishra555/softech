	<!-- TOP SECTION
		================================================== -->

	<section class="page-section black-section bg-overlay-light-alfa20 innerpage-heading-1 parallax-3" data-background="">

		<div class="container">
			<div class="sixteen columns">
				<div class="page-heading ph-left">
					<h2 class="hs3 sm-bottom20 fontalt4 color-white"><?= "Testimonials"; ?></h2>
					<!-- <h3 class="hs1 fw400 fontalt4 lp2 color-white">We are design and branding agency</h3>	 -->
				</div>
			</div>
		</div>

	</section>
	<section class="section grey-section sp-top-bottom20">
		<div class="container">
			<div class="breadcrumbs breadcrumbs-left">
				<a href="<?= site_url(); ?>">Home</a>&nbsp;/&nbsp;<span>Testimonials</span>
			</div>
		</div>
	</section>


	<section class="page-section white-section sp-top-bottom50">
		<div class="container">
			<?php if (count($testimonials) > 0) {
				foreach ($testimonials as $t) { ?>
					<div class="sixteen columns">
						<blockquote class="bk5 ">
							<p><i class="fa fa-quote-left"></i> <?php echo $t->testimonial_desc; ?></p>
							<footer>
								<cite title="Source Title"><?php echo $t->testimonial_title; ?></cite>
								<?php $hosp = getHospitals('', $t->hid);
								$hosp_name = isset($hosp[0]->hosp_name) ? $hosp[0]->hosp_name . "<br>" : '';
								echo  $hosp_name; ?>
								<?php echo  $t->address; ?>
							</footer>
						</blockquote>
					</div>
				<?php }
		} ?>

			<?php echo $pageing_link; ?>
		</div>
	</section>