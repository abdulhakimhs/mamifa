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
                      <?php foreach ($content as $c) : ?>
                        <li class="media">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="media-left ">
                                        <a href="<?= site_url('news/'.$c->content_slug) ?>">
                                          <img style="width: 275px; height: 175px;" class="media-object" src="<?= base_url('assets/backend/images/content/'.$c->content_image) ?>" alt="...">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="media-body">
                                        <a href="<?= site_url('news/'.$c->content_slug) ?>"><h4><?= $c->content_title ?></h4></a>
                                        <span><i class="fa fa-clock-o"></i> <?= $c->content_date ?> - <i class="fa fa-user"></i> <?= $c->fullname ?></span>
                                        <hr>
                                        <p><?= $c->content_desc ?></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-4" id="right-side">
                    <h5 class="heading-list">Popular News</h5><div class="hr-heading-list"></div>
                    <ul class="media-list news-item">
                      <?php foreach ($content_popular as $cp) : ?>
                        <li class="media">
                          <div class="media-left">
                            <a href="<?= site_url('news/'.$cp->content_slug) ?>">
                              <img style="width: 120px; height: 80px;" class="media-object" src="<?= base_url('assets/backend/images/content/'.$cp->content_image) ?>" alt="...">
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="<?= site_url('news/'.$cp->content_slug) ?>" class="media-heading"><?= $cp->content_title ?></a>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>

                    <h5 class="heading-list">Latest News</h5><div class="hr-heading-list"></div>
                    <ul class="media-list comment-list">
                      <?php foreach ($content_latest as $cl) : ?>
                        <li class="media">
                          <div class="media-body">
                            <a href="<?= site_url('news/'.$cl->content_slug) ?>" class="media-heading"><?= $cl->content_title ?></a>
                          </div>
                        </li>
                      <?php endforeach; ?>
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