<!--<section class="after-header">-->
  <div class="container">
    <div class="row">
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="list-group">
          <div class="text-center">
              <? foreach($gambar as $url){ ?>
            <img style="height : 100px; width : 100px;" src="<?=base_url()?>assets/images/foto/<?= ($url->user_imgurl !== "" ? $url->user_imgurl : "fotoprofil.png")?>" alt="">
            <? } ?>
            <div style="font-size: 18;"><?php echo $pname ?></div>
            <div>Bergabung pada <?php echo date_format(new DateTime($pcdate), 'd M Y') ?></div><br>
          </div>
        </div>
        <div class="list-group">
          <a href="<?=base_url()?>profil/" class="list-group-item <?php echo ($pages == "dashboard" ? "active" : "")?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>
          <a href="<?=base_url()?>profil/akun" class="list-group-item <?php echo ($pages == "akun" ? "active" : "")?>">
            <i class="far fa-user"></i> Akun
          </a>
          <a href="<?=base_url()?>profil/lelang/" class="list-group-item <?php echo ($pages == "lelang_saya" ? "active" : "")?>">
            <i class="fas fa-hammer"></i> Lelang Saya
          </a>
          <a href="<?=base_url()?>profil/tawaran" class="list-group-item <?php echo ($pages == "tawaran_saya" ? "active" : "")?>">
            <i class="far fa-save"></i> Tawaran Saya
          </a>
          <!--<a href="<?=base_url()?>client/#" class="list-group-item ">-->
          <!--  <i class="far fa-money-bill-alt"></i> Transaksi-->
          <!--</a>-->
          <a href="<?=base_url()?>profil/password/#" class="list-group-item <?php echo ($pages == "password" ? "active" : "")?>">
            <i class="fas fa-key"></i> Ubah Password
          </a>
          <a href="<?=base_url()?>login/logout" class="list-group-item ">
            <i class="fas fa-door-closed"></i> Keluar
          </a>
        </div>
      </div>
      <div class="col-md-9 mb-4 mb-md-0 konten-profil">
          <?php $this->load->view("profil/".$view); ?>
      </div>
    </div>
  </div>
<!--</section>-->
