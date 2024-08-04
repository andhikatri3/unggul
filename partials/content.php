<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("$folder_themes/partials/slider.php"); ?>

<?php if ($this->setting->covid_data) $this->load->view($folder_themes."/partials/corona-widget.php")?>
<?php if ($this->setting->covid_desa) $this->load->view($folder_themes."/partials/corona-local.php");?>

<?php if ($headline): ?>
    <?php $abstrak_headline = potong_teks($headline['isi'], 100) ?>    
        <section>
            <div class="w-100 pt-50 pb-50 position-relative">
                <img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
                <div class="container">
                    <div class="blog-wrap2 w-100">
                        <div class="post-box2 position-relative d-flex flex-wrap align-items-center w-100">
                            <div class="post-img2 overflow-hidden position-absolute">
                                <a href="<?= site_url('artikel/'.buat_slug($headline))?>" title="<?= $headline['judul'] ?>">
                                <img class="img-fluid w-100" src="<?= AmbilFotoArtikel($headline['gambar'],'sedang') ?>" alt="<?= $headline['judul'] ?>"></a>
                            </div>
                            <div class="post-info2">
                                <div class="post-info2-inner text-center">
                                    <div class="post-date2">
                                    <?php
                                        $tglx   = explode(" ",tgl_indo($headline['tgl_upload']));                                        
                                    ?>
                                        <span class="d-block"><?= $tglx[0] ?></span>
                                        <i class="d-block thm-bg"><?= $tglx[1].' '.$tglx[2] ?></i>
                                    </div>
                                    <div class="post-meta4 w-100">
                                        <span class="d-block"><i class="far fa-eye"></i><?= hit($headline['hit'])?> Dilihat</span>
                                        <span class="d-block"><i class="far fa-comment"></i><?php $baca_komentar = $this->db->query("SELECT * FROM komentar WHERE id_artikel = '".$headline['id']."'"); $komentarku = $baca_komentar->num_rows();
                            echo number_format($komentarku,0,',','.'); ?></span>
                                    </div>
                                </div>
                                <ul class="post-meta2 d-inline-flex flex-wrap align-items-center mb-0 list-unstyled">
                                    <li class="thm-clr">Oleh: <a href="javascript:void(0);" title="<?= $headline['owner']?>"><?= $headline['owner']?></a></li>
                                    <li class="thm-clr"> <a href="<?= site_url('first/kategori/'.$abstrak_headline['id_kategori'])?>"><?= $headline['kategori']?></a></li>
                                </ul>
                                <h3 class="mb-0"><a href="<?= site_url('artikel/'.buat_slug($headline))?>" title="<?= $headline['judul'] ?>"><?= $headline['judul'] ?></a></h3>
                                <p class="mb-0"><?= $abstrak_headline ?> ...</p>
                                <a class="thm-btn thm-bg" href="<?= site_url('artikel/'.buat_slug($headline))?>" title="<?= $headline['judul'] ?>">Selengkapnya ... <span></span><span></span><span></span><span></span></a>
                                <div class="post-share position-relative">
                                    <i class="fas fa-share"></i>
                                    <span class="post-share-social position-absolute">                                        
                                        <a href="http://www.facebook.com/sharer.php?u=<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Facebook'>
                                            <i class="fab fa-facebook"></i></a>
                                        <a href="http://twitter.com/share?source=sharethiscom&text=<?= htmlspecialchars($abstrak_headline["judul"]);?>%0A&url=<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'&via=ariandii'?>" class="twitter-share-button" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Twitter'>
                                            <i class="fab fa-twitter"></i></a>
                                        <a href="https://t.me/share/url?url=<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>&text=<?= htmlspecialchars($abstrak_headline["judul"]);?>%0A" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Telegram'>
                                            <i class="fab fa-telegram"></i></a>
                                        <a href="https://api.whatsapp.com/send?text=<?= htmlspecialchars($abstrak_headline["judul"]);?>%0A<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Whatsapp'>
                                            <i class="fab fa-whatsapp"></i></a>	
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

        <section>
            <div class="w-100 pt-50 pb-50 gray-layer">
                <div class="container">
                    <div class="sec-title v2 text-center w-100">
                        <div class="sec-title-inner d-inline-block">
                            <h2 class="mb-0">Berita Terbaru</h2>
                        </div>
                    </div>

                    <div class="serv-wrap2 w-100">
                        <div class="row">
                            
                        <?php foreach ($artikel as $data): ?>
                            <div class="col-md-6 col-lg-6">
                                <div class="serv-box2 position-relative w-100">
                                    <div class="serv-img overflow-hidden position-relative w-100">
                                        <a href="<?= site_url('artikel/'.buat_slug($data))?>" title="<?= $data["judul"] ?>">
                                        <?php if (is_file(LOKASI_FOTO_ARTIKEL."kecil_".$data['gambar'])): ?>
                                            <img class="img-fluid w-100" src="<?= AmbilFotoArtikel($data['gambar'],'sedang') ?>" alt="<?= $data["judul"] ?>"></a>
                                        <?php else: ?>
                                            <img class="img-fluid w-100" src="<?= base_url("$this->theme_folder/$this->theme/images/noimage.png") ?>" alt="<?= $data["judul"] ?>" />
                                        <?php endif;?>
                                    </div>
                                    <div class="serv-info post-info w-100" >
                                        <a class="thm-bg" href="<?= site_url('artikel/'.buat_slug($data))?>" title="<?= $data["judul"] ?>"><i class="fas fa-link"></i></a>
                                        <span class="post-date thm-clr"><?= tgl_indo($data['tgl_upload']);?></span>
                                        <h3><a href="<?= site_url('artikel/'.buat_slug($data))?>" title="<?= $data["judul"] ?>"> <?= $data["judul"] ?></a></h3>
                                        <ul class="post-meta d-flex flex-wrap mb-0 list-unstyled">
                                            <li><i class="fas fa-user-alt"></i><a href="javascript:void(0);" title="<?= $data['owner']?>"><?= $data['owner']?></a></li>
                                            <li><i class="fas fa-eye"></i><?= hit($data['hit']) ?> Dilihat</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="w-100 pt-80 thm-layer pb-50 opc7 position-relative">
                <div class="fixed-bg patern-bg back-blend-multiply thm-bg" style="background-image: url(assets/images/pattern-bg.jpg);"></div>
                <div class="container">
                    <div class="facts-wrap w-100">
                        <div class="row">
                            
							<?php foreach($stat_widget as $data): ?>
								<?php if ($data['jumlah'] != "-" AND $data['nama']!= "JUMLAH"): 
                                    $laki = $data['laki'];
                                    $perempuan = $data['perempuan'];
                                    $total = $laki + $perempuan;   
                                endif; ?>
							<?php endforeach; ?>
                            <div class="col-4">
                                <div class="fact-box d-flex flex-wrap align-items-center w-100">
                                    <span class="rounded-circle"><i class="fa fa-male"></i></span>
                                    <div class="fact-inner">
                                        <h3 class="mb-0 counter"><?=$laki?></h3>
                                        <h5 class="mb-0">Laki-Laki</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="fact-box d-flex flex-wrap align-items-center w-100">
                                    <span class="rounded-circle"><i class="fa fa-female"></i></span>
                                    <div class="fact-inner">
                                        <h3 class="mb-0 counter"><?=$perempuan?></h3>
                                        <h5 class="mb-0">Perempuan</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="fact-box d-flex flex-wrap align-items-center w-100">
                                    <span class="rounded-circle"><i class="fa fa-users"></i></span>
                                    <div class="fact-inner">
                                        <h3 class="mb-0 counter">
											<?= $total ?>
                                        </h3>
                                        <h5 class="mb-0">Total</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="w-100 gray-layer pt-50 pb-50 opc7 position-relative">
                <div class="fixed-bg patern-bg back-blend-multiply gray-bg" style="background-image: url(<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/pattern-bg.jpg);"></div>
                <div class="container">
                    <div class="sec-title v2 text-center w-100">
                        <div class="sec-title-inner d-inline-block">
                            <h2 class="mb-0">Galeri Album</h2>
                        </div>
                    </div><!-- Sec Title -->
                    <div class="gallery-wrap res-row w-100">
                        <div class="row">                                
                        <?php foreach ($w_gal As $data): ?>
                            <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])): ?>                            
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="gallery-box text-center overflow-hidden position-relative w-100">
                                    <img class="img-fluid w-100" src="<?= AmbilGaleri($data['gambar'],'kecil')?>" alt="<?= "$data[nama]" ?>" >
                                    <div class="gallery-info position-absolute">
                                        <h3 class="mb-0"><?= $data[nama] ?></h3>
                                        <a class="d-inline-block thm-clr" href="<?= site_url("first/sub_gallery/$data[id]"); ?>" title="<?= $data["nama"] ?>"><i class="flaticon-view"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?> 
                        </div>
                    </div>
                    <div class="view-more mt-20 d-inline-block text-center w-100">
                        <a class="thm-btn bg-color1" href="<?= site_url('first/gallery') ?>" title="Album Galeri">Semua Album</a>
                    </div>
                </div>
            </div>
        </section>
        
  <section>
    <div class="w-100 gray-layer pt-110 opc7 position-relative">
      <div class="fixed-bg patern-bg back-blend-multiply gray-bg" style="background-image: url(<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/pattern-bg.jpg);"></div>
      <img class="sec-btm-mckp img-fluid position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-botm-mckp2.png">
    </div>
  </section>