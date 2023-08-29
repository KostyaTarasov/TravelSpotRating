<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity implements \JsonSerializable
{
    /** @var int */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    # Решение проблемы несоответствием имён свойств данного класса с заголовками столбцов
    public function __set(string $name, $value) // теперь все дочерние сущности будут его иметь
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string // Преобразование
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
        /*
        Функция ucwords() делает первые буквы в словах большими, первым аргументом она принимает строку со словами, вторым аргументом – символ-разделитель (то, что стоит между словами). После этого строка string_with_smth преобразуется к виду String_With_Smth
        Функция strreplace() заменяет в получившейся строке все символы ‘’ на пустую строку (то есть она просто убирает их из строки). После этого мы получаем строку StringWithSmth
        Функция lcfirst() просто делает первую букву в строке маленькой. В результате получается строка stringWithSmth. И это значение возвращается этим методом.
        «created_at», то он вернёт «createdAt»
        «author_id», то он вернёт «authorId»
        */
    }


    # Обновление БД и Вставка в БД с помощью Active Record
    public function save(): void // Выведем полученную структуру, которая соответствует структуре в базе данных
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) { // Если id есть в бд
            $this->update($mappedProperties); // Обновить бд
        } else { // Иначе id нет в бд
            $this->insert($mappedProperties); // Вставить в бд
        }
    }

    private function update(array $mappedProperties): void // Обновление БД
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // строки column1 = :param1
            $params2values[':param' . $index] = $value; // ключ => значение вида [:param1 => value1]
            $index++;
        }
        # Cформируем запрос
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id; // SET column1 = :param1, column2 = :param2, ...

        $db = Db::getInstance(); // При вызове метода, вернётся объект класса Db
        $db->query($sql, $params2values, static::class);
    }


    private function insert(array $mappedProperties): void // Вставка в БД
    {
        $filteredProperties = array_filter($mappedProperties); // отфильтруем элементы в массиве от тех, значение которых = NULL

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) { // сформируем массив, содержащий названия столбцов
            $columns[] = '`' . $columnName . '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName; //подготовим массив с именами подстановок :author_id и :name
            $params2values[$paramName] = $value; // подготовим значения, которые нужно будет подставить в запрос
        }
        $columnsViaSemicolon = implode(', ', $columns); // Добавляем запятую между именами столбцов
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);
        // пишем запрос аналогичный: INSERT INTO `articles` (`author_id`, `name`, `text`) VALUES (:author_id, :name, :text)
        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId(); // Сохраняем текущее id, чтобы id не был null в выводе массива на экран
        //$this->refresh(); // Сохраняем текущее значение для вывода в массив на экран, в данном примере выводим дату вместо null для ["createdAt":protected]=>NULL
    }

    public function delete(): void
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    # Поля объекта обновляются значениями из БД
    private function refresh(): void
    {
        $objectFromDb = static::getById($this->id); // берет версию объекта из базы
        $reflector = new \ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties(); // получает все его свойства

        foreach ($properties as $property) {
            $property->setAccessible(true); // делает их публичными
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objectFromDb); // в текущем объекте (у которого вызвали refresh) свойству с таким же именем задаёт значение из свойства, взятого у объекта из базы ($objectFromDb).
        }
    }


    private function mapPropertiesToDbFormat(): array // прочитает все свойства объекта и создаст массив вида: ['название_свойства1' => значение свойства1, 'название_свойства2' => значение свойства2]
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName); // каждое имяСвойства привели к имя_свойства
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName; // в массив $mappedProperties мы стали добавлять элементы с ключами «имя_свойства» и со значениями этих свойств
        }

        return $mappedProperties;
    }

    private function camelCaseToUnderscore(string $source): string // Преобразовываем в строку_с_подчёркиванием, например, author_id – именно так называется поле в базе данных
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
        /*
        C помощью регулярного выражения: 
        перед каждой заглавной буквой мы добавляем символ подчёркивания
        а затем приводим все буквы к нижнему регистру
        */
    }

    // Обратиться к сущности, не создавая её, но чтобы она при этом вернула созданные сущности.
    /**
     * @return static[]
     */
    public static function findAll(): array
    {
        $db = Db::getInstance();

        # Избавляемся от зависимости имени таблицы articles:
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    abstract protected static function getTableName(): string;

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }

    # Этот метод должен возвращать представление объекта в виде массива. 
    public function jsonSerialize()
    {
        return $this->mapPropertiesToDbFormat();
    }

    # Получение количества страниц (для пагинации). Метод будет принимать на вход количество записей на одной странице.
    public static function getPagesCount(int $itemsPerPage): int
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT COUNT(*) AS cnt FROM ' . static::getTableName() . ';');
        return ceil($result[0]->cnt / $itemsPerPage); // Общее количество записей делим на 5 записей на одной странице, затем округляем и получаем необходимое колич страниц
    }


    //* Получение записей на n-ой странице
    /**
     * @return static[]
     */
    public static function getPage(int $pageNum, int $itemsPerPage): array // параметры: номер страницы, количество записей на одной странице .
    {
        $db = Db::getInstance();
        return $db->query(
            sprintf(
                'SELECT * FROM `%s` ORDER BY id DESC LIMIT %d OFFSET %d;',
                static::getTableName(),
                $itemsPerPage,
                ($pageNum - 1) * $itemsPerPage
            ),
            [],
            static::class
        );
    }

    public static function getNameCatalog(string $nameTableCatalog) // Получаем имена каталогов заданные в общей таблице catalog
    {
        $nameTableCatalog = self::replaceuUderline($nameTableCatalog); // Заменяем имя таблицы на '-', чтобы соответстовать ЧПУ из таблицы catalog
        $db = Db::getInstance();
        $allTable = $db->query(
            "SELECT `name` FROM `catalog` WHERE `cpu_name_catalog`= '$nameTableCatalog';",
        );
        return $allTable[0]->name;
    }

    //* Транслитерация из кириллицы в латиницу для ЧПУ, замена промежутков и лишних символов на '-', Lower
    /**
     * @return string
     */
    public static function slugify($string): string
    {
        $translit = "Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();";
        $string = transliterator_transliterate($translit, $string);
        $string = preg_replace('/[^\s\d\w]/', '', $string); // удаляем все симфолы кроме \s промежутков, \d - цифр, \w символов образующих слово
        $string = preg_replace('/[-\s]+/', '-', $string); // замена промежутков на '-'
        return trim($string, '-'); // Убрать вначале и в конце строки '-'
    }

    /** Замена '-' из полученного значения ЧПУ на '_', чтобы соответствовать имени таблицы в БД)
     * @return string
     */
    public static function replaceDash($nameTable): string
    {
        return preg_replace('/-/', '_', $nameTable);;
    }

    /** Замена '_' из имени таблицы на '-', чтобы соответствовать ЧПУ хранимому в таблице catalog
     * @return string
     */
    public static function replaceuUderline($nameTable): string
    {
        return preg_replace('/_/', '-', $nameTable);;
    }
}
