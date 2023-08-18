<!DOCTYPE html>
<html lang="en">
    <script>
        function clearDefaultText(inputElement) {
            if (inputElement.value === "Име...") {
                inputElement.value = "";
            }
            if (inputElement.value === "Презиме..."){
                inputElement.value = "";
            }
            if(inputElement.value === "Фамилия..."){
                inputElement.value = "";
            }
        }
    </script>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CV Maker</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Add Technology Option</title>
    <style>
        .hidden {
            display: none;
        }
        #nameInput{
            width: 300px; 
        height: 25px; 
        font-size: 16px; 
        padding: 5px; 
        }
        #birtday{
            width: 300px; 
            height: 25px; 
            font-size: 16px; 
            padding: 5px; 
        }
        #submit_button {
        width: 300px;
        height: 30px;
        font-size: 16px;
        padding: 5px;
        border-radius: 15px; 
     }
    #addUniversityButton{
    width: 30px;
    height: 30px;
    background-color: #CCCCFF; 
    border: none;
    cursor: pointer;
    background-image: url('edit.png'); 
    background-repeat: no-repeat;
    background-size: 70% auto; 
    background-position: center;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    }
    #add_technology_button{
        width: 30px;
        height: 30px;
        background-color: #CCCCFF; 
        border: none;
        cursor: pointer;
        background-image: url('edit.png'); 
        background-repeat: no-repeat;
        background-size: 70% auto; 
        background-position: center;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    </style>
    </head>
    <body>
        
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $newTechnology = $_POST["new_technology"];
        if (!empty($newTechnology)) {
            $newTechnology = htmlspecialchars($newTechnology); 
            echo "Added: $newTechnology<br>";
        }
    }
    ?>
        <h1>Създаване на CV</h1>
        
        <form class="input-form" action="data.php" method="post">
            <input type="text" id="nameInput" value="Име..." name="first_name" onfocus="clearDefaultText(this)"><br>
            
            <input type="text" id="nameInput" value="Презиме..." name="second_name" onfocus="clearDefaultText(this)"><br>
            

            <input type="text" id="nameInput" value="Фамилия..." name="last_name" onfocus="clearDefaultText(this)"><br>
             
            
            <label style="font-size: 23px; font-family: Brush Script MT, cursive;" for="birtday">Дата на раждане:</label>
            <input type="date" id="birtday" name="birtday" required>

           
            <select id="selectOption" name="selectOption">
                <?php
                $universities = array("Изберете университет...","Харвард, CAЩ",
                "Стенфорд, САЩ",
                "Масачузетски институт, САЩ",
                "Оксфорд, АНГ", 
                "Кеймбридж, АНГ",
                "ТУ София",
                "Тракийски университет",
                "Шуменски университет",
                "МУ София",
                "НБУ", 
                "Софийски университет „Свети Климент Охридски“", 
                "Американски Университет в България",
                "Висше училище по мениджмънт",
                "Минно-геоложки университет „Св. Иван Рилски“", 
                "Икономически университет - Варна");
                foreach ($universities as $option) {
                echo '<option value="' . $option . '">' . $option . '</option>';
            }
            ?>

            
            </select>
                <button type="button" id="addUniversityButton" ></button>
                <input type="text" id="newUniversityInput" style="display: none;" placeholder="Име на университет...">
                <button type="button" id="submitUniversityButton" style="display: none;">Запиши</button>

            
            <br>
           <label style="font-size: 23px; font-family: Brush Script MT, cursive;">Умения в технологиите</label>
           
           <select name="lang[]" multiple>
                    
                    <option value="php">PHP</option>
                    <option value="laravel">Laravel</option>
                    <option value="symfony">Symfony</option>
                    <option value="zend">Zend Framework</option>
                    <option value="ruby">Ruby</option>
                    <option value="mySQL">MySql</option>
                    <option value="css">CSS3</option>
                    <option value="go">GO</option>
                    <option value="kotlin">Kotlin</option>
                    <option value="js">Java Script</option>
                    <option value="swift">Swift</option>
                    <option value="python">Python</option>
                    <option value="java">Java</option>
                    <option value="django">Django</option>

            </select> 
            
            <button type="button" id="add_technology_button" onclick="toggleInput()"></button>
        <input type="text" name="new_technology" id="new_technology" class="hidden" placeholder="Име на технологията...">
        <button type="button" onclick="addNewTechnology()" id="add_button" class="hidden">Запиши</button>
        
                <br>
                
            

        <button type="submit" id="submit_button">Запис на CV</button>
                
    </form>
    <div class="top-right-link" style="margin-top: 10px;">
        <a href="data.php"><img src="archive.png" alt="архив" width="40" height="40"></a>
    </div>


    <script>
        function toggleInput() {
            var inputField = document.getElementById("new_technology");
            var addButton = document.getElementById("add_button");
            inputField.classList.toggle("hidden");
            addButton.classList.toggle("hidden");
        }

        function addNewTechnology() {
            var newTechnology = document.getElementById("new_technology").value;
            if (newTechnology) {
                var select = document.querySelector("select[name='lang[]']");
                var option = document.createElement("option");
                option.value = newTechnology.toLowerCase();
                option.text = newTechnology;
                select.appendChild(option);
            }
            toggleInput();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addUniversityButton = document.getElementById('addUniversityButton');
            const newUniversityInput = document.getElementById('newUniversityInput');
            const submitUniversityButton = document.getElementById('submitUniversityButton');
            const selectOption = document.getElementById('selectOption');

            addUniversityButton.addEventListener('click', () => {
                newUniversityInput.style.display = 'inline-block';
                submitUniversityButton.style.display = 'inline-block';
                newUniversityInput.focus();
            });

            submitUniversityButton.addEventListener('click', () => {
                const newUniversity = newUniversityInput.value;
                if (newUniversity) {
                    const optionElement = document.createElement('option');
                    optionElement.value = newUniversity;
                    optionElement.textContent = newUniversity;
                    selectOption.appendChild(optionElement);

                    newUniversityInput.value = '';
                    newUniversityInput.style.display = 'none';
                    submitUniversityButton.style.display = 'none';
                }
            });
        });
    </script>
        
               
    </body>
</html>


