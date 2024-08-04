	<div class="widget2 w-100">
		<h3 class="widget-title2"><a href="<?= site_url();?>arsip">Artikel Terbaru</a></h3>
		<div class="mini-posts-wrap w-100">			
			<?php foreach (array('terkini' => 'arsip_terkini') as $jenis => $jenis_arsip): ?>				
			<?php foreach ($$jenis_arsip as $arsip): ?>
			<div class="mini-post-box d-flex flex-wrap w-100">			
				<?php if (is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$arsip[gambar])): ?>
				<a href="<?= site_url('artikel/'.buat_slug($arsip))?>">	
					<img class="img-fluid w-100" src="<?= base_url(LOKASI_FOTO_ARTIKEL.'kecil_'.$arsip[gambar])?>" alt="<?= $arsip['judul']?>"></a>
				<?php else: ?>
					<img class="img-fluid w-100" src="<?= base_url('assets/images/404-image-not-found.jpg')?>"/>
				<?php endif;?>
				<div class="mini-post-info">
					<span class="d-block thm-clr"><?= tgl_indo($arsip['tgl_upload']);?> </span>
					<h4 class="mb-0">
					<a href="<?= site_url('artikel/'.buat_slug($arsip))?>"><?= $arsip['judul']?></a></h4>
				</div>
			</div>
			<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</div>
                                