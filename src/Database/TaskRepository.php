<?php


namespace App\Database;

/**
 * Class TaskManager
 *
 * @package App\Database
 */
class TaskRepository
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
     * @return array
     */
    public function add(string $name, string $group = '')
    {
        return $this->adaptor->query(
            "insert into tasks('name','group','completed') values (:name, :group, :completed)",
            [':name' => $name, ':group' => $group, ':completed' => 0]
        );
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function check(int $id)
    {
        return $this->adaptor->query('update tasks set completed = 1 where id = :id', [':id' => $id]);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function uncheck(int $id)
    {
        return $this->adaptor->query('update tasks set completed = 0 where id = :id', [':id' => $id]);
    }

    /**
     * @param string|null $group
     *
     * @return array
     */
    public function list(string $group = null)
    {
        if ($group !== null) {
            return $this->adaptor
                ->query('select * from tasks where "group" = :group', [':group' => $group]);
        }

        return $this->adaptor->query('select * from tasks', []);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function remove(int $id)
    {
        return $this->adaptor->query('delete from tasks where id = :id', [':id' => $id]);
    }

    /**
     * @param int    $id
     * @param string $name
     *
     * @return array
     */
    public function updateName(int $id, string $name)
    {
        return $this->adaptor
            ->query('update tasks set name = :name where id = :id', [':id' => $id, ':name' => $name]);
    }

    /**
     * @param int    $id
     * @param string $group
     *
     * @return array
     */
    public function updateGroup(int $id, string $group)
    {
        return $this->adaptor
            ->query('update tasks set "group" = :group where id = :id', [':id' => $id, ':group', $group]);
    }

}
