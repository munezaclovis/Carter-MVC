<?php
use Core\FH;
$this->setSiteTitle("Register");
?>
<?php $this->start('body');?>
<div class="registerForm">
    <form action="<?=PROOT?>register/register" method="post">
    	<div class="form-group">
            <p class="text-center"><a href="<?=PROOT?>"><img src="<?=LOGO?>" style="width:70px;"></a></p>
        </div>
        <?=FH::displayErrors($errors)?>
        <h2 class="text-center">Create Account</h2>  
        <div id="FormError"></div>
        <?=FH::csrfInput()?>
    	<div class="row">
            <?=FH::inputTextBox('text', 'First Name', 'fname', $newUser->fname, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
		    <?=FH::inputTextBox('text', 'Last Name', 'lname', $newUser->lname, ['class' => 'form-control'], ['class' => 'form-goup col']);?>
            <div class="w-100"></div>
            <?=FH::inputTextBox('email', 'Email', 'email', $newUser->email, ['class' => 'form-control', 'autocomplete'=>'email'], ['class' => 'form-goup col']);?>
            <div class="w-100"></div>
            <?=FH::inputTextBox('text', 'Username', 'username', $newUser->username, ['class' => 'form-control', 'autocomplete'=>'none'], ['class' => 'form-goup col']);?>
            <div class="w-100"></div>
            <?=FH::inputTextBox('password', 'Password', 'password', $newUser->password, ['class' => 'form-control', 'autocomplete'=>'new-password'], ['class' => 'form-goup col']);?>
            <?=FH::inputTextBox('password', 'Confirm Password', 'confirm', $newUser->confirm, ['class' => 'form-control', 'autocomplete'=>'new-password'], ['class' => 'form-goup col']);?>
        </div>
        <div class="pt-3"></div>
        <?=FH::inputButton('Register', ['class'=>'btn btn-submit'], ['class'=>'form-group text-center'])?>
        <div class="pt-0"></div>
    </form>
    <p class="text-center">Have an Account? <a href="<?=PROOT?>register/login">Login</a></p>
</div>
<?php $this->end();?>