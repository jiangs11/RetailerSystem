<?php

// NOTE: this file has a password, and so should not be world-readable.
// Usually it would be mode 600, with a ACL permitting the webserver in.  
// But it's like this because you have to use it as sample code.
//
// YOURS should also have ME listed on the ACL so I can read it without
// having to use administrative access.

// NOTE 2: this file should _not_ be in the directory with your other
// PHP files!  That's a bad security hole!
// It's here for this sample, but in general don't put it under
// public_html a all.
// That means there's less worry about someone getting the webserver
// to hand it over where they can get at it.  (Not "no worry"; there's
// never "no worry".)

// ConnectDB() - takes no arguments, returns database handle
// USAGE: $dbh = ConnectDB();
function ConnectDB() {

    /*** mysql server info ***/
    $hostname = '';
    $username = '';
    $password = '';
    $dbname   = '';

    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",
                       $username, $password);
    } catch(PDOException $e) {
        die ('PDO error in "ConnectDB()": ' . $e->getMessage() );
    }

    return $dbh;
}

?>
