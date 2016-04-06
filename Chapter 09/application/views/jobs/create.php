 <?php if ($this->session->flashdata('flash_message')) : ?>
  <div class="alert alert-info" role="alert"><?php echo $this->session->flashdata('flash_message');?></div>
 <?php endif ; ?>

  <p class="lead"><?php echo $this->lang->line('job_create_form_instruction_1');?></p>
  <div class="span8"> 
  <?php echo form_open('jobs/create','role="form" class="form"') ; ?>
    <div class="form-group">
      <?php echo form_error('job_title'); ?>
      <label for="job_title"><?php echo $this->lang->line('job_title');?></label>
      <?php echo form_input($job_title); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('job_desc'); ?>
      <label for="job_desc"><?php echo $this->lang->line('job_desc');?></label>
      <?php echo form_textarea($job_desc); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('type_id'); ?>
      <label for="type_id"><?php echo $this->lang->line('type');?></label>
      <select name="type_id" class="form-control">
      <?php foreach ($types->result() as $row) : ?>
        <option value="<?php echo $row->type_id ; ?>"><?php echo $row->type_name ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>    

    <div class="form-group">
      <?php echo form_error('cat_id'); ?>
      <label for="cat_id"><?php echo $this->lang->line('cat');?></label>
      <select name="cat_id" class="form-control">
      <?php foreach ($categories->result() as $row) : ?>
        <option value="<?php echo $row->cat_id ; ?>"><?php echo $row->cat_name ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>

    <div class="form-group">
      <?php echo form_error('loc_id'); ?>
      <label for="loc_id"><?php echo $this->lang->line('loc');?></label>
      <select name="loc_id" class="form-control">
      <?php foreach ($locations->result() as $row) : ?>
        <option value="<?php echo $row->loc_id ; ?>"><?php echo $row->loc_name ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>

    <label for="sunset_d"><?php echo $this->lang->line('job_start_date');?></label>
    <div class="row">
      <div class="form-group">
        <div class="col-md-2">
          <?php echo form_error('startd'); ?>        
          <select name="startd" class="form-control">
          <?php for ( $i = 1; $i <= 30; $i++) : ?>
            <?php if (date('j', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>

        <div class="col-md-2">      
          <?php echo form_error('startm'); ?>
          <select name="startm" class="form-control">
          <?php for ( $i = 1; $i <= 12; $i++) : ?>
            <?php if (date('m', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>

        <div class="col-md-2">
          <?php echo form_error('starty'); ?>
          <select name="starty" class="form-control">
          <?php for ($i = date("Y",strtotime(date("Y"))); $i <= date("Y",strtotime(date("Y").' +3 year')); $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
          <?php endfor ; ?>
          </select>
        </div> 
      </div>  
    </div> 

    <div class="form-group">
      <?php echo form_error('job_rate'); ?>
      <label for="job_rate"><?php echo $this->lang->line('job_rate');?></label>
      <?php echo form_input($job_rate); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('job_advertiser_name'); ?>
      <label for="job_advertiser_name"><?php echo $this->lang->line('job_advertiser_name');?></label>
      <?php echo form_input($job_advertiser_name); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('job_advertiser_email'); ?>
      <label for="job_advertiser_email"><?php echo $this->lang->line('job_advertiser_email');?></label>
      <?php echo form_input($job_advertiser_email); ?>
    </div>

    <div class="form-group">
      <?php echo form_error('job_advertiser_phone'); ?>
      <label for="job_advertiser_phone"><?php echo $this->lang->line('job_advertiser_phone');?></label>
      <?php echo form_input($job_advertiser_phone); ?>
    </div>

    <label for="sunset_d"><?php echo $this->lang->line('job_sunset_date');?></label>
    <div class="row">
      <div class="form-group">
        <div class="col-md-2">
          <?php echo form_error('sunset_d'); ?>        
          <select name="sunset_d" class="form-control">
          <?php for ( $i = 1; $i <= 30; $i++) : ?>
            <?php if (date('j', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>

        <div class="col-md-2">      
          <?php echo form_error('sunset_m'); ?>
          <select name="sunset_m" class="form-control">
          <?php for ( $i = 1; $i <= 12; $i++) : ?>
            <?php if (date('m', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>

        <div class="col-md-2">
          <?php echo form_error('sunset_y'); ?>
          <select name="sunset_y" class="form-control">
          <?php for ($i = date("Y",strtotime(date("Y"))); $i <= date("Y",strtotime(date("Y").' +3 year')); $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
          <?php endfor ; ?>
          </select>
        </div> 
      </div>  
    </div>     

    <span class="help-block"><?php echo $this->lang->line('job_sunset_date_help') ; ?></div>
    <div class="form-group">
      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button>  or <? echo anchor('jobs',$this->lang->line('common_form_elements_cancel'));?>
    </div>
<?php echo form_close() ; ?>
  </div>
</div>    