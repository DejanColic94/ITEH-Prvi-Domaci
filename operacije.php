<?php
include "database.php";
$db = new Database('booktracker');

if(isset($_POST["action"])) {
    $naziv =["imeAutora"=> "'".$_POST["ime_autora"]."'"];
    if($_POST["action"] == "insert") {
       try{
            $db->insert("autor","imeAutora",$naziv);
            echo '<p>Uspešno ubačeno!</p>';
            $db->Commit();
       }catch(Exception $e) {
            echo '<p>Ne može</p>';
            $e->getMessage();
            $db->Rollback();
       }finally{
           $db->Disconnect();
       }
       
        
       
    }
}

?>