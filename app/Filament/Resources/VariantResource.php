<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VariantResource\Pages;
use App\Models\Variant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VariantResource extends Resource
{
    protected static ?string $model = Variant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Varyantlar';
    protected static ?string $pluralModelLabel = 'Varyantlar';
    protected static ?string $modelLabel = 'Varyant';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Ürün')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Varyant Adı')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Örn: "3\'lü Koltuk", "Bej Renk"'),
                Forms\Components\TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('price')
                    ->label('Fiyat (Opsiyonel)')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('₺')
                    ->helperText('Boş bırakılırsa ana ürün fiyatı kullanılır.'),
                Forms\Components\TextInput::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Ürün')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Varyant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('try', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncelleme')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_id')
                    ->label('Ürün')
                    ->relationship('product', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListVariants::route('/'),
            'create' => Pages\CreateVariant::route('/create'),
            'edit' => Pages\EditVariant::route('/{record}/edit'),
        ];
    }
}