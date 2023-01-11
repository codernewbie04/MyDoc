</div>
<!-- main content area end -->
<!-- footer area start-->
<footer>
    <div class="footer-area">
        Copyright &copy; By MyDoc 2022</span>
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
        <?php 
         if(session()->getFlashdata("error_jadwal")){
            print("$('#modal-add-jadwal').modal('show');");
         } else if(session()->getFlashdata("error_edit_jadwal")) {
            print("$('#modal-edit-jadwal').modal('show');");
         }
        ?>
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
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $("#searchbox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
        $("#sort").on("change click", function() {
            dataTable.page.len(this.value).draw();
        });
        $('.hapus-button').click(function() {
            var url = $(this).data('url');
            if (url != '') {
                $("#haps").attr("href", "<?php echo base_url(); ?>" + url);
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
                $('#id_instansi').val(id);
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
                $('#id_pasien').val(id);
            }
        });
        $('.detail-payment').click(function() {
            var id = $(this).data('id');
            var payment_method = $(this).data('payment_method');
            var reference = $(this).data('reference');
            var url = $(this).data('url');
            var va = $(this).data('va');
            var status = $(this).data('status');
            
            if (id != '') {
                $('#payment_id').val(id);
                $('#payment_method').val(payment_method);
                $('#payment_reference').val(reference);
                $('#payment_url').val(url);
                $('#payment_va').val(va);
                $('#payment_id').val(id);
                if(status == 0) {
                    $('#payment_status').text("Menunggu Pembayaran");
                    $('#payment_status').attr("class", 'alert alert-warning');
                } else if(status == 1) {
                    $('#payment_status').text("Settlement");
                    $('#payment_status').attr("class", 'alert alert-success');
                } else if (status == 2){
                    $('#payment_status').text("Refund");
                    $('#payment_status').attr("class", 'alert alert-warning');
                } else {
                    $('#payment_status').text("Expired");
                    $('#payment_status').attr("class", 'alert alert-danger');
                }
                
            }
        });
        $('.modal-confirm').click(function() {
            var code = $(this).data('code');
        
            if (code != '') {
                $('#registration_code').val(code);
            }
        });
        $('.refund').click(function() {
            var url = $(this).data('url');
            if (url != '') {
                $("#haps").attr("href", "<?php echo base_url(); ?>" + url);
            }
        });
        $('.modal-balance').click(function() {
            $('#tbody_balance').empty();
            $('#tbody_balance').prepend('<tr><td colspan="5" class="text-center">Wait...</td></tr>');
            var id = $(this).data('id');
            $('#id_pasien2').val(id);
            $("#id_topup").attr("href", "<?php echo base_url('admin/pasien/topup'); ?>/" + id);
            if (id != '') {
                $.ajax({
                    url: "<?php echo base_url('/admin/pasien/keuangan'); ?>/"+id,
                    method: "GET",
                    success: function(data) {
                        $('#tbody_balance').empty();
                        var no = 1;
                        var html = '<tr>';
                        var total = 0;
                        data.data.forEach(function(item, index, arr) {
                            
                            html += '<td>'+no+'</td>';
                            if(item.type == "in") {
                                html += '<td><span class="alert alert-success" role="alert">In</span></td>';
                                total += parseInt(item.amount);
                            } else {
                                html += '<td><span class="alert alert-danger" role="alert">Out</span></td>';
                                total -= parseInt(item.amount);
                            }
                            html += '<td>'+formatRupiah(item.amount, "Rp")+'</td>';
                            html += '<td>'+item.description+'</td>';
                            html += '<td>'+item.created_at+'</td>';
                            no++;
                            html += '</tr>';
                        });
                        if(data.data.length == 0) {
                            html += '<td colspan="5" class="text-center">No Data</td>';
                            html += '</tr>';
                        } else {
                            html += '<tr>';
                            html += '<td colspan="4"> Total </td>'
                            html += '<td>'+ formatRupiah(total.toString(), "Rp") +'</td>';
                            html += '</tr>';
                        }
                        $('#tbody_balance').prepend(html);
                    }, 
                    error: function (request, status, error) {
                        alert("Data pasien tidak tersedia!");
                    }
                });
            }
        });        
        function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
        $('.modal-edit-dokter').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var profession = $(this).data('profession');
            var price = $(this).data('price');
            if (id != '' && nama != '') {
                $('#dokter_id').val(id);
                $('#dokter_nama').val(nama);
                $('#dokter_profession').val(profession);
                $('#dokter_price').val(price);
            }
        });
        $('.modal-edit-invoice').click(function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            if (id != '') {
                $('#invoice_id').val(id);
                $('#status').val(status);
            }
        });
        $('.modal-edit-jadwal').click(function() {
            var id = $(this).data('id');
            var hari = $(this).data('hari');
            var start = $(this).data('start');
            var end = $(this).data('end');
            if (id != '') {
                $('#jadwal_id').val(id);
                $('#jadwal_hari').val(hari);
                $('#jadwal_start').val(start);
                $('#jadwal_end').val(end);
            }
        });
        $('#birthday').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1945:+nn"
        });
    });

    var data_bulan = [];
    var data_jumlah = [];
    var data_bulan2 = [];
    var data_jumlah2 = [];
</script>
</body>

</html>