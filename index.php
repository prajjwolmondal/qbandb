<!DOCTYPE HTML>
<html>
    <head>
        <title>Home - Queen's BnB</title>
        
        <!-- Materialize - Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <!-- Materialize - Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
  
        <!-- Material icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>
<body>

    <?php
        include_once 'navbar.php';
        echo navbar(0);
    ?>
    <div class="container">

    <h3>Top properties</h3>


    <?php
        include 'config/connection.php';
        $query = "  SELECT prop_id, street_num, street_name, type, beds_avail, overall_rating 
                    FROM         property 
                    GROUP BY     overall_rating 
                    ORDER BY     overall_rating DESC";
        try {
            $stmt = $con->prepare($query); // prepare query for execution
            
            $stmt->execute(); // execute the query
     
            /* resultset */
            $result = $stmt->fetchAll();
            $resultString = "";
            $resultString .= <<<EOT
    <table class="responsive-table striped">
        <thead>
          <tr>
              <th data-field="id">Property ID</th>
              <th data-field="address">Address</th>
              <th data-field="type">Type</th>
              <th data-field="available">Available</th>
              <th data-field="rating">Rating</th>
          </tr>
        </thead>
        <tbody>
EOT;
            foreach ($result as $tuple) {
                $resultString .= "<tr>";
                $resultString .= "<td>" . $tuple['prop_id'] . "</td>"; // property ID
                $resultString .= "<td>" . $tuple['street_num'] . " " . $tuple['street_name'] . "</td>"; // address
                $resultString .= "<td>" . $tuple['type'] . "</td>"; // type
                $resultString .= "<td>" . $tuple['beds_avail'] . " beds </td>"; // beds available
                $resultString .= "<td>" . $tuple['overall_rating'] . "</td>"; // rating
                $resultString .= "</tr>";
            }
            
            $resultString .= <<<EOT
        </tbody>
    </table>
EOT;
            echo $resultString;
        }
        catch (Exception $e) {
            die(var_dump($e));
        }
    ?>


    </div>

</body>
</html>