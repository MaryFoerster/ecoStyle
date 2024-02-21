<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
<?php include 'menu.php'; ?>
</header>

<ul>
  <li>
    <a href="#">
      <i class="fab fa-edge"></i>
    </a>
  </li>
  <li>
    <a href="#">
      <i class="fab fa-firefox"></i>
    </a>
    </li>
  <li>
    <a href="#">
      <i class="fab fa-chrome"></i>
    </a>
    
  </li>
  <li>
    <a href="#">
      <i class="fab fa-opera"></i>
    </a> 
  </li>
</ul>


<div class="container_1">
  <div class="home__header">
      <img src="images/frühling.jpg" alt="Bild des aktuellen Monats"> 
  </div>
</div>


  <div class="container_3">
    <div class="container_3_box1">
       <img src="img/Handtasche.jpg" alt="">
    </div>

    <div class="container_3_box2">
        <img src="img/kleid.jpg" alt="">
    </div>

    <div class="container_3_box3">
        <img src="img/strumpfhose.jpg" alt="">
    </div>
  </div>


  <div class="container_2">
    <div class="container_2_box1">
      <h1>Eco Style</h1>
      <p>
        Willkommen bei EcoStyle, wo unsere Vision zu einer Bewegung für bewussten Konsum wurde, die Individualität und Umweltschutz in den Fokus rückt. Jedes maßgeschneiderte Produkt in unserem Online-Shop erzählt die Geschichte einer nachhaltigen Entscheidung und unterstützt lokale Handwerker und Designer. Tauchen Sie ein in unsere Welt, wo Ihre Individualität im Mittelpunkt steht und die Umwelt geschätzt wird.
        Hier finden Sie nicht nur Mode, sondern eine Ode an die Schönheit der Natur und die Kunst der nachhaltigen Gestaltung. Genießen Sie eine einzigartige Shopping-Erfahrung, die nicht nur Ihren persönlichen Stil unterstreicht, sondern auch einen positiven Beitrag zu unserer Welt leistet.</p>
    </div>
    <div class="container_2_box2">
      <a href="#"><button>zu unseren Produkten</button></a>
    </div>
  </div>

    <?php include 'footer.php'; ?>
    <script>

const datum = new Date();
const monat = datum.getMonth();
let images = "";
switch (monat) {
  case 0: images = "winter.jpg"; break;
  case 1: images = "winter.jpg"; break;
  case 2: images = "fruehling.jpg"; break;
  case 3: images = "fruehling.jpg"; break;
  case 4: images = "fruehling.jpg"; break;
  case 5: images = "sommer.jpg"; break;
  case 6: images = "sommer.jpg"; break;
  case 7: images = "sommer.jpg"; break;
  case 8: images = "herbst.jpg"; break;
  case 9: images = "herbst.jpg"; break;
  case 10: images = "herbst.jpg"; break;
  case 11: images = "winter.jpg"; break;
}

let imgElement = document.querySelector(".home__header img");
imgElement.src = "images/" + images;

</script>
</body>
</html>