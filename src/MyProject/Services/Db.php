<?php

namespace MyProject\Services;

use MyProject\Exception\DbException;

class Db
{
    private static $instance;

    /** @var \PDO */
    private $pdo;

    # Для того чтобы нельзя было в других местах кода создать новые объекты этого класса, стоит сделать конструктор private – тогда создать объект можно будет только с помощью метода getInstance() (Паттерн Singleton в PHP)
    private function __construct() // установим соединение с базой данных 1 раз
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];
        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
            // Свойство $this->pdo теперь можно использовать для работы с базой данных через PDO

        } catch (\PDOException $e) { // Ловушки для стандартных исключениий класса PDOException с заменой их исключениями
            throw new \MyProject\Exceptions\DbException('Ошибка при подключении к базе данных: ' . $e->getMessage()); // Бросаем исключение, (на рабочем сайте не стоит писать лог ошибки в параметрах)
            //throw new \MyProject\Exceptions\DbException(); // Бросаем исключение ( пример без параметров)
        }
    }

    public static function getInstance(): self
    { // Проверять, что свойство $instance не равно null
        if (self::$instance === null) { // Если оно равно null, будет создан новый объект класса Db, а затем помещён в это свойство
            self::$instance = new self();
        }

        return self::$instance; // Вернёт значение этого свойства. Со второго вызова вместо создания нового объекта вернётся уже созданный ранее.
    }

    # метод для выполнения запросов в базу, где параметр className - имя класса, объекты которого нужно создавать. По умолчанию будут объекты класса stdClass – встроенный класс в PHP, у которого нет никаких свойств и методов
    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params); // Запускает подготовленный запрос на выполнение, где $params - массив value
        if (false === $result) {
            return null;
        }

        # для ORM
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    # чтобы получить id последней вставленной записи в базе (в рамках текущей сессии работы с БД)
    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}
