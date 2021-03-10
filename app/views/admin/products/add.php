<?php use Core\H;?>

<?php $this->setSiteTitle('Add New Product');?>
<?php $this->start('body');?>

<div class="card shadow mb-4">
    <div class="card-header py-3 ">
      <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
    </div>

    <div class="card-body">
		<?php $this->partial('admin/products', 'form', ['categories' => $categories, 'product' => $product, 'errors' => $errors, 'Post'=>$Post]);?>
	</div>
</div>
<?php $this->end();?>


<?php $this->start('head');?>
	<link rel="stylesheet" type="text/css" href="<?=PROOT?>vendor/datepicker/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?=PROOT?>vendor/bootstrap/css/bootstrap-select.min.css">
	<script src="<?=PROOT?>vendor/datepicker/js/datepicker.min.js"></script>
	<script src="<?=PROOT?>vendor/bootstrap/js/bootstrap-select.min.js"></script>
	<script src="<?=PROOT?>vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<?php $this->end();?>