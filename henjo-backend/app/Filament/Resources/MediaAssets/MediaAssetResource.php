<?php

namespace App\Filament\Resources\MediaAssets;

use App\Filament\Resources\MediaAssets\Pages\CreateMediaAsset;
use App\Filament\Resources\MediaAssets\Pages\EditMediaAsset;
use App\Filament\Resources\MediaAssets\Pages\ListMediaAssets;
use App\Models\MediaAsset;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use UnitEnum;

class MediaAssetResource extends Resource
{
    protected static ?string $model = MediaAsset::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Media Library';

    protected static ?string $modelLabel = 'Media Asset';

    protected static ?string $pluralModelLabel = 'Media Library';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Details')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->schema([
                    TextInput::make('title')
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->helperText('Optional — defaults to the uploaded file name.'),
                ]),

            Section::make('File')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('file')
                        ->hiddenLabel()
                        ->collection('file')
                        ->required()
                        ->acceptedFileTypes([
                            'image/*',
                            'video/*',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            'text/csv',
                        ])
                        ->maxSize(102400)
                        ->downloadable()
                        ->openable()
                        ->previewable()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('preview')
                    ->label('')
                    ->state(fn (MediaAsset $record): ?string => $record->type === 'image'
                        ? $record->file()?->getUrl()
                        : null)
                    ->size(48)
                    ->square(),
                TextColumn::make('display_title')
                    ->label('Title')
                    ->searchable(query: fn ($query, string $search) => $query->where('title', 'like', "%{$search}%"))
                    ->sortable(query: fn ($query, string $direction) => $query->orderBy('title', $direction))
                    ->weight('medium'),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'success',
                        'video' => 'info',
                        'document' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('file_name')
                    ->label('File')
                    ->state(fn (MediaAsset $record): ?string => $record->file()?->file_name)
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('size')
                    ->state(fn (MediaAsset $record): string => $record->file()
                        ? Number::fileSize($record->file()->size)
                        : '—'),
                TextColumn::make('uploadedBy.name')
                    ->label('Uploaded By')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                        'document' => 'Document',
                    ])
                    ->query(function ($query, array $data) {
                        $value = $data['value'] ?? null;

                        if (! $value) {
                            return $query;
                        }

                        $query->whereHas('media', function ($q) use ($value) {
                            match ($value) {
                                'image' => $q->where('mime_type', 'like', 'image/%'),
                                'video' => $q->where('mime_type', 'like', 'video/%'),
                                'document' => $q->where('mime_type', 'not like', 'image/%')
                                    ->where('mime_type', 'not like', 'video/%'),
                                default => null,
                            };
                        });
                    }),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('Open')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->url(fn (MediaAsset $record): ?string => $record->file()?->getUrl())
                    ->openUrlInNewTab()
                    ->visible(fn (MediaAsset $record): bool => (bool) $record->file()),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMediaAssets::route('/'),
            'create' => CreateMediaAsset::route('/create'),
            'edit' => EditMediaAsset::route('/{record}/edit'),
        ];
    }
}
