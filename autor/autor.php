<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- biblioteke , jquery i bootstrap -->
    <link rel="stylesheet" href="../jquery-ui.css">
    <link rel="stylesheet" href="../bootstrap.min.css" />
	<script src="../jquery.min.js"></script>  
	<script src="../jquery-ui.js"></script>

    <title>Autori</title>

    <link rel="icon" href="../logo.ico" type="image/x-icon">


<!-- quick fix -->
<style>
body {
  background-color: #faf5f9;
}


</style>






</head>
<body>
    <div class="container">
        <br />

        <h3 align="center"> Booktracker</a></h3><br />
        <h5 align="center"> ITEH prvi domaci</a></h3><br />
        <br />
        <div align="right" style="margin-bottom:5px;">
                <button type="button" name="add" id="add" class="btn btn-success">Dodaj Autora</button>
        </div>
        <div id="user_data" class="table-responsive">

        </div>
        <br />
    </div>

    <!-- dodaj autora dialog -->
    <div id="user_dialog" title="Unos Autora">
        <form method="post" id="user_form">
            <div class="form-group">
                <label>Unesite ime autora:</label>
                <input type="text" name="ime_autora" id="ime_autora" class="form-control" />
                <span id="error_ime_autora" class="text-danger"></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" id="action" value="insert" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Ubaci" />
            </div>
        </form>
    </div>
    <!-- success poruka -->
    <div id="action_alert" title="Uspeh!">

    </div>

    <div id="delete_confirmation" title="Confirmation">
        <p>Da li ste sigurni da želite da obrišete?</p>
    </div>
</body>
</html>


<!-- javaScript funkcije -->

<script>
// jquery funkcija koja proverava da li se strana ucitala
// da ne bi radila na nekompletiranoj strani
 
$(document).ready(function() {

    load_data();

    // load-uje podatke u user data div
    function load_data() {
        // koristimo ajax da bi se load izvrsavao asihrono
        $.ajax({
            url:"fetch.php", // fajl gde saljemo na obradu
            method:"POST",   // http metoda
            success:function(data) {  // logika
                $('#user_data').html(data);
            }
        })

        
    }

// dialog za dodavanje novog autora
$('#user_dialog').dialog({
    autoOpen : false,
    width:400
});
// na click postavlja vrednosti hidden elemenata
$('#add').click(function(){
    $('#user_dialog').attr('title', 'Ubaci');
    $('#action').val('insert'); // ovde mu kazem da li insert, update ili delete
    $('#form_action').val("Ubaci");

    //otvara dijalog
    $('#user_dialog').dialog('open');
});

// on click
$('#user_form').on('submit', function(event){
    event.preventDefault();
    var error_imeAutora = '';

    if($('#ime_autora').val() == '') {
        
        error_imeAutora = 'Morate uneti ime autora';
        $('#error_ime_autora').text(error_imeAutora);
        $('#ime_autora').css('border-color', '#cc0000');
    }else {
        
        error_imeAutora = '';
        $('#error_ime_autora').text(error_imeAutora);
        $('#ime_autora').css('border-color', '');

    }
    // ako se nije javila greska, tj, ako je sve u redu
    if(error_imeAutora !== '') {
        return false;
    }else {
        
        //$('#form_action').attr('disabled', 'disabled');
        // serijalizacija
        var form_data = $(this).serialize();
        // sad ajax zahtev
        $.ajax({
            url:"operacije.php",
            method:"POST",
            data:form_data,
            success:function(data) {
                // dijalog nestaje
                
                $('#user_dialog').dialog('close');
                $('#action_alert').html(data);
                $('#action_alert').dialog('open');
                // refreshujem podatke
                load_data();
            }
            
        }

        )
    }
});

$('#action_alert').dialog({
    autoOpen:false
});

// --------update -----------
$(document).on('click', '.edit', function() {
    
    var id = $(this).attr("id");
    var action = 'fetch_single';
    // ajax da izvuce odabranog autora
    $.ajax({
        url:"operacije.php",
        method:"POST",
        data:{id:id, action:action},
        dataType:"json",
        success:function(data) {
            $('#ime_autora').val(data.ime_autora);
            $('#user_dialog').attr('title', 'Izmeni');
            $('#action').val('update');
            $('#hidden_id').val(id);
            $('#form_action').val('Izmeni');
            $('#user_dialog').dialog('open');
        },
        error:function(e) {
            console.log('greska u ajaxu');
            
        }
        
        

    })
});


    // DELETE
    $('#delete_confirmation').dialog({
        autoOpen: false,
        modal : true,
        buttons:{
            Ok:function() {
                var id = $(this).data('id');
                var action = 'delete';
                
                $.ajax({
                    url:"operacije.php",
                    method:"POST",
                    data:{id:id, action:action},
                    success:function(data) {
                        $('#delete_confirmation').dialog('close');
                        $('#action_alert').html(data);
                        $('#action_alert').dialog('open');
                        load_data();
                    }
                })
            },
            Odustani: function() {
                $(this).dialog('close');
            }
        }
    })


    $(document).on('click', '.delete', function() {
    
        var id = $(this).attr("id");
        $('#delete_confirmation').data('id',id).dialog('open');
        
        
    });

});
</script>
