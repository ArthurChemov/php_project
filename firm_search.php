<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Пошук за назвою фірми</h2>
		<button><a href="block1.php">Переглянути фірми</a></button>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<label for="search">Введіть назву:</label>
			<input type="text" name="search" id="search" required>
			<br><br>
			<input type="submit" value="Пошук">
		</form>

		<?php
		// Перевіряємо, чи була натиснута кнопка "Пошук"
		if($_SERVER["REQUEST_METHOD"] == "POST"){

			// Отримуємо введену користувачем назву та очищуємо її від небажаних символів
			$search = trim($_POST["search"]);
			$search = stripslashes($search);
			$search = htmlspecialchars($search);

			// Підключаємося до бази даних
			$servername = "localhost";
			$username = "user";
			$password = "12345";
			$dbname = "firmadogovor";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
				die("Помилка з'єднання: " . mysqli_connect_error());
			}

			// Виконуємо запит до бази даних
			$sql = "SELECT * FROM firm WHERE name LIKE '%$search%'";
			$result = mysqli_query($conn, $sql);

			// Виводимо результати пошуку
			if (mysqli_num_rows($result) > 0) {
				echo "<h3>Результати пошуку:</h3>";
				echo "<table>";
				echo "<tr><th>ID</th><th>Назва</th><th>Шеф</th><th>Адреса</th></tr>";
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>".$row["id_firm"]."</td><td>".$row["name"]."</td><td>".$row["shef"]."</td><td>".$row["address"]."</td></tr>";
				}
				echo "</table>";
			} else {
				echo "<p>Результати не знайдено</p>";
			}

			// Закриваємо з'єднання з базою даних
			mysqli_close($conn);
		}
		?>
	</body>
</html>