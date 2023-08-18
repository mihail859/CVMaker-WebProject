<!DOCTYPE html>
<html>
<head>
    <title>CV Архив</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        table{
            border-collapse: collapse;
            width:70%;
            color: #3D0C0C;
            font-family: monospace;
            font-size: 25px;
            text-align: center;

        }
        th {
    background-color: #060606;
    color: white;
    }   
    tr:nth-child(even) {background-color: #f2f2f2}
    #start_date {
        width: 200px;
        height: 30px; 
        font-size: 16px;  
        padding: 5px; 
    }
    #end_date{
        width: 200px;
        height: 30px; 
        font-size: 16px;  
        padding: 5px; 
    }
    #search_button{
        width: 200px;
        height: 30px;
        font-size: 16px;
        padding: 5px;
        border-radius: 15px; 
    }
    </style>
    
</head>
<body>
    
    <div class="container">
        <h1>CV Архив</h1>
        
        
        <form action="data.php" method="get">
            <label style="font-size: 23px; font-family: Brush Script MT, cursive;" for="start_date">Начало: </label>
            <input type="date" id="start_date" name="start_date" required>

            <label style="font-size: 23px; font-family: Brush Script MT, cursive;" for="end_date">Край: </label>
            <input  type="date" id="end_date" name="end_date" required>

            <button type="submit" id="search_button">Търси</button>
        </form>
        <div class="top-right-link" style="margin-top: 10px;">
            <a href="index.php"><img src="left-arrow.png" alt="Стрелка" width="40" height="40"></a>
        </div>
        
        <?php
        $is_name_valid = true;
        $is_second_name_valid = true;
        $is_last_name_valid = true;
        $is_university = true;

        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "cv_database";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $first_name = $_POST["first_name"];
            if (empty($first_name) || $first_name=="Име...") {
                echo "<label style='font-size: 28px; color: red;'>Липсва име!</label><br>";
                
            }
            else if (!preg_match("/^[\p{Cyrillic}\s]+$/u", $first_name)){
                echo "<label style='font-size: 28px; color: red;'>Невалидно име!</label><br>";
                $is_name_valid = false;
            }
            
            $second_name = $_POST["second_name"];
            if (empty($second_name)|| $second_name=="Презиме..."){
                echo "<label style='font-size: 28px; color: red;'>Липсва презиме!</label><br>";
                
            }
            else if (!preg_match("/^[\p{Cyrillic}\s]+$/u", $second_name)){
                echo "<label style='font-size: 28px; color: red;'>Невалидно презиме!</label><br>";
                $is_second_name_valid = false;
            }

            $last_name = $_POST["last_name"];
            if (empty($last_name) || $last_name=="Фамилия..."){
                echo "<label style='font-size: 28px; color: red;'>Липсва фамилия!</label><br>";
               
            }
            else if (!preg_match("/^[\p{Cyrillic}\s]+$/u", $last_name)){
                echo "<label style='font-size: 28px; color: red;'>Невалидна фамилия!</label><br>";
                $is_last_name_valid = false;
            }
            
            $birthday = $_POST["birtday"];
            $university = $_POST["selectOption"];
            if ($university == "Изберете университет..."){
                echo "<label style='font-size: 28px; color: red;'>Липсва университет!</label><br>";
                $is_university = false;
            }
            
            if (isset($_POST["lang"]))
                $skills = implode(", ", $_POST["lang"]);
            else {
                echo "<label style='font-size: 28px; color: red;'>Въведи умения!</label><br>";
            }
            if ((!empty($first_name))&& (!empty($second_name))&& (!empty($last_name)) && (!empty($skills)) && $is_university && $is_name_valid && 
            $is_second_name_valid && $is_last_name_valid){ 
                        $sql = "INSERT INTO user_data (first_name, second_name, last_name, birthday, university, skills)
                        VALUES ('$first_name', '$second_name', '$last_name', '$birthday', '$university', '$skills')";
        
                    if ($conn->query($sql) === TRUE) {
                        echo "<label style='font-size: 28px; color: green;'>Успешно добавяне към БД</label><br>";
                        
                    } else {
                        echo "Грешка" . $sql . "<br>" . $conn->error;
                    }
                }        
        }
        
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

                
        $start_date = $_GET["start_date"];
        $end_date = $_GET["end_date"];
        if (!empty($start_date) && (!empty($end_date))){

        
        $sql = "SELECT * FROM user_data WHERE birthday BETWEEN '$start_date' AND '$end_date'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Име</th><th>Презиме</th><th>Фамилия</th><th>Дата на раждане</th><th>Университет</th><th>Умения</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    
                    echo "<tr>";
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
                echo "<label style='font-size: 28px; color: #750D0D;'>Няма съвпадения</label><br>";
                
            }

            $conn->close();
        }    
        ?>
    </div>
</body>
</html>
