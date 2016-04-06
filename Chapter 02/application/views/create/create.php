      <div class="page-header">
        <h1><?php echo $this->lang->line('system_system_name'); ?></h1>
      </div>

      <p><?php echo $this->lang->line('encode_instruction_1'); ?></p>

      <?php if (validation_errors()) : ?>
        <?php echo validation_errors(); ?>
      <?php endif ; ?>

      <?php if ($success_fail == 'success') : ?>
        <div class="alert alert-success">
          <strong><?php echo $this->lang->line('common_form_elements_success_notifty'); ?></strong> <?php echo $this->lang->line('encode_encode_now_success'); ?> 
        </div>
      <?php endif ; ?>

      <?php if ($success_fail == 'fail') : ?>
        <div class="alert alert-danger">
          <strong><?php echo $this->lang->line('common_form_elements_error_notifty'); ?> </strong> <?php echo $this->lang->line('encode_encode_now_error'); ?> 
        </div>
      <?php endif ; ?>

      <?php echo form_open('create') ; ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="input-group">
              <input type="text" class="form-control" name="url_address" placeholder="<?php echo $this->lang->line('encode_type_url_here'); ?>">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><?php echo $this->lang->line('encode_encode_now'); ?></button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      <?php echo form_close() ; ?>

      <br />

      <?php if ($encoded_url == true) : ?>
        <div class="alert alert-info">
          <strong><?php echo $this->lang->line('encode_encoded_url'); ?> </strong> 
          <?php echo anchor($encoded_url, $encoded_url) ; ?>
        </div>
      <?php endif ; ?>