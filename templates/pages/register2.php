<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/23/2018
 * Time: 9:54 PM
 */
?>
<h1 style="margin-bottom: 20px">Sign In</h1>

<form method="post" id="register_form">

	<fieldset class="my-3">

		<div class="form-group row">
			<label for="user_name" class="col-sm-2 col-form-label col-form-label-sm required">Full name</label>
			<div class="col-sm-10">
				<input type="text" id="user_name" name="user_name" class="form-control form-control-sm" placeholder="Enter full name">
			</div>
		</div>

		<div class="form-group row">
			<label for="user_email" class="col-sm-2 col-form-label col-form-label-sm required">Email</label>
			<div class="col-sm-10">
				<input type="email" id="user_email" name="user_email" class="form-control form-control-sm"  placeholder="Email adress">
			</div>
		</div>

		<div class="form-group row">
			<label for="user_pass" class="col-sm-2 col-form-label col-form-label-sm required">Password</label>
			<div class="col">
				<input type="password" id="user_pass" name="user_pass" class="form-control form-control-sm" placeholder="Your password">
			</div>
			<div class="col">
				<input type="password" id="user_pass2" name="user_pass2" class="form-control form-control-sm" placeholder="Retype password">
			</div>
		</div>

	</fieldset>

	<fieldset class="my-3">

		<div class="form-group row">
			<label for="user_prof" class="col-sm-2 col-form-label col-form-label-sm">Profession</label>
			<div class="col-sm-10">
				<input type="email" id="user_prof" name="user_prof" class="form-control form-control-sm" placeholder="Profession">
			</div>
		</div>

		<div class="form-group row">
			<label for="user_dob" class="col-sm-2 col-form-label col-form-label-sm">Birthday</label>
			<div class="col-sm-10">
				<input type="date" id="user_dob" name="user_dob" class="form-control form-control-sm" placeholder="Date of birthday">
			</div>
		</div>

	</fieldset>

	<div class="form-group row">
		<label for="user_country" class="col-sm-2 col-form-label col-form-label-sm">Country</label>
		<div class="col-sm-10">
			<select id="user_country" name="user_country" class="form-control form-control-sm">
				<option value="0">Please select your country...</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label for="user_city" class="col-sm-2 col-form-label col-form-label-sm">City</label>
		<div class="col-sm-10">
			<select id="user_city" name="user_city" class="form-control form-control-sm">
				<option value="0">Please select your city...</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label for="user_street" class="col-sm-2 col-form-label col-form-label-sm">Adress</label>
		<div class="col-sm-10">
			<textarea id="user_street" name="user_street" class="form-control form-control-sm" placeholder="Your adress"></textarea>
		</div>
	</div>

	<button type="submit" class="btn btn-primary btn-sm float-sm-right my-2">Submit</button>

</form>

