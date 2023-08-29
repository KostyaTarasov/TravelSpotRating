<?php

namespace MyProject\Models\Users;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;

class User extends ActiveRecordEntity
{
    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $authToken;

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @return array
     */
    public static function getAllNickname(): ?array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT `id`, `nickname` FROM `' . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    /**
    * @return int
    */
    public function getUserIdByNickname(string $travelerName, array $users): ?int
    {
        foreach ($users as $user) {
            if ($user->getNickname() === $travelerName) {
                return $user->getId();
            }
        }

        return null;
    }
}
