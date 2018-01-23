<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Title</title>
	<link href="/bootstrap4/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap4/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap4/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="/css/select2.min.css" rel="stylesheet" />
</head>
<body>


<div class="container-fluid" style="margin-top: 80px">

	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<a class="navbar-brand" href="#">Admin <?=$testVal?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>


	<form method="post">
		<div class="form-group col-">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
		<div class="form-group col-">
			<label for="exampleInputPassword1">DOB</label>
			<input name="dob" type="date" value="1968-12-09" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
		</div>

        <div class="form-group col-">
            <label for="tselect">Select</label>
            <select id="tselect" class="form-control">
            </select>
        </div>

		<div class="form-check col-">
			<input type="checkbox" class="form-check-input" id="exampleCheck1">
			<label class="form-check-label" for="exampleCheck1">Check me out</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

    <?php
    echo $_POST['dob'];
    ?>

</div>



</body>
<script language="JavaScript" src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script language="JavaScript" src="/js/select2.min.js" type="text/javascript"></script>
<script language="JavaScript" src="/bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
<script language="JavaScript" src="/bootstrap4/js/bootstrap.bundle.min.js" type="text/javascript"></script>

<script>
	$('#tselect').select2({
		ajax: {
			url: '/api/location/countries/',
			dataType: 'json'
			// Additional AJAX parameters go here; see the end of this chapter for the full code of this example
		}
	});
</script>

</html>