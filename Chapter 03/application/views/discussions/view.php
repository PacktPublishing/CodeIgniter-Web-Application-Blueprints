    SORT: <?php echo anchor('discussions/index/sort/age/' . (($dir == 'ASC') ? 'DESC' : 'ASC'),'Newest ' 
                . (($dir == 'ASC') ? 'DESC' : 'ASC'));?>

    <table class="table table-hover">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('discussions_title') ; ?></th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($query->result() as $result) : ?>
          <tr>
            <td>
              <?php echo anchor('comments/index/'.$result->ds_id,$result->ds_title) . ' '
                    . $this->lang->line('comments_created_by') . $result->usr_name; ?>
                    
              <?php echo anchor('discussions/flag/'.$result->ds_id,
              $this->lang->line('discussion_flag')) ; ?>
              <br />
              <?php echo $result->ds_body ; ?>
            </td>
          </tr>
        <?php endforeach ; ?>

      </tbody>
    </table>