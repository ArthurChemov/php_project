<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Нова фірма</h2>
		<button><a href="block2.php">Переглянути фірми</a></button>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="id_firm">ID Фірма:</label>
            <input type="number" name="id_firm" id="id_firm"><br>
            <label for="numberd">Кількість:</label>
            <input type="number" name="numberd" id="numberd"><br>
            <label for="named">Назва:</label>
            <input type="text" name="named" id="named"><br>
            <label for="sumd">Сума:</label>
            <input type="number" name="sumd" id="sumd"><br>
            <label for="datastart">Дата початку:</label>
            <input type="date" name="datastart" id="datastart"><br>
            <label for="datafinish">Дата кінця:</label>
            <input type="date" name="datafinish" id="datafinish"><br>
            <label for="avans">Аванс:</label>
            <input type="count" name="avans" id="avans"><br><br>
            <input type="submit" value="Додати">
        </form>

		<?php
		// Перевіряємо, чи була натиснута кнопка "Пошук"
		if($_SERVER["REQUEST_METHOD"] == "POST"){

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

            // Отримання даних з форми
            $id_firm = $_POST['id_firm'];
            $numberd = $_POST['numberd'];
            $named = $_POST['named'];
            $sumd = $_POST['sumd'];
            $datastart = $_POST['datastart'];
            $datafinish = $_POST['datafinish'];
            $avans = $_POST['avans'];

            $sql = "SELECT MAX(id_d) as max_id FROM dogovor";
            $result = $conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $new_id = $row['max_id']+1;

            // Запит для додавання нового рядка
            $sql = "INSERT INTO dogovor (id_d, id_firm, numberd, named, sumd, datastart, datafinish, avans) VALUES ('$new_id', '$id_firm', '$numberd', '$named', '$sumd', '$datastart', '$datafinish', '$avans')";
            $stmt = $conn->prepare($sql);

            // Виконання запиту
            if ($stmt->execute()) {
                echo "<br>Новий рядок додано успішно.";
            } else {
                echo "Сталася помилка під час додавання нового рядка.";
            }

            // Закриття підключення
            unset($conn);
		}
		?>
	</body>
</html>