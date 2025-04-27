<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerificationResource\Pages;
use App\Filament\Resources\VerificationResource\RelationManagers;
use App\Models\Translation;
use App\Models\User;
use App\Models\Verification;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VerificationResource extends Resource
{
    protected static ?string $model = Verification::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("translator_id")
                    ->relationship('user', 'name')
                    ->options(User::all()->pluck('name', 'id'))
                    ->label("Translator")
                    ->searchable()
                    // ->preload()
                    ->required(),
                // Forms\Components\TextInput::make('translator_id')
                //     ->required()
                //     ->numeric(),
                Select::make("translation_id")
                    ->relationship('translations', 'value')
                    ->options(Translation::all()->pluck('value', 'id'))
                    ->label("Translator")
                    ->searchable()
                    // ->preload()
                    ->required(),
                // Forms\Components\TextInput::make('translation_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\Toggle::make('is_correct')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('translator.user.name')
                    ->label('Translator')
                    ->wrap()
                    ->searchable(),
    
                TextColumn::make('translation.key.value') // ✅ this accesses the key from translation
                    ->label('Key')
                    ->wrap()
                    ->searchable(),
    
                TextColumn::make('translation.language.name') // ✅ correct nested relation
                    ->label('Language')
                    ->wrap()
                    ->searchable(),
    
                TextColumn::make('translation.value') // ✅ directly from translation
                    ->label('Translation')
                    ->wrap()
                    ->searchable(),
    
                IconColumn::make('is_correct')
                    ->boolean(),
    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
    
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListVerifications::route('/'),
            'create' => Pages\CreateVerification::route('/create'),
            'edit' => Pages\EditVerification::route('/{record}/edit'),
        ];
    }
}
