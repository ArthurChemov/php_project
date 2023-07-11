<!DOCTYPE html>
<html>
    <head>
        <title>FirmaDogovor</title>
    </head>
    <body>
        <div class="wrapper">
        <h1>Block 1</h1>
        <button><a href="index.php">Home</a></button>
        </div>
        <?php
        $servername = "localhost";
        $username = "user";
        $password = "12345";
        $dbname = "firmadogovor";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
          die("Помилка з'єднання: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM firm";
        $result = mysqli_query($conn, $sql);
        $search = 'firm_search.php';
        $new_firm = 'firm_new.php';
        $correct = 'firm_correct.php';

        if (mysqli_num_rows($result) > 0) {
          echo "<table>";
          echo "<tr><th>ID</th><th>Назва</th><th>Шеф</th><th>Адреса</th></tr>";
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["id_firm"]."</td><td>".$row["name"]."</td><td>".$row["shef"]."</td><td>".$row["address"]."</td>";
            echo '
            <td><form method="post" action="firm_correct.php?id='.$row['id_firm'].'">
                <input type="hidden" name="id" value='.$row["id_firm"].'>
                <input type="submit" name="Редагувати" value="Редагувати">
            </form></td>';
            echo '
            <td><form method="post" action="firm_delete.php?id='.$row['id_firm'].'">
                <input type="hidden" name="id" value='.$row["id_firm"].'>
                <input type="submit" name="Видалити" value="Видалити">
            </form></td></tr>';
          }
          echo "</table>";
        } else {
          echo "Немає результатів";
        }
        echo "<button><a href=" . $search . ">Пошук</a></button>";
        echo "<button><a href=" . $new_firm . ">Нова фірма</a></button>";

        mysqli_close($conn);
        ?>
    </body>

</html>