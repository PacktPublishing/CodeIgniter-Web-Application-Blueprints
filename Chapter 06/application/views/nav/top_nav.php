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
          <?php echo anchor('users', $this->lang->line('system_system_name'),'class="navbar-brand"') ; ?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if ($this->session->userdata('usr_access_level') == 1) : ?>
              <li <?php if ($this->uri->segment(1) == '') {echo 'class="active"';} ; ?>><?php echo anchor('users', $this->lang->line('top_nav_users')) ; ?></li>
              <li <?php if ($this->uri->segment(2) == 'new_user') {echo 'class="active"';} ; ?>><?php echo anchor('users/new_user', $this->lang->line('top_nav_new')) ; ?></li>
            <?php else : ?>

            <?php endif ; ?>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <?php if ($this->session->userdata('logged_in') == TRUE) : ?>
              <li><?php echo anchor('signin/signout', $this->lang->line('top_nav_signout')) ; ?></li>
            <?php else : ?>
              <li><?php echo anchor('signin/signin', $this->lang->line('top_nav_signin')) ; ?></li>
            <?php endif ; ?>
          </ul>       
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase" role="main">
