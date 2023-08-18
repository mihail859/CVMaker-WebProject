
<!DOCTYPE html>
<html>
<head>
    <title>CV Архив</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <h1>CV Архив</h1>
        <?php
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "cv_database";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM user_data ORDER BY id DESC"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>First Name</th><th>Second Name</th><th>Last Name</th><th>Birthday</th><th>University</th><th>Skills</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["second_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["birthday"] . "</td>";
                echo "<td>" . $row["university"] . "</td>";
                echo "<td>" . $row["skills"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Няма съвпадения";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
