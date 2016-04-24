<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="pengunjung/" class="navbar-brand"><b>RC</b> Sukamakmur</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fasilitas <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="pengunjung/akomodasi">Akomodasi</a></li>
                            <li><a href="pengunjung/makanan">Makanan</a></li>
                            <li><a href="pengunjung/peralatan">Peralatan</a></li>
                            <li><a href="pengunjung/kegiatan">Kegiatan</a></li>
                        </ul>
                    </li>


                </ul>

                <form name="searchtamu" class="navbar-form navbar-left" role="search" method="post" action="pengunjung/cari">
                    <div class="form-group">
                        <input type="text" name="search" value="<?php echo (isset($DateSearch)) ? $DateSearch : '' ?>" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>

            </div>

            <div class="navbar-custom-menu">

                <?php if ($ID == null) { ?>
                    <ul class="nav navbar-nav">
                        <li><a href="login/">Login</a></li>
                        <li><a href="pengunjung/buatakun">Register</a></li>
                    </ul>
                <?php } ?>

                <?php if ($ID != null) { ?>
                    <ul class="nav navbar-nav">
                        <li class="user user-menu <?php echo (isset($open)) ? $open : '' ?>">
                            <a href="pesan/" class="dropdown-toggle">
                                <i class="fa fa-archive"></i>
                                <span class="hidden-xs">Pesanan</span>
                            </a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span class="hidden-xs"><?php echo $this->session->userdata('role'); ?></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="user-panel">
                                    <div class="">
                                        <?php echo $this->session->userdata('nama'); ?>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="">
                                        <a href="logout/" class="btn btn-default btn-flat btn-block">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>