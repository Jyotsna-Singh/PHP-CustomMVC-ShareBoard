

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">User Registration</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control" />
		</div> 
		<div class="form-group">
			<label>Email</label>
			<input name="email" class="form-control" />
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control" />
		</div>
		<input class="btn btn-primary" name="submit" type="submit" value="Submit"/>
		
	</form>
  </div>
</div>