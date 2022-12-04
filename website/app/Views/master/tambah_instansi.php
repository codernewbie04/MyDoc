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
                        <h4 class="header-title text-center text-uppercase">Tambah Akun Instansi</h4>
                        <?=form_error(session('error'), '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?=form_error(session('success'), '<div class="alert alert-success" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('admin/instansi/add'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nama Instansi</label>
                                    <input class="form-control inp" type="text" value="<?= old('nama');?>"  name="nama">
                                    <?=form_error(session('errors.nama'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Email</label>
                                    <input class="form-control inp" type="text" value="<?= old('email');?>" name="email">
                                    <?=form_error(session('errors.email'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Username</label>
                                    <input class="form-control inp" type="text" value="<?= old('username');?>"  name="username">
                                    <?=form_error(session('errors.username'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Address</label>
                                    <input class="form-control inp" type="text" value="<?= old('address');?>" name="address">
                                    <?=form_error(session('errors.address'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Birthday</label>
                                    <input class="form-control inp" type="text" id="birthday" value="<?= old('birthday');?>" name="birthday">
                                    <?=form_error(session('errors.birthday'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Password</label>
                                    <input class="form-control inp" type="password" value="" name="password">
                                    <?=form_error(session('errors.password'), '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Konfirm Password</label>
                                    <input class="form-control inp" type="password" value="" name="password2">
                                    <?=form_error(session('errors.password'), '<small class="text-danger pl-3">', '</small>'); ?>
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