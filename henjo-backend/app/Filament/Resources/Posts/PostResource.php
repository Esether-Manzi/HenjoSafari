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
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
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
            TextInput::make('title')->required()->maxLength(255),
            TextInput::make('slug')->maxLength(255),
            Textarea::make('excerpt')->rows(3),
            Textarea::make('content')->rows(8),
            Select::make('author_id')->relationship('author', 'name')->searchable()->preload(),
            Checkbox::make('featured'),
            TextInput::make('status')->default('draft')->maxLength(50),
            DateTimePicker::make('published_at'),
            SpatieMediaLibraryFileUpload::make('featured_image')
                ->collection('featured_image')
                ->image()
                ->imageEditor()
                ->columnSpanFull(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('title'),
            TextEntry::make('slug'),
            TextEntry::make('author.name')->label('Author'),
            TextEntry::make('status'),
            TextEntry::make('published_at')->dateTime(),
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
