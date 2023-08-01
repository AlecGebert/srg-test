<?php

    // Error messages
    $nameEmptyErr = "";
    $emailEmptyErr = "";
    $educationEmptyErr = "";
    $genderEmptyErr = "";
    $hobyEmptyErr = "";
    $commentEmptyErr = ""; 
    $nameErr = "";
    $emailErr = "";
    if(isset($_POST["submit"])) {
        // Set form variables
        $name           = checkInput($_POST["name"]);
        $email          = checkInput($_POST["email"]);
        $phone      = checkInput($_POST["phone"]);
        $check           = $_POST["check"];
        $message        = checkInput($_POST["message"]);
        // Name validation
        if(empty($name)){
            $nameEmptyErr = '<div class="error">
                Поле не может быть пустым.
            </div>';
        } // Allow letters and white space 
        else if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = '<div class="error">
                Поле может содержать буквы и пробелы.
            </div>';
        } else {
            echo $name . '<br>';
        }

        if(empty($phone)){
            $phoneEmptyErr = '<div class="error">
            Поле не может быть пустым.
            </div>';
        } // E-mail format validation
        else if (!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $phone)){
            $phoneErr = '<div class="error">
                    Введите корректный номер.
            </div>';
        } else {
            echo $email . '<br>';
        }
        // Email validation
        if(empty($email)){
            $emailEmptyErr = '<div class="error">
            Поле не может быть пустым.
            </div>';
        } // E-mail format validation
        else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
            $emailErr = '<div class="error">
                    Введите корректный email.
            </div>';
        } else {
            echo $email . '<br>';
        }

        // Checkbox validation
        if(!empty($check)){                
            foreach($_POST['check'] as $val){
                echo $val . '<br>';
            }
        } else {
            $checkEmptyErr = '<div class="error">
            Примите пользовательское соглашение
            </div>';
        }
        // Text-area validation
        if(empty($message)){
            $messageEmptyErr = '<div class="error">
                Введите сообщение.
            </div>';
        } else {
            echo $message . '<br>';
        }
    }  
    function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }    


if(isset($name) && isset($phone) && isset($email) && isset($message)) {
    $data = $name . '-' . $phone . '-' . $email . '-' . $message . "\r\n";
    $ret = file_put_contents('./my-data.txt', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        echo '<script language="javascript">';
        echo 'alert("Упс, что-то пошло не так")';
        echo '</script>';
        die('Упс, что-то пошло не так');
    }
    else {
        echo '<script language="javascript">';
        echo 'alert("Ваше сообшение отправлено!")';
        echo '</script>';
    }
}
else {
   die('Упс, что-то пошло не так');
}
