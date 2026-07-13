<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Filament\Admin\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required(),

                TextInput::make('whatsapp_number')
                ->label('Nomor WhatsApp')
                ->placeholder('Contoh: 628123456xxx')
                ->tel() // Mengaktifkan keyboard telepon di HP
                ->numeric() // Mencegah HR salah ketik huruf atau spasi
                ->maxLength(20),

            
            Forms\Components\Select::make('division_id')
                ->relationship('division', 'name')
                ->required(), // WAJIB ADA agar tidak error database
            
            Forms\Components\TextInput::make('role')
                ->required(),

            Forms\Components\TextInput::make('performance_score')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'Active' => 'Active',
                    'Leave' => 'Leave',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('division.name'),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('performance_score'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Active',
                        'warning' => 'Leave',
                ])
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
