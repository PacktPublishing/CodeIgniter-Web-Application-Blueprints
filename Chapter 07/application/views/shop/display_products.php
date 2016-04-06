      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <div class="row">
            <?php foreach ($query->result() as $row) : ?> 
              <div class="col-6 col-sm-6 col-lg-4">
                <h2><?php echo $row->product_name ; ?></h2>
                <p>&pound<?php echo $row->product_price ; ?></p>
                <p><?php echo $row->product_description ; ?></p>
                <?php echo anchor('shop/add/'.$row->product_id, $this->lang->line('index_add_to_cart'), 'class="btn btn-default"') ; ?>
              </div>
            <?php endforeach ; ?> 
          </div>
        </div>

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <?php echo anchor(base_url(), $this->lang->line('index_all_categories'), 'class="list-group-item"') ; ?>
            <?php foreach ($cat_query->result() as $row) : ?>
              <?php echo anchor('shop/index/'.$row->cat_url_name, $row->cat_name, 'class="list-group-item"') ; ?>
            <?php endforeach ; ?>
          </div>
        </div>
      </div>