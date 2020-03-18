<?php

namespace App\Models;


use PDO;

class Task
{

    /**
     * @param $name
     * @param $email
     * @param $description
     *
     * @return bool
     */
    public static function create($name, $email, $description)
    {
        global $pdo;

        $sql = "INSERT INTO tasks (name, email, description) VALUES (:name, :email, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':description', $description);
        return $stmt->execute();
    }

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $description
     * @param $completed
     *
     * @return bool
     */
    public static function update($id, $name, $email, $description, $completed)
    {
        global $pdo;

        $sql = "UPDATE tasks SET name = :name, email = :email, description = :description, completed = :completed WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':completed', $completed?1:0);
        return $stmt->execute();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public static function delete($id)
    {
        global $pdo;
        $sql = "DELETE FROM tasks WHERE id =  :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @param  int  $page
     * @param  string  $order
     * @param  string  $order_by
     *
     * @return array
     */
    public static function getWithPagination($page = 1, $order = 'ASC', $order_by = 'id')
    {
        global $pdo;

        $tasks_per_page = 3;
        $order = 'DESC' === strtoupper($order)?'DESC':'ASC';
        $order_by = in_array($order_by, ['id', 'name', 'completed', 'email'])?$order_by:'id';

        $sql = "SELECT * FROM tasks ORDER BY {$order_by} {$order}";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $max_pages = ceil($stmt->rowCount() / $tasks_per_page);

        $prev = 0;
        $next = 0;

        if($page > $max_pages) {
            $page = $max_pages;
        }

        if($page > 1 && $page <= $max_pages) {
            $prev = $page - 1;
        }

        if($page >= 1 && $page < $max_pages) {
            $next = $page + 1;
        }

        $offset = ($page - 1) * $tasks_per_page;
        $limit_sql = " LIMIT {$tasks_per_page} OFFSET {$offset}";

        $stmt = $pdo->prepare($sql.$limit_sql);
        $stmt->execute();

        return [
            'pagination' => [
                'current' => $page,
                'max' => $max_pages,
                'prev' => $prev,
                'next' => $next
            ],
            'tasks' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }
}
