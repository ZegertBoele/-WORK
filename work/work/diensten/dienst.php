<?php 

require_once('../includes/config.php');

$naam = $_POST['dienst_naam'];
$beschrijving = $_POST['dienst_beschrijving'];
$id = $_SESSION['ID'];


$naam = stripcslashes($naam);
$beschrijving = stripcslashes($beschrijving);
$naam = mysqli_real_escape_string($mysqli, $naam);
$beschrijving = mysqli_real_escape_string($mysqli, $beschrijving);

// afbeelding
$output = '';
$afbeelding = $_FILES['afbeelding']['name'];
$afbeeldingPath = 'afbeeldingen/' . $afbeelding;
$afbeeldingPath = mysqli_real_escape_string($mysqli,$afbeeldingPath);

if(preg_match("!image!", $_FILES['afbeelding']['type'])){
    if(copy($_FILES['afbeelding']['tmp_name'],$afbeeldingPath)){

        $query = "INSERT INTO dienst (user_id,naam, beschrijving, afbeelding) VALUES ('$id','$naam','$beschrijving','$afbeeldingPath')";
        if(mysqli_query($mysqli,$query)){
            header("location: ../profiel/");
        }else{
            echo "Dienst is NIET toegevoegd!";
            echo $mysqli->error;

        }
    }
}else{
    echo "Afbeelding upload fail!";
}



// if ($result = $mysqli->query($query)) {
//     echo "Returned rows are: " . $result . "<br>";
// } else {
//     echo 'fail <br/>';
//     echo "query: " . $query . "<br/>";
//     echo $mysqli->error;
// }