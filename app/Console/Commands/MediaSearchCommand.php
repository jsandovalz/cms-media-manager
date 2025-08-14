<?php

namespace App\Console\Commands;

use App\Media\Interfaces\MediaRepositoryInterface;
use Illuminate\Console\Command;

class MediaSearchCommand extends Command
{
    protected $signature = 'media:search {--type=} {--title=}';
    protected $description = 'Search media by type or title';

    public function handle(MediaRepositoryInterface $repo)
    {
        $results = [];

        if ($type = $this->option('type')) {
            $results = $repo->searchByType($type);
        } elseif ($title = $this->option('title')) {
            $results = $repo->searchByTitle($title);
        }

        foreach ($results as $media) {
            $this->line("{$media->uuid} | {$media->type} | {$media->title}");
        }

        if (empty($results)) {
            $this->warn('No media found.');
        }

    }

}