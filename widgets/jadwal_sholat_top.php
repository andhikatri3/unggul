<?php if (config_item('kode_kota')): ?>
<?php
	$tgl 	= date('Y-m-d');
	$tgl_besok = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
	$besok 	= date("Y-m-d", $tgl_besok);
	$kota 	= config_item('kode_kota');
	$kode 	= json_decode(file_get_contents('https://api.myquran.com/v2/sholat/kota/'.$kota), true);
	$nama 	= $kode['data']['lokasi'];
	$waktu 	= json_decode(file_get_contents('https://api.myquran.com/v2/sholat/jadwal/'.$kota.'/'.$tgl), true);
?>
	<section>
		<div class="w-100 position-relative">
			<div class="time-wrap2 w-100">
				<div class="row align-items-center">
					<div class="col-md-12 col-sm-12 col-lg-4">
						<div class="time-title w-100">
							<h4 class="mb-0">Jadwal Sholat & Imsak</h4>
							<p class="mb-0 thm-clr">
								<?= $waktu['data']['jadwal']['tanggal'] ?> di <?= $nama ?>
							</p>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-lg-8">
						<ul class="time-list2 d-flex flex-wrap w-100 mb-0 list-unstyled text-center">
							<li id="jadwal-shalat"><span>Imsak </span> <h5 class="mb-0"><?= $waktu['data']['jadwal']['imsak'] ?></h5> </li>
							<li id="jadwal-shalat"><span>Subuh </span><h5 class="mb-0"><?= $waktu['data']['jadwal']['subuh'] ?></h5> </li>
							<li id="jadwal-shalat"><span>Dhuhur </span><h5 class="mb-0"><?= $waktu['data']['jadwal']['dzuhur'] ?></h5> </li>
							<li id="jadwal-shalat"><span>Ashar </span><h5 class="mb-0"><?= $waktu['data']['jadwal']['ashar'] ?></h5> </li>
							<li id="jadwal-shalat"><span>Maghrib </span><h5 class="mb-0"><?= $waktu['data']['jadwal']['maghrib'] ?></h5> </li>
							<li id="jadwal-shalat"><span>Isya' </span><h5 class="mb-0"><?= $waktu['data']['jadwal']['isya'] ?></h5> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
