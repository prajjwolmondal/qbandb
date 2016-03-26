<!DOCTYPE HTML>
<html>
    <head>
        <title>Home - Queen's BnB</title>
        
        <!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <!-- Icons -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!-- JS animations -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <!-- Dropdown Animations -->
    <script>  
      $(document).ready(function() {
      $('select').material_select();
      }); </script>
   
  
    </head>
<body>

	<?php
	    include_once 'registernav.php';
	    include_once 'config/connection.php';






	?>
<!-- Register Form -->
  <div class="row">
    <form class="col s12">
      <!-- Name -->
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" length="40">
          <label class="active"  for="first_name">first name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" length="40">
          <label class="active"  for="last_name">last name</label>
        </div>
      </div>
      <!-- Password -->
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="password">
          <label class="active"  for="password">password</label>
        </div>   
        <div class="input-field col s6">
          <input id="retype_password" type="password" class="validate">
          <label class="active" for="retype_password">retype password</label>
        </div>
      </div>
      <!-- Email and Phone -->
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate">
          <label class="active" data-error="invalid email" for="email">email</label>
        </div>
         <div class="input-field col s6">
          <input id="phone_number" type="tel">
          <label class="active" for="phone_number">phone number</label>
        </div>
      </div>
      <!-- Faculty -->
      <div class="input-field col s4">
        <select>
          <option value="" disabled selected>select your faculty</option>
          <option value="1">Arts and Science</option>
          <option value="2">Commerce</option>
          <option value="3">Computing</option>
          <option value="4">Cooking</option>
          <option value="5">Engineering</option>
        </select>
        <label>faculty</label>
      </div>
      <!-- Degree -->
      <div class="input-field col s4">
        <select>
          <option value="" disabled selected>select your degree</option>
          <option value="1">Commerce</option>
          <option value="2">Computer Science</option>
          <option value="3">Cooking</option>
          <option value="4">Engineering</option>
          <option value="5">Science</option>
        </select>
        <label>degree</label>
      </div>
        <div class="input-field col s1">
          <input id="year" type="number">
          <label class="active" for="year">year</label>
        </div>
        <!-- About me -->
      <div class="row">
        <div class="input-field col s12">
          <textarea id="aboutme" length="500" class="materialize-textarea"></textarea>
          <label for="aboutme">about me</label>
        </div>
      </div>
      <!-- Credit Card Info -->
      <div class="row">
        <div class="input-field col s3">
          <input id="credit" type="text" class="validate">
          <label class="active" data-error="invalid email" for="credit">credit card number</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s1">
          <input id="expiry" type="text" class="validate">
          <label class="active" for="expiry">expiry</label>
        </div>
        <div class="input-field col s1">
          <input id="cvv" type="text" class="validate">
          <label class="active" for="cvv">cvv</label>
        </div>
      </div>


    </form>
  </div>

</body>
</html>