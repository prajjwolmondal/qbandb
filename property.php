    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Property - Queen's BnB</title>
            
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
            }); 
        </script>
        <script>
            $('#comments').val('New Text');
            $('#comments').trigger('autoresize');
        </script>
        <script src="property.js"></script>
        </head>
    <body>
        
<!-- Rating Form -->
  <div class="row">
    <form class="col s12" action="property.php" method="post">
      <!-- Rating -->
      <div class="input-field col s4">
        <select class="validate" name="user_rating"required>
          <option value="" disabled selected>Select your rating</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
        <label for="rating">Rating (Required)</label>
      </div>
        <!-- Comment -->
        <div class="row">
            <div class="input-field col s12">
              <textarea id="comment" length="500" class="materialize-textarea" name="user_comment"></textarea>
              <label for="comments">Your Comment (Optional)</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
        </button>
    </form>
  </div>
</body>
</html>