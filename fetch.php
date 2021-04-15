<?php
    include "database.php";
    $db = new Database('booktracker');

    $db->select("autor","*");

    $resultSet = $db->getResult();
    $total_row = $db->getRecords();

    $output = '
    <table class="table table-striped table-bordered">
        <tr>
            <th>Ime Autora</th>
            <th>Izmeni</th>
            <th>Obrisi</th>
        </tr>    
    ';

    if($total_row > 0) {
        foreach($resultSet as $row){
            $output .= '
                <tr>
                    <td>'.$row["imeAutora"].'</td>
                    <td>
                        <button type="button" name="edit" class="btn btn-primary btn-sm edit" id="'.$row["autorID"].'">Izmeni</button>
                    </td>
                    <td>
                        <button type="button" name="delete" class="btn btn-danger btn-sm delete" id="'.$row["autorID"].'">Obrisi</button>
                    </td>    
                <tr>    
            ';
        }
    }else {
        $output .= '
        <tr>
            <td colspan="4" align="center">Nema ovde nista :/</td>
        </tr>    
        ';
    }




    $output .= '</table>';

    echo $output;









?>