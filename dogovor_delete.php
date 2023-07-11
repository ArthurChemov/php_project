<!DOCTYPE html>
<html>
	<head>
		<title>FirmaDogovor</title>
	</head>
	<body>
		<h2>Видалення запису</h2>
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


        $sql = "DELETE FROM dogovor WHERE id_d = $id";
        $result = $conn->prepare($sql);

        // Виконання запиту
        if ($result->execute()) {
            echo "<br>Успішно видалено запис";
        } else {
            echo "Сталася помилка під час редагування рядка.";
        }

        // $sql = "SELECT id_d FROM dogovor;";
        // // Підготовка PDO запиту
        // $stmt = $conn->prepare($sql);
        // // Виконання запиту
        // $stmt->execute();

        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $i = 1;
        // foreach($result as $row) {
        //     if($row["id_d"] != $i) {
        //         $tmp = $row["id_d"];
        //         $update = "UPDATE dogovor SET id_d = $i WHERE dogovor.id_d = $tmp;";
        //         // Підготовка PDO запиту
        //         $res = $conn->prepare($update);
        //         // Виконання запиту
        //         $res->execute();
        //     }
        //     $i++;
        // }

        // Закриття підключення
        unset($conn);
		?>
	</body>
</html>