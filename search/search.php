<?php

    function getDistricts () {
    
        include '../config/connection.php';

        $query =    "   SELECT * 
                        FROM district 
                        GROUP BY dist_name ASC
                    ";


        try {
        
            // echo $query; // UNCOMMENT for DEBUGGING

            // prepare query for execution
            $stmt = $con->prepare($query);

            // Execute the query
            $stmt->execute();
     
            $result = $stmt->fetchAll();

            return $result;
        }

        catch (Exception $e) {
            die(var_dump($e));
        }
    }

    function getTypes () {
    
        include '../config/connection.php';

        $query =    "   SELECT type
                        FROM property 
                        GROUP BY type ASC
                    ";


        try {
        
            //echo $query; // UNCOMMENT for DEBUGGING

            // prepare query for execution
            $stmt = $con->prepare($query);

            // Execute the query
            $stmt->execute();
     
            $result = $stmt->fetchAll();

            return $result;
        }

        catch (Exception $e) {
            die(var_dump($e));
        }
    }
?>