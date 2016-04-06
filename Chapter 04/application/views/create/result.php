      <div class="page-header">
        <h1><?php echo $this->lang->line('system_system_name'); ?></h1>
      </div>

      <?php if (isset($result) && $result == true) : ?>
          <strong><?php echo $this->lang->line('encode_encoded_url'); ?> </strong> 
          <?php echo anchor($result, $result) ; ?>
          <br />
          <img src="<?php echo base_url() . 'upload/' . $img_dir_name . '/' . $file_name ;?>" />
      <?php endif ; ?>