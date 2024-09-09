<?php

namespace App\Notas\Models;

use App\Notas\lib\Database;
use PDO;
use PDOException;

class Note extends Database
{
    private string $uuid;
    private string $title;
    private string $content;

    public function __construct(string $title ='', string $content = '')
    {
        parent::__construct();
        $this->uuid = uniqid(); // Genera un UUID único
        $this->title = $title;
        $this->content = $content;
    }

    public function save(): void
    {
        $query = $this->connect()->prepare("INSERT INTO notes (uuid, title, content, updated) VALUES (:uuid, :title, :content, NOW())");
        $query->execute([
            'uuid' => $this->uuid,
            'title' => $this->title,
            'content' => $this->content
        ]);
    }

    public function update(): void
    {
        $query = $this->connect()->prepare("UPDATE notes SET title = :title, content = :content, updated = NOW() WHERE uuid = :uuid");
        $query->execute([
            'uuid' => $this->uuid,
            'title' => $this->title,
            'content' => $this->content
        ]);
    }

    public static function get(string $uuid): ?self
{
    $db = new Database();
    $query = $db->connect()->prepare("SELECT * FROM notes WHERE uuid = :uuid");
    $query->execute(['uuid' => $uuid]);

    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return self::createFromArray($result);
    }
    return null; // No se encontró la nota
}


    public static function getAll()
    {
        $notes = [];
        $db = new Database();
        $query = $db->connect()->query("SELECT * FROM notes");

        if ($query) {
        while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
            $note = Note::createFromArray($r);
            array_push($notes, $note);
        };
        return $notes;
        }

       return null; // No se encontró la nota
    }

    public static function createFromArray(array $data): self
{
    // echo "Datos recibidos en createFromArray:";
    // print_r($data);

    $note = new self();
    $note->setUUID($data['uuid']);
    $note->setTitle($data['title']);
    $note->setContent($data['content']);
    return $note;
}

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function setUUID(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
