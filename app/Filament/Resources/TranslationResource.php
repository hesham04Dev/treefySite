<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslationResource\Pages;
use App\Filament\Resources\TranslationResource\RelationManagers;
use App\Models\Translation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TranslationResource extends Resource
{
    protected static ?string $model = Translation::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('project_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('language_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('value')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name') // ✅ this accesses the project name
                    ->label('Project')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('key.value') // ✅ this accesses the key from translation
                    ->label('Key')
                    ->wrap()
                    ->searchable()->sortable(),
    
                TextColumn::make('language.name') // ✅ correct nested relation
                    ->label('Language')
                    ->wrap()
                    ->searchable()->sortable(),
    
                TextColumn::make('value') // ✅ directly from translation
                    ->label('Translation')
                    ->wrap()
                    ->searchable()->sortable(),
    
              
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
            'index' => Pages\ListTranslations::route('/'),
            'create' => Pages\CreateTranslation::route('/create'),
            'edit' => Pages\EditTranslation::route('/{record}/edit'),
        ];
    }
}
