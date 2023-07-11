<!DOCTYPE html>
<html>
    <head>
        <title>FirmaDogovor</title>
    </head>
    <body>
        <div class="wrapper">
        <h1>Суми всіх договорів для зазначеної фірми за вказаний період</h1>
        <button><a href="block3.php">Переглянути запити</a></button>
        </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="name">Фірма:</label>
            <input type="text" name="name" id="name"><br>
            <label for="datastart">Дата початку:</label>
            <input type="date" name="datastart" id="datastart"><br>
            <label for="datafinish">Дата завершення:</label>
            <input type="date" name="datafinish" id="datafinish"><br><br>
            <input type="submit" name="change" value="Підтвердити">
        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){

        $servername = "localhost";
        $username = "user";
        $password = "12345";
        $dbname = "firmadogovor";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
        die("Помилка з'єднання: " . mysqli_connect_error());
        }

        $name = $_POST['name'];
        $datastart = $_POST['datastart'];
        $datafinish = $_POST['datafinish'];

        // запит MySQL
        $sql = "
        SELECT firm.name, Sum(dogovor.sumd) AS sum
        FROM firm INNER JOIN dogovor ON firm.id_firm = dogovor.id_firm
        GROUP BY firm.name, dogovor.datastart, dogovor.datafinish
        HAVING firm.name = '$name' AND dogovor.datastart >= '$datastart' AND dogovor.datafinish <= '$datafinish';
        ";

        $result = $conn->query($sql);

        // виведення результатів запиту
        if ($result->num_rows > 0) {
            echo "Сума всіх договорів для фірми ";
            $sum = 0;
            $nazv;
            while($row = $result->fetch_assoc()) {
                $nazv = $row["name"];
                $sum += $row["sum"];
            }
            echo $nazv." дорівнює ".$sum."<br>";
        } else {
        echo "0 results";
        }

        $conn->close();
        }
        ?>
    </body>

</html>