<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

	<section>
		<div class="w-100 pt-80 position-relative">
			<img class="img-fluid sec-top-mckp position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-top-mckp2.png" alt="Sec Top Mockup 2">
			<div class="container">
				<div class="page-title-wrap text-center w-100">
					<div class="page-title-inner d-inline-block">
						<h1 class="mb-0">APBDes <?= $desa["nama_desa"] ?></h1>
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>" title="Beranda">Beranda</a></li>
							<li class="breadcrumb-item active">APBDes <?= $desa["nama_desa"] ?></li>
						</ol>
					</div>
				</div><!-- Page Title Wrap -->
			</div>
		</div>
	</section>
	<section>
		<div class="w-100 pt-80 pb-210 position-relative">
			<img class="sec-botm-rgt-mckp img-fluid position-absolute" src="<?= base_url("$this->theme_folder/$this->theme/"); ?>assets/images/sec-botm-mckp2.png" alt="Sec Bottom Mockup">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12">
					<style>
						.widget-tabs-int { margin-top: 0px;padding:20px;background:#fff; }
						.tab-hd{ margin-bottom:20px; }
						.tab-hd h2 {font-size:20px; color:#333;}
						.breadcomb-ctn { margin-left: 20px;}
						.breadcomb-ctn h2{ font-size:20px; color:#333;}
						.breadcomb-ctn p{ font-size:14px; color:#333; margin:0px;}
						.table.table-condensed>tbody>tr>td, .table.table-condensed>tbody>tr>th, .table.table-condensed>tfoot>tr>td, .table.table-condensed>tfoot>tr>th, .table.table-condensed>thead>tr>td, .table.table-condensed>thead>tr>th{
							border-top: 1px solid #F5F5F5; font-size:12px; color:#333; padding:10px;}
						.accordion-stn .panel-group {margin-bottom: 0px;}
						.accordion-stn .panel-body{padding-top:20px;padding-bottom: 0px;}
						.panel-group[data-collapse-color=nk-green] .panel-collapse .panel-heading.active .panel-title>a:after{
							background:#00c292
						}
						.panel-group[data-collapse-color=nk-red] .panel-collapse .panel-heading.active .panel-title>a:after{
							background:#F44336
						}
					</style>
					<?php
					
						$url = 'https://sid.kemendesa.go.id/home/apbdes/3514212010';
						$content = file_get_contents($url);
						$first_step = explode( '<div class="tabs-info-area">' , $content );
						$second_step = explode('<div class="footer-copyright-area">', $first_step[1] );
					
						echo $second_step[0];
					?>

					</div>
				</div>				
			</div>
		</div>
	</section>