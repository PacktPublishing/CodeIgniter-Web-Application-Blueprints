<h2><?php echo $page_heading ; ?></h2>
<p class="lead"><?php echo $this->lang->line('delete_confirm_message');?></p>
<?php echo form_open('tasks/delete'); ?>
    <?php if (validation_errors()) : ?>
        <h3>Whoops! There was an error:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <?php foreach ($query->result() as $row) : ?>
        <?php echo $row->task_desc; ?>
        <br /><br />
        <?php echo form_submit('submit', $this->lang->line('common_form_elements_action_delete'), 'class="btn btn-success"'); ?>
        or <?php echo anchor('tasks',$this->lang->line('common_form_elements_cancel'));?>
        <?php echo form_hidden('id', $row->task_id); ?>
    <?php endforeach; ?>
<?php echo form_close() ; ?>
