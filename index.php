<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index.PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="post">
        <label>imie: <input type="text" name="name"></label>
        <label>nazwisko: <input type="text" name="lastname"></label>
        <label>wiek: <input type="number" name="wiek" min="0"></label>
        <input type="submit" value="zapisz">
    </form>

    <br><br><br>

    <form action="index.php" method="post">
    <?php

        $server = "192.168.15.20";
        $user = "root";
        $password = "zaq12wsx";
        $database = "phpgeneral";

        //INSERT
        if (!empty($_POST["name"]) && !empty($_POST["lastname"]) && !empty($_POST["wiek"]))
        {         
            $conn = mysqli_connect($server, $user, $password, $database);

            if (!$conn)
                die('ERROR ' . mysqli_connect_error());

            $sql = "INSERT INTO `phpgeneral`(`ID`, `imie`, `nazwisko`, `wiek`) VALUES (null,'" . $_POST["name"] . "','" . $_POST["lastname"] . "','" . $_POST["wiek"] . "')";

            if (!mysqli_query($conn, $sql))
                echo mysqli_error($conn);

            mysqli_close($conn);
        }

        //DELETE
        if (!empty($_POST["id"]))
        {
            $conn = mysqli_connect($server, $user, $password, $database);

            if (!$conn)
                die('ERROR ' . mysqli_connect_error());
    
            $sql = "DELETE FROM `phpgeneral` WHERE ID=" . $_POST["id"];

            if (!mysqli_query($conn, $sql))
                echo "ERROR " . mysqli_error($conn);

            mysqli_close($conn);
        }

        //SELECT
        $conn = mysqli_connect($server, $user, $password, $database);

        if (!$conn)
            die('ERROR ' . mysqli_connect_error());

        $sql = "SELECT * FROM phpgeneral";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result))
        {
            echo "<select name='id'>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<option  value='" . $row["ID"] . "'>"
                    . $row["imie"] . " "
                    . $row["nazwisko"] . ", "
                    . $row["wiek"]
                    . "</option>";
            }
            echo "</select>";
        }

        mysqli_close($conn);

    ?>
    <input type="submit" value="DELETE">
    </form>

    <br><br>

    <form action="update.php" method="post">
    <?php
    
        $conn = mysqli_connect($server, $user, $password, $database);

        if (!$conn)
            die('ERROR ' . mysqli_connect_error());

        $sql = "SELECT * FROM phpgeneral";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result))
        {
            echo "<select name='id'>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<option  value='" . $row["ID"]
                                
                    . "'>"
                    . $row["imie"] . " "
                    . $row["nazwisko"] . ", "
                    . $row["wiek"]
                    . "</option>";
            }
            echo "</select>";
        }

        mysqli_close($conn);

    ?>
    <input type="submit" value="PRZEJDÅ»">
    </form>

</body>
</html>