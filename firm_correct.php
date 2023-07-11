<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Редагування запису</h2>
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

        $id = $_POST['id'];

        $sql = "SELECT * FROM firm WHERE id_firm = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id_firm"];
                $name = $row["name"];
                $shef = $row["shef"];
                $address = $row["address"];
            }
        }

        // Закриття підключення
        mysqli_close($conn);
		?>

		<form method="post" action="firm_edit.php">
            <br><span>ID:<?php echo $id; ?></span><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Назва:</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>"><br>
            <label for="shef">Шеф:</label>
            <input type="text" name="shef" id="shef" value="<?php echo $shef; ?>"><br>
            <label for="address">Адреса:</label>
            <input type="text" name="address" id="address" value="<?php echo $address; ?>"><br><br>
            <input type="submit" name="change" value="Змінити">
        </form>
	</body>
</html>