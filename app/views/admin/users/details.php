<?php
use Core\H;

$this->setSiteTitle('Details | '.$user->username);
$this->start('body');
?>
<div class="card shadow mb-4">
	<div class="py-3"></div>
	<h2 class="text-center"><?=$user->username?></h2>
	<div class="col px-5">
		<div class="row">
			<div class="col text-center">
				<img class="img-thumbnail w-50 rounded-circle" src="<?=PROOT?>images/users/<?=$user->image?>">
			</div>

			<div class="col">
				<div class="py-4"></div>
				<p><span class="font-weight-bold">First Name: </span><?=$user->fname?></p>
				<p><span class="font-weight-bold">Last Name: </span><?=$user->lname?></p>
				<p><span class="font-weight-bold">Email: </span><?=$user->email?></p>
				<p><span class="font-weight-bold">Username: </span><?=$user->username?></p>
				<p><span><strong>Levels:</strong> <?=$user->acl?></span></p>
			</div>
		</div>
	</div>
	<div class="btn-group px-5 pt-4">
		<a class="btn btn-submit text-black"  href="<?=PROOT?>admin/users"><i class="fas fa-angle-left"></i> Go Back</a><div class="px-2"></div>
		<!-- <a class="btn btn-reset text-black" href="<?=PROOT?>admin/users/delete/<?=$user->id?>" onclick="if (!confirm('are you sure?')) {return false;}"><i class="fas fa-trash-alt"></i> Delete</a> -->
	</div>
	<div class="pt-4"></div>
</div>
<?php $this->end();?>