<?php
include "database.php";
$db = new Database('booktracker');

// Insert
if(isset($_POST["action"])) {
    
    if($_POST["action"] == "insert") {
        $naziv =["imeAutora"=> "'".$_POST["ime_autora"]."'"];
       try{
            $db->insert("autor","imeAutora",$naziv);
            echo '<p>Uspešno ubačeno!</p>';
            $db->Commit();
       }catch(Exception $e) {
            echo '<p>Ne može</p>';
            $e->getMessage();
            $db->Rollback();
       }finally{
          // $db->Disconnect();
       }
         
    }


    // Uzmi jednog autora (za popunjavanje text polja)
    if($_POST["action"] == 'fetch_single') {
       
        try{
            $db->select("autor","*",null,null,null,"autorID =".$_POST["id"],null);
            
            $rs = $db->getResult();
            foreach($rs as $row) {
                $output['ime_autora'] = $row['imeAutora'];
            }
            
            
           echo json_encode($output);
           
          
            
        }catch(Exception $e) {
            echo '<p>Greska fetch single</p>';
            $db->Rollback();
        }finally{
           // $db->Disconnect();
        }
    }



    // update
    if($_POST["action"] == "update") {
        try{
            //$keys = array("imeAutora");
            //$values = array($_POST["ime_autora"]);
            $db->update("autor","autorID = ".$_POST["hidden_id"],"imeAutora",$_POST["ime_autora"]);
            
            $db->Commit();
            
            echo '<p>Uspešno izmenjeno!</p>';
        }catch(Exception $e) {
            echo '<p>Greska update</p>';
            $db->Rollback();
        }finally {
           // $db->Disconnect();
        }
    }


    // delete
    if($_POST["action"] == "delete") {
        try{

            $db->delete("autor","autorID",$_POST["id"]);
            $db->Commit();
            echo '<p>Uspešno obrisano!</p>';
        }catch(Exception $e) {
            echo '<p>Greska delete</p>';
            $db->Rollback();
        }finally {
           // $db->Disconnect();
        }
    }





}




?>