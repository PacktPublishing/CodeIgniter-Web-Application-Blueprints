<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-9">
    <div class="row">
      <?php echo validation_errors(); ?> 
      <?php echo form_open('/signup') ; ?>        
      <?php echo form_input($signup_email); ?><br />  
      <?php echo form_checkbox($signup_opt1) . $this->lang->line('signup_opt1'); ?><br /> 
      <?php echo form_checkbox($signup_opt2) . $this->lang->line('signup_opt2'); ?><br />
      <?php echo form_submit('', $this->lang->line('common_form_elements_go'), 'class="btn btn-success"') ; ?><br /> 
      <?php echo form_close() ; ?> 
    </div>
  </div>
</div>