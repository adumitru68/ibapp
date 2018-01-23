<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/23/2018
 * Time: 12:22 AM
 */
//date('Y-m-d')
?>
<h1 style="margin-bottom: 20px">Register form</h1>
<form method="post" id="register_form">

	<div class="form-group col-">
		<label for="user_name">Full name</label>
		<input type="text" name="user_name" class="form-control form-control-sm" id="user_name" placeholder="Enter full name">
	</div>

	<div class="form-group col-">
		<label for="exampleInputEmail1">Email address</label>
		<input type="email" name="user_email" class="form-control form-control-sm" id="user_email"  placeholder="Enter email">
	</div>

	<div class="form-group col-">
		<label for="user_prof">Profession</label>
		<input type="text" name="user_prof" class="form-control form-control-sm" id="user_prof"  placeholder="Enter email">
	</div>

	<div class="form-group col-">
		<label for="user_country">Select country</label>
		<select id="user_country" name="user_country" class="form-control form-control-sm">
			<option value="0">Please select your country...</option>
		</select>
	</div>

	<div class="form-group col-">
		<label for="user_city">Select city</label>
		<select id="user_city" name="user_city" class="form-control form-control-sm">
			<option value="0">Please select your city...</option>
		</select>
	</div>

	<div class="form-group col-">
		<label for="exampleInputPassword1">Date of birthday</label>
		<input name="dob" type="date" value="" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<div id="result" class="row">

</div>
