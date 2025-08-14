<?php
namespace App\Media\Repositories;

use App\Media\Interfaces\MediaRepositoryInterface;
use App\Media\DTO\MediaDTO;


class MemoryMediaRepository implements MediaRepositoryInterface 
{
    private string $storagePath;
    private array $storage = [];

    public function __construct(string $storagePath) {
        $this->storagePath = $storagePath ?? storage_path('app/media_store.json');
        $this->load();
    }


    public function store(MediaDTO $media): void
    {
        $this->storage[$media->uuid] = $media;
        $this->persist();

    }

    public function searchByType(string $type): array
    {
        return array_filter($this->storage, fn($m) => $m->type === $type);
    }

    public function searchByTitle(string $title): array
    {
        return array_filter($this->storage, fn($m) => str_contains(strtolower($m->title), strtolower($title)));
    }

    public function findByUuid(string $uuid): ?MediaDTO
    {
        return $this->storage[$uuid] ?? null;
    }
    
    private function persist(): void {
        $data = array_map(fn($m) => (array) $m, $this->storage);
        file_put_contents($this->storagePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function load(): void {
        if (!file_exists($this->storagePath)) return;

        $data = json_decode(file_get_contents($this->storagePath), true);
        foreach ($data as $item) {
            $this->storage[$item['uuid']] = MediaDTO::fromArray($item);

        }
    }


}