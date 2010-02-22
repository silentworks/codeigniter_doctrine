<div class="login-holder">
    <?php echo form_open('auth/login', array('class' => 'smart-form')); ?>
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
        <div class="actions">
            <span id="checkbox">
                <label for="remember_me"><?php echo 'remember me'; ?></label><?php echo form_checkbox('remember_me'); ?>
            </span>
            <div id="next">
                <?php echo form_submit(array('class' => 'button', 'value' => 'Login', 'name' => 'submit')) ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>