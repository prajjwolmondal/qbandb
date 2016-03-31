    <!DOCTYPE HTML>
    <html>
        <head>
            <title>User Profile - Queen's BnB</title>
            
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

    	<?php
    	    include_once '../navbar.php';
            echo navbar(0);
    	    include_once '../config/connection.php';

            $firstname = $_SESSION['first_name'];
            $currentMemID = $_SESSION['mem_id'];
            $lastname = $_SESSION['last_name'];
    /*
            
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              die();
            }
    */                 

      //   <ul class="collection with-header">
      //   <li class="collection-header"><h4>First Names</h4></li>
      //   <li class="collection-item">Alvin</li>
      //   <li class="collection-item">Alvin</li>
      //   <li class="collection-item">Alvin</li>
      //   <li class="collection-item">Alvin</li>
      // </ul>

    $query = "SELECT first_name, last_name, aboutme, email, degree_name, phone_num, faculty_name 
              FROM  (`member` natural join `degree`) natural join `faculty` 
              WHERE  mem_id = $currentMemID";
            try {
                // prepare query for execution
               $stmt = $con->prepare($query);
                // Execute the query
                $stmt->execute();
                /* resultset */
                $result = $stmt->fetchAll();
                echo "<div class=\"container\"><ul class=\"collection with-header\">";
                echo "<li class=\"collection-item avatar\">";
                echo "<img src=\"../qbandb/user/timmy.jpg\" alt=\"\" class=\"circle\">";
                echo "<span class=\"title\"><h3>".$firstname." ".$lastname."</h3></span>";
         
                echo "<a class=\"waves-effect waves-light btn\" href='user/edit.php'><i class=\"material-icons right\">edit</i>Edit Profile</a></li>";
                foreach ($result as $tuple){
                    echo "<br>";
                    echo "<div class=\"row\">";
                        echo "<div class=\"col s4 offset-s1\">";
                        echo "<i class=\"material-icons\">email</i>&nbsp&nbsp".$tuple['email']."</div>";
                        echo "<div class=\"col s4 offset-s1\">";
                        echo "<i class=\"material-icons\">call</i>&nbsp&nbsp".$tuple['phone_num']."</div>";
                    echo "</div>";
                    echo "<div class=\"row\">";
                        echo "<div class=\"col s4 offset-s1\">";
                        echo "<i class=\"material-icons\">import_contacts</i>&nbsp&nbsp".$tuple['degree_name']."</div>";
                        echo "<div class=\"col s4 offset-s1\">";
                        echo "<i class=\"material-icons\">account_balance</i>&nbsp&nbsp".$tuple['faculty_name']."</div>";
                    echo "</div>";
                    echo "<div class=\"row\">";
                        echo "<div class=\"col s4 offset-s1\">";
                        echo "<h5>About me:</h5>".$tuple['aboutme']."</div>";
                    echo "</div>";
                echo "</div>";

       
                }
            } catch (Exception $e) {
                die(var_dump($e));
            }   // End of try/catch

            $query = "SELECT  prop_id, street_num, street_name, apt_num, postal_code, overall_rating FROM `property` natural join `member` WHERE mem_id = $currentMemID";
            try{
                // prepare query for execution
                $stmt = $con->prepare($query);
                // Execute the query
                $stmt->execute();
                /* resultset */
                $result = $stmt->fetchAll();


            
                foreach ($result as $tuple){
                echo "<div class=\"container\">";
                echo "<ul class=\"collection with-header\">";
                if ($tuple['apt_num']!=Null){
                echo "<li class=\"collection-item avatar\">";
                echo "<img src=\"../img/property/{$tuple['prop_id']}.png\" alt=\"\" class=\"circle\">";
            
                echo "<span class=\"title\"><a href='../property.php?id={$tuple['prop_id']}'>"
                     .$tuple['street_num']." ".$tuple['street_name'].
                     "  Apt No  ".$tuple['apt_num']."</span>";
                 } else{
                echo "<li class=\"collection-item avatar\">";
                echo "<img src=\"../img/property/{$tuple['prop_id']}.png\" alt=\"\" class=\"circle\">";
                echo "<span class=\"title\"><a href='../property.php?id={$tuple['prop_id']}'>"
                     .$tuple['street_num']." ".$tuple['street_name']."</span>";
                 
                 }
                echo "<p>".$tuple['postal_code']." <br>";
                echo "</p>";
                echo "<i class=\"material-icons\">grade</i></a>".$tuple['overall_rating'];
                echo "</li>";

                echo "</div>";

                   
                   
                }
                echo "</div>";
            } catch (Exception $e){
                die(var_dump($e));
            }
    	?>
</body>
</html>