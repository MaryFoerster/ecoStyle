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
    <header>
        <?php include 'menu.php'; ?>
    </header>
    <main>
        <?php include 'artikel.php'; ?>

        <div class="container">
            <h1>Shop</h1>
        </div>
        <div class="container">
            <div class="shop__container_list">
                <div class="shop__item_list"><p>Produkt</p></div>
                <div class="shop__item_list"><p>Preis</p></div>
                <div class="shop__item_list"><p>Menge</p></div>
                <div class="shop__item_list"><p>Gesamtpreis</p></div>
            </div>
        </div>

        <div class="container">
            <form id="bestellformular" method="post" action="formular_danke.php">
                <!-- Artikel-Liste -->
                <?php for ($i = 0; $i < count($artikel); $i++) { ?>
                <div class="shop__container">
                    <div class="shop__item">
                        <img src="<?php echo $images[$i]; ?>" alt="<?php echo $artikel[$i]; ?>">
                    </div>
                    <div class="shop__item">
                        <h3><?php echo $artikel[$i]; ?></h3>
                    </div>
                    <div class="shop__item">
                        <h5 id='artikelpreis_<?php echo $i; ?>' data-preis='<?php echo $preis[$i]; ?>'>
                            <?php echo number_format($preis[$i], 2, ',', '.'); ?> €
                        </h5>
                    </div>
                    <div class="shop__item">
                        <input id='artikelanzahl_<?php echo $i; ?>' type="number" value='0' min='0' name='artikelanzahl[<?php echo $i; ?>]' onchange="updateGesamtsumme()">
                    </div>
                    <div class="shop__item">
                        <p id='artikelsumme_<?php echo $i; ?>'>0,00 €</p>
                    </div>
                </div>
                <?php } ?>


                <div class="shop__container2container">
                    <div class="shop__container2">
                        <!-- Versandoptionen -->
                        <div class="shop__item3">
                            <label for="option1"><p>Im Geschäft abholen</p></label>
                        </div>
                        <div class="shop__item4">
                            <input id="option1" type="radio" name="versandoption" value="abholen" checked onchange="updateGesamtsumme()">
                        </div>
                        <div class="shop__item3">
                            <label for="option2"><p>Lieferung 5,90 €<br>*Lieferung ab 100 € Einkaufswert gratis</p></label>
                        </div>
                        <div class="shop__item4">
                            <input id="option2" type="radio" name="versandoption" value="liefern" onchange="updateGesamtsumme()">
                        </div>
                    </div>

                    <div class="shop__container2">
                        <!-- Preisübersicht -->
                        <div class="shop__item2">
                            <p>Nettosumme</p>
                            <p id="nettosumme">0,00 €</p>
                        </div>
                        <div class="shop__item2">
                            <p>Mehrwertsteuer (19%)</p>
                            <p id="mwstsumme">0,00 €</p>
                        </div>
                        <div class="shop__item2">
                            <p>Gesamtsumme</p>
                            <p id="bruttosumme">0,00 €</p>
                        </div>
                    </div>
                </div>

                <!-- Verstecktes Feld für die Gesamtsumme -->
                <input type="hidden" id="gesamtsummeInput" name="gesamtsumme" value="0">

                <!-- Kontaktformular -->
                <div class="kontakt__containerbox_zwei">
                    <!-- Kontaktinformationen und Nachricht -->
                    <h3>Tritt mit uns in Kontakt</h3>

                    <!-- Weitere Formularelemente -->
                    <label for="vorname">Vorname</label>
                    <input type="text" id="vorname" name="vorname"  required> 
                    <br>
                    <br>
                    <label for="nachname">Nachname</label>
                    <input type="text" id="nachname" name="nachname"  required> 
                    <br>
                    <br>
                    <label for="email">email</label>
                    <input type="email" id="email" name="email"  required>
                    <br>
                    <br>
                    <label for="strasse">Straße</label>
                    <input type="text" id="strasse" name="strasse"  required> 
                    <br>
                    <br>
                    <label for="hausnummer">hausnummer</label>
                    <input type="text" id="hausnummer" name="hausnummer"  required>
                    <br>
                    <br>
                    <label for="ort">Ort</label>
                    <input type="text" id="ort" name="ort" required> 
                    <br>
                    <br>
                    <label for="plz">PLZ</label>
                    <input type="text" id="plz" name="plz" required> 
                    <br>
                    <br>
                    <label for="nachricht">nachricht</label>
                    <textarea id="nachricht" name="nachricht" placeholder="nachricht"  required></textarea>
                    <br>
                    <br>
                    <input type="checkbox" id="dsgvo-check" name="dsgvo-check" required>
                    <label for="dsgvo-check">Ich stimme der DSGVO zu</label>
                    <br>
                    <br><br>
                    <button type="submit" name="submit">Bestellung absenden</button>
                </div>
            </form>
        </div>
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

    // Versandkosten hinzufügen, falls notwendig
    let versandOption = document.querySelector('input[name="versandoption"]:checked').value;
    let versandKosten = 0;
    if (versandOption === "liefern" && gesamtNetto < 100) {
        versandKosten = 5.90;
    }

    bruttosumme += versandKosten;
    
    // Update der Anzeige im Formular
    document.getElementById('nettosumme').innerText = gesamtNetto.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('mwstsumme').innerText = mwst.toFixed(2).replace('.', ',') + ' €';
    document.getElementById('bruttosumme').innerText = bruttosumme.toFixed(2).replace('.', ',') + ' €';

    // Update des versteckten Feldes für die Gesamtsumme
    document.getElementById('gesamtsummeInput').value = bruttosumme.toFixed(2);
}

// EventListener für die Initialisierung beim Laden der Seite und bei Änderungen
document.addEventListener('DOMContentLoaded', updateGesamtsumme);
const inputs = document.querySelectorAll('input');
inputs.forEach(input => input.addEventListener('change', updateGesamtsumme));

    </script>

</body>
</html>
