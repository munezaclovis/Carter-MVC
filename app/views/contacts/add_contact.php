<?php $this->setSiteTitle('Add Contact | Contacts');?>
<?php $this->start('body')?>
<div class="add-products-page">
	<div class="clear-fix"></div>
	<div class="clear-fix"></div>
	<div class="clear-fix"></div>
	<h2 class="text-center"><u> Add Contact</u></h2>
	<?php $this->partial('contacts', 'form', ['contact' => $contact, 'errors' => $errors, 'Post'=>$Post]);?>
</div>
<?php $this->end()?>