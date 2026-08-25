<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaAsset extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'uploaded_by',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->useDisk(config('filesystems.media_disk'))->singleFile();
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function file(): ?Media
    {
        return $this->getFirstMedia('file');
    }

    public function getTypeAttribute(): string
    {
        $mime = $this->file()?->mime_type ?? '';

        return match (true) {
            str_starts_with($mime, 'image/') => 'image',
            str_starts_with($mime, 'video/') => 'video',
            $mime !== '' => 'document',
            default => 'unknown',
        };
    }

    public function getDisplayTitleAttribute(): string
    {
        return $this->title ?: ($this->file()?->name ?? 'Untitled');
    }
}
