g<body>
  <style media="screen">
    .after-header {
      padding-top: 170px;
    }
    
    .card-boody {
        padding: 18px 20px 35px 20px;
    }
  </style>
  <!--<section class="after-header">-->
  <div class="containers">
    <!--<div class="row">-->
    <div class="section-intro text-center pb-80px">
      <div class="section-intro__style">
        <img src="<?=base_url()?>assets/web/img/home/news.png" alt="">
      </div>
      <h2 class="section-intro text-center ">News & Events</h2>
    </div>
    <!--</div>-->

    <div class="row">
      <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
        <div class="card card-news">
          <div class="card-news__img">
            <img class="card-img" src="<?=base_url()?>assets/web/img/home/explore1.png" alt="">
          </div>
          <div class="card-body">
            <h4 class="card-news__title"><a href="#">Hotel companies tipped the scales</a></h4>
            <ul class="card-news__info">
              <li><a href="#"><span class="news-icon"><i class="ti-notepad"></i></span> 20th Nov, 2018</a></li>
              <li><a href="#"><span class="news-icon"><i class="ti-comment"></i></span> 03 Comments</a></li>
            </ul>
            <p>Not thoughts all exercise blessing Indulgence way everything joy alteration boisterous the attachment party we years to order</p>
            <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
        <div class="card card-news">
          <div class="card-news__img">
            <img class="card-img" src="<?=base_url()?>assets/web/img/home/explore2.png" alt="">
          </div>
          <div class="card-body">
            <h4 class="card-news__title"><a href="#">Try your hand inaugural industry crossword</a></h4>
            <ul class="card-news__info">
              <li><a href="#"><span class="news-icon"><i class="ti-notepad"></i></span> 20th Nov, 2018</a></li>
              <li><a href="#"><span class="news-icon"><i class="ti-comment"></i></span> 03 Comments</a></li>
            </ul>
            <p>Not thoughts all exercise blessing Indulgence way everything joy alteration boisterous the attachment party we years to order</p>
            <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
        <div class="card card-news">
          <div class="card-news__img">
            <img class="card-img" src="<?=base_url()?>assets/web/img/home/explore3.png" alt="">
          </div>
          <div class="card-body">
            <h4 class="card-news__title"><a href="#">Hoteliers resolve to invest in guests</a></h4>
            <ul class="card-news__info">
              <li><a href="#"><span class="news-icon"><i class="ti-notepad"></i></span> 20th Nov, 2018</a></li>
              <li><a href="#"><span class="news-icon"><i class="ti-comment"></i></span> 03 Comments</a></li>
            </ul>
            <p>Not thoughts all exercise blessing Indulgence way everything joy alteration boisterous the attachment party we years to order</p>
            <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--</section>-->
  <!-- ================ news section end ================= -->
  <!-- ================ Daftar Lelang start ================= -->
  <section class="section-padding-small bg-porcelain">
    <div class="containers">
      <div class="section-intro text-center"><br><br>
        <div class="section-intro__style">
          <!-- <img src="<?=base_url()?>assets/web/img/home/bed-icon.png" alt=""> -->
        </div>
        <h2> Lelang Terbaru</h2>
      </div>

      <!--<div class="col-md-12 row">-->
      <div class="owl-carousel owl-theme testi-carousel" style="padding: 0px;">
        <?php $i=0; foreach($lelang as $l ){ ?>
        <!--<div class="col-md-6 col-lg-4 mb-4 mb-md-0 rounded-0">-->
        <div class="testi-carousel__item">
           <div class="card card-news"> 
              <div class="card-boody">
                  <div class="card-header bg-light border-success" style="border-width:5px;">
                    <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?=$l->lelang_judul;?></h5>
                  </div>
                  <div class="card-boody">
                    <h5 class="card-title pull-right">Rp. <cite><?=number_format($l->lelang_anggaran)?></cite></h5>
                    <span class="pull-right">(<?php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                    <div class="col-md-12 mt-3"></div>
                    <hr />
                    <span>
                        <a onclick="tampilproduk(this.id)" id="clickproduk<?=$i?>" href="#daftarP" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk(array ("lelang_id"=>$l->lelang_id))); ?>'>
                            <span class="badge badge-danger" id="lihatProduk"><?php echo $controller->getJumlahProduk($l->lelang_id); ?></span> Lihat Produk 
                        </a>
                    </span><br/>
                    <span>
                        <a onclick="tampiltawaran(this.id)" id="clicktawaran<?=$i?>" href="#daftartawaran" class="text-primary"  data-listtawaran='<?php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id))); ?>' >
                            <span class="badge badge-info"><?php echo $controller->getJumlahTawaran($l->lelang_id); ?> </span> Lihat Tawaran 
                        </a>
                    </span>
                    <p class="card-text">Deadline : <b><?php echo date_format(new DateTime($l->lelang_tglselesai), 'd M Y'); ?></b></p>
                    <!--Pemilik Lelang : <br/>-->
                    <hr />
                    <p class="card-text">
                      <a href="#" style="text-transform:capitalize;"><i class="far fa-user"></i>&ensp;<?php echo $controller->getUserDetail($l->lelang_userid)['user_nama']; ?></a><br />
                      <span style="text-transform:capitalize;"><i class="fas fa-home"></i>&ensp;<?php echo ($l->lelang_alamat)?$l->lelang_alamat:'-'; ?></span> <br/>
                      <b><i class="fas fa-map-marker-alt"></i> &nbsp;
                        <?php $kabprov = $controller->getKabProv($l->lelang_kota); echo "$kabprov->kab, $kabprov->prov";?><br />
                        <i class="fas fa-phone fa-rotate-90"></i>&ensp;(<?php $telp = $controller->getUserDetail($l->lelang_userid)['user_telpon']; echo ($telp)?$telp:' - '; ?>)
                      </b>
                    </p>
                    <!--Deskripsi : <br/>-->
                    <!--<hr/>-->
                    <!--<blockquote class="blockquote mb-0">-->
                    <!--  <footer class="blockquote-footer">-->
                    <!--      <p>-->
                    <!--          <?=substr($l->lelang_deskripsi, 0, 80)?><span id="dots">...</span><span id="more"><?=substr($l->lelang_deskripsi, 80)?>-->
                    <!--      </p>-->
                    <!--          <a href="#" onclick="myFunction()" id="myBtn">Read more</a>-->
                    <!--  </footer>-->
                    <!--</blockquote>-->
                    <div class="row mx-auto">
                        <a href="#" onclick="clickDetail(this.id)" class="linkdetail" id="detaildesk<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php if ($cekbuttontawar) { ?>
                    <button type="button" class="btn btn-primary mt-3 pull-right" data-toggle="modal" data-target="#penawaran">
                      Ajukan Penawaran
                    </button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-primary mt-3 pull-right" data-toggle="modal" data-target="#stop">
                      Ajukan Penawaran
                    </button>
                    <?php } ?>
                  </div>
              </div>
           </div> 
        </div>
        <?php $i++;} ?>
        <!--<div class="col-md-6 col-lg-4 mb-4 mb-md-0">-->
        <!--  <div class="card card-news">-->
        <!--    <div class="card-body">-->
        <!--      <h4 class="card-news__title"><a href="#">Percetakan kartu nama dan undangan</a></h4>-->
        <!--      <h5>Rp 5.000.000 </h5>-->
        <!--      <ul class="card-news__info">-->
        <!--        <li><a href="#"><span class="news-icon"><i class="ti-id-badge"></i></span>SMA 1 Malang </a></li>-->
        <!--        <li><span class="news-icon"><i class="ti-user"></i></span> 0 Tawaran</li>-->
        <!--      </ul>-->
        <!--      <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <!--<div class="col-md-6 col-lg-4 mb-4 mb-md-0">-->
        <!--  <div class="card card-news">-->
        <!--    <div class="card-body">-->
        <!--      <h4 class="card-news__title"><a href="#">Percetakan kartu nama dan undangan</a></h4>-->
        <!--      <h5>Rp 5.000.000 </h5>-->
        <!--      <ul class="card-news__info">-->
        <!--        <li><a href="#"><span class="news-icon"><i class="ti-id-badge"></i></span>SMA 1 Malang </a></li>-->
        <!--        <li><span class="news-icon"><i class="ti-user"></i></span> 0 Tawaran</li>-->
        <!--      </ul>-->
        <!--      <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <!--<div class="col-md-6 col-lg-4 mb-4 mb-md-0">-->
        <!--  <div class="card card-news">-->
        <!--    <div class="card-body">-->
        <!--      <h4 class="card-news__title"><a href="#">Percetakan kartu nama dan undangan</a></h4>-->
        <!--      <h5>Rp 5.000.000 </h5>-->
        <!--      <ul class="card-news__info">-->
        <!--        <li><a href="#"><span class="news-icon"><i class="ti-id-badge"></i></span>SMA 1 Malang </a></li>-->
        <!--        <li><span class="news-icon"><i class="ti-user"></i></span> 0 Tawaran</li>-->
        <!--      </ul>-->
        <!--      <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->

      </div>
      <br>
      <!--<div class="section-padding-small text-center pb-100px">-->
      <!--  <h3><a class="button-lihat" href="https://lelang.agsgroup.co.id/lelang/tampil">Tampilkan Semua lelang</a></h3>-->
      <!--</div><br>-->
    </div>
    <div class="row">
    </div>
  </section>
  <section class="section-margin--small">
  </section>
  <!-- Modal stop -->
  <div class="modal fade" id="stop" tabindex="-1" role="dialog" aria-labelledby="stopModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <h3 >Silahkan Login Dulu !</h3>
                <br>
                <!--<a href="https://lelang.agsgroup.co.id/login" class="btn btn-submit">Login</a>-->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="location.href='https://lelang.agsgroup.co.id/login';" >Login</button>
        </div>
      </div>
    </div>
  <!--</div>-->

  <!-- ================ Daftar Lelang end ================= -->



  <!-- ================ carousel section start ================= -->
  <!--<section class="selection-margin--small ">-->
  <!--  <div class="container">-->
  <!--    <div class="section-intro text-center pb-20px">-->
  <!--      <div class="section-intro__style">-->
  <!--        <img src="<?=base_url()?>assets/web/img/home/bed-icon.png" alt="">-->
  <!--      </div>-->
  <!--      <h2>Apa kata Meraka</h2>-->
  <!--    </div>-->
  <!--    <div class="owl-carousel owl-theme testi-carousel">-->
  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial1.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>Robert Mack</h3>-->
  <!--              <p>Surabaya</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial2.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>David Alone</h3>-->
  <!--              <p>Malang</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial3.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>Adam Pallin</h3>-->
  <!--              <p>Jakarta</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial1.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>Robert Mack</h3>-->
  <!--              <p>Surabaya</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial2.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>David Alone</h3>-->
  <!--              <p>Medan</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial3.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>Adam Pallin</h3>-->
  <!--              <p>Malang</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial1.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>Robert Mack</h3>-->
  <!--              <p>Jakarta</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="testi-carousel__item">-->
  <!--        <div class="media">-->
  <!--          <div class="testi-carousel__img">-->
  <!--            <img src="<?=base_url()?>assets/web/img/home/testimonial2.png" alt="">-->
  <!--          </div>-->
  <!--          <div class="media-body">-->
  <!--            <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>-->
  <!--            <div class="testi-carousel__intro">-->
  <!--              <h3>David Alone</h3>-->
  <!--              <p>Bandung</p>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
        
  <!--    </div>-->
    </div>
  <!--</section><br>-->
</body>
<script>
  // $(document).ready(function () { 
  // });
</script>