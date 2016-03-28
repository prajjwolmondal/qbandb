    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Search - Queen's BnB</title>
            
            <!-- Compiled and minified CSS -->
    		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

    		<!-- Compiled and minified JavaScript -->
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
      
        </head>
    <body>

    	<?php
    	    include_once 'navbar.php';
    	    include_once 'config/connection.php';
    /*
            
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              die();
            }
    */  
            $propID = 2;
            $query = 
            "SELECT  street_num, street_name, postal_code, type, num_rooms, beds_avail, overall_rating, price, dist_name, full_kitchen, laundry, shared_room, private_room, pool, close_to_transit, gym, first_name, last_name, overall_rating, about_prop
            FROM property natural join district natural join member
            WHERE prop_id=$propID";
            try {

                // prepare query for execution
               $stmt = $con->prepare($query);

                // Execute the query
                $stmt->execute();

                /* resultset */
                $result = $stmt->fetchAll();
                echo "<table border='1'>";
                foreach ($result as $tuple){
                    echo "<tr><td> Address: ".$tuple['street_num']." ".$tuple['street_name']."</td>";
                    echo "<td> Postal Code: ".$tuple['postal_code']."</td>";
                    echo "<td> District: ".$tuple['dist_name']."</td>";
                    echo "</tr><tr>";
                    echo "<td> Total number of rooms: ".$tuple['num_rooms']."</td>";
                    echo "<td> Price: ".$tuple['price']."</td>";
                    echo "<td> Overall Rating: ".$tuple['overall_rating']."</td>";    
                    echo "<td> Property Type: ".$tuple['type']."</td>";
                    echo "<td> Beds Available: ".$tuple['beds_avail']."</td></tr>";
                    echo "<tr> ";
                    echo "<td> About Property: </td>";
                    echo "<td>".$tuple['about_prop']."</td>";
                    echo "</tr>";
                    echo "<tr> <td>Ammenities: </td></tr>";
                    echo "<tr><td>";
                    if($tuple['full_kitchen']=1){
                        echo "<br> Full Kitchen</br>";
                    }
                    if($tuple['laundry']=1){
                        echo "<br> Laundry</br>";
                    }
                    if($tuple['shared_room']=1){
                        echo "<br> Shared Room</br>";
                    }
                    if($tuple['private_room']=1){
                        echo "<br> Private Room</br>";
                    }
                    if($tuple['pool']=1){
                        echo "<br> Pool</br>";
                    }
                    if($tuple['close_to_transit']=1){
                        echo "<br> Close to transit</br>";
                    }
                    if($tuple['gym']=1){
                        echo "<br> Gym</br>";
                    }
                }
            } catch (Exception $e) {
                die(var_dump($e));
            }   // End of try/catch

            $propID = 2;
            $query = "SELECT first_name, last_name, date_added, comment, reply, rating
                        FROM  comments natural join member
                        WHERE prop_id = $propID";
            try{
                // prepare query for execution
                $stmt = $con->prepare($query);
                // Execute the query
                $stmt->execute();
                /* resultset */
                $result = $stmt->fetchAll();
                echo "<table boder=1>";
                echo "<tr><th>Reviews</th></tr>";
                foreach ($result as $tuple){
                    echo "<tr><td>";
                    echo "Rating: ".$tuple['rating']."<br>";
                    echo "Comment: ".$tuple['comment']."<br>";
                    echo "Comment added on: ".$tuple['date_added']."<br>";
                    echo "Owner Reply: ".$tuple['reply'];
                    echo "</td></tr>";
                }
                echo "</table>";
            } catch (Exception $e){
                die(var_dump($e));
            }
    	?>


     <!-- dynamic content will be here -->
    <!--  <form name='login' id='login' action='index.php' method='post'>
        <table border='0'>
            <tr>
                <td>Username</td>
                <td><input type='text' name='username' id='username' /></td>
            </tr>
            <tr>
                <td>Password</td>
                 <td><input type='password' name='password' id='password' /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' id='loginBtn' name='loginBtn' value='Log In' /> 
                </td>
            </tr>
        </table>
    </form> -->

    </body>
    </html>