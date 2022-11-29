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
                            <a href="<?=base_url('admin/instansi/tambah');?>" class="btn btn-success"><i class="fa fa-plus"></i>  Tambah Instansi</a>
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($list_instansi as $instansi) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                      <td><?= $instansi['fullname']; ?></td>
                                      <td><?= $instansi['email']; ?></td>
                                      <td><?= $instansi['username']; ?></td>
                                      <td><?= $instansi['status'] == 1 ? '<span class="alert alert-success" role="alert">1</span>' : '' ?></td>
                                      <td><?php echo $instansi['active'] == 0 ? '<span class="alert alert-warning" role="alert">Pending</span>':' <span class="alert alert-success" role="alert">Active</span>';?></td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-xs modal-edit-instansi" data-target="#modal-edit-instansi" data-toggle="modal" data-nama="<?=$instansi['fullname']; ?>" data-id="<?=$instansi['id']; ?>" data-username="<?=$instansi['username']; ?>" data-email="<?=$instansi['email']; ?>" data-active="<?=$instansi['active']; ?>" data-status="<?=$instansi['status']; ?>"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="/admin/instansi/delete/<?=$instansi['id']; ?>"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Instansi Kesehatan?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-instansi">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('admin/instansi/edit') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Instansi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Nama</label>
                    <input name="nama" type="text" class="form-control" value="" id="nama_instansi">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Email</label>
                    <input name="email" type="text" class="form-control" value="" id="email_instansi" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Username</label>
                    <input name="username" type="text" class="form-control" value="" id="username_instansi" disabled>
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Status</label>
                    <input name="status" type="number" class="form-control" value="" id="status_instansi">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Active</label>
                    <input name="active" type="number" class="form-control" value="" id="active_instansi">
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
            <input name="id" type="hidden" class="form-control" value="" id="id_instansi">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>