   <?php if ($this->session->flashdata('flash_message')) : ?>
    <div class="alert alert-info" role="alert"><?php echo $this->session->flashdata('flash_message');?></div>
   <?php endif ; ?>
   
   <div class="row">
    <div class="col-sm-12 blog-main">
      <div class="blog-post">
        <?php foreach ($query->result() as $row) : ?>
          <h2 class="blog-post-title"><?php echo $row->job_title ; ?></h2>
          <p class="blog-post-meta">Posted by <?php echo $row->job_advertiser_name . ' on ' . $row->job_created_at ; ?></p> 
          <table class="table">
            <tr>
              <td>Start Date
              </td>
              <td><?php echo $row->job_start_date ; ?>
              </td>
              <td>Contact Name
              </td>
              <td><?php echo $row->job_advertiser_name ; ?>
              </td>                            
            </tr>
            <tr>
              <td>Location
              </td>
              <td><?php echo $row->loc_name ; ?>
              </td>
              <td>Contact Phone
              </td>
              <td><?php echo $row->job_advertiser_phone ; ?>
              </td>               
            </tr>
            <tr>
              <td>Type
              </td>
              <td><?php echo $row->type_name ; ?>
              </td>
              <td>Contact Email
              </td>
              <td><?php echo $row->job_advertiser_email ; ?>
              </td>               
            </tr>                
          </table>
          <p><?php echo $row->job_desc ; ?></p>
        <?php endforeach ; ?>
      </div>
    </div>
  </div>
 
  <p class="lead"><?php echo $this->lang->line('apply_instruction_1') . $job_title ;?></p>
  <div class="span12"> 
  <?php echo form_open('jobs/apply','role="form" class="form"') ; ?>
    <div class="form-group">
      <?php echo form_error('app_name'); ?>
      <label for="app_name"><?php echo $this->lang->line('app_name');?></label>
      <?php echo form_input($app_name); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('app_email'); ?>
      <label for="app_email"><?php echo $this->lang->line('app_email');?></label>
      <?php echo form_input($app_email); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('app_phone'); ?>
      <label for="app_phone"><?php echo $this->lang->line('app_phone');?></label>
      <?php echo form_input($app_phone); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('app_cover_note'); ?>
      <label for="app_cover_note"><?php echo $this->lang->line('app_cover_note');?></label>
      <?php echo form_textarea($app_cover_note); ?>
    </div>

    <input type="hidden" name="job_id" value="<?php echo $this->uri->segment(3) ; ?>" />

    <div class="form-group">
      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button>  or <? echo anchor('jobs',$this->lang->line('common_form_elements_cancel'));?>
    </div>
<?php echo form_close() ; ?>
  </div>
</div>    