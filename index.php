<!DOCTYPE HTML>
<html>
    <head>
        <title>Home - Queen's BnB</title>
        
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

        echo "php is working";

        $rows = mysqli_query($con,"SELECT * FROM booking;"); 
        echo $rows;

        foreach($rows as $row) {

            echo $row['mem_id'];
            echo $row['prop_id'];
        }
        */
        $query = "SELECT * FROM qbandb.member";

        // prepare query for execution
        if($stmt = $con->prepare($query)){

            echo $stmt;

            $memID = 2;
            
            // bind the parameters. This is the best way to prevent SQL injection hacks.
            $stmt->bind_Param("i", $memID);

            // Execute the query
            $stmt->execute();
     
            /* resultset */
            $result = $stmt->get_result();

            // Get the number of rows returned
            $num = $result->num_rows;
     
            //resultset
            $result = $stmt->get_result();

            echo "working?";
            echo $result;

        }
        else {
            echo "not working at all :(";
        }
	?>


 <!-- dynamic content will be here -->
 <form name='login' id='login' action='index.php' method='post'>
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
</form>

</body>
</html>