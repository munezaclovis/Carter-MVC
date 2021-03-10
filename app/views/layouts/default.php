<?php 
use Core\Session;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="<?=PROOT?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?=PROOT?>css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=PROOT?>css/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="<?=PROOT?>js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?=PROOT?>js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?=PROOT?>js/script.js"></script>

    <title><?=$this->siteTitle()?></title>
    <?=$this->content('head')?>
  </head>

  <body>
    <div id="container">
      <?php include'main_menu.php' ?>
      <?=Session::displayMessage();?>
      <div id="ajax-response"></div>
      <?=$this->content('body')?>
    </div>
    <footer class="footer page-footer font-small bg-light cyan darken-3" id="footer">
      <div class="container footer-copyright text-center py-3">Copyright &copy; <?=COPYRIGHT?> <?=date("Y")?></div>
    </footer>
  </body>
</html>