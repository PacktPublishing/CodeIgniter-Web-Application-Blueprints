<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('usr_form_instruction_edit');?></p>

	<div class="span8"> 
		<?php echo form_open('users/edit_user','role="form" class="form"') ; ?>
	    <div class="form-group">
	      <?php echo form_error('usr_fname'); ?>
	      <label for="usr_fname"><?php echo $this->lang->line('usr_fname');?></label>
	      <?php echo form_input($usr_fname); ?>
	    </div>
	    <div class="form-group">
	      <?php echo form_error('usr_lname'); ?>
	      <label for="usr_lname"><?php echo $this->lang->line('usr_lname');?></label>
	      <?php echo form_input($usr_lname); ?>
	    </div>  
	    <div class="form-group">
	      <?php echo form_error('usr_uname'); ?>
	      <label for="usr_uname"><?php echo $this->lang->line('usr_uname');?></label>
	      <?php echo form_input($usr_uname); ?>
	    </div>   
	    <div class="form-group">
	      <?php echo form_error('usr_email'); ?>	    	
	      <label for="usr_email"><?php echo $this->lang->line('usr_email');?></label>
	      <?php echo form_input($usr_email); ?>
	    </div>   
	    <div class="form-group">
	    	<?php echo form_error('usr_confirm_email'); ?>	
	      <label for="usr_confirm_email"><?php echo $this->lang->line('usr_confirm_email');?></label>
	      <?php echo form_input($usr_confirm_email); ?>
	    </div>   
	    <div class="form-group">
	    	<?php echo form_error('usr_add1'); ?>
	      <label for="usr_add1"><?php echo $this->lang->line('usr_add1');?></label>
	      <?php echo form_input($usr_add1); ?>
	    </div>  
	    <div class="form-group">
	    	<?php echo form_error('usr_add2'); ?>
	      <label for="usr_add2"><?php echo $this->lang->line('usr_add2');?></label>
	      <?php echo form_input($usr_add2); ?>
	    </div>
	    <div class="form-group">
	    	<?php echo form_error('usr_add3'); ?>
	      <label for="usr_add3"><?php echo $this->lang->line('usr_add3');?></label>
	      <?php echo form_input($usr_add3); ?>
	    </div> 
	    <div class="form-group">
	    	<?php echo form_error('usr_town_city'); ?>
	      <label for="usr_town_city"><?php echo $this->lang->line('usr_town_city');?></label>
	      <?php echo form_input($usr_town_city); ?>
	    </div>         
	    <div class="form-group">
	    	<?php echo form_error('usr_zip_pcode'); ?>
	      <label for="usr_zip_pcode"><?php echo $this->lang->line('usr_zip_pcode');?></label>
	      <?php echo form_input($usr_zip_pcode); ?>
	    </div>        
	    <div class="form-group">
	    	<?php echo form_error('usr_access_level'); ?>
	      <label id="usr_access_level" for="usr_access_level"><?php echo $this->lang->line('usr_access_level');?></label>
	      <?php echo form_dropdown('usr_access_level', $usr_access_level_options, $usr_access_level); ?>
	    </div>  
	    <div class="form-group">
	    	<?php echo form_error('usr_is_active'); ?>
	      <label for="usr_is_active"><?php echo $this->lang->line('usr_is_active');?></label>
	      <input type="radio" name="usr_is_active" <?php if ($usr_is_active == 1) { echo 'checked' ;} ?> /> Active
	      <input type="radio" name="usr_is_active" <?php if ($usr_is_active == 0) { echo 'checked' ;} ?> /> Inactive
	    </div>

	    <?php echo form_hidden($id); ?>

	    <div class="form-group">
	      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button> or <? echo anchor('users',$this->lang->line('common_form_elements_cancel'));?>
	    </div>
		<?php echo form_close() ; ?>
	</div>

</div>