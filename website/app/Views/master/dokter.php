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
                            <a href="<?=base_url('admin/dokter/tambah');?>" class="btn btn-success"><i class="fa fa-plus"></i>  Tambah Dokter</a>
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
                                    <th scope="col">Image</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Profession</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Jadwal</th>
                                    <th scope="col">Reviews</th>
                                    <th scope="col">Join At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($list_dokter as $dokter) : ?>
                                    <tr>
                                        <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                        <td><img class="rounded-circle" width="50" height="50" src="<?= base_url(); ?>/assets/images/doctor/<?=$dokter['image'];?>" alt="Dokter"></td>
                                        <td><?= $dokter['nama']; ?></td>
                                        <td><?= $dokter['profession']; ?></td>
                                        <td><?= "Rp" . number_format($dokter['price'],0,',','.'); ?></td>
                                        <td><a href="<?= base_url('admin/dokter/detail_jadwal/'.$dokter['id']); ?>" class="btn btn-primary" ><i class="fa fa-list"></i> Detail Jadwal</a></td>
                                        <td><a href="<?= base_url('admin/dokter/reviews/'.$dokter['id']); ?>" class="btn btn-secondary" ><i class="fa fa-star"></i> Detail Review</a></td>
                                        <td><?= $dokter['created_at']; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-xs modal-edit-dokter" data-target="#modal-edit-dokter" data-toggle="modal" data-nama="<?= $dokter['nama']; ?>" data-profession="<?= $dokter['profession']; ?>" data-price="<?= $dokter['price']; ?>" data-id="<?= $dokter['id']; ?>"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="/admin/dokter/delete/<?=$dokter['id']; ?>"><i class="fa fa-trash"></i></button>
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Dokter?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-dokter">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('admin/dokter/edit') ;?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title">Edit Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="foto_dokter" accept="image/*">
                    <label class="custom-file-label" for="customFile">Foto dokter (Optional)</label>
                </div>
                <div class="form-group mt-3">
                    <label for="edit_floor" class="form-control-label">Nama</label>
                    <input name="nama" type="text" class="form-control" value="" id="dokter_nama">
                </div>
                <div class="form-group">
                    <label for="profession" class="col-form-label">Profession</label>
                    <input class="form-control inp" type="text" value="<?= old('profession');?>"  name="profession" id="dokter_profession">
                    <?=form_error(session('errors.profession'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="price" class="col-form-label">Price</label>
                    <input class="form-control inp" type="number" value="<?= old('price');?>"  name="price" id="dokter_price">
                    <?=form_error(session('errors.price'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id" type="hidden" class="form-control" value="" id="dokter_id">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>