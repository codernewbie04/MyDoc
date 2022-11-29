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
                            <a href="<?=base_url('admin/pasien/tambah');?>" class="btn btn-success"><i class="fa fa-plus"></i>  Tambah Pasien</a>
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Email Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($list_pasien as $pasien) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                      <td><?= $pasien['fullname']; ?></td>
                                      <td><?= $pasien['email']; ?></td>
                                      <td><?= $pasien['username']; ?></td>
                                      <td><?=  "Rp" . number_format($pasien['balance'],0,',','.'); ?></td>
                                      <td><?= $pasien['status'] == 1 ? '<span class="alert alert-success" role="alert">1</span>' : '' ?></td>
                                      <td><?php echo $pasien['active'] == 0 ? '<span class="alert alert-warning" role="alert">Pending</span>':' <span class="alert alert-success" role="alert">Active</span>';?></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-xs modal-balance" data-target="#modal-balance" data-toggle="modal" data-id="<?=$pasien['id']; ?>"><i class="fa fa-money"></i></button>
                                            <button class="btn btn-success btn-xs modal-edit-pasien" data-target="#modal-edit-pasien" data-toggle="modal" data-nama="<?=$pasien['fullname']; ?>" data-id="<?=$pasien['id']; ?>" data-username="<?=$pasien['username']; ?>" data-email="<?=$pasien['email']; ?>" data-active="<?=$pasien['active']; ?>" data-status="<?=$pasien['status']; ?>" data-balance="<?=$pasien['balance']; ?>"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="/admin/pasien/delete/<?=$pasien['id']; ?>"><i class="fa fa-trash"></i></button>
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


<div class="modal fade" id="modal-balance">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Proyeksi Keuangan Akun Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="table-obat" class="table table-striped table-hover" style="width:100%">
                    <thead class="bg-secondary">
                        <tr class="text-uppercase text-sm text-white">
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_balance">
                        <tr>
                            <td colspan="4" class="text-center">Wait...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success modal-topup" data-dismiss="modal" aria-label="Close" data-target="#modal-topup" data-toggle="modal" data-id=""><i class="fa fa-money"></i> Topup</button>
                    <!-- <a href="" class="btn btn-success" id="id_topup"><i class="fa fa-plus"></i> Topup</a> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-topup">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('admin/pasien/topup') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Topup Saldo Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Balance</label>
                    <input name="balance" type="number" class="form-control" value="">
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batalkan</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Tambah</button>
            </div>
            <input name="id" type="hidden" class="form-control" value="" id="id_pasien2">
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
            <form id="form-edit" action="<?php echo base_url('admin/pasien/edit') ;?>" method="post">
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
                    <label for="edit_floor" class="form-control-label">Email Status</label>
                    <input name="active" type="number" class="form-control" value="" id="active_pasien">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Password (Optional)</label>
                    <input name="password" type="password" class="form-control" value="">
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