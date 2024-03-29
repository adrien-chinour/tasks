<?php

namespace App\Database;

use PDO;

class DatabaseAdaptor
{

    /**
     * The database connection.
     *
     * @var PDO
     */
    protected $connection;

    /**
     * Create a new DatabaseAdapter instance.
     *
     * @param PDO $connection
     */
    function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Perform a generic database query.
     *
     * @param $sql
     * @param $parameters
     *
     * @return array
     */
    public function query($sql, $parameters)
    {
        $query = $this->connection->prepare($sql);
        $query->execute($parameters);

        return $query->fetchAll();
    }

}
