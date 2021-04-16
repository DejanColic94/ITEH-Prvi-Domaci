<?php
include "../database.php";
$db = new Database('booktracker');

// Insert
if(isset($_POST["action"])) {
    
    if($_POST["action"] == "insert") {
        $naziv =["naziv"=> "'".$_POST["ime_knjige"]."'"];
       try{
            $db->insert("knjiga","naziv",$naziv);
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


    // Uzmi jednu knjigu (za popunjavanje text polja)
    if($_POST["action"] == 'fetch_single') {
       
        try{
            $db->select("knjiga","*",null,null,null,"knjigaID =".$_POST["id"],null);
            
            $rs = $db->getResult();
            foreach($rs as $row) {
                $output['ime_knjige'] = $row['naziv'];
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
            
            $db->update("knjiga","knjigaID = ".$_POST["hidden_id"],"naziv",$_POST["ime_knjige"]);
            
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

            $db->delete("knjiga","knjigaID",$_POST["id"]);
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