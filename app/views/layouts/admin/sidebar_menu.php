<?php
use Core\Router;
use Core\H;
use App\Models\Users;

  $sidebar = Router::getMenu('admin_menu_acl');
  //H::d($sidebar);
  $currentPage = H::currentPage();
?>
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=PROOT?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-arrow-left"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Go Back <sup>MVC</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      <?php foreach ($sidebar as $item => $link): ?>
        <?php if ($item == 'separator'): ?>
          <hr class="sidebar-divider">
        <?php elseif (is_array($link)): ?>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span><?=$item?></span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom <?=$item?>:</h6>
                  <?php foreach ($link as $key => $value): ?>
                    <a class="collapse-item" href="<?=$value?>"><?=$key?></a>
                  <?php endforeach ?>
                </div>
              </div>
            </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span><?=$item?></span></a>
          </li>
        <?php endif;?>
      <?php endforeach ?>
      
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>