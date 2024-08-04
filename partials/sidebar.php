<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
	
	<?php
	if ($w_cos):
		foreach ($w_cos as $data):
			$widget = trim($data['isi']);
			if ($data["jenis_widget"] == 1):
				include("$this->theme_folder/$this->theme/widgets/".$widget);
			elseif ($data["jenis_widget"] == 2):
				include($widget);
				else: ?>
					<div class="single_bottom_rightbar">
						<h2><i class="fa fa-folder"></i> <?=$data["judul"]?></h2>
						<div class="box-body">
							<?=html_entity_decode($data['isi'])?>
						</div>
					</div>
				<?php endif;
			endforeach;
		endif;
		?>
