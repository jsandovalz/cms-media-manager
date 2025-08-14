<?php

namespace App\Media\Interfaces;

use App\Media\DTO\MediaDTO;

interface MediaRepositoryInterface
{
    public function store(MediaDTO $media): void;
    public function searchByType(string $type): array;
    public function searchByTitle(string $title): array;
    public function findByUuid(string $uuid): ?MediaDTO;
}
