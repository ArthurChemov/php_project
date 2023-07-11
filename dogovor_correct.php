<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Редагування запису</h2>
		<button><a href="block2.php">Переглянути договори</a></button>

		<?php
		// Підключення до бази даних
        $servername = "localhost";
        $username = "user";
        $password = "12345";
        $dbname = "firmadogovor";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Помилка: " . $e->getMessage();
        }

        $id = $_POST['id'];

        $sql = "SELECT * FROM dogovor WHERE id_d = $id";
        // Підготовка PDO запиту
        $stmt = $conn->prepare($sql);
        // Виконання запиту
        $stmt->execute();
        // вывод результатов запроса
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row) {
            $id = $row["id_d"];
            $id_firm = $row["id_firm"];
            $numberd = $row["numberd"];
            $named = $row["named"];
            $sumd = $row["sumd"];
            $datastart = $row["datastart"];
            $datafinish = $row["datafinish"];
            $avans = $row["avans"];
        }

        // Закриття підключення
        unset($conn);
		?>

		<form method="post" action="dogovor_edit.php">
            <br><span>ID:<?php echo $id; ?></span><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="id_firm">ID Фірма:</label>
            <input type="number" name="id_firm" id="id_firm" value="<?php echo $id_firm; ?>"><br>
            <label for="numberd">Кількість:</label>
            <input type="number" name="numberd" id="numberd" value="<?php echo $numberd; ?>"><br>
            <label for="named">Назва:</label>
            <input type="text" name="named" id="named" value="<?php echo $named; ?>"><br>
            <label for="sumd">Сума:</label>
            <input type="number" name="sumd" id="sumd" value="<?php echo $sumd; ?>"><br>
            <label for="datastart">Дата початку:</label>
            <input type="date" name="datastart" id="datastart" value="<?php echo $datastart; ?>"><br>
            <label for="datafinish">Дата кінця:</label>
            <input type="date" name="datafinish" id="datafinish" value="<?php echo $datafinish; ?>"><br>
            <label for="avans">Аванс:</label>
            <input type="count" name="avans" id="avans" value="<?php echo $avans; ?>"><br><br>
            <input type="submit" name="change" value="Змінити">
        </form>
	</body>
</html>