<!DOCTYPE html>
<html lang="pl">
    <head>
<meta charset="utf-8"/>
<title> Panel administratora </title>
<link rel="stylesheet" type="text/css" href="styl4.css"/>
    </head>
    <body>

<div id="baner">
<h3> Portal Społecznościowy - panel administratora </h3>
</div>

    <div id="lewy">
<h4> Użytkownicy </h4>
<?php

//utworzenie zmiennych 
$server = "localhost";
$user = "root";
$passwd = "";
$dbname = "dane4";

$conn = mysqli_connect($server,$user,$passwd,$dbname);
/*
if (!$conn){
    die ("fatal error: mysqli_error($conn)");
} echo "jest okej";
*/

$zapytanie = "SELECT id, imie, nazwisko, rok_urodzenia, zdjecie FROM osoby LIMIT 30";
$sql = mysqli_query($conn,$zapytanie);
$lat = date('Y');


while ($wynik = mysqli_fetch_row($sql)) {
    $lata = $lat - $wynik[3];
    echo $wynik[0]. " ".$wynik[1]. " ". $wynik[2]. " " .$lata;
    echo "<br>";
    
}
?>
<a href="settings.html">Inne ustawienia</a>
    </div>

       <div id="prawy">
        <h4> Podaj id użytkownika </h4>
        <form action="" method="post">
            <input type="number" id="numer" name="numer"/>
            <button type="submit">ZOBACZ</button>
            <hr>
<?php
if (!empty($_POST['numer'])){
$numer = $_POST['numer'];
$zapytanie2 = "SELECT osoby.imie, osoby.nazwisko, osoby.rok_urodzenia, osoby.opis, osoby.zdjecie, hobby.nazwa FROM osoby JOIN hobby ON osoby.Hobby_id = hobby.id WHERE osoby.id = '$numer'";
$sql2 = mysqli_query($conn,$zapytanie2);

while($wynik2 = mysqli_fetch_row($sql2)) {
    echo "<h2>". $numer." ". $wynik2[0]." ".$wynik2[1]."</h2>";
    echo "<img src='$wynik2[4]' alt='$numer'>";
    echo "<p>". "Data urodzenia:".$wynik2[2]."</p>";
    echo "<p>" . "opis"." ". $wynik2[3]."</p>";
    echo "<p>". "Hobby". " ". $wynik2[5]."</p>";
}
}


mysqli_close($conn);
?>
        </form>
       </div>
 
          <div id="stopka">
          <p> Stronę wykonał:000000000 </p>
          </div>


    </body>
</html>