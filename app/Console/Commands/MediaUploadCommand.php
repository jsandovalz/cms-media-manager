<?php

namespace App\Console\Commands;

use App\Media\DTO\MediaDTO;
use App\Media\Interfaces\MediaRepositoryInterface;
use App\Media\Interfaces\MediaValidatorInterface;
use Illuminate\Console\Command;
use DateTime;
use Illuminate\Support\Str;


class MediaUploadCommand extends Command {
    protected $signature = 'media:upload {type} {title} {description} {source_url}';
    protected $description = 'Simulate media upload';

    public function handle(
        MediaRepositoryInterface $repo,
        MediaValidatorInterface $validator
    ) {
        $media = new MediaDTO(
            Str::uuid()->toString(),
            $this->argument('type'),
            $this->argument('title'),
            $this->argument('description'),
            $this->argument('source_url'),
            new DateTime()
        );

        if (!$validator->validate($media)) {
            $this->error('Invalid media type.');
            return;
        }

        $repo->store($media);
        $this->info("Media uploaded: {$media->uuid}");
    }

}