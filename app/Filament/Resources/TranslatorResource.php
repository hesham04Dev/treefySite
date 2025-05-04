<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslatorResource\Pages;
use App\Filament\Resources\TranslatorResource\RelationManagers;
use App\Forms\LangForm;
use App\Forms\TranslatorForm;
use App\Models\Translator;
use App\Models\User;
// use App\Table\UserTable;
use App\Tables\UserTable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select as FormSelect;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

use App\Forms\UserForm;
class TranslatorResource extends Resource
{
    protected static ?string $model = Translator::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("user_id")
                    ->relationship('user', 'name')
                    ->options(User::all()->pluck('name', 'id'))
                    ->label("User")
                    ->searchable()
                    ->preload()
                    ->createOptionForm(function () {
                        return UserForm::make(); // Ensure this is correct and returns a valid form
                    })
                    ->required(),
                ...TranslatorForm::make()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ...UserTable::make(true),
                TextColumn::make('languages')
                    ->label('Languages')
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record->languages->pluck('code')->join(', ')
                    )
                    ->wrap() // optional: to prevent overflow
                    ->searchable(),
                ToggleColumn::make("is_accepted")->label("accept"),
                TextColumn::make('cv_path')
                    ->label('CV')
                    ->formatStateUsing(function ($state) {
                        if (!$state)
                            return 'No file';
                        return 'Download';
                    })
                    ->url(function ($record) {
                        return \Storage::disk('public')->url($record->cv_path);
                    }, true) 
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListTranslators::route('/'),
            'create' => Pages\CreateTranslator::route('/create'),
            'edit' => Pages\EditTranslator::route('/{record}/edit'),
            // 'accept' => Pages\AcceptTranslators::class,
            'new' => Pages\ViewNewTranslator::route('/need-accept'),
        ];
    }




}
