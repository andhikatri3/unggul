<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
           
<?php $this->load->view("$folder_themes/widgets/jadwal_sholat_top.php"); ?>                  
<section>
    <div class="w-100 gray-layer pt-50 pb-50 opc7 position-relative">
        <div class="owl-carousel owl-theme">
            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if(is_file($file_gambar)) : ?>
                <div class="item" <?php if ($slider_gambar['sumber'] != 3): ?> onclick="location.href='<?='artikel/'.buat_slug($gambar); ?>'" <?php endif; ?>>
                    <img src="<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>" alt="<?= $gambar['judul'] ?>" style="border-radius:3%;padding:0 10px;"/>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>