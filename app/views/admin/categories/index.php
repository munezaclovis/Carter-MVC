<?php
  $this->setSiteTitle('Categories');
  $this->start('body');?>
  <script>
		function deleteCategory(id){
		  if(window.confirm("Are you sure you want to delete this category?")){
		    $.ajax({
		      url : '<?=PROOT?>admin/category/delete',
		      method : "POST",
		      data : {id : id},
		      success : function(response){
		        console.log(response);
		        if(response.success){
		          $('tr[data-id="' + response.model_id + '"').removeClass('bg-white').addClass('bg-deleted');
		          updateButtons(response.model_id);
		        }
		      },
		      error : function(result){
		      	console.log(result.responseText);
		      }
		    });
		  }
		}

		function restoreCategory(id){
		  if(window.confirm("Are you sure you want to restore this category?")){
		    $.ajax({
		      url : '<?=PROOT?>admin/categories/restore',
		      method : "POST",
		      data : {id : id},
		      success : function(response){
		        console.log(response);
		        if(response.success){
		        	$('tr[data-id="' + response.model_id + '"').removeClass('bg-deleted').addClass('bg-white');
		        	updateButtons(response.model_id);
		        }
		      },
		      error : function(result){
		      	console.log(result.responseText);
		      }
		    });
		  }
		}

		function updateButtons(id){
			let html = '';
			html = '<a class="btn btn-details btn-sm w-45" href="<?=PROOT?>admin/categories/details/'+ id +'"><i class="fas fa-info-circle"></i> Details</a> ';
			if($('tr[data-id="' + id + '"').hasClass("bg-white")){
				html = html + '<a class="btn btn-reset btn-sm w-50" href="#" onclick="deleteCategory(\''+ id +'\');return false;">';
				html = html + '<i class="fas fa-trash-alt"></i> Delete' ;
				html = html + '</a>';
				$('tr[data-id="' + id + '"').find('.buttons').html(html);
			}
			else{
				html = html + '<a class="btn btn-reset btn-sm w-50" href="#" onclick="restoreCategory(\''+ id +'\');return false;">';
				html = html + '<i class="fas fa-undo-alt"></i> Restore' ;
				html = html + '</a>';
				$('tr[data-id="' + id + '"').find('.buttons').html(html);
			}
		}
	</script>
	<div class="card shadow mb-4">
		<div class="card-header py-3 ">
		  <h6 class="m-0 font-weight-bold text-primary float-left">All Categories</h6>
		  <a class="btn btn-submit btn-sm d-inline text-dark float-right" data-toggle="tooltip" data-placement="top" tabindex="0" title="Details" href="<?=PROOT?>admin/categories/add"><i class="fas fa-plus"></i> Add Categories</a>
		</div>
		<div class="card-body">
		  <div class="table-responsive">
		    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		      <thead>
		        <tr>
		        	<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Action</th>
		        </tr>
		      </thead>
		      <tfoot>
		        <tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Action</th>
		        </tr>
		      </tfoot>
		      <tbody>
		        <?php 
		        if(!empty($categories))
		        	foreach ($categories as $category):
		        	$backGround = 'bg-white';
		        	if($category->deleted == '1') $backGround = 'bg-deleted';?>
		        	<tr data-id="<?=$category->id?>" class="<?=$backGround?>">
					<td><?=$category->id?></td>
					<td><?=$category->name?></td>
					<td class="buttons justify-content-center">
						<script>
							updateButtons('<?=$category->id?>');
						</script>
					</td>
		        </tr>
		        <?php endforeach ?>
		      </tbody>
		    </table>
		  </div>
		</div>
	</div>
<?php $this->end();?>