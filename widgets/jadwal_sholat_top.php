<?php if (config_item('kode_kota')): ?>
	<script>
		const KODE_KOTA = "<?= config_item('kode_kota') ?>";
		const TANGGAL = "<?= date('Y-m-d') ?>";
		const BESOK = "<?= date("Y-m-d", mktime(0,0,0,date("n"),date("j")+1,date("Y"))) ?>";
	</script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/widget.min.js") ?>"></script>

	<section>
		<div class="w-100 position-relative">
			<div class="time-wrap2 w-100">
				<div class="row align-items-center">
					<div class="col-md-12 col-sm-12 col-lg-4">
						<div class="time-title w-100">
							<h4 class="mb-0">Jadwal Sholat & Imsak</h4>
							<p class="mb-0 thm-clr">
								<span data-name="tanggal"></span> di 
								<span data-name="kota"></span>
							</p>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-lg-8">
						<ul class="time-list2 d-flex flex-wrap w-100 mb-0 list-unstyled text-center">
							<li id="jadwal-shalat"><span>Imsak </span> <h5 data-name="imsak" class="mb-0"><i class="fa fa-spinner fa-pulse"></i></h5> </li>
							<li id="jadwal-shalat"><span>Subuh </span><h5 data-name="subuh" class="mb-0"><i class="fa fa-spinner fa-pulse"></i></h5> </li>
							<li id="jadwal-shalat"><span>Dhuhur </span><h5 data-name="dzuhur" class="mb-0"><i class="fa fa-spinner fa-pulse"></i></h5> </li>
							<li id="jadwal-shalat"><span>Ashar </span><h5 data-name="ashar" class="mb-0"><i class="fa fa-spinner fa-pulse"></i></h5> </li>
							<li id="jadwal-shalat"><span>Maghrib </span><h5 data-name="maghrib" class="mb-0"><i class="fa fa-spinner fa-pulse"></i></h5> </li>
							<li id="jadwal-shalat"><span>Isya' </span><h5 data-name="isya" class="mb-0"><i class="fa fa-spinner fa-pulse"></i></h5> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
