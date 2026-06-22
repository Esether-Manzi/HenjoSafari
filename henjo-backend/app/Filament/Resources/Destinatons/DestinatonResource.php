<?php

namespace App\Filament\Resources\Destinatons;

use App\Filament\Resources\Destinatons\Pages\CreateDestinaton;
use App\Filament\Resources\Destinatons\Pages\EditDestinaton;
use App\Filament\Resources\Destinatons\Pages\ListDestinatons;
use App\Filament\Resources\Destinatons\Pages\ViewDestinaton;
use App\Filament\Resources\Destinatons\Schemas\DestinatonForm;
use App\Filament\Resources\Destinatons\Schemas\DestinatonInfolist;
use App\Filament\Resources\Destinatons\Tables\DestinatonsTable;
use App\Models\Destinaton;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DestinatonResource extends Resource
{
    protected static ?string $model = Destinaton::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Destinatoins';

    public static function form(Schema $schema): Schema
    {
        return DestinatonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DestinatonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DestinatonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDestinatons::route('/'),
            'create' => CreateDestinaton::route('/create'),
            'view' => ViewDestinaton::route('/{record}'),
            'edit' => EditDestinaton::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
