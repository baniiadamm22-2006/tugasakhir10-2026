<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ComplaintResource\Pages;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\{Section, TextEntry};

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Keluhan Karyawan';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Keluhan')
                    ->schema([
                        TextEntry::make('employee.name')->label('Nama Pelapor'),
                        TextEntry::make('division.name')->label('Divisi'),
                        TextEntry::make('category')->label('Kategori'),
                        TextEntry::make('month_year')->label('Bulan & Tahun'),
                        TextEntry::make('priority')->label('Prioritas')->badge(),
                        TextEntry::make('status')->label('Status')->badge(),
                        TextEntry::make('title')->label('Judul Keluhan')->columnSpanFull(),
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Select::make('employee_id') // Harus 'user_id'
                    ->relationship('employee', 'name') // Mengambil nama dari model Employee/User
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Nama Karyawan/Pelapor'),

                Forms\Components\Select::make('division_id')
                    ->relationship('division', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Divisi'),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Manajemen Vendor'),

                Forms\Components\DatePicker::make('month_year')
                    ->label('Pilih Bulan & Tahun')
                    ->required()
                    ->format('F Y') 
                    ->displayFormat('F Y') 
                    ->native(false) 
                    ->closeOnDateSelection(),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Keluhan')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->label('Deskripsi Keluhan')
                    ->columnSpanFull(),

                Forms\Components\Select::make('priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ])
                    ->required()
                    ->label('Prioritas'),

                Forms\Components\Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Processed' => 'Diproses',
                        'Resolved' => 'Selesai',
                    ])
                    ->required()
                    ->default('Pending')
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->wrap()
                    ->label('Judul Keluhan'),
                
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\TextColumn::make('month_year')
                    ->label('Bulan & Tahun')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('division.name')
                    ->sortable()
                    ->label('Divisi'),

                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'High' => 'danger',
                        'Medium' => 'warning',
                        'Low' => 'info',
                        default => 'gray',
                    })
                    ->label('Prioritas'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'danger',
                        'Processed' => 'warning',
                        'In Progress' => 'warning',
                        'Resolved' => 'success',
                        default => 'gray',
                    })
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\Filter::make('month_year')
                    ->label('Filter Bulan & Tahun')
                    ->form([
                        Forms\Components\DatePicker::make('month_year')
                            ->label('Pilih Bulan & Tahun')
                            ->format('F Y'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when($data['month_year'], fn ($q) => $q->where('month_year', $data['month_year']));
                    }),
                    
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ])
                    ->label('Filter Prioritas'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), 
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}