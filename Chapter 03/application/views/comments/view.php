
<!-- Discussion - initial comment -->
<?php foreach ($discussion_query->result() as $discussion_result) : ?>
  <h2>
      <?php echo $discussion_result->ds_title; ?><br />
      <small><?php echo $this->lang->line('comments_created_by') . $discussion_result->usr_name . $this->lang->line('comments_created_at') . $discussion_result->ds_created_at; ?></small>
  </h2>
  <p class="lead"><?php echo $discussion_result->ds_body; ?></p>
<?php endforeach ; ?>

<!-- Comment - list of comments -->
<?php foreach ($comment_query->result() as $comment_result) : ?>
  <li class="media">
    <a class="pull-left" href="#">
      <img class="media-object" src="<?php echo base_url() ; ?>img/profile.svg" />
    </a>
    <div class="media-body">
      <h4 class="media-heading"><?php echo $comment_result->usr_name . anchor('comments/flag/'.$comment_result->ds_id . '/' . $comment_result->cm_id,$this->lang->line('comments_flag')) ; ?></h4>
      <?php echo $comment_result->cm_body ; ?>
    </div>
  </li>
<?php endforeach ; ?>

<!-- Form - begin form section -->
<br /><br />
<p class="lead"><?php echo $this->lang->line('comments_form_instruction');?></p>

<?php echo validation_errors(); ?>
<?php echo form_open('comments/index','role="form"') ; ?>
    <div class="form-group col-md-5">
      <label for="comment_name"><?php echo $this->lang->line('comments_comment_name');?></label>
      <input type="text" name="comment_name" class="form-control" id="comment_name" value="<?php echo set_value('comment_name'); ?>">
    </div>
    <div class="form-group col-md-5">
      <label for="comment_email"><?php echo $this->lang->line('comments_comment_email');?></label>
      <input type="email" name="comment_email" class="form-control" id="comment_email" value="<?php echo set_value('comment_email'); ?>">
    </div>
    <div class="form-group  col-md-10">
      <label for="comment_body"><?php echo $this->lang->line('comments_comment_body');?></label>
      <textarea class="form-control" rows="3" name="comment_body" id="comment_body"><?php echo set_value('comment_body'); ?></textarea>
    </div>
    <div class="form-group  col-md-11">
      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button>
    </div>
  <?php echo form_hidden('ds_id',$ds_id) ; ?>
<?php echo form_close() ; ?>  

