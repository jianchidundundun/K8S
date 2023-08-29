<div class="container">
      <div class="col-4 offset-4">
            <form action="/create/insertNewCourse" method="POST">
			
				<h2 class="text-center">Create your course</h2>    
				<br>   
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Type your course name" required="required" name="courseName">
					</div>
					

					<div class="form-group">
						<input type="text" class="form-control" placeholder="Type your course description" required="required" name="des">
					</div>

					
					<div class="form-group">
					<?php echo $error; ?>
					</div>

					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Create your own course</button>
					</div>
					
            </form>



	</div>
</div>