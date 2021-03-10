<?php
use Core\FH;
$this->setSiteTitle('Login');
?>

<?php $this->start('body'); ?>

<div class="loginForm">
    <form action="<?=PROOT?>register/login" method="post">
        <?=FH::displayErrors($errors);?>
    	<div class="form-group">
            <p class="text-center"><a href="<?=PROOT?>"><img src="<?=LOGO?>"  style="width:70px;"></a></p>
        </div>

        <h2 class="text-center">Log in</h2>
        <div id="FormError"></div>
        <?=FH::csrfInput()?>
        <?=FH::inputTextBox('text', 'Username', 'username', $login->username, ['class' => 'form-control', 'autocomplete' => 'username'], ['class' => 'form-group']);?>
        <?=FH::inputTextBox('password', 'Password', 'password', $login->password, ['class' => 'form-control', 'autocomplete' => 'password'], ['class' => 'form-group']);?>

        <?=FH::inputCheckBox('Remember me', 'remember_me', ["class"=>"form-check-label"], ["class"=>"form-check-input"], ['class' => 'form-check'], ['class' => 'form-group']);?>

        <?=FH::inputButton('Login', ['class' => 'btn btn-submit'], ['class' => 'form-goup  text-center']);?>
        <div class="pt-2"></div>
        <p class="text-center"><small>Forgot Password? <a href="<?=PROOT?>register/forgot">Reset</a></small></p>
    </form>
    <p class="text-center">Don't Have an account? <a href="<?=PROOT?>register/register">Create an Account</a></p>
</div>

<?php $this->end();?>