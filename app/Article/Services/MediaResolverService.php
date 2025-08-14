<?php

namespace App\Article\Services;

use App\Article\DTO\ArticleDTO;
use App\Media\Interfaces\MediaRepositoryInterface;

class MediaResolverService 
{
    private MediaRepositoryInterface $mediaRepo;

    public function __construct(MediaRepositoryInterface $mediaRepo) 
    {
        $this->mediaRepo = $mediaRepo;
    }

    /**
     * @return MediaDTO[]
     */
    public function resolveMedia(ArticleDTO $article) : array 
    {
        $uuids = array_merge($article->imageUuidList,$article->mediaAttachments);
        $resolved = [];
        foreach($uuids as $uuid) {
            $media = $this->mediaRepo->findByUuid($uuid);
            
            if ($media) {
                $resolved[] = $media;
            }
        }
        return $resolved;

    }

}