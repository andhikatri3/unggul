<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section>
		<div class="w-100 pt-80 position-relative">
			<img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
			<div class="container">
				<div class="page-title-wrap text-center w-100">
					<div class="page-title-inner d-inline-block">
						<h1 class="mb-0">Galeri Album <?= $parrent[nama] ?></h1>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>" title="Beranda">Beranda</a></li>
							<li class="breadcrumb-item"><a href="<?= site_url('first/gallery'); ?>" title="Galeri Album">Galeri Album </a></li>
							<li class="breadcrumb-item active"><?= $parrent[nama] ?></li>
						</ol>
					</div>
				</div><!-- Page Title Wrap -->
			</div>
		</div>
	</section>
	<section>
		<div class="w-100 pt-120 pb-250 position-relative">
			<img class="sec-botm-rgt-mckp img-fluid position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-botm-mckp2.png" alt="Sec Bottom Mockup">
			<div class="container">
				<div class="gallery-wrap w-100">
					<div class="row mrg">					
					<?php
					$i=1;
					foreach($gallery AS $data){
						if(is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) {
							echo '
							
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <div class="gallery-box text-center overflow-hidden position-relative w-100">
                                    <img class="img-fluid w-100" src="'.AmbilGaleri($data['gambar'],'sedang').'" alt="'. $data["nama"].'">
                                    <div class="gallery-info position-absolute">
                                        <h3 class="mb-0">'. $data["nama"].'</h3>
                                        <a class="d-inline-block thm-clr" href="'.AmbilGaleri($data['gambar'],'sedang').'" data-fancybox="gallery" title="'. $data["nama"].'"><i class="flaticon-view"></i></a>
                                    </div>
                                </div>
                            </div>';
							if(fmod($i,2)==0){echo "";}
							$i++;
						}
					}					
					?>
					</div>
				</div><!-- Gallery Wrap -->
				<div class="pagination-wrap mt-40 d-flex flex-wrap justify-content-center text-center w-100">
					<ul class="pagination mb-0">
					<?php 
					if($paging->start_link){
					echo ' <li class="page-item prev"><a class="page-link" href="'.site_url("first/sub_gallery/$parrent[id]/$paging->start_link").'" title="Halaman Pertama">
					<i class="fa fa-fast-backward"></i></a></li>';
					}
					if($paging->prev){
						echo '<li class="page-item prev"><a class="page-link" href="'.site_url("first/sub_gallery/$parrent[id]/$paging->prev").'" title="Halaman Sebelumnya">
						<i class="fas fa-long-arrow-alt-left"></i></a></li>';
					}

					foreach($pages as $i) {
						$strC = ($p == $i)? 'active' : '';
						echo'<li class="page-item '.$strC.'"><a class="page-link" href="'.site_url("first/sub_gallery/$parrent[id]/$i").'" title="Halaman '.$i.'">'.$i.'</a></li>';
					}

					if($paging->next){
						echo'<li class="page-item next"><a class="page-link" href="'.site_url("first/sub_gallery/$parrent[id]/$paging->next").'" title="Halaman Selanjutnya">
						<i class="fas fa-long-arrow-alt-right"></i></a></li>';
					}
					if($paging->end_link){
						echo "<li class='page-item next'><a class='page-link' href=\"".site_url("first/sub_gallery/$parrent[id]/$paging->end_link")."\" title=\"Halaman Terakhir\">
						<i class=\"fa fa-fast-forward\"></i>&nbsp;</a></li>";
					}
					?>
					</ul>
				</div>
			</div>
		</div>
	</section>