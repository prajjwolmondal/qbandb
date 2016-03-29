<?php
function navbar($directoryLevel) {

	$directoryString = "";
	for ($i = 0; $i < $directoryLevel; $i += 1) {
		$directoryString .= "../";
	}
	$directoryString .= "./";

	$returnString = <<<EOT
	<nav>
	  <div class="nav-wrapper teal lighten-2">
	    <a href="{$directoryString}" class="brand-logo">Queen's BnB</a>
	    <form class="col s12" action="{$directoryString}logout-ajax.php" method="post">
		    <ul id="nav-mobile" class="right hide-on-med-and-down">
		      <li><a href="{$directoryString}search">Search Listings</a></li>
		      <li><a href="{$directoryString}dashboard.php">Dashboard</a></li>
		      <li><a href="{$directoryString}register.php">Register</a></li>
		      <li><a id="logoutBtn" name="logout" value="logout" type="submit" onClick="javascript:document.forms[0].submit();">Log out</a></li>
		    </ul>
		</form>
	  </div>
	</nav>
EOT;
	return $returnString;
}

?>