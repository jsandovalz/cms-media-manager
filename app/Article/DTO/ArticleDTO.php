<?php

namespace App\Article\DTO;

class ArticleDTO 
{
    public string $articleUuid;
    public string $headline;
    public string $content;
    public array $imageUuidList;
    public array $mediaAttachments;

    public function __construct(
        string $articleUuid,
        string $headline,
        string $content,
        array $imageUuidList = [],
        array $mediaAttachments = []
    ) {
        $this->articleUuid = $articleUuid;
        $this->headline = $headline;
        $this->content = $content;
        $this->imageUuidList = $imageUuidList;
        $this->mediaAttachments = $mediaAttachments;
    }

    
}