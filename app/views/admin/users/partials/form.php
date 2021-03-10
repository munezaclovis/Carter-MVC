<?php
use Core\FH;
?>
<?=FH::displayErrors($errors);?>

<form class="form" method="post" action="<?=$Post?>">
	<div id="FormError" class="error-green"></div>
	<div class="row">
		<?=FH::csrfInput()?>
		<?=FH::inputTextBox('text', 'First Name', 'fname', $user->fname, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Last Name', 'lname', $user->lname, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Email', 'email', $user->email, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Address', 'address', $user->address, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'Alternate Address', 'address2', $user->address2, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'City', 'city', $user->city, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'State', 'state', $user->state, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'Zip Code', 'zip', $user->zip, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
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