<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <?php $this->load->view("$folder_themes/partials/meta.php"); ?>
    <?php $this->load->view('head_tags_front') ?>
  </head>

  <body>
    <main>
      <?php $this->load->view("$folder_themes/partials/header.php"); ?>
    
      <?php $this->load->view("$folder_themes/partials/content.php"); ?>      
    
      <?php $this->load->view("$folder_themes/partials/footer_top.php"); ?> 

    </main>
    <script src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/js/counterup.min.js"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/js/jquery.fancybox.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/js/custom-scripts.js"></script>
    <!-- owl javascript -->
    <script src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/owlcarousel/owl.carousel.js"></script>
    
    <script>
      $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
          loop: true,
          margin: 10,
          nav: false,
          autoplay:true,
          autoplayTimeout:5000,
          autoplayHoverPause:true,
          responsive: {
            0: {
              items: 1
            },
            600: {
              items: 1
            },
            1000: {
              items: 1,
              stagePadding: 300,
              margin: 10
            }
          }
        })
      })
    </script>
  </body>
</html>