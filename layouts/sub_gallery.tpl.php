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
    
      <?php $this->load->view("$folder_themes/partials/sub_gallery.php"); ?>      
    
      <?php $this->load->view("$folder_themes/partials/footer_top.php"); ?> 

    </main>
  </body>
</html>
