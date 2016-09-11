<?php

require("../private/helpers.php");
require("../private/sql.php");

//if no event id in request
if(!isset($_GET["e_id"]))
{
    print("Error! Missing event ID param. Send as GET e_id, please!");
} else {
        //query database    
        $pull = $pdo->prepare("SELECT * FROM event WHERE id = ?");
        $pull->execute(array($_GET["e_id"]));
        $rows = $pull->fetchAll(PDO::FETCH_ASSOC);
//prepare json
print(json_encode($rows, JSON_PRETTY_PRINT));

}

?>