<!DOCTYPE HTML>
<html>
  <head>
        <title>Dashboard - Queen's BnB</title>
        
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
    <script>
  $(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });
    </script>
  
  </head>

  <body>
  <?php
    include_once 'navbar.php';
    include_once 'config/connection.php';
  ?>


  <div class="divider"></div>
  <div class="section">
  <h4>Profile</h4>
    

  </div>
  <div class="divider"></div>
  <div class="section">

<ul class="collapsible" data-collapsible="accordion">
    <li>
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
      <div class="collapsible-body"><table class="hightlight bordered"><caption>Booking Summary</caption>
          <tr><th>Date Booked</th><th>Period</th><th>Status</th></tr></table>
        </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
        <div class="collapsible-body"><table class="hightlight bordered"><caption>Booking Summary</caption>
          <tr><th>Date Booked</th><th>Period</th><th>Status</th></tr></table>
    </li>
  </ul>

  <h4>Properties</h4>
  <?php
  $currentMemID = 3;
  //Query to obtain current member owned properties
  $query ="SELECT   street_num, street_name, apt_num, postal_code, type, prop_id
           FROM    `property` natural join `member`
           WHERE mem_id = $currentMemID";
  //Query to show bookings on current property
 
  try {
          //Execute first query 
          $stmt = $con->prepare($query); // prepare query for execution
          $stmt->execute(); // execute the query
          $result = $stmt->fetchAll();

          //Execute second query


          $resultString = "";
          $resultString .= <<<EOT

          <ul class="collapsible" data-collapsible="accordion">
           <li>
EOT;
            foreach ($result as $tuple) {
                $resultString .= "<div class=\"collapsible-header\">";
                $resultString .= "<a href='property.php?id={$tuple['prop_id']}'>" . $tuple['street_num'] . " " . $tuple['street_name']; // address
                $resultString .= "</div>";
                $currentPropID = $tuple['prop_id'];

                 $query2= "SELECT  date_booked, period, status, property.prop_id, street_num, street_name, apt_num 
                           FROM  property, booking 
                           WHERE property.prop_id = booking.prop_id and property.prop_id = $currentPropID 
                           ORDER BY date_booked DESC";

                $stmt2 = $con->prepare($query2); // prepare query for execution
                $stmt2->execute(); // execute the query
                $result2 = $stmt2->fetchAll();


                //Set up inner table to show bookings
                $resultString .="<div class=\"collapsible-body\"><p><table class=\"hightlight bordered\"><caption><strong>Booking Summary<strong></caption>";
                $resultString .="<tr><th>Date Booked</th><th>Period</th><th>Status</th>";

                //SHow bookings
                foreach ($result2 as $tuple2){
                  $resultString.= "<tr><td>".$tuple2['date_booked']."</td>";
                  $resultString.= "<td>".$tuple2['period']."</td>";

                  //If booking is pending, give option to change
                  if ($tuple2['status']== "Pending"){
                  $resultString.= "<td><form id=\"update status\" method=\"post\" action=\"bookingconfirm.js\">  <div class=\"input-field s12 m6 l3\">
                                  <select>
                                  <option value=\"\" disabled selected>" .$tuple2['status']. "</option>
                                  <option value=\"1\">Confirm</option>
                                  <option value=\"2\">Reject</option>
                                </select>
                                <label>Materialize Select</label>
                                </div></td>";
                  $resultString.="<td>  
                                  <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Update
                                          <i class=\"material-icons right\">send</i>
                                         </button> </form></td></form>";
                  }
                  //Else, disable change button
                  else {
                       $resultString.= "<td><div class=\"input-field s4\">
                        <select disabled>
                        <option value=\"\" disabled selected>" .$tuple2['status']. "</option>
                        <option value=\"1\">Confirm</option>
                        <option value=\"2\">Reject</option>
                        </select>
                        <label>Materialize Select</label>
                        </div></td>";
                  $resultString.="<td><form id=\"update status\">   
                                  <button disabled class=\"btn disabled\" >Update
                                  <i class=\"material-icons right\">send</i>
                                  </button></form></td>";
                  }
                  $resultString.="</tr>";
                }

            
                $resultString .="</table></p></div>";

                $resultString .= <<<EOT
                </li>
EOT;

            }          
            $resultString .= <<<EOT
          </ul>
        <br>
EOT;
 echo $resultString;

         if ($result == NULL){
            echo "You do not own any properties";
          }


        }
        catch (Exception $e) {
            die(var_dump($e));
        }
  ?>
  <br>
   <br>
  <a class="waves-effect waves-light btn" href='edit-property.php'><i class="material-icons right">add</i>Add a Property</a>
  </div>
  <div class="divider"></div>
  <div class="section">



  <h4>Bookings</h4>
  <?php
    $bookingQuery = "SELECT  date_booked, period, status, property.prop_id, street_num,street_name, apt_num FROM  property, booking WHERE  property.prop_id = booking.prop_id and booking.mem_id = $currentMemID ORDER BY  date_booked DESC";
        try {
            // prepare query for execution
            $stmtbook = $con->prepare($bookingQuery);
            // Execute the query
            $stmtbook->execute();
            $resultbook = $stmtbook->fetchAll();
            echo "<table border=1>";
            echo "<tr><th>Date Booked</th><th>Period</th><th>Status</th><th>Address </th> <th>Cancel</th></tr>";
            foreach ($resultbook as $tuplebook){
                echo "<tr><td>".$tuplebook['date_booked']."</td>";
                echo "<td>".$tuplebook['period']."</td>";
                echo "<td>".$tuplebook['status']."</td>";
                echo "<td><a href='property.php?id={$tuplebook['prop_id']}'>".$tuplebook['street_num']." ".$tuplebook['street_name']."</td>";
                echo "<td>";
                echo "Cancel Booking";
                echo "</td>";
            }
            echo "</table>";
        }catch (Exception $e){
            die(var_dump($e));
        }




    // $query3 = "UPDATE  booking SET  status = 'Cancelled' WHERE  mem_id = $selectedMemID and status != ‘Finished’;";
    //   try {
    //       // prepare query for execution
    //      $stmt = $con->prepare($query2);
    //       // Execute the query
    //       $stmt->execute();
    //   }catch (Exception $e){
    //       die(var_dump($e));
    //   }

   ?>
  <br>
  
  </div>




  </body>
</html>