<?php
use Core\FH;
$this->setSiteTitle('Test');

$this->start('head');
?>

<script src="<?=PROOT?>vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector:'#comments',
		branding:false
	});
</script>
<?php 
$this->end();

$this->start('body');
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
      <h6 class="m-0 font-weight-bold text-primary">Test</h6>
    </div>
    <div class="card-body">
		<form class="form" method="post" action="" enctype="multipart/form-data">
			<div id="FormError" class="error-green"></div>
			<?=FH::imageGallery('uploadField', ['class' => 'max-w-75 center']);?>
		<!-- 	<input type="file" name="images[]" multiple="multiple" hidden="hidden" id="uploadField" oninput="LoadImagesToGallery(this)"> -->
			<?=FH::fileInput('Images', 'uploadField', ['class' => 'form-control', 'multiple'=>'multiple', 'hidden' => 'hidden'], ['class' => 'form-goup col'], "LoadImagesToGallery");?>
			<div class="py-3"></div>
			<?=FH::inputButton('Save', ['class'=>'btn btn-submit'], ['class'=>'form-group text-center'], true)?>
		</form>
	</div>
</div>
<?php $this->end()?>