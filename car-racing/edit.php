<!-- form edit user action manage.php -->

<div class="container" id="login-register">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6" style="font-weight: bold; font-size: 20px">
							Edit Profile
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">

							<form id="register-form" action="manage.php" method="post" role="form">
								<label>Username</label>
								<div class="form-group">
									<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" disabled="disabled" value="<?php echo $loginname ?>">
								</div>
								<div class="form-group">
									<input type="hidden" name="username" value="<?php echo $loginname ?>">
								</div>
								<label>Fullname</label>
								<div class="form-group">
									<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Full Name" value="<?php echo $fullname ?>">
								</div>
								<div class="form-group">
									<input type="hidden" name="edit_data" value="y">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Save">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>