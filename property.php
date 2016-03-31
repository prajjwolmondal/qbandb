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
                $('#comments').val('New Text');
                $('#comments').trigger('autoresize');
                }); 
            </script>
            <script>
            </script>
            <script src="property.js"></script>

        </head>
    <body>

        <!-- PHP code for inserting new comment -->
        <?php

            // no property specified
            if (!isset($_GET['id']) || $_GET['id'] == '') {
                header ("Location: /qbandb/index.php");
            }


            include_once 'navbar.php';
            echo navbar(0);

            // not logged in
            if (!isset($_SESSION['mem_id'])) {
                echo "<script>Materialize.toast(\"You're not logged in! You will not be able to rate/comment on properties!\", 5000)</script>"; // display message
            
                echo <<<EOT
                        <script>
                            $(document).ready(function() {
                                document.getElementById('strangerRating').disabled = true;
                                $('#strangerRating').material_select();

                                document.getElementById('strangerCommentBtn').disabled = true;
                                document.getElementById('strangerCommentBox').setAttribute("disabled", "true");
                                document.getElementById('strangerCommentBox').value = "You must be logged in to comment!";
                            });
                        </script>
EOT;
            }


            include_once 'config/connection.php';


            $currentMemID = -1;

            if (isset($_SESSION['mem_id']))
                $currentMemID = $_SESSION['mem_id']; // ID of user currently logged in

            $currentPropID = $_GET['id']; // ID of property currently viewing
            $date = new DateTime();
            $currentDate = $date->format('Y-m-d');

            // add new stranger/property comment and rating to property
            if (isset($_POST['strangerComment']) and isset($_POST['user_comment']) and isset($_POST['user_rating'])) {

                $comment = $_POST['user_comment'];
                $newRating = $_POST['user_rating'];
                $query = "INSERT into qbandb.comments 
                          values ($currentMemID, $newRating, '$comment', NULL, $currentPropID, '$currentDate');";
                try {
                    // prepare query for execution
                   $stmt = $con->prepare($query);
                    // Execute the query
                    $stmt->execute();
                }
                catch (Exception $e){
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
            // add owner's reply
            else if (isset($_POST['ownerReply'])) {
                echo "Owner's reply: " . $_POST['ownerReply'];

                $commenter_id = $_POST['ownerReply']; // commenter's id was passed through here

                echo "reply = {$_POST['user_comment']}
                                WHERE   prop_id = {$currentPropID}
                                and     mem_id = {$commenter_id}";

                $query =    "   UPDATE  qbandb.comments
                                SET     reply = \"{$_POST['user_comment']}\"
                                WHERE   prop_id = {$currentPropID}
                                and     mem_id = {$commenter_id};
                            ";
                try {
                    // prepare query for execution
                    $stmt = $con->prepare($query);
                    
                    // Execute the query
                    $stmt->execute();
                }
                catch (Exception $e){
                    die(var_dump($e));
                }

            }

            $propID = $_GET['id'];

            $query = 
            "SELECT  mem_id, street_num, street_name, postal_code, type, num_rooms, beds_avail, overall_rating, price, dist_name, full_kitchen, laundry, shared_room, private_room, pool, close_to_transit, gym, first_name, last_name, overall_rating, about_prop
            FROM property natural join district natural join member
            WHERE prop_id = $propID";
            $property_owner_id = 0;

            try {

                // prepare query for execution
                $stmt = $con->prepare($query);

                // Execute the query
                $stmt->execute();

                /* resultset */
                $result = $stmt->fetchAll();
                echo "<table border='1'>";

                // no results from query: property does not exist
                if (empty($result)) {
                    echo "<h3>404: Property does not exist!</h3>";
                    echo "<p>We cannot find this property! :(</p>";
                    echo "<script>Materialize.toast(\"This property does not exist!\", 1500)</script>"; // display message
                    die();
                }

                foreach ($result as $tuple){

                    $property_owner_id = $tuple['mem_id'];

                    echo "Property owner: {$tuple['first_name']} {$tuple['last_name']} ({$tuple['mem_id']})";

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

            $query = "SELECT first_name, last_name, date_added, comment, reply, rating, mem_id
                        FROM  comments natural join member
                        WHERE prop_id = $propID";
            try{
                // prepare query for execution
                $stmt = $con->prepare($query);
                // Execute the query
                $stmt->execute();
                /* resultset */
                $result = $stmt->fetchAll();

                echo "<table border=1>";
                echo "<tr><th>Reviews</th></tr>";

                foreach ($result as $tuple){

                    $commenter_id = $tuple['mem_id'];

                    // while going through all comments,
                    // if the person logged in has made a comment (or is the owner),
                    // disable the rating/commenting
                    if ($currentMemID == $commenter_id || $currentMemID == $property_owner_id) {
                        echo <<<EOT
                        <script>
                            $(document).ready(function() {
                                document.getElementById('strangerRating').disabled = true;
                                $('#strangerRating').material_select();

                                document.getElementById('strangerCommentBtn').disabled = true;
                                document.getElementById('strangerCommentBox').setAttribute("disabled", "true");
                            
EOT;
                        $commentBoxValue = "";

                        if ($currentMemID == $commenter_id) {
                            $commentBoxValue = "document.getElementById('strangerCommentBox').value = \"You already made a comment!\"";
                        }
                        if ($currentMemID == $property_owner_id) { // precedence over having already made a comment
                            $commentBoxValue = "document.getElementById('strangerCommentBox').value = \"You cannot comment on your own property!\"";
                        }

                        echo <<<EOT
                                {$commentBoxValue}
                            });
                        </script>
EOT;



                    }

                    echo <<<EOT
                        <tr>
                            <td>
                            Rating: {$tuple['rating']}<br>
                            Comment: {$tuple['comment']}<br>
                            Comment added by: {$tuple['first_name']} {$tuple['last_name']} ({$tuple['mem_id']}) on: {$tuple['date_added']}<br>
EOT;
                    if ($tuple['reply'] != NULL){
                        echo "Owner Reply: " . $tuple['reply'];
                        echo "</td></tr>";
                    }

                    // enable ability to add reply if a reply does not already exist
                    else{

                        // if the ID if the currently logged in user matches the ID this property's owner
                        if ($property_owner_id == $currentMemID){

                            $currentPage = htmlspecialchars($_SERVER['REQUEST_URI']);

                            echo <<<EOT
                            <div class="owner_reply">
                                <button class='btn waves-effect waves-light' type='submit' id='btn'>Reply?
                                    <i class="material-icons right">trending_flat</i>
                                </button>
                            </div>

                            <tr id="ownerReplyTextArea" style="display: none">
                                <td>
                                    <div class='row'>
                                        <form class='col s12' action='{$currentPage}' method='post'>
                                            <div class='row'>
                                                <div class='input-field col s12'>
                                                    <textarea id='ownerCommentBox' length='500' class='materialize-textarea' name='user_comment'></textarea>
                                                    <label for='comments'>Your Comment (Optional)</label>
                                                </div>
                                            </div>
                                            <button class='btn waves-effect waves-light' type='submit' name='ownerReply' value='$commenter_id'>Reply
                                                <i class='material-icons right'>trending_flat</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
EOT;

                        }
                    }
                }
                echo "</table>";
            } catch (Exception $e){
                die(var_dump($e));
            }
    	?>

<!-- Rating Form -->
  <div class="row">
    <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post">
      <!-- Rating -->
      <div class="input-field col s4">
        <select id="strangerRating" class="validate" name="user_rating" required>
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
              <textarea id="strangerCommentBox" length="500" class="materialize-textarea" name="user_comment"></textarea>
              <label for="comments">Your Comment (Optional)</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" id="strangerCommentBtn" name="strangerComment">Submit
        <i class="material-icons right">send</i>
        </button>
    </form>
  </div>
</body>
</html>