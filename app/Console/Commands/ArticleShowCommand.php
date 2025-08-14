<?php

namespace App\Console\Commands;

use App\Article\DTO\ArticleDTO;
use App\Article\Services\MediaResolverService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;


class ArticleShowCommand extends Command 
{
    protected $signature = 'article:show {--meddiaUUID=}';
    protected $description = 'Display article content and resolved media';

       

    public function handle(MediaResolverService $resolver) : void
    {
        //simulate article
        $article = new ArticleDTO(
            Str::uuid()->toString(),
            'The Future of Modular CMS',
            'This article explores the evolution of content management systems...',
            [$this->option('meddiaUUID')],
            ['uuid-video-1', 'uuid-audio-1']
        );

        $this->info("Headline: {$article->headline}");
        $this->line("Content: {$article->content}");
        $this->line("Attached Media:");

        $mediaList = $resolver->resolveMedia($article);

        foreach ($mediaList as $media) {
            $this->line("- {$media->type} | {$media->title} | {$media->sourceUrl}");
            if (!empty($media->metadata)) {
                $this->line("  Metadata: " . json_encode($media->metadata));
            }
        }

        if (empty($mediaList)) {
            $this->warn("No media resolved.");
        }
    }
}