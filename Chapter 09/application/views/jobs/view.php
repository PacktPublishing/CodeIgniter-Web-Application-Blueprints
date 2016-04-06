<div class="page-header">
  <h1>
    <?php echo form_open('jobs/index') ; ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="input-group">
            <input type="text" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('jobs_view_search'); ?>">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit"><?php echo $this->lang->line('jobs_view_search'); ?></button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    <?php echo form_close() ; ?>
  </h1>
</div>

<table class="table table-hover">
  <?php foreach ($query->result() as $row) : ?>
  <tr>
    <td><?php echo anchor ('jobs/apply/'.$row->job_id, $row->job_title) ; ?><br /><?php echo word_limiter($row->job_desc, 50) ; ?>
    </td>
    <td>Posten on <?php echo $row->job_created_at ; ?><br />Rate is &pound;<?php echo $row->job_rate ; ?>
    </td>
    <td><?php echo anchor ('jobs/apply/'.$row->job_id, $this->lang->line('jobs_view_apply')) ; ?>
    </td>                    
  </tr>
<?php endforeach ; ?>
</table>