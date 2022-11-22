<?php

require_once 'utilities/Model.php';

class User extends Model
{
    private  int $id;
    private string $email;
    private string $password;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * La méthode permet de récupérer un utilisateur à partir d'une adresse mail fournie
     *
     * @param string $email
     * @return array|false
     */
    public function getOneByEmail(string $email) : array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Insérer un utilisateur dans la BDD
     * @return void
     */
    public function insert() : void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (`email`, `password`) VALUES (:email, :password)");

        $stmt->execute([
            "email" => $this->email,
            "password" => password_hash($this->password, PASSWORD_ARGON2ID)
        ]);
    }

    /**
     * find an element by id
     *
     * @param int $id
     * @return self|false
     */
    public function find(int $id) : self|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS , __CLASS__);
        $stmt->execute();
        return $stmt->fetch();
    }

}