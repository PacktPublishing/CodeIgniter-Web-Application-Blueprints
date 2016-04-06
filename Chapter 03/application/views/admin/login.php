<?php if (isset($login_fail)) : ?>
  <div class="alert alert-danger"><?php echo $this->lang->line('admin_login_error') ; ?></div>
<?php endif ; ?>
<?php echo validation_errors(); ?>

<div class="container">
  <?php echo form_open('admin/login', 'class="form-signin" role="form"') ; ?>
    <h2 class="form-signin-heading"><?php echo $this->lang->line('admin_login_header') ; ?></h2>
    <input type="email" name="usr_email" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_email') ; ?>" required autofocus>
    <input type="password" name="usr_password" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_password') ; ?>" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('admin_login_signin') ; ?></button>
  <?php echo form_close() ; ?>
</div>