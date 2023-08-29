<br>
<br>
<br>

<br>
<br>
<div class="container">
      <div class="col-4 offset-4">
            <form action="/signup/sign_up" method="POST">


				<h2 class="text-center">Sign Up</h2>    
				<br>   
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Email" required="required" name="email">
					</div>
					
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
					

					<div class="form-group">
						<input type="password" class="form-control" placeholder="Type your Password Again" required="required" name="password_Twice">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Question can proof if you forget password" required="required" name="question">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" placeholder="The answer of above question" required="required" name="answer">
					</div>
					

					<div class="form-group">
					<?php echo $error; ?>
					</div>

					<!-- reference from https://developers.google.com/recaptcha/docs/display
					<div class="g-recaptcha" data-sitekey="6LcKkiAgAAAAAIkNe3SsejiZBPepOU-J9xlD0n-k"></div> -->


					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Sign Up</button>
					</div>
					
            </form>
	</div>
</div>

<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>