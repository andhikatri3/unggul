<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <?php $this->load->view("$folder_themes/partials/meta.php"); ?>
</head>
  <body>
    <main>
      <?php $this->load->view("$folder_themes/partials/header.php"); ?>   
      <section>
        <div class="w-100 pt-80 position-relative">
        <img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
          <div class="container">
            <div class="page-title-wrap text-center w-100">
              <div class="page-title-inner d-inline-block">
                <h1 class="mb-0">Peta</h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>" title="Home">Beranda</a></li>
                    <li class="breadcrumb-item active">Peta</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="w-100 pt-80 pb-210 position-relative">
          <img class="sec-botm-rgt-mckp img-fluid position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-botm-mckp2.png" alt="<?= $single_artikel["judul"]?>">
          <div class="container">
            <div class="post-detail-wrap w-100">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                  <?php $this->load->view($halaman_peta); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php $this->load->view("$folder_themes/partials/footer_top.php"); ?> 
    </main>
  </body>
</html>