<header class="main-header">
    <a href="index.php/administrator/" class="logo">
        <span class="logo-mini"><b>S</b>U</span>
        <span class="logo-lg"><b>RC</b>Sukamakmur</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $this->session->userdata('role'); ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="">
                                <a href="logout" class="btn btn-default btn-flat btn-block">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>