<!DOCTYPE html>
<html>

<?php $this->load->view('template/head'); ?>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    <?php $this->load->view('template/header'); ?>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="css/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Manager</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>


            <ul class="sidebar-menu">
                <li class="header">Menu Utama</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Fasilitas</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminakomodasi">Akomodasi</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminperalatan">Peralatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkegiatan">Kegiatan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminmakanan">Makanan</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Pegawai</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpegawai">Buat Akun
                                Pegawai</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpegawai">Daftar
                                Pegawai</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Pemesanan</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/admintambahpesanan">Buat Pemesanan
                                Baru</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatpesanan">Lihat Semua
                                Pesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipesanan">Konfirmasi
                                Pemesanan</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminkonfirmasipembayaran">Konfirmasi
                                Pembayaran Pesanan</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Kelola Akun Member</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminlihatakun">Lihat Semua
                                Member</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/administrator/adminbuatakun">Buat Member Baru</a>
                        </li>
                    </ul>
                </li>

                <li class="header">Version - 0.1 beta</li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pesanan
                <small>Tambah Pesanan</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Quick Example</h3>
                        </div>

                        <form role="form" method="post"
                              action="<?php echo base_url() ?>index.php/administrator/admintambahpesanan" name="add">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tamu</label>
                                    <select name="idtamu" id="pemesan" class="form-control select2">
                                        <?php foreach ($Tamu as $Value) {
                                            $data = $Value;
                                            echo "<option value='" . $data['idtamu'] . "'>" . $data['nama'] . "</option>";
                                        } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="box-group" id="accordion">

                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Pesanan Akomodasi
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tempat</label>
                                                <select name="idakomodasi" class="form-control select2">
                                                    <?php foreach ($Akomodasi as $Value) {
                                                        $data = $Value;
                                                        echo "<option value='" . $data['idakomodasi'] . "'>" . $data['nama'] . "</option>";
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal</label>
                                                <input type="text" placeholder="dari" name="tanggalmasuk"
                                                       value="<?php echo date("d-m-Y") ?>"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Hingga</label>
                                                <select name="tanggalkeluar" class="form-control select2">
                                                    <option value="1">1 Hari</option>
                                                    <option value="2">2 Hari</option>
                                                    <option value="3" selected>3 Hari</option>
                                                    <option value="4">4 Hari</option>
                                                    <option value="5">5 Hari</option>
                                                    <option value="6">6 Hari</option>
                                                    <option value="7">7 Hari</option>
                                                    <option value="8">8 Hari</option>
                                                    <option value="9">9 Hari</option>
                                                    <option value="10">10 Hari</option>
                                                </select>
                                            </div>

                                            <div id="akomodasires">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" disabled> Pilih tanggal dan lama menyewa
                                                        lebih dahulu.
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputFile">Jumlah Peserta</label>
                                                <input type="text" name="jumlah" class="form-control">

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputFile">Keterangan</label>
                                                <textarea required name="keteranganakomodasi" class="form-control"
                                                          style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-danger">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Pesanan Makanan
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Menu</label>
                                                <select name="idmenu" class="form-control select2">
                                                    <?php foreach ($MenuMakanan as $Value) {
                                                        $data = $Value;
                                                        echo "<option value='" . $data['idmenumakanan'] . "'>" . $data['idtipemakanan'] . " " . $data['keterangan'] . "</option>";
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal</label>
                                                <input type="text" placeholder="dari" name="tanggalmakan"
                                                       value="<?php echo date("d-m-Y") ?>"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Waktu</label>
                                                <select name="waktumakan" class="form-control select2">
                                                    <option value="Pagi">Pagi</option>
                                                    <option value="Siang">Siang</option>
                                                    <option value="Malam">Malam</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Jumlah Porsi</label>
                                                <input type="text" name="jumlahporsi" placeholder="jumlah porsi"
                                                       class="form-control">

                                                <p class="help-block" id="sisaporsi"></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Keterangan</label>
                                                <textarea required name="keteranganmakanan" class="form-control"
                                                          style="max-width: 100%; min-width: 100%; min-height: 60px; max-height: 120px;"></textarea>

                                            </div>

                                            <div class="form-group">
                                                <div id="makananadd" class="btn btn-info">Tambahkan</div>
                                            </div>

                                            <div id="makanres">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" disabled> Pilih makanan dahulu.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="panel box box-success">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseThree">
                                                    Pesanan Peralatan
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="box-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor
                                                brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                tempor, sunt
                                                aliqua put a bird on it squid single-origin coffee nulla assumenda
                                                shoreditch et.
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                nesciunt
                                                sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft
                                                beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                heard
                                                of them
                                                accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel box box-info">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseThree">
                                                    Pesanan Kegiatan
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="box-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor
                                                brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                                tempor, sunt
                                                aliqua put a bird on it squid single-origin coffee nulla assumenda
                                                shoreditch et.
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                nesciunt
                                                sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft
                                                beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                heard
                                                of them
                                                accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button class="btn btn-primary" type="submit" name="_submit">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <?php $this->load->view('template/footer'); ?>
    <?php $this->load->view('template/sidebar'); ?>
</div>
</body>
<?php $this->load->view('template/script'); ?>

<script src="css/plugins/select2/select2.min.js"></script>
<script src="css/plugins/validate/jquery.validate.min.js"></script>
<script src="css/plugins/validate/additional-methods.min.js"></script>

<script>
    $(document).ready(function () {

        $('input[name=tanggalmasuk]').datepicker({
            format: 'dd-mm-yyyy'
        });

        $('.select2').select2();

        $('form[name=add]').validate({
            rules: {
                idtamu: {
                    required: true
                },
                jumlahporsi: {
                    required: true,
                    range: [1, 1000]
                }
            },
            showErrors: function (errorMap, errorList) {
                this.defaultShowErrors();
            }
        });

        $('select[name=tanggalkeluar]').on('change', function () {
            $.ajax({
                    method: "POST",
                    url: "index.php/service/AvailableAkomodasi",
                    data: {
                        idakomodasi: $('select[name=idakomodasi]').val(),
                        start: $('input[name=tanggalmasuk]').val(),
                        end: $('select[name=tanggalkeluar]').val()
                    }
                })
                .done(function (msg) {
                    var htmlcontent = '';
                    $.each(msg.Akomodasi, function (index, value) {
                        htmlcontent += '<div class="checkbox">';
                        if (value.Result)
                            htmlcontent += '<label><input checked type="checkbox" name="checkakomodasi[]" value="' + value.Tanggal + '">' + value.Tanggal + ' Tersedia</label>';
                        else
                            htmlcontent += '<label><input disabled type="checkbox" name="checkakomodasi[]" value="' + value.Tanggal + '">' + value.Tanggal + ' Tidak Tersedia</label>';
                        htmlcontent += '</div>';
                    });
                    $('#akomodasires').html(htmlcontent);
                });
        });

        $('#akomodasiplus').on('click', function () {
            console.log('asdfgh');
            var line = $(this).parents("tr");
            var lineOffset = line.index();
            $("table tr:eq(" + lineOffset + ")").after(line.clone(true));
        });

        $('input[name=tanggalmasuk]').on('change', function () {
            $('select[name=tanggalkeluar]').trigger('change');
        });

        $('select[name=idakomodasi]').on('change', function () {
            $('select[name=tanggalkeluar]').trigger('change');
        });

        $('input[name=tanggalmasuk]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('select[name=tanggalkeluar]').trigger('change');


        $('input[name=tanggalmakan]').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('input[name=tanggalmakan]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        $('input[name=tanggalmakan]').on('change', function () {
            $.ajax({
                    method: "POST",
                    url: "index.php/service/AvailableMakanan",
                    data: {
                        tanggalmakan: $('input[name=tanggalmakan]').val(),
                    }
                })
                .done(function (msg) {
                    console.log(msg.sisa);
                    if (msg.sisa == null) {
                        $('p[id=sisaporsi]').html('Sisa porsi tersedia 1000 *Retreat Centre hanya bisa mengakomodir 1000 pesanan per harinya');
                        $("input[name*=jumlahporsi]").rules("remove", "range");
                        $("input[name*=jumlahporsi]").rules("add", {
                            range: [1, 1000]
                        });

                    } else {
                        $('p[id=sisaporsi]').html('Sisa porsi tersedia ' + msg.sisa + ' *Retreat Centre hanya bisa mengakomodir 1000 pesanan per harinya');
                        $("input[name*=jumlahporsi]").rules("remove", "range");
                        $("input[name*=jumlahporsi]").rules("add", {
                            range: [1, msg.sisa]
                        });
                    }
                });
        });

        $('input[name=tanggalmakan]').trigger('change');

        $('div[id=makananadd]').on('click', function () {
            var htmlcontent = '';
            htmlcontent += '<div class="checkbox">';
            htmlcontent += '<label><input checked type="checkbox" name="checkmakanan[]" value="' + $('input[name=tanggalmakan]').val() + '">' + $('input[name=jumlahporsi]').val() + ' Tersedia</label>';
            htmlcontent += '</div>';
            $('div[id=makanres]').append(htmlcontent);
        });
    });
</script>
</html>