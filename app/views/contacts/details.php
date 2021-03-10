<?php $this->setSiteTitle($contact->fname . ' ' . $contact->lname . ' | Details');?>
<?php $this->start('body'); ?>

<div class="clear-fix"></div>
<div class="clear-fix"></div>
<div class="clear-fix"></div>
<div class="clear-fix"></div>

<div class="col-md-8 col-md-offset-2 card center">
	<div class="clear-fix"></div>

	<h2 class="text-center"><?=$contact->fname . ' ' . $contact->lname?></h2>

	<div class="col">
		<div class="row">
			<div class="col">
				<p><span class="font-weight-bold">Email: </span><?=$contact->email?></p>
				<p><span class="font-weight-bold">Cell Phone: </span><?=$contact->cell_phone?></p>
				<p><span class="font-weight-bold">Home Phone: </span><?=$contact->home_phone?></p>
				<p><span class="font-weight-bold">Work Phone: </span><?=$contact->work_phone?></p>
			</div>

			<div class="col">
				<p></p>
				<p><span><?=$contact->address?></span></p>
				<p><span><?=$contact->address2?></span></p>
				<p><span><?=$contact->city?></span></p>
				<p><span><?=$contact->state?></span></p>
				<p><span><?=$contact->zip?></span></p>
			</div>
		</div>
	</div>
	<div class="btn-group">
		<a class="btn btn-submit"  href="<?=PROOT?>contacts"><i class="fas fa-angle-left"></i> Go Back</a><div class="px-2"></div>
		<a class="btn btn-details" href="<?=PROOT?>contacts/edit/<?=$contact->id?>"><i class="fas fa-pencil-alt"></i> Edit</a><div class="px-2"></div>
		<a class="btn btn-reset" href="<?=PROOT?>contacts/delete/<?=$contact->id?>" onclick="if (!confirm('are you sure?')) {return false;}"><i class="fas fa-trash-alt"></i> Delete</a>
	</div>
	<div class="pt-3"></div>
</div>


<?php $this->end();?>