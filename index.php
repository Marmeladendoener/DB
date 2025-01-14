<style>
    /* Add some basic styling to the form */
    form {
        width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #1f4037;
    }

    /* Style the labels */
    label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    /* Style the inputs */
    input {
        width: 100%;
        padding: 12px 20px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style the submit button */
    input[type="submit"] {
        background-color: #99f2c8;
        color: #1f4037;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Style the result text */
    .result {
        margin-top: 20px;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }
</style>

<title>DB Navigator</title>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>


<?php

$ch = curl_init("https://apis.deutschebahn.com/db-api-marketplace/apis/station-data/v2/stations");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
'DB-Client-Id: fef7e2d16dd19ee4dc3de32274c66d60',
'DB-Api-Key: 2f97bf22fb1e4b02643f0ce3fc06bca8'
));


//execute
$response = curl_exec($ch);

//close
curl_close($ch);

//do

//var_dump($response);


$response = json_decode($response, true);


$m=0;
 foreach ($response['result'] as $h){
        $bahnhof[$m] = $response['result'][$m]['name'];
        $bahnhof[$m] = str_replace(" ( ","(",$bahnhof[$m]);
        $bahnhof[$m] = str_replace(" (b ","-(bei ",$bahnhof[$m]);
        $bahnhof[$m] = str_replace(" ) ",")",$bahnhof[$m]);
        $bahnhof[$m] = str_replace(" )",")",$bahnhof[$m]);
        $bahnhof[$m] = str_replace(" ","-",$bahnhof[$m]);

        $m++;
 }


 


$items = array();
$j = 0;
$o = 0;
 if (isset($_GET['von'])) {
    $search = $_GET['von'];
    
    foreach ($bahnhof as $an_item) {
        if (stripos($an_item, $search)){
            $items[$o] = $an_item;
            $o++;
            echo $items[$o];
        }
        $j++;
    }
   // echo json_encode($items);
}
 //echo json_encode($bahnhof);
 //echo json_encode($response);



?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post>
  <label for="von">Von:
  <br />  
	<input type="string" list="vonliste">
	<datalist id="vonliste">
<?php
echo gettype($bahnhof);
    foreach($bahnhof as $bh) {
        echo '<option value='. htmlspecialchars($bh) .'>';
    }
    ?>
</datalist>
</label>
<br />  
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post>
<label nach = "nach">  Nach:<br />  
	<input type="string" list="nachliste">
	<datalist id="nachliste">
<?php
echo gettype($bahnhof);
    foreach($bahnhof as $bh) {
        echo '<option value='. htmlspecialchars($bh) .'>';
    }
    ?>
</datalist>
</label>
<br />  
Datum:
  <input type="Date" id="date" name="date" > 
  <br>  
Zeit:
  <input type="time" id="time" name="time" > 
  <br>
  <input type="submit" value="Ermitteln">
  <br />




