<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if ($single_artikel["id"]) : ?>
	
    <section>
        <div class="w-100 pt-80 position-relative">
			<img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
            <div class="container">
                <div class="page-title-wrap text-center w-100">
                    <div class="page-title-inner d-inline-block">
                        <h1 class="mb-0">Detail Artikel</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>" title="Home">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="#" title="Artikel">Artikel</a></li>
                            <li class="breadcrumb-item active"><?= $single_artikel["judul"]?></li>
                        </ol>
                    </div>
                </div><!-- Page Title Wrap -->
            </div>
        </div>
    </section>
	<section>
        <div class="w-100 pt-80 pb-210 position-relative">
            <img class="sec-botm-rgt-mckp img-fluid position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-botm-mckp2.png" alt="<?= $single_artikel["judul"]?>">
            <div class="container">
                <div class="post-detail-wrap w-100">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-9">
                            <div class="post-detail-inner w-100">
                                <div class="post-detail-img w-100">                                    
                                <?php if ($single_artikel['gambar']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar'])): ?>
                                    <img class="img-fluid w-100" src="<?= AmbilFotoArtikel($single_artikel['gambar'],'sedang')?>" alt="<?= $single_artikel["judul"]?>">
                                <?php endif;?></div>
                                <div class="post-detail-info position-relative w-100">
                                    <div class="post-info2-inner text-center">
                                        <div class="post-date2">
                                        <?php $tglx = tgl_indo2($single_artikel['tgl_upload']);
                                            $tgl = explode(" ",$tglx);
                                        ?>
                                            <span class="d-block"><?= $tgl[0]?></span>
                                            <i class="d-block thm-bg"><?= $tgl[1].' '.$tgl[2]?></i>
                                        </div>
                                        <div class="post-meta4 w-100">
                                            <span class="d-block"><i class="far fa-eye"></i><?= hit($single_artikel['hit']) ?> Dilihat</span>
                                        </div>
                                    </div>
                                    <ul class="post-meta2 d-inline-flex flex-wrap align-items-center mb-0 list-unstyled">
                                        <?php if (trim($single_artikel['kategori']) != '') : ?>
                                        <li class="thm-clr">
                                            <a href="<?= site_url('first/kategori/'.$single_artikel['id_kategori'])?>">
                                                <i class='fa fa-tag'></i><?= $single_artikel['kategori']?></a>
                                        </li><?php endif; ?>
                                        <li class="thm-clr"><i class="fa fa-user"></i>&nbsp;oleh : <a href="javascript:void(0);" title="<?= $single_artikel['owner']?>"><?= $single_artikel['owner']?></a></li>
                                        <li class="thm-clr"><i class="fa fa-comment"></i> <a href="javascript:void(0);" title="<?= $single_artikel['judul']?>"><?php $baca_komentar = $this->db->query("SELECT * FROM komentar WHERE id_artikel = '".$headline['id']."'"); $komentarku = $baca_komentar->num_rows(); 
                                            echo number_format($komentarku,0,',','.'); ?></a></li>
                                    </ul>
                                    <h2 class="mb-0"><?= $single_artikel["judul"]?></h2>
                                </div>
                                
                                <div class="post-detail-desc w-100">
                                    <p class="mb-0"><?= $single_artikel["isi"]?></p>
                                    <?php if ($single_artikel['dokumen']!='' and is_file(LOKASI_DOKUMEN.$single_artikel['dokumen'])): ?>
                                        <p>Download Lampiran:<br><a href="<?= base_url().LOKASI_DOKUMEN.$single_artikel['dokumen']?>" title=""><?= $single_artikel['link_dokumen']?></a></p>
                                    <?php endif; ?>
                                    <?php if ($single_artikel['gambar1']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar1'])): ?>
                                        <p class="mb-0"><img class="img-fluid alignleft" src="<?= AmbilFotoArtikel($single_artikel['gambar1'],'sedang')?>" alt="<?= $single_artikel["judul"]?>"></p>
                                    <?php endif; ?>
                                    <?php if ($single_artikel['gambar2']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar2'])): ?>
                                        <p class="mb-0"><img class="img-fluid alignleft" src="<?= AmbilFotoArtikel($single_artikel['gambar2'],'sedang')?>" alt="<?= $single_artikel["judul"]?>"></p>
                                    <?php endif; ?>
                                    <?php if ($single_artikel['gambar3']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar3'])): ?>
                                        <p class="mb-0"><img class="img-fluid alignleft" src="<?= AmbilFotoArtikel($single_artikel['gambar3'],'sedang')?>" alt="<?= $single_artikel["judul"]?>"></p>
                                    <?php endif; ?>                                
                                </div>
                                
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- ads 728x90 -->
                                <ins class="adsbygoogle"
                                    style="display:inline-block;width:728px;height:90px"
                                    data-ad-client="ca-pub-7926427521678697"
                                    data-ad-slot="3739103187"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                                
                                <div class="share-tags-wrap d-flex flex-wrap w-100">
                                    <div class="share-links d-inline-flex">
                                        <span class="d-inline-block">Share This:</span>
                                        <div class="social-links4 v2 text-center d-inline-flex">
                                            <a href="http://www.facebook.com/sharer.php?u=<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Facebook'>
                                                <i class="fab fa-facebook fa-2x"></i></a>
                                            <a href="http://twitter.com/share?source=sharethiscom&text=<?= htmlspecialchars($single_artikel["judul"]);?>%0A&url=<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'&via=ariandii'?>" class="twitter-share-button" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Twitter'>
                                                <i class="fab fa-twitter fa-2x"></i></a>
                                            <a href="https://t.me/share/url?url=<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>&text=<?= htmlspecialchars($single_artikel["judul"]);?>%0A" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Telegram'>
                                                <i class="fab fa-telegram fa-2x"></i></a>
                                            <a href="https://api.whatsapp.com/send?text=<?= htmlspecialchars($single_artikel["judul"]);?>%0A<?= "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]?>" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Whatsapp'>
                                                <i class="fab fa-whatsapp fa-2x"></i></a>		
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="author-box-wrap w-100">
                                    <div class="author-box d-flex flex-wrap pat-bg gray-layer opc8 position-relative back-blend-multiply gray-bg w-100" style="background-image: url(<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/pattern-bg.jpg);">
                                        <!-- fb coment -->
                                        <?php if ($single_artikel['boleh_komentar'] == 1): ?>
                                            <div class="fb-comments" data-href="<?= site_url('artikel/'.buat_slug($single_artikel))?>" width="100%" data-numposts="5"></div>
                                        <?php endif; ?>
                                    </div>
                                </div><!-- Author Box Wrap -->
                                
                                <?php if (!empty($komentar)): ?>
                                <div class="comments-thread w-100">
                                    <h3 class="mb-0"><?= number_format($komentarku,0,',','.'); ?> Komentar</h3>
                                    <ul class="comments-list mb-0 list-unstyled w-100">
                                        
                                        <?php foreach ($komentar AS $data): ?>
                                        <li>
                                            <div class="comment d-flex flex-wrap pat-bg gray-layer opc8 position-relative back-blend-multiply gray-bg w-100" style="background-image: url(<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/pattern-bg.jpg);">
                                               
                                                <div class="comment-detail">
                                                    <h4 class="mb-0">
                                                    <i class="fa fa-user"></i> <?= $data['owner']?></h4> <small class="thm-clr"><?= tgl_indo2($data['tgl_upload'])?></small>
                                                    <p class="mb-0"><?= $data['komentar']?></p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div><!-- Comments Thread -->
		                        <?php endif; ?>
		                        <?php if ($single_artikel['boleh_komentar'] == 1): ?>
                                <div class="comment-reply w-100">
                                    <h3 class="mb-0">Tinggalkan Komentar:</h3><hr />
                                    <?php
                                        $notif = $this->session->flashdata('notif');
                                        $label = ($notif['status'] == -1) ? 'label-danger' : 'label-info';
                                    ?>
                                    <form class="w-100 contact_form form-komentar" id="validasi" name="form" action="<?= site_url("add_comment/$single_artikel[id]"); ?>" method="POST" onSubmit="return validasi(this);">
                
                                        <div class="row mrg5">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <input type="text" name="owner" placeholder="Nama Anda">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
                                                <input type="email" name="email" placeholder="Alamat Email">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
                                                <input type="text" name="no_hp" placeholder="No. HP">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <textarea placeholder="Komentar Anda"  name="komentar"><?= $notif['data']['komentar']; ?></textarea>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
                                                <img id="captcha" src="<?= base_url('securimage/securimage_show.php'); ?>" alt="CAPTCHA Image"/>
                                                <a href="#" onclick="document.getElementById('captcha').src = '<?= base_url()."securimage/securimage_show.php?"?>' + Math.random(); return false" style="color: #000000;">[ Ganti gambar ]</a>
                                                </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
                                                <input type="text" name="captcha_code" class="required" maxlength="6" value="<?= $notif['data']['captcha_code']; ?>" placeholder="Isikan kode di gambar" />                                                            
                                                <button class="thm-btn thm-bg" type="submit">Kirim<span></span><span></span><span></span><span></span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
		                        <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-3">                        
                            <aside class="sidebar w-100">
                            <?php $this->load->view("$folder_themes/partials/sidebar.php"); ?> 
                            </aside><!-- Sidebar -->
                        </div>
                    </div>
                </div><!-- Post Detail Wrap -->
            </div>
        </div>
    </section>
<?php else: ?>
	<section>
        <h1>404</h1>
        <h2>Maaf</h2>
        <h3>Halaman ini belum tersedia atau sedang dalam perbaikan</h3>
        <p class="wow fadeInLeftBig">Silahkan kembali lagi ke halaman <a href="<?= site_url(); ?>first">Beranda</a></p>
    </section>
<?php endif; ?>
