<!DOCTYPE HTML>
<html>
    <head>
        <title>Create Property - Queen's BnB</title>
        
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

        <!-- Material icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script>
          $(document).ready(function() {
            $('select').material_select();
          });
        </script>

    </head>
<body>

    <?php
        include_once './navbar.php'; // include navbar
        echo navbar(0);
    ?>
    <div class="container">

        <div class="row">
            <div class="col s8 offset-s2">

                <div class="row">
                    <h3>Create Property</h3>
                </div>

                <div class="row">
                    <form class="col s12" name='edit-prop' id='edit-prop' action='index.php' method='post'>

                        <div class="row">
                            <h4>Address</h4>
                        </div>

                        <div class="row">
                            <div class="input-field col s2">
                                <input id="addrNum" type="text" class="validate">
                                <label for="addrNum">number</label>
                            </div>

                            <div class="input-field col s10">
                                <input id="addrName" type="text" class="validate">
                                <label for="addrName">street name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input id="aptNum" type="text" class="validate">
                                <label for="aptNum">apartment number</label>
                            </div>

                            <div class="input-field col s3">
                                <input id="postal" type="text" class="validate">
                                <label for="postal">postal code</label>
                            </div>

                            <div class="input-field col s6">
                                <select>
                                    <option value="" disabled selected>Choose a district</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                <label>district</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s2">
                                <select>
                                    <option value="" disabled selected>0</option>
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
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <label>number of rooms</label>
                            </div>

                            <div class="input-field col s2">
                                <select>
                                    <option value="" disabled selected>0</option>
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
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <label>beds available</label>
                            </div>

                            <div class="input-field col s3">
                                <input id="postal" type="number" class="validate">
                                <label for="postal">price per day</label>
                            </div>
                        </div>

                        <div class="file-field input-field">
                            <div class="waves-effect waves-light btn">
                                <span>Upload image</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="upload an image">
                            </div>
                        </div>


                        <br/>

                        <div class="row">
                            <h4>Features</h4>
                        </div>

                        <div class="row">
                            <p>
                              <input type="checkbox" id="fullKitchen" />
                              <label for="fullKitchen">full kitchen</label>
                              &nbsp;
                              <input type="checkbox" id="laundry" />
                              <label for="laundry">laundry</label>
                              &nbsp;
                              <input type="checkbox" id="pool" />
                              <label for="pool">pool</label>
                              &nbsp;
                              <input type="checkbox" id="gym" />
                              <label for="gym">gym</label>
                            </p>
                            <p>
                              <input type="checkbox" id="sharedRoom" />
                              <label for="sharedRoom">shared room</label>
                                &nbsp;
                              <input type="checkbox" id="privateRoom" />
                              <label class="tooltipped" data-position="top" data-delay="50" data-tooltip="Each guest is given their own room" for="privateRoom">private room</label>
                            </p>
                            <p>
                              <input type="checkbox" id="closeToTransit" />
                              <label for="closeToTransit">close to transit</label>
                            </p>
                        </div>

                        <div class="row">
                            <button class="waves-effect waves-light btn">
                                Create Property
                                <i class="material-icons right">send</i>
                            </button>
                        </div>



                    </form>
                 </div>
            </div>
        </div>
    </div>

</body>
</html>