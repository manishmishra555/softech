<div class="container products_conts">
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="breadcrumbs">
                <a href="#">home</a>
                <a href="#">Products</a>
            </div>
            <div class="empty-space col-xs-b15 col-sm-b50 col-md-b50"></div>
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                  
                    <div class="align-inline spacing-1">
                        <div class="h4">All Products</div>
                    </div>

                    <div class="products-content">
                        <div class="products-wrapper">
                            <div class="row nopadding">
                            <?php if (count($productlist) > 0) {
                                foreach ($productlist as $l) {
                                    $pid = $l->pid;
                                    $cat_id = $l->cat_id;
                                    $name = $l->product_name;
                                    $PImages = json_decode($l->image_fids);
                                    $image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '600x800/') : FRONT_ASSETS_PATH . "images/tuoren_noproduct.png";
                                    $url = site_url('product/') . $l->url_slug;
                                    $mrp = $l->mrp;
                                    $price = $l->price;

                                    $p_size = explode(',',$l->frame_size);
                                    $p_color = explode(',',$l->frame_color);
                                    $p_shape = explode(',',$l->frame_shape);

                                    $key_f = '';
                                    $proid = $pid.'-1-'.$p_size[0].'-'.$p_color[0].'-'.$p_shape[0];
                                    $cart = getCart();
                                    if (count($cart['products']) > 0) {
                                        foreach ($cart['products'] as $pr) { 
                                            if ($pr['pcookie_id'] == $proid) {
                                                $key_f = $pr['pcookie_id'];
                                              }
                                        }
                                    }
                                    $brand_data = $this->db->get_where('tbl_brand',array('id ' => $l->brand_name))->result();
                                    
                                    $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';
                                    $brand_url=isset($brand_data[0])?$brand_data[0]->url_slug:'';
                            ?>
                                <div class="col-sm-4">
                                    <div class="product-shortcode style-1 pros_page">
                                        <a href="<?php echo $url; ?>">
                                        <div class="preview">
                                            <img src="<?= $image; ?>" alt="">
                                        </div>
                                        </a>
                                        <div class="title">
                                            <div class="simple-article size-1 color col-xs-b5 bran_name"><a href="<?= site_url('brands/'.$brand_url) ?>"><?php echo $brand_name; ?></a></div>
                                            <?php if($this->session->has_userdata('userId')){ ?>
                                                <div class="price">
                                                    <div class="simple-article size-4"><span class="color">₹<?= $price; ?></span>&nbsp;&nbsp;&nbsp;<span class="line-through">₹<?= $mrp; ?></span></div>
                                                </div>
                                            <?php } ?>
                                            <div class="h6 animate-to-green"><a href="<?php echo $url; ?>"><?php echo $l->product_name; ?></a></div>
                                        </div>
                                        <div class="btn_cart001 btn_middle valign-middle-content cartblk_<?= $pid; ?> row_pros-<?= $proid; ?>">
                                           <?php if ($proid == $key_f) { ?>
                                            <a class="button size-2 style-2" href="javascript:void(0);" onclick="removeCartItem(<?= $pr['pcookie_id']; ?>);">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                                    <span class="text">Remove from Cart</span>
                                                </span>
                                            </a>
                                            <?php }else{ ?>
                                                <a class="button size-2 style-3" href="javascript:void(0);" onclick="addToCartItem('<?= $proid; ?>');">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                                        <span class="text">Add To Cart</span>
                                                    </span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>  
                                </div>
                            <?php } }else{ ?>
                                <div class="col-sm-12">
                                    <p class="no-product">No Products Found</p>
                                </div>

                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="empty-space col-xs-b35 col-sm-b0"></div>
                    <div class="row">
                        <?php echo $pageing_link; ?>
                    </div>

                    <div class="empty-space col-xs-b35 col-md-b70"></div>
                    <div class="empty-space col-md-b70"></div>
                </div>
                <div class="col-md-3 col-md-pull-9"> 
                    <div class="h4 col-xs-b10">popular categories</div>
                    <div class="filter_categ">
                        <?php if (count($selected_category) > 0) {
                                foreach ($selected_category as $c) {
                        ?>
                        <label class="checkbox-entry">
                            <input type="checkbox" class="filter_var category" value="<?= $c->cat_id; ?>"><span><?= $c->category_name; ?></span>
                        </label>  
                    <div class="empty-space col-xs-b10"></div>
                    <?php } } ?>
                    </div>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>   

                    <div class="h4 col-xs-b25">Brands</div>
                    <div class="filter_categ">
                    <?php if (count($brands) > 0) {
                                foreach ($brands as $b) {
                        ?>
                        <label class="checkbox-entry">
                            <input type="checkbox" class="filter_var brand" value="<?= $b->id; ?>"><span><?= $b->brand_name; ?></span>
                        </label>  
                    <div class="empty-space col-xs-b10"></div>
                    <?php } } ?>
                </div>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b25">Choose Color</div>
                    <div class="filter_categ">
                    <?php if (count($colors) > 0) {
                                foreach ($colors as $c) {
                        ?>
                    <label class="checkbox-entry chk_color">
                        <input type="checkbox" class="filter_var color" id="col-<?= $c->color_id; ?>" value="<?= $c->color_id; ?>"> <span>
                            <?php if($c->color_type == 'dual'){  ?>
                
                                <td><label class="entry" style="background-image: linear-gradient(140deg, #EADEDB 0%, <?php echo $c->color_value1; ?> 50%, <?php echo $c->color_value2; ?> 75%);height: 20px;width: 20px;"></label></td>
                          <?php }else{ ?>
                                <td><label class="entry" style="background-color:<?php echo $c->color_value1; ?>;height: 20px;width: 20px;"></label></td>
                          <?php } ?>

                            <label for="col-<?= $c->color_id; ?>" class="lbl_color"><?= $c->color_name; ?></label></span>
                    
                    </label>
                   <div class="empty-space col-xs-b10"></div>
                    <?php } } ?>
                </div>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b25">Frame Type</div>

                    <div class="filter_categ">
                    <?php if (count($type) > 0) {
                                foreach ($type as $pt) {
                        ?>

                    <label class="checkbox-entry">
                        <input type="checkbox" class="filter_var frame_type" value="<?= $pt->type_id; ?>"><span><?= $pt->producttype_name; ?></span>
                    </label>
                    <div class="empty-space col-xs-b10"></div>
                <?php } } ?>
            </div>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b25">Gender</div>
                    <label class="checkbox-entry">
                        <input type="checkbox" class="filter_var gender" value="male" name="male"><span>Male</span>
                    </label>
                    <div class="empty-space col-xs-b10"></div>
                    <label class="checkbox-entry">
                        <input type="checkbox" class="filter_var gender" value="female" name="female"><span>Female</span>
                    </label>
                    <div class="empty-space col-xs-b10"></div>
                    <label class="checkbox-entry">
                        <input type="checkbox" class="filter_var gender" value="Unisex" name="unisex"><span>Unisex</span>
                    </label>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b25">Frame Size</div>

                    <div class="filter_categ">
                    <?php if (count($size) > 0) {
                                foreach ($size as $s) {
                        ?>

                    <label class="checkbox-entry">
                        <input type="checkbox" class="filter_var frame_size" value="<?= $s->id; ?>"><span><?= $s->product_size; ?></span>
                    </label>
                    <div class="empty-space col-xs-b10"></div>
                <?php } } ?>
            </div>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b25">Frame Shape</div>

                    <div class="filter_categ">
                    <?php if (count($shape) > 0) {
                                foreach ($shape as $sh) {
                        ?>

                    <label class="checkbox-entry">
                        <input type="checkbox" class="filter_var frame_shape" value="<?= $sh->id; ?>"><span><?= $sh->product_shape; ?></span>
                    </label>
                    <div class="empty-space col-xs-b10"></div>
                <?php } } ?>
            </div>

                    <div class="empty-space col-xs-b25 col-sm-b50"></div>

                    <div class="h4 col-xs-b25">Material</div>

                    <div class="filter_categ">
                    <?php if (count($material) > 0) {
                                foreach ($material as $mt) {
                        ?>

                    <label class="checkbox-entry">
                        <input type="checkbox" value="<?= $mt->id; ?>" class="filter_var frame_material" data-id="<?= $mt->id; ?>" data-val="material"><span><?= $mt->material_name; ?></span>
                    </label>
                    <div class="empty-space col-xs-b10"></div>
                <?php } } ?>
                    </div>
                    <div class="empty-space col-xs-b25 col-sm-b50"></div>


                </div>
            </div>
        </div>

        <script type="text/javascript">
           
        </script>