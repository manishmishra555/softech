  <?php
  $maincategory = getCategory('', '0');
  $current_url = $this->uri->segment(2);
  ?>

<div class="sidebar-wrap dark-background">
                            
<div class="sidebar-blog-wrapper">
    <h6>Categories</h6>
  <?php if (count($maincategory) > 0) { ?>
    <ul class="categories">
      <?php

        $i = 1;

        foreach ($maincategory as $mc) {
          $cat_name = $mc->category_name;
          $cat_url = $mc->url_slug;
          $hasChild = $mc->hasChild;
          $cat_id = $mc->cat_id;
          ?>
            <li><a href="<?php echo site_url('category/') . $cat_url; ?>"><?php echo $cat_name; ?></a></li>
      <?php $i++;
        } ?>
    </ul>
  <?php } ?>

  </div>
                             
</div> 