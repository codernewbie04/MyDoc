<?= $this->extend('template/template') ?>
 
<?= $this->section('content') ?>
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Tambah Dokter</h4>
                            <?=form_error(session('error'), '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?=form_error(session('success'), '<div class="alert alert-success" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('admin/dokter/add'); ?>" enctype="multipart/form-data">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="foto_dokter" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Foto dokter (Optional)</label>
                                    <?=form_error(session('errors.foto_dokter'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="supplier" class="col-form-label">Nama Dokter</label>
                                    <input class="form-control inp" type="text" value="<?= old('nama');?>"  name="nama">
                                    <?=form_error(session('errors.nama'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="profession" class="col-form-label">Profession</label>
                                    <input class="form-control inp" type="text" value="<?= old('profession');?>"  name="profession" id="profession">
                                    <?=form_error(session('errors.profession'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="col-form-label">Price</label>
                                    <input class="form-control inp" type="number" value="<?= old('price');?>"  name="price" id="price">
                                    <?=form_error(session('errors.price'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group ml-auto">
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Tambah</button>                              
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>