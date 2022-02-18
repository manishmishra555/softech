<!--Page Title-->

<section class="page-title" style="background-image:url(<?php echo FRONT_ASSETS_PATH; ?><?php echo FRONT_ASSETS_PATH; ?>images/background/3.jpg)">

    <div class="auto-container">

        <h2>Search results for "<?= $searchkey; ?>"</h2>

        <ul class="page-breadcrumb">

            <li><a href="<?= site_url('');?>">home</a></li>

            <li>Search</li>

        </ul>

    </div>

</section>

<!--End Page Title-->



<!--Sidebar Page Container-->

<div class="sidebar-page-container">

    <div class="auto-container">

        <div class="row clearfix">



            <!--Content Side / Category List -->

            <div class="content-side col-lg-12 col-md-12 col-sm-12">

                <!-- <h3>Airway Product</h3> <br> -->

                <div class="row">



                    <?php if (count($searchresults) > 0) {

                        foreach ($searchresults as $l) {

                                $pname = $l->product_name;

                                $category_name= $l->category_name;

                                $name=$pname." - ".$category_name;

                                $PImages = json_decode($l->image_fids);

                                $image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '390x367'): FRONT_ASSETS_PATH . "images/tuoren_noproduct.png";

                                $url = site_url('product/') . $l->product_url;

                            

                            ?>

                            <div class="col-sm-3">
                                <div class="service-block-two style-two box-shadow">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="<?= $url; ?>"><img src="<?php echo $image; ?>" alt=""></a>
                                        </div>
                                        <div class="lower-content text-center">
                                            <h3><a href="<?= $url; ?>" class="color-black"><?= $name; ?></a></h3>
                                        </div>

                                    </div>

                                </div>

                            </div>

                    <?php }

                    }else{ ?>
                        <div class="col-md-12 text-center noresulttxt">No result found.</div>
                    <?php } ?>



                </div>



            </div>





        </div>

    </div>

</div>