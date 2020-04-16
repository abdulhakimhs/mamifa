<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php foreach ($slider as $key => $s) { ?>
      <div class="<?= $key == 0 ? 'carousel-item active' : 'carousel-item' ?>" style="height: 500px;">
        <img style="width: 100%;" class="d-block w-100" src="<?= base_url('assets/backend/images/slider/'.$s->slide_image) ?>" alt="First slide">
      </div>
    <?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <a href="<?= site_url('monila') ?>" style="text-decoration: none; color: #212529;">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-screen-desktop m-auto text-danger"></i>
            </div>
            <h3>MONILA</h3>
            <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit!</p>
          </div>
          </a>
        </div>
        <div class="col-lg-6">
        	<a href="<?= site_url('training_request') ?>" style="text-decoration: none; color: #212529;">
	          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	            <div class="features-icons-icon d-flex">
	              <i class="icon-check m-auto text-danger"></i>
	            </div>
	            <h3>Training Request</h3>
	            <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit!</p>
	          </div>
	      	</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <?php foreach ($content as $key => $c) { ?>
        <?php if($key%2) { ?>
          <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('<?= base_url('assets/backend/images/content/'.$c->content_image) ?>');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
              <h2><?= strtoupper($c->content_title) ?></h2>
              <p class="lead mb-0"><?= $c->content_desc ?></p>
            </div>
          </div>
        <?php } else { ?>
          <div class="row no-gutters">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('<?= base_url('assets/backend/images/content/'.$c->content_image) ?>');"></div>
            <div class="col-lg-6 my-auto showcase-text">
              <h2><?= strtoupper($c->content_title) ?></h2>
              <p class="lead mb-0"><?= $c->content_desc ?></p>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </section>