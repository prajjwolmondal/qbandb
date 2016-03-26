<!DOCTYPE HTML>
<html>
    <head>
        <title>Home - Queen's BnB</title>
        
        <!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
  
    </head>
<body>

	<?php
	    include_once 'navbar.php';
	    include_once 'config/connection.php';






	?>
<!-- Register Form -->
  <div class="row">
    <form class="col s12">
      <!-- Name -->
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="first name" type="text" length="40">
          <label class="active" /label>
        </div>
        <div class="input-field col s6">
          <input Placeholder="last name" type="text" length="40">
          <label class="active" /label>
        </div>
      </div>
      <!-- Password -->
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="password" type="password">
          <label class="active" /label>
        </div>   
        <div class="input-field col s6">
          <input placeholder="retype password" type="password" class="validate">
          <label class="active" /label>
        </div>
      </div>
      <!-- Email and Phone -->
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="email" type="email" class="validate">
          <label class="active" data-error="Invalid email"/label>
        </div>
         <div class="input-field col s6">
          <input placeholder="phone number" type="tel">
          <label class="active" /label>
        </div>
      </div>
      <!-- Degree -->
      <div class="input-field col s6">
        <select>
          <option value="" disabled selected>select your degree</option>
          <option value="1">Commerce</option>
          <option value="2">Computer Science</option>
          <option value="3">Cooking</option>
          <option value="4">Engineering</option>
          <option value="5">Science</option>
        </select>
        <label>Materialize Select</label>
      </div>
    </form>
  </div>

</body>
</html>