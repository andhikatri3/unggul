<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section>
	<div class="w-100 pt-80 position-relative">
		<img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
		<div class="container">
			<div class="page-title-wrap text-center w-100">
				<div class="page-title-inner d-inline-block">
					<h1 class="mb-0">Data Demografi Berdasar <?=$heading?></h1>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>" title="Home">Beranda</a></li>
						<li class="breadcrumb-item active">Data Demografi Berdasar <?=$heading?></li>
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
					<div class="col-md-12 col-sm-12 col-lg-12">
					<?php if(count($main) > 0) : ?>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th><?= ucwords($this->setting->sebutan_dusun)?></th>
								<th>RW</th>
								<th>RT</th>
								<th>Nama Kepala/Ketua</th>
								<th class="center">KK</th>
								<th class="center">L+P</th>
								<th class="center">L</th>
								<th class="center">P</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($main as $indeks => $data): ?>
								<tr>
									<td align="center"><?= $indeks + 1?></td>
									<td><?= ($main[$indeks - 1]['dusun'] == $data['dusun']) ? '' : strtoupper($data['dusun'])?></td>
									<td><?= ($main[$indeks - 1]['rw'] == $data['rw']) ? '' : $data['rw']?></td>
									<td><?= $data['rt']?></td>
									<td><?= $data['nama_kepala']?></td>
									<td align="right"><?= $data['jumlah_kk']?></td>
									<td align="right"><?= $data['jumlah_warga']?></td>
									<td align="right"><?= $data['jumlah_warga_l']?></td>
									<td align="right"><?= $data['jumlah_warga_p']?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr style="background-color:#0a993c;font-weight:bold;color:#fff;">
								<td colspan="5" align="left"><label>TOTAL</label></td>
								<td align="right"><?= $total['total_kk']?></td>
								<td align="right"><?= $total['total_warga']?></td>
								<td align="right"><?= $total['total_warga_l']?></td>
								<td align="right"><?= $total['total_warga_p']?></td>
							</tr>
						</tfoot>
					</table>
					<?php else : ?>
						Belum ada data...
					<?php endif ?>			
					</div>
				</div>
			</div>
		</div>
	</div>
</section>