<?php $this->setSiteTitle('Contacts');?>


<?php $this->start('body'); ?>
<h1 class="text-center red">My Contacts</h1>
<div class="contacts-page">
	<a href="<?=PROOT?>/contacts/add" class="btn btn-link btn-sm float-right mx-2" data-toggle="tooltip" data-placement="left" tabindex="0" title="Add New Contact"><i class='fas fa-plus'></i> <b>Add Contact</b></a>
	
	<div class="pb-5"></div>

	<table class="table table-striped table-bordered">
		<thead class="text-center">
			<th>Name</th>
			<th>Email</th>
			<th>Home Phone</th>
			<th>Cell Phone</th>
			<th>Work Phone</th>
			<th>Address</th>
			<th>Address 2</th>
			<th>City</th>
			<th>State</th>
			<th>Zip Code</th>
			<th>Action</th>
		</thead>

		<?php foreach ($contacts as $contact): ?>
			<tr>
				<td><a href="<?=PROOT?>contacts/details/<?=$contact->id?>"><?=$contact->fname . ' ' . $contact->lname?></a></td>
				<td><?=$contact->email?></td>
				<td><?=$contact->home_phone?></td>
				<td><?=$contact->cell_phone?></td>
				<td><?=$contact->work_phone?></td>
				<td><?=$contact->address?></td>
				<td><?=$contact->address2?></td>
				<td><?=$contact->city?></td>
				<td><?=$contact->state?></td>
				<td><?=$contact->zip?></td>
				<td class="action-cell">
					<a class="btn btn-details btn-sm d-inline" data-toggle="tooltip" data-placement="top" tabindex="0" title="Details" href="<?=PROOT?>contacts/details/<?=$contact->id?>"><i class="fas fa-info-circle"></i></a>
					<a class="btn btn-submit btn-sm d-inline" data-toggle="tooltip" data-placement="top" tabindex="0" title="Edit" href="<?=PROOT?>contacts/edit/<?=$contact->id?>"><i class="fas fa-pencil-alt"></i></a>
					<a class="btn btn-reset btn-sm d-inline" data-toggle="tooltip" data-placement="top" tabindex="0" title="Detete" href="<?=PROOT?>contacts/delete/<?=$contact->id?>" onclick="if (!confirm('are you sure?')) {return false;}"><i class="fas fa-trash-alt"></i></a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>
<?php $this->end();?>