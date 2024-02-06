<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update.PHP</title>
</head>
<body>
    <?php
        
        if (!empty($_POST["id"]))
        {
            $server = "192.168.15.20";
            $user = "root";
            $password = "zaq12wsx";
            $database = "phpgeneral";

            if (!empty($_POST["nameU"]) && !empty($_POST["lastnameU"]) && !empty($_POST["ageU"]))
            {
                $conn = mysqli_connect($server, $user, $password, $database);

                if (!$conn)
                    die('ERROR ' . mysqli_connect_error());


                $sql = "UPDATE `phpgeneral` SET `imie`='" . $_POST["nameU"] . "',`nazwisko`='" . $_POST["lastnameU"] . "',`wiek`='" . $_POST["ageU"] . "' WHERE ID = " . $_POST["id"];

                if (mysqli_query($conn, $sql))
                    echo "UPDATED";
                else
                    echo "ERROR " . mysqli_error($conn);

                mysqli_close($conn);
            }

            $id = $_POST["id"];
            $dane = null;

            $conn = mysqli_connect($server, $user, $password, $database);

            if (!$conn)
                die('ERROR ' . mysqli_connect_error());

            $sql = "SELECT * FROM phpgeneral WHERE ID = " . $id;
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result))
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $dane = $row;
                }
            }

            mysqli_close($conn);
        }
    ?>

    <form action="update.php" method="post">
        <input type="text" name="nameU" value="<?php echo $dane["imie"]; ?>">
        <input type="text" name="lastnameU" value="<?php echo $dane["nazwisko"]; ?>">
        <input type="text" name="ageU" value="<?php echo $dane["wiek"]; ?>">
        <input type="text" name="id" value="<?php echo $id; ?>" hidden>
        <input type="submit" value="ZMIEŃ">
    </form>
</body>
</html>