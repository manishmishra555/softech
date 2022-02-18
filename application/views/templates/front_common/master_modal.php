<div class="popup-wrapper">
        <div class="bg-layer"></div>

        <div class="popup-content" data-rel="1">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
            	<form name="loginform" id="loginform" method="POST" action="<?= site_url('validatelogin');?>">
                <div class="popup-align">
                    <h3 class="h3 text-center">Log in</h3>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" type="email" name="email"  placeholder="Your email" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" name="password"  placeholder="Enter password" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b5"></div>
                            <a class="simple-link">Forgot password?</a>
                            <div class="empty-space col-xs-b5"></div>
                            <a class="simple-link">register now</a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="button size-2 style-3" type="submit">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">submit</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
            </form>
                <div class="button-close"></div>
            </div>
        </div>

        <div class="popup-content" data-rel="2">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
            	<form name="registrationform" id="registrationform" method="POST" action="<?= site_url('submitregistration');?>">
                <div class="popup-align">
                    <h3 class="h3 text-center">register</h3>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" name="uname" type="text"  placeholder="Your name" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="mobile" type="text"  placeholder="Your Phone Number" required/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="email" type="email"  placeholder="Your email" required/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="password" type="password"  placeholder="Enter password" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="confirmpassword" type="password"  placeholder="Repeat password" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-7 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b15"></div>
                            <label class="checkbox-entry">
                                <input type="checkbox" /><span><a href="#">Privacy policy agreement</a></span>
                            </label>
                        </div>
                        <div class="col-sm-5 text-right">
                            <button class="button size-2 style-3" type="submit">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">submit</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
            </form>
                <div class="button-close"></div>
            </div>
        </div>

        

    </div>
 