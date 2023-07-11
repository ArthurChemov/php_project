<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Нова фірма</h2>
		<button><a href="block1.php">Переглянути фірми</a></button>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="name">Назва:</label>
            <input type="text" name="name" id="name"><br>
            <label for="shef">Шеф:</label>
            <input type="text" name="shef" id="shef"><br>
            <label for="address">Адреса:</label>
            <input type="text" name="address" id="address"><br><br>
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

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Перевірка підключення
        if (!$conn) {
            die("Помилка з'єднання: " . mysqli_connect_error());
        }

        // Отримання даних з форми
        $name = $_POST['name'];
        $shef = $_POST['shef'];
        $address = $_POST['address'];

        $sql = "SELECT MAX(id_firm) as max_id FROM firm";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $new_id = $row['max_id']+1;

        // Запит для додавання нового рядка
        $sql = "INSERT INTO firm (id_firm, name, shef, address) VALUES ('$new_id', '$name', '$shef', '$address')";
        mysqli_query($conn, $sql);

        // Закриття підключення
        mysqli_close($conn);
		}
		?>
	</body>
</html>