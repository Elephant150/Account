<?php
//session_start();
require_once "Connect.php";


class Signup
{
    private $full_name;
    private $username;
    private $email;
    private $password;
    private $password_confirm;
    private $picture;
    private $maxLengthUsername;
    private $minLengthUsername;
    private $minLengthPassword;


    function __construct($full_name, $username, $email, $password, $password_confirm)
    {
        $this->full_name = htmlspecialchars(trim($full_name));
        $this->username = htmlspecialchars(trim($username));
        $this->email = htmlspecialchars(trim($email));
        $this->password = htmlspecialchars(trim($password));
        $this->password_confirm = htmlspecialchars(trim($password_confirm));
//        $this->picture = $picture;
        $this->maxLengthUsername = $maxLengthUsername = 15;
        $this->minLengthUsername = $minLengthUsername = 3;
        $this->minLengthPassword = $minLengthPassword = 6;
    }

    // registration - main function
    function register()
    {

        if ($this->addToDB()) {
            if ($this->checkLogin()) {
                if ($this->checkPassword()) {
                    if ($this->checkEmail()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {

            return false;
        }

    }

    private function pathToPicture()
    {
        //    ----------------------- uploads a picture
        $this->picture = '/uploads/' . time() . $_FILES['picture']['name'];
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $this->picture)) {
            $_SESSION['message'] = 'Error loading image!';
//            header('Location: ../register.php');
        }
    }

    //add to DataBase
    private function addToDB()
    {
        $connect = new Connect();
        $connect->connect_db();

        //    ----------------------- check that the entry has the same username
        $query = $connect->pdo->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = '$this->username'");
        $query->execute();

        if ($query->fetchColumn() > 0) {
            $_SESSION['message'] = 'This username is already busy!';
//            header('Location: ../register.php');
        } else {
            $password = MD5($this->password);
            $ins = $connect->pdo->exec("INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `picture`) VALUES (NULL, '$this->full_name', '$this->username', '$this->email', '$password', '$this->picture')");

            if ($ins) {
                return true;
            } else {
                return false;
            }

            $_SESSION['message'] = 'You have successfully registered!';
//            header('Location: ../index.php');
        }

        $connect->disConnect();
    }

    //login validation
    private function checkLogin()
    {
        if (strlen($this->username) >= $this->minLengthUsername and strlen($this->username) <= $this->maxLengthUsername) {
            $notCorrectSymbol = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
            $correctSymbol = "/[a-zA-Z0-9]/";
            $bool = false;

            for ($i = 0; $i < strlen($this->username); $i++) {
                for ($j = 0; $j < strlen($notCorrectSymbol); $j++) {
                    if ($this->username[$i] == $notCorrectSymbol) {
                        $_SESSION['message'] = "Characters are not allowed in your username!";
                    }
                }

                if ($bool) {
                    if (preg_match($correctSymbol, $this->username)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }

        } elseif($this->username < $this->minLengthUsername) {
            $_SESSION['message'] = "Incorrect username! Username must be 3 to 15 characters long!";
            header('Location: ../register.php');
        }
    }

    //email validation
    private function checkEmail()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    //password validation
    private function checkPassword()
    {
        if ($this->password === $this->password_confirm) {
            if (strlen($this->password) >= $this->minLengthPassword) {
                $notCorrectSymbol = "!@\"#№;$%^:&?*()-_+=//|\\`.,";
                $correctSymbol = "/[a-zA-Z0-9]/";
                $bool = false;

                for ($i = 0; $i < strlen($this->password); $i++) {
                    for ($j = 0; $j < strlen($notCorrectSymbol); $j++) {
                        if ($this->password[$i] == $notCorrectSymbol) {
                            $_SESSION['message'] = "Characters are not allowed in your password!";
//                            header('Location: ../register.php');
                        }
                    }

                    if ($bool) {
                        if (preg_match($correctSymbol, $this->password)) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }

            } else {
                $_SESSION['message'] = "Incorrect password! Password must be 6 characters or more!";
//                header('Location: ../register.php');
            }
        } else {
            $_SESSION['message'] = "Passwords do not much!";
//            header('Location: ../register.php');
        }
    }

}