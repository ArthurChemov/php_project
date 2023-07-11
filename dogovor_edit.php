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

        // Отримання даних з форми
        $id = $_POST['id'];
        $edit_id_firm = $_POST['id_firm'];
        $edit_numberd = $_POST['numberd'];
        $edit_named = $_POST['named'];
        $edit_sumd = $_POST['sumd'];
        $edit_datastart = $_POST['datastart'];
        $edit_datafinish = $_POST['datafinish'];
        $edit_avans = $_POST['avans'];

        // Запит для додавання нового рядка
        $sql = "UPDATE dogovor SET id_firm = '$edit_id_firm', numberd = '$edit_numberd', named = '$edit_named', sumd = '$edit_sumd',
         datastart = '$edit_datastart', datafinish = '$edit_datafinish', avans = '$edit_avans' WHERE id_d = $id";
        $result = $conn->prepare($sql);

        // Виконання запиту
        if ($result->execute()) {
            echo "<br>Успішно змінено запис";
        } else {
            echo "Сталася помилка під час редагування рядка.";
        }

        // Закриття підключення
        unset($conn);
		?>
	</body>
</html>