<div class="section padding-top padding-bottom-med white-background">
	
    <div class="container">
        <div class="twelve columns">
            <div class="title-text-center">
                <h4>Order Details</h4>
            </div>
        </div>
        <div class="">
            <div class="twelve columns text-center">
                
				
                <div class="clear"></div>
                    <div id="ajaxsuccess" style="display:block">
                        <?php
                            $msg=$this->session->userdata('message');
                            $this->session->unset_userdata('message');
                            //$msg="Your order has been place successfully";
                            echo $msg;
                        ?>
                        <div class="clear"></div>
                          View Details : <a href="<?= site_url('orderdetail/').$invoice_no;?>"><?= $invoice_no;?></a>
                        </div>

                    </div>
				<div class="clear"></div>
           </div>
          
        </div>
         
    </div>	
</div>