<?php

namespace App\Model;

class LoginManager extends AbstractManager
{
    public const TABLE = 'user_login';


    public function selectOneByIdUserPass(array $user): array | false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " 
        WHERE user_name=:login and password=:password");
        $statement->bindValue('login', $user['login'], \PDO::PARAM_STR);
        $statement->bindValue('password', md5($user['password']), \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
