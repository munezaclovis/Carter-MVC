<?php
use Core\FH;
?>
<?=FH::displayErrors($errors);?>

<form class="form" method="post" action="<?=$Post?>">
	<div id="FormError" class="error-green"></div>
	<div class="row">
		<?=FH::csrfInput()?>
		<?=FH::inputTextBox('text', 'First Name', 'fname', $contact->fname, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Last Name', 'lname', $contact->lname, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Email', 'email', $contact->email, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Home Phone', 'home_phone', $contact->home_phone, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'Cell Phone', 'cell_phone', $contact->cell_phone, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'Work Phone', 'work_phone', $contact->work_phone, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'Address', 'address', $contact->address, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'Alternate Address', 'address2', $contact->address2, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<div class="w-100"></div>
		<?=FH::inputTextBox('text', 'City', 'city', $contact->city, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'State', 'state', $contact->state, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		<?=FH::inputTextBox('text', 'Zip Code', 'zip', $contact->zip, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
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