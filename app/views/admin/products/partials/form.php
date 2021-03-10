<?php use Core\FH;?>
<?=FH::displayErrors($errors);?>
<script>
	tinymce.init({
		selector:'#description',
		branding:false
	});
	
	$(function() {
		$('.selectpicker').selectpicker();
	});
</script>

<form class="form" method="post" action="<?=$Post?>" enctype="multipart/form-data">
	<div id="FormError" class="error-green"></div>
	<?=FH::csrfInput()?>
	<div class="row">
		<div class="col">
			<div class="row">
				<input type="text" name="id" hidden="hidden" value="<?=$product->id?>">
				<?=FH::inputTextBox('text', 'Barcode', 'barcode', $product->barcode, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
				<?=FH::inputTextBox('text', 'Name', 'name', $product->name, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
				<div class="w-100 py-1"></div>
				<?=FH::selectBox('Category', 'category', [$categories, $product->category], ['class' => 'form-control'], ['class' => 'form-goup col']);?>
				<div class="w-100 py-1"></div>
				<?=FH::inputTextBox('text', 'Price', 'price', $product->price, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
				<?=FH::inputTextBox('text', 'Quantity', 'quantity', $product->quantity, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
				<div class="w-100 py-1"></div>
				<?=FH::inputTextBox('date', 'Date Added', 'date_added', $product->date_added, ['class' => 'form-control'], ['class' => 'form-goup col-4']);?>
				<?=FH::inputTextBox('date', 'Date Made', 'date_made', $product->date_made, ['class' => 'form-control'], ['class' => 'form-goup col-4']);?>
				<?=FH::inputTextBox('date', 'Expiry Date', 'date_expiry', $product->date_expiry, ['class' => 'form-control'], ['class' => 'form-goup col-4']);?>
				<div class="w-100 py-1"></div>
				<?=FH::textArea('Description', 'description', $product->description, ['class' => 'form-control', 'row' => 6], ['class' => 'form-goup col']);?>
			</div>
		</div>
		
		<div class="col">
			<?=FH::fileInput('Images', 'images', ['class' => 'form-control', 'multiple'=>'multiple', 'hidden' => 'hidden'], ['class' => 'form-goup col'], "LoadImagesToGallery");?>
			<?=FH::imageGallery('images', ['class' => 'form-group max-w-100 center col']);?>
		</div>
	</div>
	<div class="py-3"></div>
	<?=FH::inputButton('Save', ['class'=>'btn btn-submit'], ['class'=>'form-group text-center'], true)?>
</form>