<!-- JAVASCRIPT
    ================================================== -->
       

<script src="<?php echo FRONT_ASSETS_PATH; ?>js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/swiper.jquery.min.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/global.js"></script>

    <!-- styled select -->
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/jquery.sumoselect.min.js"></script>

    <!-- counter -->
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/jquery.classycountdown.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/jquery.knob.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/jquery.throttle.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/action.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/prism.js"></script>
    <script src="<?php echo FRONT_ASSETS_PATH; ?>js/blowup.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() { 
                $(".brand_block_home .brand_blk").hover(function() { 
                    var brand_id = $(this).attr('data-menu');
                    $('.data-'+brand_id).toggleClass("open"); 
                    
                }); 
            });
            $(".open_drop").click(function(){
              $(".logged_in_block").toggle();
            });
    </script>