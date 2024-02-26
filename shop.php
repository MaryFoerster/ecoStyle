<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Shop</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'menu.php'; ?>

    <main>
        <?php include 'artikel.php'; ?>

        <div class="shop_container_alle1">
            <form id="bestellformular" method="post" action="formular_danke.php">
                <?php for ($i = 0; $i < count($artikel); $i++) { ?>
                    <div class="container_onlineShop">
                        <div class="onlineShop__item1">
                            <img src="<?php echo $images[$i]; ?>" alt="<?php echo $artikel[$i]; ?>">
                        </div>
                        <div class="onlineShop__item2">
                            <h3><?php echo $artikel[$i]; ?></h3>
                        </div>
                        <div class="onlineShop__item3">
                            <h5 id='artikelpreis_<?php echo $i; ?>' data-preis='<?php echo $preis[$i]; ?>'>
                                <?php echo number_format($preis[$i], 2, ',', '.'); ?> €
                            </h5>
                        </div>
                        <div class="onlineShop__item4">
                            <input id='artikelanzahl_<?php echo $i; ?>' type="number" value='0' min='0' name='artikelanzahl[<?php echo $i; ?>]' onchange="updateGesamtsumme()">
                        </div>
                        <div class="onlineShop__item5">
                            <p id='artikelsumme_<?php echo $i; ?>'>0,00 €</p>
                        </div>
                    </div>
                <?php } ?>
        </div>

                <div class="shop_container_alle2">
                    <div class="container_onlineShop2">
                        <div class="shop__item2_1">
                            <p>Nettosumme</p>
                            <p id="nettosumme">0,00 €</p>
                        </div>
                        <div class="shop__item2_2">
                            <p>Mehrwertsteuer (19%)</p>
                            <p id="mwstsumme">0,00 €</p>
                        </div>
                        <div class="shop__item2_3">
                            <p>Gesamtsumme</p>
                            <p id="bruttosumme">0,00 €</p>
                        </div>
                    </div>
                </div>

                <h2>Bestellformular</h2>

                <input type="hidden" id="gesamtsummeInput" name="gesamtsumme" value="0">

                <div class="kontaktEmail__containerbox">
                    <div class="kontaktEmail__containerbox_eins">
                        <label for="vorname"><p>Vorname</p></label>
                        <br>
                        <input type="text" id="vorname" placeholder="Vorname" name="vorname"  required> 
                        <br>
                        <label for="nachname"><p>Nachname</p></label>
                        <br>
                        <input type="text" id="nachname" placeholder="Nachname" name="nachname"  required> 
                        <br>
                        <label for="email"><p>e-mail</p></label>
                        <br>
                        <input type="email" id="email" placeholder="e-mail" name="email"  required>
                        <br>
                        <label for="strasse"><p>Straße</p></label>
                        <br>
                        <input type="text" id="strasse" placeholder="Straße" name="strasse"  required>
                        <br>
                        <label for="hausnummer"><p>Hausnummer</p></label>
                        <br>
                        <input type="text" id="hausnummer" name="hausnummer" placeholder="Hausnummer" required>
                        <br>
                        <label for="ort"><p>Ort</p></label>
                            <br>
                            <input type="text" id="ort" placeholder="Ort" name="ort" required> 
                            <br>
                    </div>

                        <div class="kontaktEmail__containerbox_zwei">
                            <label for="plz"><p>PLZ</p></label>
                            <br>
                            <input type="text" id="plz" placeholder="PLZ" name="plz" required> 
                            <br><br>
                            <label for="option1"><p>Im Geschäft abholen</p></label>
                            <input id="option1" type="radio" name="versandoption" value="abholen" checked onchange="updateGesamtsumme()">
                            <br>
                            <label for="option2"><p>Lieferung 5,90 €</p><p>*Lieferung ab 100 € Einkaufswert gratis</p></label>
                            <input id="option2" type="radio" name="versandoption" value="liefern" onchange="updateGesamtsumme()">
                            <br>
                            <br>
                            <label for="nachricht"><p>Nachricht</p></label>
                            <br>
                            <textarea id="nachricht" name="nachricht" placeholder="nachricht"  required></textarea>
                            <br>
                            <label for="dsgvo-check"><p>Ich stimme der DSGVO zu</p></label>
                            <br>
                            <input type="checkbox" id="dsgvo-check" name="dsgvo-check" required>
                            <br>
                            <button type="submit" name="submit">Bestellung absenden</button>
                    </div>
                </div>  

            </form>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        function updateGesamtsumme() {
    let gesamtNetto = 0;
    const anzahlArtikel = <?php echo count($artikel); ?>;
    for (let i = 0; i < anzahlArtikel; i++) {
        let menge = parseFloat(document.getElementById('artikelanzahl_' + i).value);
        let preis = parseFloat(document.getElementById('artikelpreis_' + i).getAttribute('data-preis'));
        let summe = menge * preis;
        document.getElementById('artikelsumme_' + i).innerText = summe.toFixed(2).replace('.', ',') + ' €';
        gesamtNetto += summe;
    }

    let mwst = gesamtNetto * 0.19;
    let bruttosumme = gesamtNetto + mwst;

    let versandOption = document.querySelector('input[name="versandoption"]:checked').value;
    let versandKosten = 0;
    if (versandOption === "liefern" && gesamtNetto < 100) {
        versandKosten = 5.90;
    }

    bruttosumme += versandKosten;
    
    document.getElementById('nettosumme').innerText = gesamtNetto.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('mwstsumme').innerText = mwst.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('bruttosumme').innerText = bruttosumme.toFixed(2).replace('.', ',') + ' €';

    document.getElementById('gesamtsummeInput').value = bruttosumme.toFixed(2);
}

document.addEventListener('DOMContentLoaded', updateGesamtsumme);
const inputs = document.querySelectorAll('input');
inputs.forEach(input => input.addEventListener('change', updateGesamtsumme));

    </script>

</body>
</html>
