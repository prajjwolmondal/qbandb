<?php
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'insert':
                insert();
                break;
            case 'search':
                //$red = false;
                //if ($_POST['colorRed'] == "true")
                //    $red = true;

                $features = $_POST['features'];

                searchPropertyListings($features);
                break;
        }
    }

    function searchPropertyListings($features) {


        include_once '../config/connection.php';

        $query =    "   SELECT * 
                        FROM property natural join district
                    ";

        $whereFlag = false;
        foreach ($features as $key => $val) { // go through each feature
            if ($val == 0 || $val == 1) { // add if not indeterminate (purposely checked on or off)

                if ($whereFlag == false) { // first WHERE expression
                    $query .= " WHERE " . $key . " = " . $val;
                    $whereFlag = true;
                }
                else {
                    $query .= " and ". $key . " = " . $val;
                }
            }
        }


        try {
        
            // echo $query; // UNCOMMENT for DEBUGGING

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
                $district = "<strong>District:</strong> " . $tuple['dist_name'];
                $price = "<strong>Price:</strong> $" . $tuple['price'] . " per day";
                $available = "<strong>Beds available:</strong> " . $tuple['beds_avail'];
/*
                if ($red) {
                    $resultString .= "<div class='row' style='background-color: red'>";
                }
                else {*/
                    $resultString .= "<div class='row'>";
  //              }


                $resultString .= <<<EOT

                <div class="col s3">
                    <img src="images/yuna.jpg" alt="" class="circle">
                    <span class="title">{$address}</span>
                </div>
                <div class="col s3 offset-s9">
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </div>
            </div>
            <div class="row">
                <div class="col s3">
                    {$district}
                </div>
                <div class="col s3">
                    {$price}
                </div>
                <div class="col s3">
                    {$available}
                </div>
            </div>
EOT;

                $resultString .= "</li>";
            }

            $resultString .= "</ul>";
        }

        catch (Exception $e) {
            die(var_dump($e));
        }

        if ($result == []) // no results
            echo "No listings available :(";
        else
            echo $resultString;
        exit;
    }
?>