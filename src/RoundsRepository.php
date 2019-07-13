<?php

namespace Bringo;

class RoundsRepository
{
    protected $dbHelper;

    public function __construct()
    {
        $this->dbHelper = new DBHelper();
    }

    public function createRoundsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS rounds (
            id varchar(255) NOT NULL,
            chosen_door int NOT NULL,
            opened_door int NOT NULL,
            next_door int NOT NULL,
            door_with_car int NOT NULL,
            post_date varchar(255) NOT NULL,
            PRIMARY KEY (id)
        )";
        return $this->dbHelper->execute($sql);
    }

    public function clearTable()
    {
        $sql = "TRUNCATE TABLE rounds";
        return $this->dbHelper->execute($sql);
    }

    public function insertRound($stateOfDoors)
    {
        $sql = "INSERT INTO rounds VALUES (?, ?, ?, ?, ?)";
        $data = [
            \uniqid(),
            $stateOfDoors['chosenDoor'],
            $stateOfDoors['openedDoor'],
            $stateOfDoors['nextDoor'],
            $stateOfDoors['doorWithCar'],
            Carbon::now()->toDateTimeString()
        ];
        return $this->dbHelper->execute($sql, $data);
    }

    public function calculateGoodRounds()
    {
        $sql = "SELECT COUNT(*) FROM rounds WHERE next_door = door_with_car";
        $result = $this->dbHelper->fetch($sql);
        return $result ? $result[0] : false;
    }

    public function calculateAllRounds()
    {
        $sql = "SELECT COUNT(*) FROM rounds";
        $result = $this->dbHelper->fetch($sql);
        return $result ? $result[0] : false;
    }
}
