<div class="page-loader">
  <div class="page-loader__spinner">
    <svg viewBox="25 25 50 50">
      <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
</div><h1>Hello</h1>
<header class="header">
  <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
    <div class="navigation-trigger__inner"> <i class="navigation-trigger__line"></i> <i class="navigation-trigger__line"></i> <i class="navigation-trigger__line"></i> </div>
  </div>
  <div class="header__logo hidden-sm-down">
     <h1><a href="<?= base_url('sysadmin');?>"><?php echo MY_APP;?></a></h1> 
    <!--<a href="<?= base_url('sysadmin');?>"><img src="<?php echo ADMIN_ASSETS_PATH;?>img/logo.png" style="width: 150px;"/></a>-->
  </div>
  <!--<form class="search">
    <div class="search__inner">
      <input type="text" class="search__text" placeholder="Search for people, files, documents...">
      <i class="zmdi zmdi-search search__helper" data-ma-action="search-close"></i> </div>
  </form>-->
  <ul class="top-nav">
    <!--<li class="hidden-xl-up"><a href="#" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>
    <li class="dropdown"> <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-email"></i></a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
        <div class="listview listview--hover">
          <div class="listview__header"> Messages
            <div class="actions"> <a href="messages.html" class="actions__item zmdi zmdi-plus"></a> </div>
          </div>
          <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/1.jpg" class="listview__img" alt="">
          <div class="listview__content">
            <div class="listview__heading"> David Belle <small>12:01 PM</small> </div>
            <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
          </div>
          </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/2.jpg" class="listview__img" alt="">
          <div class="listview__content">
            <div class="listview__heading"> Jonathan Morris <small>02:45 PM</small> </div>
            <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
          </div>
          </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/3.jpg" class="listview__img" alt="">
          <div class="listview__content">
            <div class="listview__heading"> Fredric Mitchell Jr. <small>08:21 PM</small> </div>
            <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
          </div>
          </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/4.jpg" class="listview__img" alt="">
          <div class="listview__content">
            <div class="listview__heading"> Glenn Jecobs <small>08:43 PM</small> </div>
            <p>Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</p>
          </div>
          </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/5.jpg" class="listview__img" alt="">
          <div class="listview__content">
            <div class="listview__heading"> Bill Phillips <small>11:32 PM</small> </div>
            <p>Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</p>
          </div>
          </a> <a href="#" class="view-more">View all messages</a> </div>
      </div>
    </li>
    <li class="dropdown top-nav__notifications"> <a href="#" data-toggle="dropdown" class="top-nav__notify"> <i class="zmdi zmdi-notifications"></i> </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
        <div class="listview listview--hover">
          <div class="listview__header"> Notifications
            <div class="actions"> <a href="#" class="actions__item zmdi zmdi-check-all" data-ma-action="notifications-clear"></a> </div>
          </div>
          <div class="listview__scroll scrollbar-inner"> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/1.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">David Belle</div>
              <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/2.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">Jonathan Morris</div>
              <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/3.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">Fredric Mitchell Jr.</div>
              <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/4.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">Glenn Jecobs</div>
              <p>Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/5.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">Bill Phillips</div>
              <p>Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/1.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">David Belle</div>
              <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/2.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">Jonathan Morris</div>
              <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
            </div>
            </a> <a href="#" class="listview__item"> <img src="<?php echo ADMIN_ASSETS_PATH;?>demo/img/profile-pics/3.jpg" class="listview__img" alt="">
            <div class="listview__content">
              <div class="listview__heading">Fredric Mitchell Jr.</div>
              <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
            </div>
            </a> </div>
          <div class="p-1"></div>
        </div>
      </div>
    </li>
    <li class="dropdown hidden-xs-down"> <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-check-circle"></i></a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">
        <div class="listview listview--hover">
          <div class="listview__header">Tasks</div>
          <a href="#" class="listview__item">
          <div class="listview__content">
            <div class="listview__heading">HTML5 Validation Report</div>
            <div class="progress">
              <div class="progress-bar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          </a> <a href="#" class="listview__item">
          <div class="listview__content">
            <div class="listview__heading">Google Chrome Extension</div>
            <div class="progress">
              <div class="progress-bar bg-warning" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          </a> <a href="#" class="listview__item">
          <div class="listview__content">
            <div class="listview__heading">Social Intranet Projects</div>
            <div class="progress">
              <div class="progress-bar bg-success" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          </a> <a href="#" class="listview__item">
          <div class="listview__content">
            <div class="listview__heading">Bootstrap Admin Template</div>
            <div class="progress">
              <div class="progress-bar bg-info" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          </a> <a href="#" class="listview__item">
          <div class="listview__content">
            <div class="listview__heading">Youtube Client App</div>
            <div class="progress">
              <div class="progress-bar bg-danger" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          </a> <a href="#" class="view-more">View all tasks</a> </div>
      </div>
    </li>
    <li class="dropdown hidden-xs-down"> <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-apps"></i></a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">
        <div class="row app-shortcuts"> <a class="col-4 app-shortcuts__item" href="#"> <i class="zmdi zmdi-calendar bg-red"></i> <small class="">Calendar</small> </a> <a class="col-4 app-shortcuts__item" href="#"> <i class="zmdi zmdi-file-text bg-blue"></i> <small class="">Files</small> </a> <a class="col-4 app-shortcuts__item" href="#"> <i class="zmdi zmdi-email bg-teal"></i> <small class="">Email</small> </a> <a class="col-4 app-shortcuts__item" href="#"> <i class="zmdi zmdi-trending-up bg-blue-grey"></i> <small class="">Reports</small> </a> <a class="col-4 app-shortcuts__item" href="#"> <i class="zmdi zmdi-view-headline bg-orange"></i> <small class="">News</small> </a> <a class="col-4 app-shortcuts__item" href="#"> <i class="zmdi zmdi-image bg-light-green"></i> <small class="">Gallery</small> </a> </div>
      </div>
    </li>-->
    <li class="dropdown hidden-xs-down"> <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
         <a href="<?php echo site_url('sysadmin/website_settings');?>" class="dropdown-item">Settings</a> 
         <a href="<?php echo site_url('sysadmin/login/logout');?>" class="dropdown-item">Logout</a> 
      </div>
    </li>
    <!--<li class="hidden-xs-down"> <a href="#" data-ma-action="aside-open" data-ma-target=".chat" class="top-nav__notify"> <i class="zmdi zmdi-comment-alt-text"></i> </a> </li>-->
  </ul>
</header>

<style type="text/css">
  .page-loader{
    display: none;
  }
</style>