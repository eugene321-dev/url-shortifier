<?php

namespace Models;

use DateInterval;
use DateTime;
use PDO;
use stdClass;

class URLRepository extends Repository
{

    public function store(string $url, string $expirationPeriod = null): string
    {
        $code = $this->generateKey();
        $expireDateTime = new DateTime();
        $expireDateTime->add(new DateInterval('PT' . $expirationPeriod . 'M'));

        $q = $this->connection->prepare('INSERT INTO urls (code, url, expires_at) VALUES (:code, :url, :expires_at)');
        $q->execute([
            'code' => $code,
            'url' => $url,
            'expires_at' => $expireDateTime->format('Y-m-d H:i:s')
        ]);
        return $code;
    }

    public function get(): array
    {
        $q = $this->connection->query("SELECT * FROM urls ORDER BY id DESC");
        return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function find(string $code): ?STDClass
    {
        $q = $this->connection->prepare("SELECT * FROM urls WHERE code = :code AND expires_at > :date_time LIMIT 1");
        $q->execute([
            ':code' => $code,
            ':date_time' => date('Y-m-d H:i:s')
        ]);
        return $q->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function incrementViewsByKey(string $code): void
    {
        $q = $this->connection->prepare(" UPDATE urls SET clicks = clicks + 1 WHERE code = :code");
        $q->execute([':code' => $code]);
    }

    private function generateKey(): string
    {
        return strtolower(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));
    }

}
