<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Ürünler';
    protected static ?string $pluralModelLabel = 'Ürünler';
    protected static ?string $modelLabel = 'Ürün';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Genel Bilgiler')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Ürün Adı')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('brand_id')
                            ->label('Marka')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\TextInput::make('price')
                            ->label('Fiyat')
                            ->numeric()
                            ->minValue(0)
                            ->required()
                            ->prefix('₺'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),

                        SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->label('Kapak Görseli')
                            ->image()
                            ->directory('products/covers')
                            ->preserveFilenames(),
                        
                        SpatieMediaLibraryFileUpload::make('images')
                            ->collection('images')
                            ->label('Ürün Görselleri')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->panelLayout('grid')
                            ->directory('products')
                            ->preserveFilenames()
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\RichEditor::make('description')
                    ->label('Açıklama')
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Ürün Adı')
                    ->searchable()
                    ->sortable(),
                SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->conversion('thumb')
                    ->label('Kapak')
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Marka')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('try', true)
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
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
                Tables\Filters\SelectFilter::make('brand_id')
                    ->label('Marka')
                    ->relationship('brand', 'name'),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
            // İleride Product -> Variants RelationManager ekleyebiliriz.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}