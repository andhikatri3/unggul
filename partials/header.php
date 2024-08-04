<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

  <header class="stick style2 w-100">
    <div class="topbar bg-color1 d-flex flex-wrap justify-content-between w-100">
      <div class="topbar-left">      
        <ul class="mb-0 list-unstyled d-inline-flex" style="padding-top:15px;">
          <li>
          <?php if (!empty($teks_berjalan)): ?>
            <marquee onmouseover="this.stop()" onmouseout="this.start()">
              <?php $this->load->view($folder_themes.'/layouts/teks_berjalan.php') ?>
            </marquee>
          <?php endif; ?>
          </li>
        </ul>        
      </div>
      <div class="topbar-right d-inline-flex">
        <ul class="topbar-info-list mb-0 list-unstyled d-inline-flex">
          <li><i class="thm-clr fa fa-clock"></i><a id="jam" href="javascript:void(0);"></a></li>
        </ul>
        <div class="social-links d-inline-flex">            
          <?php foreach ($sosmed As $data): ?>
            <?php if (!empty($data["link"])): ?>
              <a href="<?= $data['link']?>" title="<?= strtolower($data['nama']) ?>" target="_blank"><i class="fab fa-<?= strtolower($data['nama']) ?>"></i></a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div><!-- Topbar -->
    <div class="logo-menu-wrap v2 d-flex flex-wrap align-items-center justify-content-between w-100 pat-bg thm-layer opc65 back-blend-multiply thm-bg" style="background-image: url(assets/images/pattern-bg.jpg);">
      <div class="d-flex logo">
        <a href="<?= site_url(); ?>"  alt="<?= $desa['nama_desa']?>">
          <img class="img-fluid" src="<?= gambar_desa($desa['logo']);?>" style="height: 55px;float:left;margin-right: 10px;" alt="<?= $desa['nama_desa']?>">
        </a>       
        <a href="<?= site_url(); ?>" title="<?= $desa['nama_desa']?>" >
          <h4 class="mb-0" style="color:#fff;"><?= $this->setting->website_title. ' ' . ucwords($this->setting->sebutan_desa). (($desa['nama_desa']) ? ' ' . $desa['nama_desa'] : ''); ?></h4>
          <h6 class="mt-0" style="color:#fff;"><?= ucwords($this->setting->sebutan_kecamatan_singkat." ".$desa['nama_kecamatan'])?> <?= ucwords($this->setting->sebutan_kabupaten_singkat." ".$desa['nama_kabupaten'])?> Prov. <?= $desa['nama_propinsi']?></h6>
        </a>
      </div>
      <nav class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="header-left">
          <ul class="mb-0 list-unstyled d-inline-flex">                                      
            <li><a href="<?= site_url(); ?>" title="Beranda">Beranda</a></li>	
            <?php foreach($menu_atas as $data) { ?>					
            <li <?php if(count($data['submenu'])>0) echo 'class="menu-item-has-children"'; ?> title="<?= $data['nama']; ?>">
            <a href="<?= $data['link']?>"><?= $data['nama']; ?></a>
              <?php if(count($data['submenu'])>0): ?>  
                <ul class="mb-0 list-unstyled">
                  <?php foreach($data['submenu'] as $submenu): ?>
                  <li><a href="<?= $submenu['link']?>" title="<?= $submenu['nama']?>"><?= $submenu['nama']?></a> </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </li> 
            <?php } ?>
          </ul>
        </div>
      </nav>
    </div><!-- Logo Menu Wrap -->
  </header><!-- Header -->
  <div class="sticky-menu">
    <div class="container">
        <div class="sticky-menu-inner d-flex flex-wrap align-items-center justify-content-between w-100">
          <div class="d-flex logo">
            <a href="<?= site_url(); ?>" alt="<?= $desa['nama_desa']?>">
            <img class="img-fluid" src="<?= gambar_desa($desa['logo']);?>" alt="<?= $desa['nama_desa']?>" srcset="<?= gambar_desa($desa['logo']);?>" style="height: 55px;margin-right:10px;"></a>                     
          
              <a href="<?= site_url(); ?>" title="<?= $desa['nama_desa']?>" >
                <h4 class="mb-0"><?= $this->setting->website_title. ' ' . ucwords($this->setting->sebutan_desa). (($desa['nama_desa']) ? ' ' . $desa['nama_desa'] : ''); ?> </h4>
                <h6 class="mt-0"><?= ucwords($this->setting->sebutan_kecamatan_singkat." ".$desa['nama_kecamatan'])?> <?= ucwords($this->setting->sebutan_kabupaten_singkat." ".$desa['nama_kabupaten'])?> Prov. <?= $desa['nama_propinsi']?></h6>
              </a>
          </div>
          <nav class="d-flex flex-wrap align-items-center justify-content-between">
            <div class="header-left">
                <ul class="mb-0 list-unstyled d-inline-flex">                      
                  <li><a href="<?= site_url(); ?>">Beranda</a></li>	
                  <?php foreach($menu_atas as $data) { ?>					
                  <li <?php if(count($data['submenu'])>0) echo 'class="menu-item-has-children"'; ?> >
                  <a href="<?= $data['link']?>"><?= $data['nama']; ?></a>
                    <?php if(count($data['submenu'])>0): ?>  
                      <ul class="mb-0 list-unstyled">
                        <?php foreach($data['submenu'] as $submenu): ?>
                        <li><a href="<?= $submenu['link']?>"><?= $submenu['nama']?></a> </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </li> 
                  <?php } ?>
                </ul>
            </div>
          </nav>
        </div>
    </div>
  </div><!-- Sticky Menu -->
  <div class="rspn-hdr">
    <div class="rspn-mdbr">
        <div class="rspn-scil">                  
            <?php foreach ($sosmed As $data): ?>
              <?php if (!empty($data["link"])): ?>
                <a href="<?= $data['link']?>" title="<?= strtolower($data['nama']) ?>" target="_blank"><i class="fab fa-<?= strtolower($data['nama']) ?>"></i></a>
              <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <form class="rspn-srch" method="post" action="<?= site_url(); ?>">
            <input type="text" name="cari" placeholder="Cari artikel">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="lg-mn">
        <div class="logo" style="width:100%;">
          <a href="<?= site_url(); ?>" title="<?= $this->setting->website_title. ' ' . ucwords($this->setting->sebutan_desa). (($desa['nama_desa']) ? ' ' . $desa['nama_desa'] : ''); ?>">
            <img src="<?= gambar_desa($desa['logo']);?>" alt="Desa <?= $desa['nama_desa']?>" style="max-width: 50px;float:left;margin-right: 5px;">
    
            <h4 class="mb-0"><?= ucwords($this->setting->sebutan_desa). (($desa['nama_desa']) ? ' ' . $desa['nama_desa'] : ''); ?> </h4>
            <h6 class="mt-0"><?= ucwords($this->setting->sebutan_kecamatan_singkat." ".$desa['nama_kecamatan'])?> <?= ucwords($this->setting->sebutan_kabupaten_singkat." ".$desa['nama_kabupaten'])?> </h6>
          </a>
        </div>
        <div class="rspn-cnt">            
          <?php if (!empty($desa['email_desa'])): ?>
            <span><i class="thm-clr far fa-envelope"></i><a href="mailto:<?= $desa['email_desa'] ?>" title="<?= $desa['email_desa'] ?>" target="_top"> <?= $desa['email_desa']?></a></span>
          <?php endif; ?>            
          <?php if (!empty($desa['telepon'])): ?>
            <span><i class="thm-clr fas fa-phone-alt"></i><?= $desa['telepon']?></span>
          <?php endif; ?>
        </div>
        <span class="rspn-mnu-btn"><i class="fa fa-list-ul"></i></span>
    </div>
    <div class="rsnp-mnu">
        <span class="rspn-mnu-cls"><i class="fa fa-times"></i></span>
        <ul class="mb-0 list-unstyled w-100">                         
          <li><a href="<?= site_url(); ?>" title="Beranda">Beranda</a></li>	
          <?php foreach($menu_atas as $data) { ?>					
          <li <?php if(count($data['submenu'])>0) echo 'class="menu-item-has-children"'; ?> title="<?= $data['nama']; ?>">
          <a href="<?= $data['link']?>"><?= $data['nama']; ?></a>
            <?php if(count($data['submenu'])>0): ?>  
              <ul class="mb-0 list-unstyled">
                <?php foreach($data['submenu'] as $submenu): ?>
                <li><a href="<?= $submenu['link']?>" title="<?= $submenu['nama']?>"><?= $submenu['nama']?></a> </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li> 
          <?php } ?>
        </ul>
    </div>
  </div>