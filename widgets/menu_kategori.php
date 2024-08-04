<div class="widget2 w-100">
	<h3 class="widget-title2">Kategori</h3>
	<ul class="cate-list mb-0 list-unstyled w-100">
	<?php foreach($menu_kiri as $data):?>	
		<li> <a href="<?= site_url("artikel/kategori/$data[slug]"); ?>"><?= $data['kategori']; ?> </a> (<?= count($data['kategori'])?>)</li>
		<?php if(count($data['submenu'])>0): ?>
			<ul class="nav submenu">
				<?php foreach($data['submenu'] as $submenu):?>
					<li><a href="<?= site_url("artikel/kategori/$submenu[slug]"); ?>"><?= $submenu['kategori']?></a></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php endforeach;?>
	</ul>
</div>