<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <?php $this->load->view("$folder_themes/partials/meta.php"); ?>
</head>
  <body>
    <main>
      <?php $this->load->view("$folder_themes/partials/header.php"); ?>
    
	  	<?php if ($tipe == 2): ?>
			<?php $this->load->view($folder_themes.'/partials/statistik_sos.php'); ?>
		<?php elseif ($tipe == 3): ?>
			<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/wilayah.php')); ?>
		<?php elseif ($tipe == 4): ?>
			<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/dpt.php')); ?>
		<?php else: ?>
		<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/statistik.php')); ?>
		<?php endif; ?>    
    
      <?php $this->load->view("$folder_themes/partials/footer_top.php"); ?> 

    </main>
  </body>
</html>