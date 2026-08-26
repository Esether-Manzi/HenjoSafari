<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Support\Sanitizer;
use App\Support\ValidationPatterns;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.settings';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Site Identity')
                    ->schema([
                        TextInput::make('site_name')->required()->maxLength(255)
                            ->dehydrateStateUsing(fn (?string $state) => Sanitizer::clean($state)),
                        TextInput::make('tagline')->maxLength(255)
                            ->dehydrateStateUsing(fn (?string $state) => Sanitizer::clean($state)),
                        FileUpload::make('logo')->image()->directory('site'),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('email')->email()->regex(ValidationPatterns::EMAIL),
                        TextInput::make('phone')->regex(ValidationPatterns::PHONE),
                        TextInput::make('address')->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => Sanitizer::clean($state)),
                        TextInput::make('working_hours_weekday')->placeholder('Mon - Fri: 8:00 AM - 6:00 PM (EAT)'),
                        TextInput::make('working_hours_saturday')->placeholder('Sat: 9:00 AM - 4:00 PM (EAT)'),
                    ])->columns(2),

                Section::make('Social Links')
                    ->schema([
                        TextInput::make('facebook_url')->url(),
                        TextInput::make('twitter_url')->url(),
                        TextInput::make('instagram_url')->url(),
                        TextInput::make('linkedin_url')->url(),
                        TextInput::make('tiktok_url')->url(),
                        TextInput::make('youtube_url')->url(),
                        TextInput::make('tripadvisor_url')->url(),
                    ])->columns(2),

                Section::make('Payments')
                    ->schema([
                        TextInput::make('payment_url')->url()->placeholder('https://payments.pesapal.com/henjoafricansafaris'),
                    ]),

                Section::make('Homepage & Stats')
                    ->schema([
                        FileUpload::make('homepage_hero')->image()->directory('site'),
                        TextInput::make('years_experience')->placeholder('5+'),
                        TextInput::make('happy_travelers_count')->placeholder('500+'),
                        TextInput::make('average_rating')->placeholder('4.9'),
                        TextInput::make('footer_tagline')->columnSpanFull(),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $settings = SiteSetting::current();

        $logo = $data['logo'] ?? null;
        $hero = $data['homepage_hero'] ?? null;
        unset($data['logo'], $data['homepage_hero']);

        $settings->update($data);

        if ($logo) {
            $settings->addMedia(storage_path('app/public/'.$logo))
                ->preservingOriginal()
                ->toMediaCollection('logo');
        }

        if ($hero) {
            $settings->addMedia(storage_path('app/public/'.$hero))
                ->preservingOriginal()
                ->toMediaCollection('homepage_hero');
        }

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
