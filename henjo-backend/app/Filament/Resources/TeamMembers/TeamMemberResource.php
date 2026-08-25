<?php

namespace App\Filament\Resources\TeamMembers;

use App\Filament\Resources\TeamMembers\Pages\CreateTeamMember;
use App\Filament\Resources\TeamMembers\Pages\EditTeamMember;
use App\Filament\Resources\TeamMembers\Pages\ListTeamMembers;
use App\Filament\Resources\TeamMembers\Pages\ViewTeamMember;
use App\Models\TeamMember;
use App\Support\Sanitizer;
use App\Support\ValidationPatterns;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
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

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $navigationLabel = 'Team Members';

    protected static ?string $modelLabel = 'Team Member';

    protected static ?string $pluralModelLabel = 'Team Members';

    protected static string|UnitEnum|null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Team Member')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    SpatieMediaLibraryFileUpload::make('photo')
                        ->collection('photo')
                        ->image()
                        ->imageEditor()
                        ->circleCropper()
                        ->columnSpanFull(),
                    TextInput::make('name')->required()->maxLength(255)->regex(ValidationPatterns::NAME)
                        ->dehydrateStateUsing(fn (?string $state) => Sanitizer::clean($state)),
                    TextInput::make('position')->required()->maxLength(255)
                        ->dehydrateStateUsing(fn (?string $state) => Sanitizer::clean($state)),
                    Textarea::make('bio')->rows(5)->columnSpanFull()
                        ->dehydrateStateUsing(fn (?string $state) => Sanitizer::clean($state)),
                ]),

            Section::make('Contact')
                ->icon(Heroicon::OutlinedPhone)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextInput::make('email')->email()->regex(ValidationPatterns::EMAIL)->prefixIcon(Heroicon::OutlinedEnvelope),
                    TextInput::make('phone')->maxLength(50)->regex(ValidationPatterns::PHONE)->prefixIcon(Heroicon::OutlinedPhone),
                ]),

            Section::make('Status')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('green')
                ->schema([
                    Checkbox::make('is_active')->default(true),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Team Member')
                ->icon(Heroicon::OutlinedIdentification)
                ->iconColor('gold')
                ->columns(2)
                ->schema([
                    SpatieMediaLibraryImageEntry::make('photo')
                        ->collection('photo')
                        ->hiddenLabel()
                        ->circular()
                        ->size(80)
                        ->columnSpanFull(),
                    TextEntry::make('name')->weight('bold'),
                    TextEntry::make('position')->badge()->color('gold')->placeholder('-'),
                    TextEntry::make('bio')->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Contact')
                ->icon(Heroicon::OutlinedPhone)
                ->iconColor('blue')
                ->columns(2)
                ->schema([
                    TextEntry::make('email')->icon(Heroicon::OutlinedEnvelope)->placeholder('-')->copyable(),
                    TextEntry::make('phone')->icon(Heroicon::OutlinedPhone)->placeholder('-'),
                ]),

            Section::make('Status')
                ->icon(Heroicon::OutlinedAdjustmentsHorizontal)
                ->iconColor('green')
                ->schema([
                    IconEntry::make('is_active')->boolean(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('photo')
                    ->collection('photo')
                    ->label('Photo')
                    ->circular(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('position'),
                TextColumn::make('email'),
                IconColumn::make('is_active')->boolean(),
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
            'index' => ListTeamMembers::route('/'),
            'create' => CreateTeamMember::route('/create'),
            'view' => ViewTeamMember::route('/{record}'),
            'edit' => EditTeamMember::route('/{record}/edit'),
        ];
    }
}
