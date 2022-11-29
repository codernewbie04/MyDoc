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
                            <button class="btn btn-success btn-xs" data-target="#modal-add-jadwal" data-toggle="modal"><i class="fa fa-pencil"></i> Tambah Jadwal</button>
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
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jadwal Praktik</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($dokter['schedule'] as $jadwal) : ?>
                                    <tr>
                                        <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                        <td><?= $jadwal['day']; ?></td>
                                        <?php
                                        if($jadwal['id'] == -1){ ?>
                                            <td colspan="4" class="text-center">Tidak ada jadwal</td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                        <?php } else { ?>
                                            <td><?= $jadwal['time_start']; ?> - <?= $jadwal['time_end']; ?></td>
                                            <td><?= $jadwal['created_at']; ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-xs modal-edit-jadwal" data-target="#modal-edit-jadwal" data-toggle="modal" data-id="<?= $jadwal['id']; ?>" data-hari="<?= $jadwal['day']; ?>" data-start="<?= $jadwal['time_start']; ?>" data-end="<?= $jadwal['time_end']; ?>"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="/admin/dokter/jadwal_delete/<?=$jadwal['id']; ?>/<?=$dokter['id']?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        <?php } ?>
                                        
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Ingin Menghapus Jadwal Dokter?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-jadwal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('admin/dokter/edit_jadwal') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Jadwal Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mt-3">
                    <label for="edit_floor" class="form-control-label">Hari</label>
                    <input name="hari" type="text" class="form-control" value="<?= old('hari');?>" id="jadwal_hari" readonly>
                    <?=form_error(session('errors.hari'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            
                <div class="form-group mt-3">
                    <label for="edit_floor" class="form-control-label">Time Start</label>
                    <input name="start" type="time" class="form-control datepicker" value="<?= old('start');?>"id="jadwal_start" required>
                    <?=form_error(session('errors.start'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mt-3">
                    <label for="edit_floor" class="form-control-label">Time End</label>
                    <input name="end" type="time" class="form-control" value="<?= old('end');?>" id="jadwal_end" required>
                    <?=form_error(session('errors.end'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="jadwal_id" type="hidden" class="form-control" value="<?= old('jadwal_id');?>" id="jadwal_id">
            <input name="dokter_id" type="hidden" class="form-control" value="<?=$dokter['id'];?>">
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-jadwal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('admin/dokter/add_jadwal') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jadwal Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <select class="form-control p-1" name="hari" id="hari" required>
                        <option <?= old('hari') == "Senin" ? "selected":'';?> value="Senin">Senin</option>
                        <option <?= old('hari') == "Selasa" ? "selected":'';?> value="Selasa">Selasa</option>
                        <option <?= old('hari') == "Rabu" ? "selected":'';?> value="Rabu">Rabu</option>
                        <option <?= old('hari') == "Kamis" ? "selected":'';?> value="Kamis">Kamis</option>
                        <option <?= old('hari') == "Jumat" ? "selected":'';?> value="Jumat">Jumat</option>
                        <option <?= old('hari') == "Sabtu" ? "selected":'';?> value="Sabtu">Sabtu</option>
                        <option <?= old('hari') == "Minggu" ? "selected":'';?> value="Minggu">Minggu</option>
                    </select>
                    <?=form_error(session('errors.hari'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mt-3">
                    <label for="edit_floor" class="form-control-label">Time Start</label>
                    <input name="start" type="time" class="form-control datepicker" value="<?= old('start');?>" required>
                    <?=form_error(session('errors.start'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mt-3">
                    <label for="edit_floor" class="form-control-label">Time End</label>
                    <input name="end" type="time" class="form-control" value="<?= old('end');?>" required>
                    <?=form_error(session('errors.end'), '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Tambah</button>
            </div>
            <input name="dokter_id" type="hidden" class="form-control" value="<?=$dokter['id'];?>" id="jadwal_id">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>