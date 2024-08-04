<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php foreach ($teks_berjalan AS $teks): ?>
	<h6 href="#" style="color:#ffffff;" > <?= $teks['teks']?>
	<?php if ($teks['tautan']): ?>
		<a href="<?= $teks['tautan'] ?>" title="Baca Selengkapnya"><?= $teks['judul_tautan']?></a>
	<?php endif; ?>
	</h6> 
<?php endforeach; ?>
