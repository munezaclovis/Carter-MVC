<?php 
use Core\Session;
use Core\H;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?=$this->siteTitle()?></title>

  <!-- Custom fonts for this template-->
  <!-- <link href="<?=PROOT?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link href="<?=PROOT?>css/fonts.css" rel="stylesheet">
  <link href="<?=PROOT?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?=PROOT?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?=PROOT?>css/style.css" rel="stylesheet">
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="<?=PROOT?>js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="<?=PROOT?>js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="<?=PROOT?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=PROOT?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?=PROOT?>js/demo/datatables-demo.js"></script>
  
  <script type="text/javascript" src="<?=PROOT?>js/script.js"></script>
  <script src="<?=PROOT?>js/sb-admin-2.min.js"></script>
  <?=$this->content('head')?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include'sidebar_menu.php' ?>
    
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include'main_menu.php' ?>
        <?=Session::displayMessage();?>
        <div id="ajax-response"></div>
        <div class="container-fluid">
          <?php
            $url = explode('/', explode('/mvc/', H::currentPage())[1]);
            foreach ($url as $key => $value) {
              $url[$key] = ucwords($value);
            }
            $page = '';
            $page = implode(' / ', $url);
          ?>
          <span class="text-left pl-2 mb-5 alert text-dark"><?=$page?></span>
          <div class="py-2"></div>
          <?=$this->content('body')?>
        </div>
      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?=COPYRIGHT?> <?=date("Y")?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</body>

</html>
