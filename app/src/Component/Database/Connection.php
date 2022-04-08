<?php

namespace App\Component\Database;

class Connection
{
    /** @var Connection */
    protected $client;

    public function __construct()
    {
        $this->client = new \PDO(
            getenv("DB_DSN"),
            getenv("DB_USER"),
            getenv("DB_PASSWORD")
        );
        $this->client->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function run($sql, $args = []): array
    {
        if (empty($args)) {
            return $this->client->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        }

        $stmt = $this->client->prepare($sql);

        try {
            $stmt->execute($args);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            //@todo log
        }

        return $stmt->fetchAll(\PDO::FETCH_BOTH);
    }

}