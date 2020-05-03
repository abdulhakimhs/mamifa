<?php $this->load->view('frontend/header', FALSE); ?>

<?= $content; ?>
<?php if($this->uri->segment(1) == '') { ?>
<hr>
<!-- Clients Aside -->
<section id="partner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3>Fiber Academy Pekalongan</h3>
                    <p>&nbsp</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="clients">
                <?php foreach ($foto as $ft) : ?>
                    <div class="col-md-12">
                        <img style="width: 150px; height: 50px;" src="<?= base_url('/assets/backend/images/gallery/'.$ft->photo) ?>" class="img-responsive" alt="...">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php $this->load->view('frontend/footer', FALSE); ?>