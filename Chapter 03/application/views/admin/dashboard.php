  <h1 id="tables" class="page-header">Dashboard</h1>

<table class="table">
	<thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
	      <td>Actions</td>          
        </tr>          
    </thead>
    <tbody>
    	<?php if ($discussion_query->num_rows() > 0) : ?>    	
		<?php foreach ($discussion_query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->ds_id ; ?></td>
		          <td><?php echo $row->usr_name ; ?></td>
		          <td><?php echo $row->usr_email ; ?></td>
		          <td><?php echo anchor('admin/update_item/ds/allow/'.
                    $row->ds_id,$this->lang->line('admin_dash_allow')) .
                    ' ' . anchor('admin/update_item/ds/disallow/'.
                    $row->ds_id,$this->lang->line('admin_dash_disallow')) ; ?>
		          </td>
		        </tr>
		        <tr>
		          <td colspan="3"><?php echo $row->ds_title; ?></td>
		          <td></td>
		        </tr>
		        <tr>
		          <td colspan="3"><?php echo $row->ds_body; ?></td>	    
		          <td></td>      	          
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="4">No naughty forums here, horay!</td>
	        </tr>			
		<?php endif; ?>
	</tbody>
</table>

<table class="table">
    <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
	      <td>Actions</td>                    
        </tr>
    </thead>	
    <tbody>
    	<?php if ($comment_query->num_rows() > 0) : ?>
			<?php foreach ($comment_query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->cm_id ; ?></td>
		          <td><?php echo $row->usr_name ; ?></td>
		          <td><?php echo $row->usr_email ; ?></td>
		          <td><?php echo anchor('admin/update_item/cm/allow/'.
		            $row->cm_id,$this->lang->line('admin_dash_allow')) . 
		            ' ' . anchor('admin/update_item/cm/disallow/'.
		            $row->cm_id,$this->lang->line('admin_dash_disallow')) ; ?>
		      	  </td>
		        </tr>
		        <tr>
		          <td colspan="3"><?php echo $row->cm_body; ?></td>	    
		          <td></td>      	          
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="4">No naughty comments here, horay!</td>
	        </tr>			
		<?php endif; ?>
	</tbody>
</table>