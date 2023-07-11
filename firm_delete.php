<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Видалення запису</h2>
		<button><a href="block1.php">Переглянути фірми</a></button>

        <?php

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
        $id = $_POST['id'];


        $sql = "DELETE FROM dogovor WHERE id_firm = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<br>Успішно видалено договори фірми";
        } else {
            echo "Помилка: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Запит для додавання нового рядка
        $sql = "DELETE FROM firm WHERE id_firm = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<br>Успішно видалено фірму";
        } else {
            echo "Помилка: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Закриття підключення
        mysqli_close($conn);
		?>
	</body>
</html>