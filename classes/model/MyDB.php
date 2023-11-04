<?php
namespace classes\model;
use InvalidArgumentException;
use PDO;
use PDOException;
class MyDB
{
    protected $host;
    protected $username;
protected $password;
protected $dbname;
protected $conn;

public function __construct()
{
    $this->host ="localhost";
    $this->username ="root";
    $this->password = "root";
    $this->dbname = "taxi";
}

public function getHost()   
{
    return $this->host;
}
public function getUsername()   
{
    return $this->username; 
}
public function getPassword()   
{
                return $this->password;
}
    public function getDbname() 
    {
        return $this->dbname;
    }

    public function setHost($host)
    {
        
        if (filter_var($host, FILTER_VALIDATE_IP) || filter_var(gethostbyname($host), FILTER_VALIDATE_IP)) {
            $this->host = $host;
        } else {
            throw new InvalidArgumentException("Hôte non valide");
        }
    }

    public function setUsername($username)
    {
        if (ctype_alnum($username)) {
            $this->username = $username;
        } else {
            throw new InvalidArgumentException("Nom d'utilisateur non valide");
        }
    }

    public function setPassword($password)
    {
        if (strlen($password) >= 6) {
            $this->password = $password;
        } else {
            throw new InvalidArgumentException("Mot de passe non valide");
        }
    }

    public function setDbname($dbname)
    {
        
        $this->dbname = $dbname;
    }
    public function connection()
    {
      try {
        $_dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $this->conn = new PDO($_dsn,$this->username,$this->password);
        echo "connexion reussi";
      } catch (PDOException $e) {
    echo "oupps echec connexion ala base de donnee".$e->getMessage();
      }
    }
    public function getConn()
    {
        return $this->conn; 
    }
}





?>