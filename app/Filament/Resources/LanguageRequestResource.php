<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageRequestResource\Pages;
use App\Filament\Resources\LanguageRequestResource\RelationManagers;
use App\Models\LanguageRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LanguageRequestResource extends Resource
{
    protected static ?string $model = LanguageRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('translator_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('language_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('file_path')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translator.user.name')
                ->label("Translator")
                    ->numeric()
                    ->sortable(),
                TextColumn::make('language.name') 
                ->label('Language')
                ->searchable()
                ->wrap(),
            
                ToggleColumn::make("is_approved")->label("approve"),
                TextColumn::make('file_path')
                    ->label('file')
                    ->formatStateUsing(function ($state) {
                        if (!$state)
                            return 'No file';
                        return 'Download';
                    })
                    ->url(function ($record) {
                        return \Storage::disk('public')->url($record->file_path);
                    }, true) 
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListLanguageRequests::route('/'),
            'create' => Pages\CreateLanguageRequest::route('/create'),
            'edit' => Pages\EditLanguageRequest::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
{
    return false;
}

}
