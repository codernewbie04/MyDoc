<?= $this->extend('template/template') ?>
 
<?= $this->section('content') ?>
<div class="main-content-inner">
    <div class="row mt-4">
        <!-- data table start -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-users"></i></div>
                            <h2><?=str_pad($total_berobat,4,'0',STR_PAD_LEFT);?></h2>
                            <span>Jumlah Berobat</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-user-plus"></i></div>
                            <h2><?=str_pad($total_pasien,4,'0',STR_PAD_LEFT);?></h2>
                            <span>Jumlah Pasien</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg3 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-medkit "></i></div>
                            <h2><?=str_pad($total_instansi,4,'0',STR_PAD_LEFT);?></h2>
                            <span>Total Instansi</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg4 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-stethoscope"></i></div>
                            <h2><?=str_pad($total_dokter,4,'0',STR_PAD_LEFT);?></h2>
                            <span>Total Dokter</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <canvas id="myKunjungan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <canvas id="myObat"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>