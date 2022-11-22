<?php

require_once 'utilities/Model.php';

class Task  extends Model
{
    private int $id;
    private string $name;
    private string $to_do_at; // TODO change type
    private bool $is_done;
    private int $id_user;



    // accesseurs (getters & setters)

    /**
     * Permet de récupérer l'identifiant de la tâche
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getToDoAt(): string
    {
        return $this->to_do_at;
    }

    /**
     * @param string $to_do_at
     * @return void
     */
    public function setToDoAt(string $to_do_at): void
    {
        $this->to_do_at = $to_do_at;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->is_done;
    }

    /**
     * @param bool $is_done
     * @return void
     */
    public function setIsDone(bool $is_done): void
    {
        $this->is_done = $is_done;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return void
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }


    ///////////////////////////////////METHODES/////////////////////////////////////////////////////
    /**
     * Insérer une tâche dans la BDD
     * @return void
     */
    public function insert(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO task (`name`, `to_do_at`, `id_user`) VALUES (:`name`, :to_do_at, :id_user)");
        $stmt->execute([
            "name" => $this->name,
            "to_do_at" => $this->to_do_at,
            "id_user" => $this->id_user
        ]);
    }

    /**
     * Récupérer la liste des tâches d'un utilisateur à partir de son id_user
     *
     * @param int $id_user
     * @return array|false
     */
    public function getTaskByIdUser(int $id_user): self|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id = :id_user ");
        $stmt->bindParam(':id_user', $id_user);
        // $stmt->setFetchMode(PDO::FETCH_CLASS , __CLASS__); A tester !!!
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Modifier la liste des tâches d'un utilisateur à partir de son id_user
     *
     * @param int $id_user
     * @return void
     */
    public function edit(int $id_user): void
    {
        $stmt = $this->pdo->prepare("UPDATE task SET `to_do` = :new_task, `to_do_at`= :new_date WHERE id = :id");
        $stmt->execute(array(
            'new_task' =>  htmlentities($this->task),
            'new_date' => $this->new_date,
            'id' => $this->id_user
        ));
    }

    /**
     * Supprimer une tâche
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM task WHERE id=:id");
        foreach ($_POST['event'] as $id) {
            $stmt->execute(['id' => $id]);
        }
    }

    /**
     * Indiquer que la tâche a été réalisée à partir de son id
     *
     * @param int $id
     * @return void
     */
    public function declareDone(int $id): void
    {
        $stmt = $this->pdo->prepare("UPDATE task set is_done = 1 WHERE id=:id");
        foreach ($_POST['event'] as $id) {
            $stmt->execute(['id' => $id]);
        }
    }
}
