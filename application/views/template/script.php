<script src="css/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="css/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="css/plugins/knob/jquery.knob.js"></script>
<script src="css/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="css/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="css/plugins/fastclick/fastclick.min.js"></script>
<script src="css/plugins/iCheck/icheck.min.js"></script>
<script src="css/dist/js/app.min.js"></script>
<script src="css/plugins/bootbox/bootbox.min.js"></script>
<script>
    $(document).ready(function(){
        $('input[name=search]').datepicker({format: 'dd MM yyyy', startDate: new Date()});
        $('input[name=search]').on('changeDate', function (ev) {
            $(this).datepicker('hide');
            $('form[name=searchtamu]').submit();
        });

        $('.deleteact').on('click', function(event) {
            event.preventDefault();
            var delobj = $(this);
            bootbox.confirm("Yakin ingin menghapus?", function(result) {
                if (result) {
                    window.location = delobj.attr("href");
                }
            });
        });

        $('.deletetipemakananact').on('click', function(event) {
            event.preventDefault();
            var delobj = $(this);
            bootbox.confirm("Yakin ingin menghapus?<br/> " +
                "!!Menghapus Tipe Makanan yang dipilih Akan Menghapus Seluruh Makanan dengan Tipe Tersebut <br/>" +
                " Lanjutkan?", function(result) {
                if (result) {
                    window.location = delobj.attr("href");
                }
            });
        });

        $('.approveact').on('click', function(event) {
            event.preventDefault();
            var delobj = $(this);
            bootbox.confirm("Are you sure to approve this transaction?", function(result) {
                if (result) {
                    window.location = delobj.attr("href");
                }
            });
        });
    });
</script>
