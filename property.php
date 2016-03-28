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
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        </head>
    <body>
        <!-- PHP code for inserting new comment -->
        <?php
            include_once 'config/connection.php';
            $currentMemID = 1;
            $currentPropID = 2;
            $date = new DateTime();
            $currentDate = $date->format('Y-m-d');
            if(isset($_POST['user_comment']) and isset(($_POST['user_rating']))){
                $comment = $_POST['user_comment'];
                $newRating = $_POST['user_rating'];
                $query = "INSERT into qbandb.comments 
                          values ($currentMemID, $newRating, '$comment', NULL, $currentPropID, '$currentDate');";
                try {
                    // prepare query for execution
                   $stmt = $con->prepare($query);
                    // Execute the query
                    $stmt->execute();
                }catch (Exception $e){
                    die(var_dump($e));
                }
                $query2 = " UPDATE property
                SET sum_votes = sum_votes + $newRating, num_votes = num_votes + 1, overall_rating = sum_votes / num_votes
                WHERE prop_id = $currentPropID;";
                try {
                    // prepare query for execution
                   $stmt = $con->prepare($query2);
                    // Execute the query
                    $stmt->execute();
                }catch (Exception $e){
                    die(var_dump($e));
                }
            }
        ?>

    	<?php
    	    include_once 'navbar.php';
    	    include_once 'config/connection.php';
    /*
            
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              die();
            }
    */      $currentMemID = 3;
            $propID = 2;
            $query = 
            "SELECT  mem_id, street_num, street_name, postal_code, type, num_rooms, beds_avail, overall_rating, price, dist_name, full_kitchen, laundry, shared_room, private_room, pool, close_to_transit, gym, first_name, last_name, overall_rating, about_prop
            FROM property natural join district natural join member
            WHERE prop_id=$propID";
            $property_owner_id = 0;
            try {

                // prepare query for execution
               $stmt = $con->prepare($query);

                // Execute the query
                $stmt->execute();

                /* resultset */
                $result = $stmt->fetchAll();
                echo "<table border='1'>";
                foreach ($result as $tuple){
                    $property_owner_id = $tuple['mem_id'];
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
                    echo "Comment added by: ".$tuple['first_name'].$tuple['last_name']." on: ".$tuple['date_added']."<br>";
                    if ($tuple['reply']!=NULL){
                        echo "Owner Reply: ".$tuple['reply'];
                        echo "</td></tr>";
                    }
                    else{
                        if ($property_owner_id==$currentMemID){
                            echo '<div class="owner_reply">';
                            echo "<button class='btn waves-effect waves-light' type='submit' id='btn' onclick='showReply()'>Reply?";
                                echo '<i class="material-icons right">trending_flat</i>';
                            echo '</button>';
                            // echo '<button onclick="showReply()">Click me</button>';
                            echo '</div>';
                        }
                    }
                }
                echo "</table>";
            } catch (Exception $e){
                die(var_dump($e));
            }
    	?>
<!-- Register Form -->
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
        <script>
            function showReply(){
                document.getElementsByClassName("owner_reply").innerHTML = "
                <tr><td><div class='row'>
                <form class='col s12' action='property.php' method='post'>
                <div class='row'>
                <div class='input-field col s12'>
                <textarea id='comment' length='500' class='materialize-textarea' name='user_comment'></textarea>
                <label for='comments'>Your Comment (Optional)</label>
                </div>
                </div>
                <button class='btn waves-effect waves-light' type='submit' name='action'>Reply
                <i class='material-icons right'>trending_flat</i>
                </button>
                </form>
                </div></td></tr>";
            }
        </script>

</body>
</html>