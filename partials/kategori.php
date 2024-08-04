<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <section>
        <div class="w-100 pt-80 position-relative">
            <img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
            <div class="container">
                <div class="page-title-wrap text-center w-100">
                    <div class="page-title-inner d-inline-block">
                        <?php 
                        $title = $judul_kategori;
                        if (is_array($title)): 
                            foreach ($title as $item):
                                $title = str_replace("-"," ",$item);
                            endforeach;
                        endif; 
                        ?>
                        <h1 class="mb-0"><?= $title?></h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>" title="Home">Beranda</a></li>
                            <li class="breadcrumb-item active"><?= $title?></li>
                        </ol>
                    </div>
                </div><!-- Page Title Wrap -->
            </div>
        </div>
    </section>

        <section>
            <div class="w-100 pt-50 pb-50">
                <div class="container">
                    <div class="serv-wrap2 w-100">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-9">    
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
                                
                                <div class="pagination-wrap mt-40 d-flex flex-wrap justify-content-center text-center w-100">
                                    <ul class="pagination mb-0">
                                    <?php 
                                    if($paging->start_link){
                                    echo ' <li class="page-item prev"><a class="page-link" href="'.site_url($paging_page."/$paging->start_link" . $paging->suffix).'" title="Halaman Pertama">
                                    <i class="fa fa-fast-backward"></i></a></li>';
                                    }
                                    if($paging->prev){
                                        echo '<li class="page-item prev"><a class="page-link" href="'.site_url("first/gallery/$paging->prev").'" title="Halaman Sebelumnya">
                                        <i class="fas fa-long-arrow-alt-left"></i></a></li>';
                                    }

                                    foreach($pages as $i) {
                                        $strC = ($p == $i)? 'active' : '';
                                        echo'<li class="page-item '.$strC.'"><a class="page-link" href="'.site_url($paging_page."/$i" . $paging->suffix).'" title="Halaman '.$i.'">'.$i.'</a></li>';
                                    }

                                    if ($i != $paging->end_link) {
                                        echo '<li> ... </li>';
                                    }

                                    if($paging->next){
                                        echo'<li class="page-item next"><a class="page-link" href="'.site_url("first/gallery/$paging->next").'" title="Halaman Selanjutnya">
                                        <i class="fas fa-long-arrow-alt-right"></i></a></li>';
                                    }
                                    if($paging->end_link){
                                        echo "<li class='page-item next'><a class='page-link' href=\"".site_url($paging_page."/$paging->end_link" . $paging->suffix)."\" title=\"Halaman Terakhir\">
                                        <i class=\"fa fa-fast-forward\"></i>&nbsp;</a></li>";
                                    }

                                    ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-lg-3">                        
                                <aside class="sidebar w-100">
                                <?php $this->load->view("$folder_themes/partials/sidebar.php"); ?> 
                                </aside>
                                
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- ads 300x250 -->
                                <ins class="adsbygoogle"
                                    style="display:block"
                                    data-ad-client="ca-pub-7926427521678697"
                                    data-ad-slot="4758162079"
                                    data-ad-format="auto"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

    <section>
        <div class="w-100  pt-110 opc7 position-relative">
            <img class="sec-btm-mckp img-fluid position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-botm-mckp2.png">
        </div>
    </section>