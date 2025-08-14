# 📦 Modular CMS – Media Module
This module simulates media management and article rendering.

# 📦 Overview
    This CMS module includes:
    - Part 1: Media upload, enrichment via OpenAI, and storage.
    - Part 2: Article rendering with media resolution.
    
## 📁 Project Structure
```bash
app/
├── Article/
│   ├── DTO/
│   │   └── ArticleDTO.php 
│   ├── Services/
│   │   └── MediaResolverService.php
├── Media/
│   ├── DTO/
│   │   └── MediaDTO. 
│   ├── Interfaces/
│   │   └── MediaRepositoryInterface.php 
│   │   └── MediaValidatorInterface.php 
│   ├── Repositories/
│   │   └── MemoryMediaRepository.php
│   ├── Services/
│   │   └── MediaMetadataService.php
│   ├── Validators/
│   │   └── MediaValidator.php
├── Console/
│   ├── Commands/
│   │   ├── ArticleShowCommand.php
│   │   ├── MediaUploadCommand.php
│   │   ├── MediaEnrichCommand.php
│   │   └── MediaSearchCommand.php
```
📁 app/Article

DTO/ArticleDTO.php
- Used to simulate articles that reference media, without requiring a database.

MediaResolverService.php
- Returns the actual MediaDTO objects linked to an article.

📁 app/Media

DTO/MediaDTO.php
- Encapsulates all relevant data about a media item.

Interfaces/MediaRepositoryInterface.php
- Enables decoupling of storage logic from business logic.

Interfaces/MediaValidatorInterface.php
- Ensures media items meet required criteria before being stored.

Repositories/MemoryMediaRepository.php
- Simulates storage without a database.

Services/MediaMetadataService.php
- Adds useful metadata such as duration, tags, summaries, etc.

Validators/MediaValidator.php
- Validates media type against allowed values (image, video, etc.).

📁 app/Console/Commands

MediaUploadCommand.php
- Creates a MediaDTO, validates it, and stores it in the repository.

MediaEnrichCommand.php
- Uses MediaMetadataService to update the MediaDTO.

MediaSearchCommand.php
- Filters the repository and displays results in the console.

ArticleShowCommand.php
- Simulates editorial content with attached media.


## 🚀 Artisan Commands

### Upload media
```bash
php artisan media:upload image "Sunset" "Beautiful view" "https://example.com/sunset.jpg" 
```
### Enrich metadata
```bash
php artisan media:enrich {uuid}
```
### Search media
```bash
php artisan media:search --type=image
```

### Show article
```bash
php artisan article:show {uuid}
```

