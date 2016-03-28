<!DOCTYPE HTML>
<html>
    <head>
        <title>Search - Queen's BnB</title>
        
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

        <script type="text/javascript" src="./search.js"></script>

    </head>
<body>

    <?php
        include_once '../navbar.php';
    ?>

    <div class="container">
        <h3>Search Listings</h3>

        <input type="checkbox" id="fullKitchen" />
        <label for="fullKitchen">Full Kitchen</label>
        &nbsp;
        <input type="checkbox" id="laundry" />
        <label for="laundry">Laundry</label>
        &nbsp;
        <input type="checkbox" id="pool" />
        <label for="pool">Pool</label>
        &nbsp;
        <input type="checkbox" id="gym" />
        <label for="gym">Gym</label>
        &nbsp;
        <input type="checkbox" id="sharedRm" />
        <label for="sharedRm">Shared Room</label>
        &nbsp;
        <input type="checkbox" id="privateRm" />
        <label for="privateRm">Private Room</label>
        &nbsp;
        <input type="checkbox" id="closeToTransit" />
        <label for="closeToTransit">Close to Transit</label>

        <br/><br/>

        <input class="btn" type="submit" value="search"/>

        <br/>
        <h3>Results</h3>

        <div class="searchResults">
            Search above!
        </div>

    </div>



</body>
</html>