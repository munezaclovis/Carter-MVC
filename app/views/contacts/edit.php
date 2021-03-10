<?php $this->setSiteTitle($contact->fname . ' ' . $contact->lname . ' | Details');?>
<?php $this->start('body'); ?>
<div class="add-products-page">
	<div class="clear-fix"></div>
	<div class="clear-fix"></div>
	<div class="clear-fix"></div>
	<h2 class="text-center"><u> Edit Contact</u></h2>
	<?php $this->partial('contacts', 'form', ['contact' => $contact, 'errors' => $errors, 'Post'=>$Post]);?>
</div>
<?php $this->end();?>