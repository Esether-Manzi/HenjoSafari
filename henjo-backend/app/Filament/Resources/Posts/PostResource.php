<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\ViewPost;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Blog Posts';

    protected static ?string $modelLabel = 'Blog Post';

    protected static ?string $pluralModelLabel = 'Blog Posts';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Post')
                ->icon(Heroicon::OutlinedDocumentText)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                    TextInput::make('slug')->required()->maxLength(255),
                    Select::make('author_id')->label('Author')->relationship('author', 'name')->searchable()->preload(),
                    Textarea::make('excerpt')->rows(3)->columnSpanFull(),
                    Textarea::make('content')->required()->rows(8)->columnSpanFull(),
                ]),

            Section::make('Featured Image')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->hiddenLabel()
                        ->collection('featured_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                ]),

            Section::make('Publishing')
                ->icon(Heroicon::OutlinedMegaphone)
                ->iconColor('blue')
                ->columns(3)
                ->schema([
                    Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                        ])
                        ->default('draft')
                        ->required(),
                    DateTimePicker::make('published_at'),
                    Checkbox::make('featured'),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Featured Image')
                ->icon(Heroicon::OutlinedPhoto)
                ->iconColor('teal')
                ->visible(fn ($record) => $record->hasMedia('featured_image'))
                ->schema([
                    SpatieMediaLibraryImageEntry::make('featured_image')
                        ->collection('featured_image')
                        ->hiddenLabel()
                        ->height('14rem')
                        ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full']),
                ]),

            Section::make('Post')
                ->icon(Heroicon::OutlinedDocumentText)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    TextEntry::make('title')->weight('bold')->columnSpanFull(),
                    TextEntry::make('slug')->badge()->color('gray'),
                    TextEntry::make('author.name')->label('Author')->placeholder('-'),
                    TextEntry::make('excerpt')->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Publishing')
                ->icon(Heroicon::OutlinedMegaphone)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => $state === 'published' ? 'success' : 'gray'),
                    TextEntry::make('published_at')->dateTime()->placeholder('-'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->label('Image'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('author.name')->label('Author')->sortable(),
                TextColumn::make('status')->badge(),
                IconColumn::make('featured')->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'view' => ViewPost::route('/{record}'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
