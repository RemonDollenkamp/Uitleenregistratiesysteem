<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>header</title>
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="#">Rocfriesepoort</a></div>
        <ul class="links">
        <li><a href="login.php">Login</a></li>
       
          <li>
            <a href="#" class="desktop-item">Sorteer</a>
            <input type="checkbox" id="showDrop">
            <label for="showDrop" class="mobile-item">Sorteer</label>
            <ul class="drop-menu">
              <li><a href="#">Beschikbaar</a></li>
              <li><a href="#">Uitgeleend</a></li>
            </ul>
          </li>
          <li>
            <a href="#" class="desktop-item">Categorie</a>
            <input type="checkbox" id="showDrop">
            <label for="showDrop" class="mobile-item">Categorie</label>
            <ul class="drop-menu">
              
<?php

//connectie maken met de database
Include "configure.php";
session_start();

//info uit de database halen
$sql3 = "SELECT `Naam` FROM categorieen";
$result2 = $conn->query($sql3);
//header van de tabel
foreach ($result2 as $row2) {
echo "
<li><p>" . $row2['Naam']  . "</p></li>



<tbody>

";


    }
  ?>


             
            </ul>
            
          
         
        </ul>
        
      </div>
      <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Typ iets om te zoeken..." required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      </form>
    </nav>
  </div>
<?php


//verwijzing naar de pagina "nieuwe_categorie_popup.php", daar staat de code van de nieuwe categorie popup in.




echo "<br><br><br><div class='apparatencontainer'>";

    $sql = "SELECT * FROM apparaten";
    if ($result = $conn->query($sql)) {
      foreach ($result as $row) {
      echo "
      
      <div class='nested'>
      <div>catagorie: " . $row['Categorie'] . "</div>
      <div>apparaat: " . $row['Apparaatnaam'] . "</div>
            <div><img class='Image-AO' src=img/" . $row['Afbeelding'] . "></div>
            <div> <br>";
            if($row['status'] == 0){
                echo"<p style='color:Red; text-decoration:underline;'>Uitgeleend</p> </div>
                </div>";
            }else{
              echo"<p style='color:Green; text-decoration:underline;'> Beschikbaar</p> </div>
              </div>";
      }}}
    echo "</div>";      
    
?>Include "login.css";
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apparaten overzicht</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

</head>
<body>

<div class="form-popup" id="myForm">
  <form action="" method="POST" class="form-apparaten-overzicht">
    <h1></h1>

    <input type="text" placeholder="Naam Docent" name="Docent" required>
    
    <input type="text" placeholder="Leerlingnummer" name="Leerlingnmr" required>
    <input type="date" name="Retouneer" required>

    <button name="submittie" class="btn-AO">Leen uit</button>
    <a type="button" class="btn-cancel-AO" href="/Uitleenregistratiesysteem/Apparaten%20overzicht.php#">Sluit</a>
  </form>
</div>



</body>
</html>

<?php
if (isset($_POST['submittie'])) {


  $apparaat= $_GET['apparaat'];
  $retouneerdatum = $_POST['Retouneer']; 
  $docent = $_POST['Docent']; 
  $leerlingnmr = $_POST['Leerlingnmr']; 
  $datum=date('d-m-Y');

  
  

  $sql = "INSERT INTO `uitleen`(`Docent`, `Naam`, `Apparaat`,`Uitleendatum`, `Inleverdatum`) VALUES ('$docent', '$leerlingnmr', '$apparaat', '$datum', '$retouneerdatum' )";

 $insert = $conn->query($sql);


  if ($insert)  {

    $sql4 = "UPDATE `apparaten` SET `status`=0 WHERE Apparaatnaam='$apparaat'";
    
    $update = $conn->query($sql4);

    if ($update)  {
      header("location:/Uitleenregistratiesysteem/Apparaten%20overzicht.php#");
    }}}
?>