<?php

namespace Config;

use PDO;

class checkConnexion
{
    private string $password;
    private object $pdo;
    private string $db_host = "custom-pcvp.mysql.eu2.frbit.com";
    private string $db_user = 'custom-pcvp';
    private string $db_pass = 'ClblgnkUMoXyy03hhy_whnlM';
    private string $db_name = 'custom-pcvp';

    public function __construct(string $password){
        $this->password = $password;
    }

    public function connect(): bool {
        try {
            $mysql_connect_str = "mysql:host=$this->db_host;dbname=$this->db_name";
            $dbConnection = new PDO($mysql_connect_str, $this->db_user, $this->db_pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $this->pdo = $dbConnection;
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function checkPassword():bool {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([
            "id" => 1
        ]);
        $user = $stmt->fetch();

        return password_verify($this->password, $user['password']);
    }
}