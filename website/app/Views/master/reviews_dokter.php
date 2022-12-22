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
                                    <th scope="col">Reviewer</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Star</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($reviews as $review) : ?>
                                    <tr>
                                        <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                        <td><?= $review['fullname']; ?></td>    
                                        <td><?= $review['description']; ?></td>    
                                        <td><?= $review['star']; ?></td>    
                                        <td><?= $review['created_at']; ?></td>                                        
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
<?= $this->endSection() ?>