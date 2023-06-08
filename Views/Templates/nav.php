    <!--sidebar start-->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>Control SCDS-System</h3>
        <ul class="nav side-menu">

        <?php echo Permisos::nav(); ?>
        </ul>
      </div>

    </div>

    </div>
    </div>


    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
          <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
              <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="<?= IMG ?>img.jpg" alt=""><!-<h2><?php echo $_SESSION['nombre'];?></h2>
              </a>
              <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?= base_url ?>/logout"><i class="fa fa-sign-out pull-right"></i> Salir</a>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->