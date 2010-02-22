<div class="login-holder">
    <?php echo form_open('auth/register', array('class' => 'smart-form')); ?>
        <p>
            <label for="username"><?php echo 'Username'; ?></label>
            <?php echo form_input(array('class' => 'size hasDefault', 'name' => 'username', 'id' => 'username'), set_value('username')); ?>
            <?php echo form_error('username'); ?>
        </p>
        <p>
            <label for="password"><?php echo 'Password'; ?></label>
            <?php echo form_password(array('class' => 'size hasDefault', 'name' => 'password', 'id' => 'password'), set_value('password')); ?>
            <?php echo form_error('password'); ?>
        </p>
        <p>
            <label for="password_confirm"><?php echo 'Password Confirm'; ?></label>
            <?php echo form_password(array('class' => 'size hasDefault', 'name' => 'password_confirm', 'id' => 'password_confirm'), set_value('password_confirm')); ?>
            <?php echo form_error('password_confirm'); ?>
        </p>
        <div class="actions">
            <div id="next">
                <?php echo form_submit(array('class' => 'button', 'value' => 'Login', 'name' => 'submit')) ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>