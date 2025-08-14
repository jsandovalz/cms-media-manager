<?php
namespace App\Media\Interfaces;

use App\Media\DTO\MediaDTO;

interface MediaValidatorInterface 
{
    public function validate(MediaDTO $media) : bool;
}