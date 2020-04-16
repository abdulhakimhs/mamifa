<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-dark" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title">Change Password</h5>
			<div class="widget-toolbar">

				<a href="#" data-action="fullscreen" class="orange2">
					<i class="ace-icon fa fa-expand"></i>
				</a>

				<a href="#" data-action="reload">
					<i class="ace-icon fa fa-refresh"></i>
				</a>

				<a href="#" data-action="collapse">
					<i class="ace-icon fa fa-chevron-up"></i>
				</a>

				<a href="#" data-action="close">
					<i class="ace-icon fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<?php
	                $info = $this->session->flashdata('info');
	                if (!empty($info)) {
	                    echo $info;
	                }
	            ?>
	            <div class="row">
	            	<div class="col-xs-12">
	            		<!-- PAGE CONTENT BEGINS -->
	            		<form id="change-pass" action="<?= site_url('admin/auth/changePassword') ?>" class="form-horizontal" role="form" method="POST">
	            			<input type="hidden" name="users_id" value="<?= $this->session->userdata('user_id') ?>">
	            			<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Old Password : </label>
								<div class="col-sm-8">
									<input type="password" id="oldpass" name="oldpass" placeholder="Your Old Password" class="col-xs-10 col-sm-6" required />
									<?php echo form_error('oldpass'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-2"> New Password : </label>
								<div class="col-sm-8">
									<input type="password" id="newpass" name="newpass" placeholder="Your New Password" class="col-xs-10 col-sm-6" required />
									<?php echo form_error('newpass'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-3"> Retype Password : </label>
								<div class="col-sm-8">
									<input type="password" id="repass" name="repass" placeholder="Retype Your Password" class="col-xs-10 col-sm-6" required />
									<?php echo form_error('repass'); ?>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-danger" type="submit" name="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										Save
									</button>

									&nbsp;
									<button class="btn" type="reset">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										Reset
									</button>
								</div>
							</div>
	            		</form>
	            		<!-- END PAGE CONTENT BEGINS -->
	            	</div>
	            </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function() {
        $('#change-pass').validate({
            errorClass: "help-block",
            rules: {
                newpass: {
                    required: true,
                    confirmed: true
                },
                repass: {
                    equalTo: newpass
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>