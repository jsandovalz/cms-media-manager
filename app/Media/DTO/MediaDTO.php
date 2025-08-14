<?php

namespace App\Media\DTO;

use DateTime;

class MediaDTO 
{
    public string $uuid;
    public string $type;
    public string $title;
    public string $description;
    public string $sourceUrl;
    public DateTime $uploadedAt;
    public array $metadata = [];

    public function __construct(
        string $uuid,
        string $type,
        string $title,
        string $description,
        string $sourceUrl,
        DateTime $uploadedAt,
        array $metadata = []
    ) {
        $this->uuid = $uuid;
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->sourceUrl = $sourceUrl;
        $this->uploadedAt = $uploadedAt;
        $this->metadata = $metadata;
    }
    public static function fromArray(array $data): self
    {
        try {
            $createdAt = new \DateTime($data['uploadedAt']['date']);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Invalid date format for 'createdAt': " . $data['uploadedAt']);
        }

        return new self(
            $data['uuid'],
            $data['type'],
            $data['title'],
            $data['description'],
            $data['sourceUrl'],
            $createdAt,
            $data['metadata']
        );
    }

}
