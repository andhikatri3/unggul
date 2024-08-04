<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php if (!is_null($transparansi)) $this->load->view($folder_themes. '/partials/apbdesa-tema.php', $transparansi);?>
   
  <footer>
    <div class="w-100 pt-70 thm-layer pb-70 opc8 position-relative">
      <div class="fixed-bg patern-bg back-blend-multiply thm-bg" style="background-image: url(<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/pattern-bg.jpg);"></div>
        <div class="container">
          <div class="footer-data v2 w-100">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-3"> 
                <div class="widget w-100">
                  <h4 class="widget-title">Alamat </h4>
                  <ul class="cont-info-list2 mb-0 list-unstyled w-100">
                    <li><?= ucwords($this->setting->sebutan_desa." ")?> <?= ucwords($desa['nama_desa'])?></li>
                    <?php if (!empty($desa['telepon'])): ?><li>Telp: <?= $desa['telepon']?></li><?php endif; ?>
                    <?php if (!empty($desa['email_desa'])): ?><li>Email: <?= $desa['email_desa']?></li><?php endif; ?>
                    <li><?= $desa['alamat_kantor']?>
                    <?= ucwords($this->setting->sebutan_kecamatan." ".$desa['nama_kecamatan'])?> <?= ucwords($this->setting->sebutan_kabupaten." ".$desa['nama_kabupaten'])?> Provinsi <?= $desa['nama_propinsi']?> Kode Pos <?= $desa['kode_pos']?></li>
                  </ul>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-lg-9"> 
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-lg-6"> 
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6"> 
                        <div class="widget w-100">
                          <h4 class="widget-title">Kategori</h4>
                          <ul class="mb-0 list-unstyled w-100">                                
                            <?php foreach ($menu_kiri as $data): ?>
                              <li><a href="<?= site_url("artikel/kategori/$data[slug]"); ?>" title="<?= $data['kategori']; ?>"><?= $data['kategori']; ?></a></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-lg-6"> 
                        <div class="widget w-100">
                          <h4 class="widget-title">Data Desa</h4>
                          <ul class="mb-0 list-unstyled w-100">
                            <li><a href="javascript:void(0);" title="">IDM</a></li>
                            <li><a href="javascript:void(0);" title="">APBDes</a></li>
                            <li><a href="javascript:void(0);" title="">SDGs Desa</a></li>
                            <li><a href="javascript:void(0);" title="">Pagu Dana Desa</a></li>
                            <li><a href="javascript:void(0);" title="">BLT Dana Desa</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-6 col-lg-6"> 
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6"> 
                        <div class="widget w-100">
                            <h4 class="widget-title">Statistik</h4>
                            <ul class="mb-0 list-unstyled w-100">
                                <li><a href="<?= site_url(); ?>first/wilayah">Wilayah</a></li>
                                <li><a href="<?= site_url(); ?>first/statistik/0">Pendidikan</a></li>
                                <li><a href="<?= site_url(); ?>first/statistik/1">Pekerjaan</a></li>
                                <li><a href="<?= site_url(); ?>first/statistik/3">Agama </a></li>
                                <li><a href="<?= site_url(); ?>first/statistik/4">Jenis Kelamin</a></li>
                                <li><a href="<?= site_url(); ?>first/statistik/13">Umur</a></li>
                            </ul>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-lg-6"> 
                        <div class="widget w-100">
                          <h4 class="widget-title">Pengunjung</h4>                                   
                          <?php $this->load->view("$folder_themes/widgets/statistik_pengunjung.php"); ?> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="bottom-bar2 text-center w-100">
          <p class="mb-0">
            <a href="https://github.com/OpenSID/OpenSID" title="opensid" target="_blank">OpenSID 21.04-Pasca</a> | <a href="https://fb.com/andhika.tri" title="Unggul" target="_blank">Unggul v1.0</a></p>
          </div><!-- Bottom Bar -->
      </div>
    </div>
  </footer>