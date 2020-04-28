<style>
    .navbar-default{
        background-color:#222 !important;
    }
</style>
<section id="page-title" style="margin-top: 100px; background-color:#eeeeee;">
    <div class="container">
        <div class="page-title col-md-4">
            <h1><?= $title; ?></h1>
        </div>
        <div class="col-md-8">
            <ol class="breadcrumb pull-right" style="background-color: #eeeeee;">
                <li><a href="#"><i class="fa fa-home"></i></a>
                </li>
                <li><a href="#" ><span>News</span></a></li>
                <li class="active"><?= $subtitle; ?></li>
            </ol>
        </div>
    </div>
</section>

<section id="berita">
    <div class="container">
        <div class="row" id="content-list">
            <div class="col-md-8" id="left-side">
                <h2><b><?= $news->content_title ?></b></h2>
                <p class="post-meta">Posted by <i class="fa fa-user"></i> <?= $news->fullname ?> <i class="fa fa-clock-o"></i> <?= $news->content_date ?></p>
                <div class="col-xs-12  no-gutter nopadding">
                
                    <img class="img-responsive" src="<?= base_url('assets/backend/images/content/'.$news->content_image) ?>" style="width: 650px; height: 350px;" alt="...">
                    <br>
                    <p><?= $news->content_desc ?></p>

                </div>
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