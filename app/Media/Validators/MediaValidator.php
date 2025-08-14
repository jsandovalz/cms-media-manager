<?php

namespace App\Media\Validators;

use App\Media\DTO\MediaDTO;
use App\Media\Interfaces\MediaValidatorInterface;

class MediaValidator implements MediaValidatorInterface
{
    private array $allowedTypes = ['image', 'video', 'audio', 'graph', 'file'];

    public function validate(MediaDTO $media): bool
    {
        return in_array($media->type, $this->allowedTypes);
    }
}
