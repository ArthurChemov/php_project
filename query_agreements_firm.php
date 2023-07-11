<!DOCTYPE html>
<html>
    <head>
        <title>FirmaDogovor</title>
    </head>
    <body>
        <div class="wrapper">
        <h1>Усі договори для зазначеної фірми за вказаний період</h1>
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
        SELECT firm.name, dogovor.numberd, dogovor.named, dogovor.sumd, dogovor.datastart, dogovor.datafinish, dogovor.avans
        FROM firm INNER JOIN dogovor ON firm.id_firm = dogovor.id_firm
        WHERE firm.name = '$name' AND dogovor.datastart >= '$datastart' AND dogovor.datafinish <= '$datafinish';
        ";

        $result = $conn->query($sql);

        // виведення результатів запиту
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Фірма</th><th>Кількість</th><th>Назва</th><th>Сума</th><th>Дата початку</th><th>Дата кінця</th><th>Аванс</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["numberd"]."</td><td>".$row["named"]."</td>
                <td>".$row["sumd"]."</td><td>".$row["datastart"]."</td><td>".$row["datafinish"]."</td><td>".$row["avans"]."</td>";
            }
            echo "</table>";
        } else {
          echo "0 results";
        }

        $conn->close();
        }
        ?>
    </body>

</html>