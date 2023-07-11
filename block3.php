<!DOCTYPE html>
<html>
    <head>
        <title>FirmaDogovor</title>
    </head>
    <body>
        <div class="wrapper">
        <h1>Block 3</h1>
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
        ?>
        <br>
        <button><a href="query_agreements_firm.php">Query1</a></button>
        <button><a href="query_sums_firms.php">Query2</a></button>
        <button><a href="query_info_longterm.php">Query3</a></button>
    </body>

</html>