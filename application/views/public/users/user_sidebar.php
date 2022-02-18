                         
                            <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                                <li class="nav-item">
                                <a class="<?php if($cls == 'userinfo'){ echo 'active';}else{ echo '';}?>" href="<?php echo site_url('user/info'); ?>">Account Info</a>
                                </li>
                                <li class="nav-item">
                                <a class="<?php if($cls == 'useraddr'){ echo 'active';}else{ echo '';}?>" href="<?php echo site_url('user/address'); ?>">Manage Address</a>
                                </li>
                                <li class="nav-item">
                                <a class="<?php if($cls == 'userorder'){ echo 'active';}else{ echo '';}?>" href="<?php echo site_url('user/orders'); ?>">Manage Enquiries</a>
                                </li>
                                <li class="nav-item">
                                <a href="<?php echo site_url('user/logout'); ?>">Logout</a>
                                </li>
                            </ul>

