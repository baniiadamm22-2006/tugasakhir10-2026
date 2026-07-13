<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DivisionResource\Pages;
use App\Filament\Admin\Resources\DivisionResource\RelationManagers;
use App\Models\Division;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\{Section, TextEntry, Grid};

class DivisionResource extends Resource
{
    protected static ?string $model = Division::class;

    // Mengatur icon di sidebar admin panel
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Divisi';


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Informasi Divisi')
                ->schema([
                    TextEntry::make('name')->label('Nama Divisi'),
                    TextEntry::make('manager_name')->label('Manager'), // Pastikan kolom ini ada di db
                    TextEntry::make('employees_count')->counts('employees')->label('Total Staf'),
                ])->columns(3),
        ]);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input untuk Nama Divisi
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Divisi'),
                
                // Input untuk Nama Manager
                Forms\Components\TextInput::make('manager_name')
                    ->maxLength(255)
                    ->label('Nama Manajer'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan kolom nama divisi di tabel beserta fitur pencarian
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Divisi'),
                
                // Menampilkan nama manajer
                Tables\Columns\TextColumn::make('manager_name')
                    ->searchable()
                    ->label('Manajer'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter data nanti kita pasang di sini jika diperlukan
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
            // Di sini kita akan pasang drill-down Karyawan & Keluhan Divisi nanti
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDivisions::route('/'),
            'create' => Pages\CreateDivision::route('/create'),
            'edit' => Pages\EditDivision::route('/{record}/edit'),
        ];
    }
}