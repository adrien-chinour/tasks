<?php


namespace App\Database;

class TaskManager
{

    /** @var DatabaseAdaptor */
    private $adaptor;

    /**
     * TaskManager constructor.
     *
     * @param DatabaseAdaptor $adaptor
     */
    public function __construct(DatabaseAdaptor $adaptor)
    {
        $this->adaptor = $adaptor;
    }

    /**
     * @param string $name
     * @param string $group
     *
     * @return mixed
     */
    public function add(string $name, string $group)
    {
        return $this->adaptor->query(
            "insert into tasks('name','group','done') values (:name, :group, :done)",
            [':name' => $name, ':group' => $group, ':done' => 0]
        );
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function check(int $id)
    {
        return $this->adaptor->query('update tasks set done = 1 where id = :id', ['id' => $id]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function uncheck(int $id)
    {
        return $this->adaptor->query('update tasks set done = 0 where id = :id', ['id' => $id]);
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return $this->adaptor->query('select * from tasks', []);
    }

}
