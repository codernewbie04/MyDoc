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
                                    <th scope="col">No. Invoice</th>
                                    <th scope="col">Pasien</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Invoice Status</th>
                                    <th scope="col">Registration Code</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $i=1; 
                                foreach($list_riwayat as $riwayat) : 
                                    if($riwayat['status'] == 0) {
                                        $status = '<span class="alert alert-warning" role="alert">Pending</span>';
                                    } else if($riwayat['status'] == 1){
                                        $status = '<span class="alert alert-success" role="alert">Proses</span>';
                                    } else if($riwayat['status'] == 2){
                                        $status = '<span class="alert alert-success" role="alert">Selesai</span>';
                                    } else if($riwayat['status'] == -1) {
                                        $status = '<span class="alert alert-danger" role="alert">Dibatalkan</span>';
                                    } else {
                                        $status = 'Unkown Status';
                                    }
                            ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                      <td><?= $riwayat['no_invoice']; ?></td>
                                      <td><?= $riwayat['fullname']; ?></td>
                                      <td><?= $riwayat['dokter']['nama']; ?></td>
                                      <td><?= "Rp" . number_format($riwayat['price'],0,',','.'); ?></td>
                                      <td style="color:red"><?= "Rp" . number_format($riwayat['discount'],0,',','.'); ?></td>
                                      <td><?= "Rp" . number_format($riwayat['total_price'],0,',','.');?></td>
                                      <td><?= $status; ?></td>
                                      <td><?= $riwayat['registration_code']; ?></td>
                                      <td class="text-center">
                                        <?php if($riwayat['payment']){
                                            ?>
                                            <button class="btn btn-success btn-xs detail-payment" data-target="#detail-payment" data-toggle="modal" data-payment_method="<?= $riwayat['payment']['payment_method']['paymentName']; ?>" data-reference="<?= $riwayat['payment']['reference']; ?>" data-url="<?= $riwayat['payment']['url']; ?>" data-va="<?= $riwayat['payment']['vaNumber']; ?>" data-status="<?= $riwayat['payment']['status']; ?>" data-id="<?= $riwayat['payment']['id']; ?>"><i class="fa fa-eye"></i></button>
                                            <?php
                                        } else { echo '-';}?>
                                      </td>
                                      <td><?= $riwayat['created_at']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if($user['role'] == 2){?>
                                                <button class="btn btn-success btn-xs modal-edit-pasien" data-target="#modal-edit-pasien" data-toggle="modal" data-nama="<?=$riwayat['fullname']; ?>" data-id="<?=$riwayat['id']; ?>" data-username="<?=$riwayat['fullname']; ?>" data-email="<?=$riwayat['fullname']; ?>" data-active="<?=$riwayat['fullname']; ?>" data-status="<?=$riwayat['fullname']; ?>" data-balance="<?=$riwayat['fullname']; ?>"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="admin/pasien/delete_pasien/<?=$riwayat['id']; ?>"><i class="fa fa-trash"></i></button>
                                            <?php } else {
                                                 echo "-";
                                            }?>
                                            
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach ?>

                            </tbody>

                        </table>



                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

<div class="modal fade" id="detail-payment" tabindex="-1" role="dialog" aria-labelledby="detail-payment" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('pasien/editProses') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Detail Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Payment Method</label>
                    <input type="text" class="form-control" value="VA BCA" id="payment_method" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Reference</label>
                    <input type="text" class="form-control" value="asd" id="payment_reference" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">URL</label>
                    <input type="text" class="form-control" value="https://sandbox.duitku.com/topup/" id="payment_url" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">VA Number</label>
                    <input type="text" class="form-control" value="123" id="payment_va" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Status</label><br>
                    <span id="payment_status" class="alert alert-warning" role="alert">Pending</span>
                </div>
            </div>

            <input name="id" type="hidden" class="form-control" value="" id="payment_id">
            </form>
        </div>
  </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin ingin menghapus pasien?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-pasien">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('pasien/editProses') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Nama</label>
                    <input name="nama" type="text" class="form-control" value="" id="nama_pasien">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Email</label>
                    <input name="email" type="text" class="form-control" value="" id="email_pasien" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Username</label>
                    <input name="username" type="text" class="form-control" value="" id="username_pasien" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Balance</label>
                    <input name="username" type="number" class="form-control" value="" id="balance_pasien" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Status</label>
                    <input name="status" type="number" class="form-control" value="" id="status_pasien">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Konfirm Password</label>
                    <input name="active" type="number" class="form-control" value="" id="active_pasien">
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id" type="hidden" class="form-control" value="" id="id_pasien">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>