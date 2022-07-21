<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Restauracja Wszystkie Smaki</title>
    <link href="styl_11.css" rel="stylesheet">
</head>
<body>
    <div id="baner">
        <h1>Witamy w restauracji: "Wszystkie smaki"</h1>
    </div>

    <div id="lewy">
        <img src="restauracja.jpg" alt="Nasze danie">
    </div>
    <div id="prawy">
        <h4>U nas dobrze zjesz!</h4>
        <ol>
            <li>Obiady od 40 zł</li>
            <li>Przekąski od 10 zł</li>
            <li>Kolacje od 20 zł</li>
        </ol>
    </div>
    
    <div id="dolny">
        <h2>Zarezerwuj stolik on-line</h2>
        <form action="" method="POST">

            <label for="date">Data (format rrrr-mm-dd)</label><br>
            <input type="date" name="date" id="date" ><br>

            <label for="ileosob"></label>ile osob?</label><br>
            <input type="number" name="ileosob" id="ileosob" ><br>
          
            <label for="telefon">Twój numer telefonu</label><br>
            <input type="text" name="telefon" id="telefon"><br>

            <input type="checkbox" name="zgoda" id="zgoda">
            <label for="zgoda">Zgadzam się na przetwarzanie moich danych osobowych</label>
            <br>
         
            <input type="submit" value="wyczysc" class="przyciski" name="wyczysc">
            <input type="submit" value="rezerwuj" class="przyciski" name="rezerwuj">
        </form>

        <?php

        //polaczenie z baza
        $servername = 'localhost';
        $username = 'root1';
        $password = 'hania123';
        $dbname = 'baza';

        $conn = mysqli_connect ($servername, $username, $password, $dbname);

        if(!$conn) {
            die("blad polaczenia" . mysqli_connect_error());
        }

        
        //sprawdzanie czy istnieje tabela "baza" w bazie danych
        $result = mysqli_query($conn, "SHOW TABLES LIKE 'rezerwacje' ");

        //jeśli nie istnieje to ją stwórz
            if(mysqli_num_rows($result) === 0) {
       
        //formujemy SQL zakładający tabelę w BD
        $sql = 'CREATE TABLE rezerwacje (
            id INT AUTO INCREMENT PRIMARY KEY,
            nr_stolika INT NOT NULL,
            data_rez DATE NOT NULL,
            liczba_osob INT NOT NULL,
            telefon TEXT
            ) ';

        //wysyłamy stworzone polecenie do BD
        mysqli_query($conn, $sql);
    }

        //przypisanie danych z formularza do zmiennych
        $date = $_POST['date'];
        $ileosob = $_POST['ileosob'];
        $telefon = $_POST['telefon'];

        //kwerenda dodajaca dane do bc
        $sql1 = "INSERT INTO rezerwacje (id, nr_stolika, data_rez, liczba_osob, telefon) 
            VALUES (NULL, '1', '$date', '$ileosob', '$telefon' ) ";

        //wykonywanie polecenia na bd
        if(mysqli_query($conn, $sql1) ) {
            ?>
        <p>Dodano rezerwację do bazy</p>
            <?php

    } else {
        die ("Bład dodawania danych");
    }

    mysqli_close($conn);
?>
    </div>

<footer>
Stronę internetową opracował: <i>91022401861</i>
</footer>
</body>
</html>