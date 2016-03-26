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

    <!-- NAVIGATION BAR -->
    <?php
        include_once 'navbar.php';
    ?>

    <div class="container">

    <?php
	    include_once 'config/connection.php';

        $query = "  SELECT street_num, street_name, apt_num, dist_name, price, beds_avail
                    FROM property natural join district";

        try {

            // prepare query for execution
            $stmt = $con->prepare($query);

            // Execute the query
            $stmt->execute();
     
            $result = $stmt->fetchAll();

            $resultString = "";
            $resultString .= "<ul class=\"collection\">";

            foreach ($result as $tuple) {

                $resultString .= "<li class=\"collection-item avatar\">";

                $address = $tuple['street_num'] . " " . $tuple['street_name'];
                if ($tuple['apt_num'])
                    $address .= " Apt #" . $tuple['apt_num']; // add apartment number if included
                $district = $tuple['dist_name'];
                $price = "$" . $tuple['price'];
                $available = "Beds available: " . $tuple['beds_avail'];


                $resultString .= <<<EOT
            <img src="images/yuna.jpg" alt="" class="circle">
            <span class="title">{$address}</span>
            <p>{$district}</br>
            {$price}</br>
            {$available}
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
EOT;

                $resultString .= "</li>";
            }

            echo $resultString;

        }

        catch (Exception $e) {
            die(var_dump($e));
        }
	?>

  </div>

</body>
</html>