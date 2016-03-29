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
    	    include_once '../config/connection.php';
    /*
            
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              die();
            }
    */      $currentMemID = 3;
            $query = 
            "SELECT first_name, last_name, aboutme, email, degree_name, phone_num, faculty_name FROM  (`member` natural join `degree`) natural join `faculty` WHERE  mem_id = $currentMemID";
            try {
                // prepare query for execution
               $stmt = $con->prepare($query);
                // Execute the query
                $stmt->execute();
                /* resultset */
                $result = $stmt->fetchAll();
                echo "<table border='1'>";
                foreach ($result as $tuple){
                    echo "<tr><td> My name is ".$tuple['first_name']." ".$tuple['last_name']."</td></tr>";
                    echo "<tr><td> My email is ".$tuple['email']."</td></tr>";
                    echo "<tr><td> My phone number is ".$tuple['phone_num']."</td></tr>";
                    echo "<tr><td> I have a degree in <strong>".$tuple['degree_name']."</strong> under the faculty of <strong>".$tuple['faculty_name']."</strong></td></tr>";
                    echo "<tr><td> About me: ".$tuple['aboutme']."</td></tr>";
                }
            } catch (Exception $e) {
                die(var_dump($e));
            }   // End of try/catch

            $query = "SELECT  prop_id, street_num, street_name, apt_num, overall_rating FROM `property` natural join `member` WHERE mem_id = $currentMemID";
            try{
                // prepare query for execution
                $stmt = $con->prepare($query);
                // Execute the query
                $stmt->execute();
                /* resultset */
                $result = $stmt->fetchAll();
                echo "<table border=1><caption>Properties that I own</caption>";
                foreach ($result as $tuple){
                    echo "<tr><td>";
                    if ($tuple['apt_num']!=Null){
                        echo "Address: Apt. Number: ".$tuple['apt_num'].", ".$tuple['street_num']." ".$tuple['street_name']."<br>";
                    }
                    else{
                        echo "Address: ".$tuple['street_num']." ".$tuple['street_name']."<br>";
                    }
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "Rating: ";
                    echo "<i class='material-icons'>grade</i>".$tuple['overall_rating'];
                    // echo "<i class='tiny material-icons'>star_rate</i>".$tuple['overall_rating'];
                    echo "</td></tr>";
                    echo "<tr><td>";
                    echo "<a href='../property.php?id={$tuple['prop_id']}'>";
                    echo "Go to property"."</a>";
                    echo "</td></tr>";
                    echo "<br>";
                }
                echo "</table>";
            } catch (Exception $e){
                die(var_dump($e));
            }
    	?>
</body>
</html>