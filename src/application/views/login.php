<div class="container">
      <div class="col-4 offset-4">
	 	 <form action="/login/check_login" method="POST">
				<h2 class="text-center">Login</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Log in</button>
					</div>
					<div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name = "remember"> Remember me</label>
						<a href="<?php echo base_url()?>/forget" class="float-right">Forgot Password?</a>
					</div>    
		 </form>
	</div>
</div>