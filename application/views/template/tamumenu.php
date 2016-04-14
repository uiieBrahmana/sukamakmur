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

                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>

            </div>

            <div class="navbar-custom-menu">

                <?php if($ID == null) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="login/">Login</a></li>
                    <li><a href="pengunjung/buatakun">Register</a></li>
                </ul>
                <?php } ?>

                <?php if($ID != null) { ?>
                    <ul class="nav navbar-nav">
                        <li><a href="pesan/">Pesanan</a></li>
                        <li><a href="logout/">Logout</a></li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>