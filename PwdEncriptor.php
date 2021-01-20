<!DOCTYPE HTMl>
<html>
    <head>
        <title>PWDEncriptor</title>
    </head>
    <body>
        <form action="./PwdEncriptor.php" method="POST">
            Password to encript: <input type="text" name="pwd"><br>
            <input type="submit" value="Send">
        </form>
        <?php
        $sname = 'localhost'; // Server Name
        $dbname = 'tripcount'; // DB name
        $username = "proyecto";  
        $password = "P@ssw0rd";  


        // DATABASE CONNECTION.

        try{
            // Connect to Database
            $conn = new PDO("mysql:host=$sname;dbname=tripcount", $uname, $pwd);

            // PDO error mode to exception.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        // ENCRIPT

        if (isset($_POST["pwd"])) {
            $password = $_POST["pwd"];
            $newPWD = hash(sha256, $password);
            $sql = 'INSERT INTO users VALUES(105, "Encripted", "User", "dunno@something.tk", "Mlem", '."'$newPWD'".');';
            echo "<br>Password: $password<br>Encripted password: $newPWD<br>Query: $sql";
        }
        ?>
    </body>
</html>

