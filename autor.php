<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- biblioteke , jquery i bootstrap -->
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="bootstrap.min.css" />
	<script src="jquery.min.js"></script>  
	<script src="jquery-ui.js"></script>

    <title>Autori</title>
</head>
<body>
    <div class="container">
        <br />

        <h3 align="center"> Booktracker</a></h3><br />
        <br />
        <div align="right" style="margin-bottom:5px;">

        </div>
        <div id="user_data" class="table-responsive">

        </div>
        <br />
    </div>
</body>
</html>


<!-- javaScript funkcije -->

<script>
// jquery funkcija koja proverava da li se strana ucitala
// da ne bi radila na nekompletiranoj strani
// logika se izvrsava unutar anonimne f-je 
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
});



</script>
