<?php
use Core\FH;
$this->setSiteTitle('Users');?>

<?php $this->start('head');?>
<script src="<?=PROOT?>js/crop.js"></script>
<link href="<?=PROOT?>css/croppie.css" rel="stylesheet">
<script src="<?=PROOT?>js/croppie.js"></script>
<?php $this->end();?>


<?php $this->start('body');?>

<?=FH::displayErrors($errors);?>
<div class="card shadow mb-4">
    <div class="card-header py-3 ">
      <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
    </div>

    <div class="card-body">
		<div id="FormError" class="error-green"></div>
        <div id="debug"></div>
		<div class="row">
            <div class="col-3 pl-5">
                <div class="form-group pl-5">
                    <div class="py-3"></div>
                    <div class="rounded-circle">
                        <img class="profile-pic img-profile profile" src="<?=PROOT . 'images/users/' . $user->image?>">
                    </div>
                    <label for="profile">
                        <div id="ProfileError" class="error"></div>
                    </label>
                    <div class="btn btn-details profile-pic profile upload_button">
                        <i class="fa fa-camera"></i>
                    </div>
                    <input class="upload_image" name="image" id="upload_image" type="file"/>
                </div>
            </div>
            <div class="col-9 px-5">
                <form action="<?=PROOT?>admin/account" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <?=FH::csrfInput()?>
        				<?=FH::inputTextBox('text', 'First Name', 'fname', $user->fname, ['class' => 'form-control'], ['class' => 'form-goup py-1 col']);?>
        			    <?=FH::inputTextBox('text', 'Last Name', 'lname', $user->lname, ['class' => 'form-control'], ['class' => 'form-goup py-1 col']);?>
        	            <div class="w-100"></div>
        	            <?=FH::inputTextBox('email', 'Email', 'email', $user->email, ['class' => 'form-control', 'autocomplete'=>'email'], ['class' => 'form-goup py-1 col']);?>
        	            <div class="w-100"></div>
        	            <?=FH::inputTextBox('text', 'Username', 'username', $user->username, ['class' => 'form-control', 'autocomplete'=>'username'], ['class' => 'form-goup col']);?>
                        <div class="w-100"></div>
                        <div class="py-1"></div>
                        <?=FH::inputTextBox('password', 'Current Password', 'password', 'password', ['class' => 'form-control', 'autocomplete'=>'password'], ['class' => 'form-goup py-1 col']);?>
                        <?=FH::inputTextBox('password', 'New Password', 'newPassword', 'password', ['class' => 'form-control', 'autocomplete'=>'new-password'], ['class' => 'form-goup py-1 col']);?>
                        <?=FH::inputTextBox('password', 'Confirm New Password', 'confirm', 'password', ['class' => 'form-control', 'autocomplete'=>'new-password'], ['class' => 'form-goup py-1 col']);?>
                    </div>

                    <div class="pt-4"></div>
                    <?=FH::inputButton('Save', ['class'=>'btn btn-submit w-15 text-black'], ['class'=>'form-group text-center'])?>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="uploadimageModal" class="modal text-black" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="image_crop"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-submit crop_image text-black" value="<?=PROOT . 'admin'.DS.'upload'.DS.'profile'?>" >Upload</button>
                <button type="button" class="btn btn-reset text-black" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->end();?>