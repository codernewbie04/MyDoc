</div>
<!-- main content area end -->
<!-- footer area start-->
<footer>
    <div class="footer-area">
        Copyright &copy; By MyDoc 2022<br>Template by : <span>Lupa</span>
    </div>
</footer>
<!-- footer area end-->
</div>
<!-- page container area end -->
<!-- offset area start -->
<div class="offset-area">
    <div class="offset-close"><i class="ti-close"></i></div>
    <ul class="offset-menu-tab">
        <li><a href="<?= base_url('user'); ?>"><i class="fa fa-user"> </i>&nbsp; EDIT PROFIL</a></li>
        <li><a href="<?= base_url('user/password'); ?>"><i class="fa fa-key"> </i>&nbsp; UBAH PASSWORD</a></li>
        <li><a href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out"> </i>&nbsp; LOGOUT</a></li>
    </ul>
</div>
<!-- offset area end -->
<!-- jquery latest version -->
<script src="<?= base_url(); ?>/assets/js/jquery-3.4.1.min.js"></script>
<!-- bootstrap 4 js -->
<script src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/jquery.slicknav.min.js"></script>
<!-- Start datatable js -->
<script src="<?= base_url(); ?>/assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url(); ?>/assets/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/assets/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/jquery-ui.min.js"></script>
<!-- others plugins -->
<script src="<?= base_url(); ?>/assets/js/Chart.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/utils.js"></script>
<!-- Maaa -->
<script src="<?= base_url(); ?>/assets/js/plugins.js"></script>
<script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Initialize 
        $("#cari_pasien").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>/pasien/autoPasien",
                    type: 'post',
                    dataType: "json",
                    data: {
                        no_ktp: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#cari_pasien').val(ui.item.label); // display the selected text
                // $('#userid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
        var dataTable = $('#table-obat').DataTable({
            "language": {
                "lengthMenu": "Baris _MENU_",
                "zeroRecords": "Tidak Ada Data - sorry",
                "info": "Menampilkan _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak Ada Data",
                "infoFiltered": "(Filter dari _MAX_ total records)",
                "search": "Cari",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya",
                }
            }
        });
        $("#searchbox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
        $("#sort").on("change click", function() {
            dataTable.page.len(this.value).draw();
        });
        $('#table-kategori').DataTable();
        $('#table-pasien').DataTable();
        $('#expired').datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            minDate: new Date()
        });
        $('#bulan').datepicker({
            dateFormat: "mm-yy",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,

            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
            }
        });
        $("#bulan").focus(function() {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });
        $('#birth').datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1945:+nn"
        });
        $("#nama-obat-auto").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>rekam_medis/searchObat",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#nama-obat-auto').val(ui.item.label); // display the selected text
                $('#userid').val(ui.item.value); // save selected id to input
                $('#obat_satuan').html(ui.item.satuan);
                return false;
            }
        });
        $('#klinik').change(function() {
            var klinik = $(this).val();
            if (klinik != '') {
                $.ajax({
                    url: "<?php echo base_url('rekam_medis/load_dokter'); ?>",
                    method: "POST",
                    data: {
                        klinik: klinik
                    },
                    success: function(data) {
                        $('#dokter').html(data);
                    }
                });
            } else {
                $('#dokter').html('<option value="">---</option>');
            }

        });
        $('#seluruh').click(function() {

            if ($(this).prop("checked") == true) {
                $('#bulan').attr('disabled', true);

            } else if ($(this).prop("checked") == false) {
                $('#bulan').attr('disabled', false);
            }
        });
        $(document).on('click', '#pilih-obat', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#nama-obat').val(nama);
            $('#userid').val(id);
            $('#modal-obat').modal('hide');
        });
        $('.rujuk-bnt').click(function() {
            var rm = $(this).data('norm');
            console.log(rm);
            if (rm != '') {
                $('#rujuk-title-modal').html('Rujuk Rekam Medis ' + rm);
                $("#r-internal").attr("href", "<?php echo base_url('pemeriksaan/rujuk_internal/'); ?>" + rm);
                $("#r-external").attr("href", "<?php echo base_url('pemeriksaan/rujuk_external/'); ?>" + rm);
            }
        });

        $('.hapus-button').click(function() {
            var url = $(this).data('url');
            if (url != '') {
                $("#haps").attr("href", "<?php echo base_url(); ?>" + url);
            }
        });
        $('.hapus-button2').click(function() {
            var url = $(this).data('url');
            if (url != '') {
                $("#haps2").attr("href", "<?php echo base_url(); ?>" + url);
            }
        });
        $('.edit-kategori').click(function() {
            var id = $(this).data('id');
            var kategori = $(this).data('kategori');
            if (id != '' && kategori != '') {
                $('#kategori_nama').val(kategori);
                $('#id_kategori').val(id);
            }
        });
        $('.modal-edit-instansi').click(function() {
            var id = $(this).data('id');
            var username = $(this).data('username');
            var active = $(this).data('active');
            var status = $(this).data('status');
            var nama = $(this).data('nama');
            var email = $(this).data('email');
            
            if (id != '' && username != '' && nama != '') {
                $('#nama_instansi').val(nama);
                $('#username_instansi').val(username);
                $('#email_instansi').val(email);
                $('#active_instansi').val(active);
                $('#status_instansi').val(status);
                $('#id_petugas').val(id);
            }
        });
        $('.modal-edit-pasien').click(function() {
            var id = $(this).data('id');
            var username = $(this).data('username');
            var active = $(this).data('active');
            var status = $(this).data('status');
            var nama = $(this).data('nama');
            var email = $(this).data('email');
            var balance = $(this).data('balance');
            
            if (id != '' && username != '' && nama != '') {
                $('#nama_pasien').val(nama);
                $('#username_pasien').val(username);
                $('#email_pasien').val(email);
                $('#active_pasien').val(active);
                $('#status_pasien').val(status);
                $('#balance_pasien').val(balance);
                $('#id_petugas').val(id);
            }
        });
        $('.modal-edit-dokter').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            if (id != '' && nama != '') {
                $('#nama_dokter').val(nama);
                $('#id_dokter').val(id);
            }
        });
        $('.u-diagnosa').click(function() {
            var id = $(this).data('id');
            var diagnosa = $(this).data('diagnosa');
            var saran = $(this).data('saran');
            if (id != '') {
                $('#diagnosa_rujuk').val(diagnosa);
                $('#saran_tindakan').val(saran);
                $('#id_rujuk').val(id);
            }
        });
        $('.lab-btn').click(function() {
            var rm = $(this).data('norm');
            if (rm != '') {
                $(".lab-a").attr("href", "<?php echo base_url('pemeriksaan/addLab/'); ?>" + rm);
            }
        });
        $('.btn-resep').click(function() {
            var id = $(this).data('idresep');
            if (id != '') {
                $("#h-only").attr("href", "<?php echo base_url('pemeriksaan/delete_resep_o/'); ?>" + id);
                $("#h-all").attr("href", "<?php echo base_url('pemeriksaan/delete_resep_all/'); ?>" + id);
            }
        });
        $('.btn-labp').click(function() {
            var id = $(this).data('id');
            var keterangan = $(this).data('keterangan');
            var nolabor = $(this).data('nolabor');
            if (id != '') {
                $('#no_lab').val(nolabor);
                $('#keterangan_labor').val(keterangan);
                $('#id_lab').val(id);
            }
        });
    });

    var data_bulan = [];
    var data_jumlah = [];
    $.post("<?= base_url('dashboard/getKunjungan') ?>",
        function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function(test, item) {
                data_bulan.push(item.bulan);
                data_jumlah.push(item.jumlah);
            });

            var ctx = $("#myKunjungan")[0].getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: data_bulan,
                    datasets: [{
                        label: 'Kunjungan',
                        backgroundColor: window.chartColors.green,
                        data: data_jumlah
                    }]
                },

                // Configuration options go here
                options: {}
            });
        });
    var data_bulan2 = [];
    var data_jumlah2 = [];
    $.post("<?= base_url('dashboard/getObat') ?>",
        function(data) {
            var obj = JSON.parse(data);
            $.each(obj, function(test, item) {
                data_bulan2.push(item.bulan);
                data_jumlah2.push(item.jumlah);
            });

            var ctx = $("#myObat")[0].getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: data_bulan2,
                    datasets: [{
                        label: 'Pemberian Obat',
                        backgroundColor: window.chartColors.orange,
                        data: data_jumlah2
                    }]
                },

                // Configuration options go here
                options: {}
            });
        });
</script>
</body>

</html>