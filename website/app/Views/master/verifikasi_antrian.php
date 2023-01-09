<?= $this->extend('template/template') ?>
 
<?= $this->section('content') ?>
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body row top-info">
                    <div class="col-md-6 clearfix">
                        <input type="text" id="searchbox" class="pull-left form-search col-8" placeholder="Pencarian.." value=""> 
                    </div>
                    <div class="clearfix col-md-6">
                        <div class="pull-right">
                            <a href="<?=base_url('admin/dokter/tambah');?>" class="btn btn-success"><i class="fa fa-check"></i>  Verifikasi by Kode Registrasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <?=form_error(session('error'), '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?=form_error(session('success'), '<div class="alert alert-success" role="alert">', '</div>'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                    	<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-uppercase text-sm text-white">
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Kode Registrasi</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Jadwal Reservasi</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($invoices as $invoice) : 
                                        if($invoice['status'] == 1):
                                        $jadwalReserve = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $invoice['created_at'])->locale('id'); 
                                        ?>
                                    <tr>
                                        <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                        <td><?= $invoice['registration_code']; ?></td>
                                        <td><img class="rounded-circle" width="50" height="50" src="<?= base_url(); ?>/assets/images/doctor/dokter.jpg" alt="Dokter"></td>
                                        <td><?= $invoice['fullname']; ?></td>
                                        <td><?= $jadwalReserve->isoFormat('dddd, D MMMM Y, HH:mm:ss'); ?></td>
                                        <td><?= "Rp" . number_format($invoice['total_price'],0,',','.'); ?></td>
                                        <td><?= $invoice['dokter']['nama']; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-xs modal-confirm" data-target="#modal-confirm" data-toggle="modal" data-code="<?= $invoice['registration_code']; ?>"><i class="fa fa-check"></i> Confirm</button>
                                            <button class="btn btn-danger btn-xs refund" data-target="#refund" data-toggle="modal" data-url="<?="/admin/verifikasi_antrian/refund/".$invoice['id']; ?>"><i class="fa fa-trash"></i> Refund</button>
                                        </td>
                                    </tr>
                                    <?php $i++; 
                                    endif;
                                    endforeach ?>

                            </tbody>
                            

                        </table>



                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

<div class="modal fade" id="refund" tabindex="-1" role="dialog" aria-labelledby="refund" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin ingin melakukan refund ?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-warning" id="haps"><i class="fa fa-money"></i> Refund</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-confirm">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('admin/verifikasi_antrian/confirm') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Antrian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="registration_code" class="col-form-label">Registration Code</label>
                    <input class="form-control inp" type="text" name="registration_code" id="registration_code" readonly>
                    <?=form_error(session('errors.registration_code'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id" type="hidden" class="form-control" value="" id="dokter_id">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>