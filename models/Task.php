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
    public function getId() : int
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



}

