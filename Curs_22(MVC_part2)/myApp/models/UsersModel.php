<?php

include_once 'config.php';

class UsersModel extends DBModel
{
    protected $userName;
    protected $userEmail;
    protected $userPass;


    public function __construct($uName = 'N', $uEmail = 'E', $uPass = 'P')
    {
        // set properties
        $this->userName = $uName;
        $this->userEmail = $uEmail;
        $this->userPass = $uPass;
    }
    // public function getDetails()
    // {
    //     return $this->userName . ' are emailul ' . $this->userEmail . ' si parola ' . $this->userPass;
    // }

    public function getUsers()
    {
        $q = "SELECT * FROM `user`";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProducts()
    {
        $q = "SELECT * FROM `products`";
        $result = $this->db()->query($q);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //! DELETE USER
    public function delProducts($id)
    {
        $q = "DELETE FROM `products` WHERE `id` = $id";
        $result = $this->db()->query($q);
        if ($result) return true;
        else return false;
    }

    //! ADD USER
    public function addUser($uName, $uPass, $uEmail = 'generic@gmail.com')
    {
        $hashedPass = password_hash($uPass, PASSWORD_DEFAULT);
        $q = "INSERT INTO `user` 
                        (`USER`, `USER-Password`, `USER-Email`, `hashedPass`) 
                        VALUES (?, ?, ?, ?);";
        // prepared statements
        $myPrep = $this->db()->prepare($q);
        // s - string, i - integer, d- double, b - blob
        $myPrep->bind_param("ssss", $uName, $uPass, $uEmail,  $hashedPass);
        if ($myPrep->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // ! MODIFICARE USER
    public function modUser($id, $uName = 'NumeGeneric', $uPass = 'ParolaGeneric', $uEmail = 'generic@gmail.com')
    {
        $hashedPass = password_hash($uPass, PASSWORD_DEFAULT);
        $q = "UPDATE `user` SET 
                    `USER`=?,`USER-Email`=?,`USER-Password`=?,`hashedPass`=? 
                    WHERE `id` = $id";
        // prepared statements
        $myPrep = $this->db()->prepare($q);
        // s - string, i - integer, d- double, b - blob
        $myPrep->bind_param("ssss", $uName, $uEmail, $uPass, $hashedPass);
        $myPrep->execute();
        $myPrep->close();
    }

    // ! Autentificare
    public function isAuth($uName, $uPass)
    {
        // interogheaza baza de date
        $q = "SELECT * FROM `user` WHERE `USER` = ?";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("s", $uName);
        $myPrep->execute();
        $result = $myPrep->get_result()->fetch_assoc();
        $myPrep->close();
        if (!$result) return false; // daca NU a gasit userul, returneaza false 

        // verificare parola
        if (password_verify($uPass, $result['hashedPass'])) {
            return true;
        } else {
            return false;
        }

        // returnez true sau false

    }

    public function displayData()
    {
        $dataArray = $this->getProducts();

        $table = '';

        if (is_array($dataArray)) {
            $table .= '<table class="table table-striped">';
            $table .= '<tr>';
            // Header row
            foreach (array_keys($dataArray[0]) as $field) {
                $table .= "<th>$field</th>";
            }
            $table .= '<th>Action</th>';
            $table .= '</tr>';

            // Data rows
            foreach ($dataArray as $user) {
                $table .= '<tr>';
                foreach ($user as $field => $value) {
                    $table .= "<td>$value</td>";
                }
                $table .= '<td>' . "<a href='?page=delete' >DELETE</a>";
                $table .= '</tr>';
            }
            $table .= '</table>';
        }
        return $table;
    }
}
