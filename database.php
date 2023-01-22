<?php
    class Database {
        private $url = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname;

        // pomocni atributi

        private $dblink; // tu smestam objekat mysqli
        private $result; // resultSet u Javi? pa se obradjuje rs.next
        private $records; // broj vracenih redova
        private $affected; // broj affected redova

        // konstruktor

        function __construct($dbname) {
            $this->dbname = $dbname;
            $this->Connect();
        }

        // Funkcija koja pravi konekciju, poziva se u konstruktoru, verovatno moze ovako zbog hoistinga kao u javascriptu

        function Connect(){
            $this->dblink = new mysqli($this->url, $this->username, $this->password, $this->dbname);
            if($this->dblink->connect_errno){
                printf("Greska u konekciji: %s\n", $this->dblink->connect_error);
                exit();
            }
            $this->dblink->set_charset("utf8");
            $this->dblink->autocommit(FALSE); 
        }

        function Commit() {
            $this->dblink->commit();
        }

        function Rollback() {
            $this->dblink->rollback();
        }

        function Disconnect() {
            mysqli_close($this->dblink);
        }


        // izvrsava upit i vraca records i affected rows ako prodje

        function ExecuteQuery($upit){
            $this->result = $this->dblink->query($upit);
            if($this->result){
                if(isset($this->result->num_rows)){
                    $this->records = $this->result->num_rows;
                }
                if(isset($this->result->affected_rows)){
                    $this->affected = $this->result->affected_rows;
    
                }
                return true;
            }else{
                return false;
            }
        }

        // getter najobicniji
        function getResult(){
            return $this->result;
        }

        function getRecords(){
            return $this->records;
        }

        // CRUD
        

        // where i order by i join parametre stavljam na null default da bih prosledjivao samo ako mi zatreba
        // join parametri nek se nadju za svaki slucaj

        function select($table,$rows,$join_table=null,$join_key1=null,$join_key2=null, $where=null, $order=null){
            // default select
            $upit = 'SELECT '.$rows.' FROM '.$table;
            // ako imam join
            if($join_table!=null){
                $upit.=' JOIN '.$join_table.' ON '.$table.'.'.$join_key1.'='.$join_table.'.'.$join_key2;
                
            }
            // ako imam where
            if($where!=null){
                $upit.=' WHERE '.$where;
            }
            // ako imam order by
            if($order!=null){
                $upit.=' ORDER BY '.$order;
            }
            // this se ovde odnosi ja mislim na objekat klase kao u javi, nisu one zajebancije kao u javascript sa this
            // poziva metodu ExecuteQuery da procesuira upit
            
            // ispisujem upit u konzoli, dobra praksa
           // echo '<script>console.log("'.$upit.'"); </script>'; 
            $this->ExecuteQuery($upit);
            
        }

        function insert($table,$rows, $values){
            $query_values = implode(',',$values);
            $upit ='INSERT INTO '.$table;
            if($rows!=null){
                $upit.='('.$rows.')';
            }
            $upit.=" VALUES($query_values)";
           // echo '<script>console.log("'.$upit.'"); </script>'; 
            if($this->ExecuteQuery($upit)){
                return true;
            }else{
                return false;
            }
        }
        function update($table, $id, $keys,$values){
            //$query_values ="";
           // $set_query = array();
           // for($i =0; $i<sizeof($keys); $i++){
              //  $set_query[] = "$keys[$i] = $values[$i]";
           // }
           // $query_values = implode(",", $set_query);  
            $upit = "UPDATE $table SET $keys = '$values' WHERE $id";
           // echo '<script>console.log("'.$upit.'"); </script>'; 
            if($this->ExecuteQuery($upit) && $this->affected>0){
                return true;
            }else{
                return false;
            }
        }
    
        function delete($table, $id, $id_value){
            $upit = "DELETE FROM $table WHERE $id=$id_value";
           // echo '<script>console.log("'.$upit.'"); </script>'; 
            if($this->ExecuteQuery($upit)){
                return true;
            }else{
                return false;
            }
        }
    
    



    }
    
        
    
    
?>
