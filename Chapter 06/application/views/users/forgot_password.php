<?php if (isset($login_fail)) : ?>
  <div class="alert alert-danger"><?php echo $this->lang->line('admin_login_error') ; ?></div>
<?php endif ; ?>
  <?php echo validation_errors(); ?>
  <?php echo form_open('password/forgot_password', 'class="form-signin" role="form"') ; ?>
    <h2 class="form-signin-heading"><?php echo $this->lang->line('forgot_pwd_header') ; ?></h2>
    <p class="lead"><?php echo $this->lang->line('forgot_pwd_instruction') ;?></p>
    <?php echo form_input(array('name' => 'usr_email', 'class' => 'form-control', 'placeholder' => $this->lang->line('admin_login_email'),'id' => 'email', 'value' => set_value('email', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?>
    <br />
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('common_form_elements_go') ; ?></button>
    <br />
  <?php echo form_close() ; ?>
</div>