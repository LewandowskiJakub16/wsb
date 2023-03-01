<?php
$firstname = "Janusz";
$secondname = "Nowak";
echo "Imie i nazwisko $firstname $secondname <br>";
echo 'Imie i nazwisko $firstname $secondname <br>';

//heardoc
echo <<< DATA

<hr>
Imie: $firstname <br>
Nazwisko: $secondname
<hr>
DATA;

$data = <<< DATA
<hr>
Imie: $firstname <br>
Nazwisko: $secondname
<hr>
DATA;

echo $data;

$data1 = <<< 'DATA1'
<hr>
Imie: $firstname <br>
Nazwisko: $secondname
<hr>
DATA1;

echo $data1;

$bin = 0b1010;
echo $bin;
echo "<br>";

$oct = 0101;
echo $oct;
echo "<br>";

$hex = 0x1A;
echo $hex;
echo "<br>";

echo PHP_VERSION;
echo "<br>";

$x=1;
$y=1.0;
echo gettype($x);
echo "<br>";

echo gettype($y);
echo "<br>";

if($x==$y){
    echo "Identyczne";
}else{
    echo "Nie identyczne";
}

?>