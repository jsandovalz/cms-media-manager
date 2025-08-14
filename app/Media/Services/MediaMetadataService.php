<?php
namespace App\Media\Services;

use App\Media\DTO\MediaDTO;

class MediaMetadataService 
{
    public function enrich(MediaDTO $media): MediaDTO
    {
        $media->metadata['enriched'] = true;
        $media->metadata['length'] = rand(1, 300); // Simulated enrichment
        return $media;
    }


}