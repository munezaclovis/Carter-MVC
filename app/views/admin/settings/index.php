<?php
use Core\FH;
$this->setSiteTitle('Settings');

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

<form class="form" method="post" action="">
	<div id="FormError" class="error-green"></div>
	<div class="row">
		<?=FH::inputTextBox('text', 'Last Name', 'lname', '', ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Email', 'email', '', ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::textArea('textArea', 'comments', '', ['class' => 'form-control', 'row' => 6], ['class' => 'form-goup col']);?>
	</div>
	<div class="py-3"></div>
	<?=FH::inputButton('Save', ['class'=>'btn btn-submit'], ['class'=>'form-group text-center'], true)?>
</form>
<div class="clear-fix"></div>
<div class="clear-fix"></div>
<div class="clear-fix"></div>
<div class="clear-fix"></div>
<div class="clear-fix"></div>
<div class="clear-fix"></div>
<?php $this->end()?>