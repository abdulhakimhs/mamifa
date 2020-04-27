<!-- Start Home Page Slider -->
<section id="page-top">
        <!-- Carousel -->
        <div id="main-slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
              <?php foreach ($slider as $key => $s) { ?>
                <li data-target="#main-slide" data-slide-to="<?= $key; ?>" class="<?= $key == 0 ? 'active' : '' ?>"></li>
              <?php } ?>
            </ol>
            <!--/ Indicators end-->

            <!-- Carousel inner -->
            <div class="carousel-inner">
              <?php foreach ($slider as $key => $s) { ?>
                <div class="<?= $key == 0 ? 'item active' : 'item' ?>">
                    <img class="img-responsive" src="<?= base_url('assets/backend/images/slider/'.$s->slide_image) ?>" alt="slider">
                    <div class="layer"></div>
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h1 class="animated1">
                    		      <span>
                                <?php 
                                  $title  = explode(' ', $s->slide_title);
                                  $last   = array_pop($title);
                                  $new_string = implode(' ', $title);
                                  echo $new_string;
                                ?>
                                <strong><?= $last; ?></strong>
                              </span>
                    	      </h1>
                            <p class="animated2"><?= $s->slide_desc ?></p>
                        </div>
                    </div>
                </div>
                <!--/ Carousel item end -->
              <?php } ?>

            </div>
            <!-- Carousel inner end-->

            <!-- Controls -->
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
        </div>
        <!-- /carousel -->
    </section>
    <!-- End Home Page Slider -->

    <section id="berita">
        <div class="container">
            <div class="row" id="content-list">
                <div class="col-md-8" id="left-side">
                    <h5 class="heading-list">FIBER ACADEMY NEWS</h5><div class="hr-heading-list"></div>
                    <ul class="media-list news-item" id="berita-terbaru">
                        <li class="media">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="media-left ">
                                        <a href="#">
                                          <img style="width: 275px; height: 175px;" class="media-object" src="https://i.ytimg.com/vi/YimoazCbArw/maxresdefault.jpg" alt="...">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="media-body">
                                        <a href="#"><h4>Pilih, Mereka Atau Kami Yang Mundur?</h4></a>
                                        <span><i class="fa fa-clock-o"></i> 2 April 2020 - <i class="fa fa-user"></i> Benny Tarwidi</span>
                                        <hr>
                                        <p>Tuntutan kami jelas, delapan tuntutan dan deretan nama yang tidak berprestasi. Sekarang tinggal pilih, keluarkan semua yang tidak berkompeten atau kami yang keluar dari tribun selamanya/boikot semua pertandingan PS Sleman?</p>
                                    </div>
                                </div>
                            </div>
                            </li>
                        <li class="media">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="media-left ">
                                        <a href="#">
                                          <img class="media-object" src="http://placehold.it/275x175" alt="...">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="media-body ">
                                        <a href="#"><h4>Melatih Senjata Utama; Suara</h4></a>
                                        <span><i class="fa fa-clock-o"></i> 2 April 2020 - <i class="fa fa-user"></i> Benny Tarwidi</span>
                                        <hr>
                                        <p>Bersorak saat terjadi gol maupun chants yang lantang selama pertandingan berlangsung seperti menjadi sebuah ‘keharusan’ bagi orang yang menganggap dirinya ultras. Karena di sinilah passion dan kebanggaan seorang ultras dinilai</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4" id="right-side">
                    <h5 class="heading-list">Popular News</h5><div class="hr-heading-list"></div>
                    <ul class="media-list news-item">
                      <li class="media">
                        <div class="media-left">
                          <a href="#">
                            <img style="width: 120px; height: 80px;" class="media-object" src="https://i.ytimg.com/vi/YimoazCbArw/maxresdefault.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <a href="<?= site_url('news/kewajiban-lapor') ?>" class="media-heading">Kewajiban Lapor Kartu Kredit Bikin Ekonomi Kian Lesu</a>
                        </div>
                      </li>
                      <li class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" src="http://placehold.it/120x80" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <a href="#" class="media-heading">Wapres JK Kaji Masukan Mantan Presiden SBY</a>
                        </div>
                      </li>
                      <li class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" src="http://placehold.it/120x80" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <a href="#" class="media-heading">Artha Graha Gelar Pasar Murah, Harga Daging Rp 75 Ribu Per Kilogram</a>
                        </div>
                      </li>
                      <li class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" src="http://placehold.it/120x80" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <a href="#" class="media-heading">Pendapatan Indofood Diprediksi Rp 70 Triliun pada 2016</a>
                        </div>
                      </li>
                    </ul>

                    <h5 class="heading-list">Latest News</h5><div class="hr-heading-list"></div>
                    <ul class="media-list comment-list">
                      <li class="media">
                        <div class="media-body">
                          <a href="#" class="media-heading">Investor Jepang Minati Sektor Ketenagalistrikan dan Gas</a>
                        </div>
                      </li>
                      <li class="media">
                        <div class="media-body">
                          <a href="#" class="media-heading">Menteri Susi Ancam Tenggelamkan Rumpon Liar di Laut Timor  </a>
                        </div>
                      </li>
                      <li class="media">
                        <div class="media-body">
                          <a href="#" class="media-heading">Kewajiban Lapor Kartu Kredit Bikin Ekonomi Kian Lesu</a>
                        </div>
                      </li>
                    </ul>
                    <br>
                    <h5 class="heading-list">SOCIAL MEDIA</h5><div class="hr-heading-list"></div>
                    <a class="btn btn-block btn-social btn-lg btn-instagram" href="https://www.instagram.com/telkomaksespekalongan/" target="_blank">
                        <i class="fa fa-instagram"></i> Follow us on Instagram
                    </a>
                </div>
            </div>
        </div>
    </section>