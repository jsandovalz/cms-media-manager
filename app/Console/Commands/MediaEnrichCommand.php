<?php

namespace App\Console\Commands;

use App\Media\Interfaces\MediaRepositoryInterface;
use App\Media\Services\MediaMetadataService;
use Illuminate\Console\Command;

class MediaEnrichCommand extends Command
{
    protected $signature = 'media:enrich {uuid}';
    protected $description = 'Enrich media metadata';

    public function handle(
        MediaRepositoryInterface $repo,
        MediaMetadataService $service
    ) {
        $media = $repo->findByUuid($this->argument('uuid'));

        if (!$media) {
            $this->error('Media not found.');
            return;
        }

        $enriched = $service->enrich($media);
        $repo->store($enriched);

        $this->info("Metadata enriched for: {$enriched->uuid}");
    }

}