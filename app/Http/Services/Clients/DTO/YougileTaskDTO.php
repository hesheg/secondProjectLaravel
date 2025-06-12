<?php

namespace App\Http\Services\Clients\DTO;

class YougileTaskDTO

{
    public function __construct(
        private string $title,
        private string $columnId,
        private string $description,
    ){
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function getColumnId(): string
    {
        return $this->columnId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }


    public function getArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'columnId' => $this->getColumnId(),
            'description' => $this->getDescription(),
        ];
    }
}
