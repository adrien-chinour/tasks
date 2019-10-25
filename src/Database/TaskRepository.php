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
     * @param string $category
     *
     * @return array
     */
    public function add(string $name, string $category = null)
    {
        return $this->adaptor->query(
            "insert into tasks('name','category','completed') values (:name, :category, :completed)",
            [':name' => $name, ':category' => $category, ':completed' => 0]
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
     * @param string|null $category
     *
     * @return array
     */
    public function list(string $category = null)
    {
        if ($category !== null) {
            return $this->adaptor
                ->query('select * from tasks where category = :category', [':category' => $category]);
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
     * @param string $category
     *
     * @return array
     */
    public function updateCategory(int $id, string $category)
    {
        return $this->adaptor
            ->query('update tasks set category = :category where id = :id', [':id' => $id, ':category', $category]);
    }

}
