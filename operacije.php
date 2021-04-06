<?php
include "database.php";
$db = new Database('booktracker');

if(isset($_POST["action"])) {
    $naziv =["imeAutora"=> "'".$_POST["ime_autora"]."'"];
    if($_POST["action"] == "insert") {
       if( $db->insert("autor","imeAutora",$naziv)) {
        echo '<p>Uspesno ubaceno!</p>';
        $db->Commit();
       }else{
           echo '<p>Ne moze</p>';
           $db->Rollback();
       }
        // planirao sam try - catch - finally pa da imam i disconnect ali ajde sad   
       
    }
}

?>