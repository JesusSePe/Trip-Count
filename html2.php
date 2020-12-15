<br />
<!DOCTYPE html><br />
<html lang="en"><br />
	<head><br />
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/><br />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" /><br />
	</head><br />
<body><br />
	<nav class="navbar navbar-default"><br />
		<div class="container-fluid"><br />
			<a class="navbar-brand" href="https://sourcecodester.com">Sourcecodester</a><br />
		</div><br />
	</nav><br />
	<div class="col-md-3"></div><br />
	<div class="col-md-6 well"><br />
		<h3 class="text-primary">PHP - Sort Data Using PDO</h3><br />
		<hr style="border-top:1px dotted #ccc;"/><br />
		<div class="col-md-4"><br />
			<form action="add.php" method="POST"><br />
				<div class="form-group"><br />
					<label>Firstname</label><br />
					<input type="text" name="firstname" class="form-control" required="required"/><br />
				</div><br />
				<div class="form-group"><br />
					<label>Lastname</label><br />
					<input type="text" name="lastname" class="form-control" required="required"/><br />
				</div><br />
				<div class="form-group"><br />
					<label>Address</label><br />
					<input type="text" name="address" class="form-control" required="required"/><br />
				</div></p>
<p>				<center><button class="btn btn-primary" name="add" ><span class="glyphicon glyphicon-save"></span> Save</button></center><br />
			</form><br />
		</div><br />
		<div class="col-md-8"><br />
			<form method="POST" action=""><br />
				<button class="btn btn-primary" name="asc"><span class="glyphicon glyphicon-arrow-up"></span> Ascending</button><br />
				<button class="btn btn-danger" name="desc"><span class="glyphicon glyphicon-arrow-down"></span> Descending</button><br />
			</form><br />
			<br /><br /><br />
			<?php include 'sort.php'?><br />
		</div><br />
	</div><br />
</body><br />
</html><br />