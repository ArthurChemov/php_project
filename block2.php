<!DOCTYPE html>
<html>
    <head>
        <title>FirmaDogovor</title>
    </head>
    <body>
        <div class="wrapper">
        <h1>Block 2</h1>
        <button><a href="index.php">Home</a></button>
        </div>
        <?php
        $servername = "localhost";
        $username = "user";
        $password = "12345";
        $dbname = "firmadogovor";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Підготовка SQL запиту для видалення рядка з таблиці
            $sql = "SELECT * FROM dogovor";
            // Підготовка PDO запиту
            $stmt = $conn->prepare($sql);
            // Виконання запиту
            $stmt->execute();
            $correct = 'dogovor_correct.php';

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table>";
            echo "<tr><th>ID</th><th>ID фірми</th><th>Кількість</th><th>Назва</th><th>Сума</th><th>Дата початку</th><th>Дата кінця</th><th>Аванс</th></tr>";
            foreach($result as $row) {
                echo "<tr><td>".$row["id_d"]."</td><td>".$row["id_firm"]."</td><td>".$row["numberd"]."</td><td>".$row["named"]."</td>
                <td>".$row["sumd"]."</td><td>".$row["datastart"]."</td><td>".$row["datafinish"]."</td><td>".$row["avans"]."</td>";
                echo '
                <td><form method="post" action="dogovor_correct.php?id='.$row['id_d'].'">
                    <input type="hidden" name="id" value='.$row["id_d"].'>
                    <input type="submit" name="Редагувати" value="Редагувати">
                </form></td>';
                echo '
                <td><form method="post" action="dogovor_delete.php?id='.$row['id_d'].'">
                    <input type="hidden" name="id" value='.$row["id_d"].'>
                    <input type="submit" name="Видалити" value="Видалити">
                </form></td></tr>';
            }
            echo "</table>";
        } catch(PDOException $e) {
            echo "Помилка: " . $e->getMessage();
        }
        $new_dogovor = 'dogovor_new.php';
        echo "<button><a href=" . $new_dogovor . ">Новий договір</a></button>";

        // Закриття підключення
        unset($conn);
        ?>
    </body>

</html>