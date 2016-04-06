  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url() ; ?>"><?php echo $this->lang->line('system_system_name'); ?></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><?php echo anchor('shop', $this->lang->line('nav_home')) ; ?></li>
          <li><?php echo anchor('shop/display_cart', ($items > 0) ? $this->lang->line('nav_cart_count') . '(' . $items . ')' : $this->lang->line('nav_cart_count') .'(0)') ; ?></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  <div class="container theme-showcase" role="main">
