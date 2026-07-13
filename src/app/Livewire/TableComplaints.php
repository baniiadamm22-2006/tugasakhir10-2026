<?php

namespace App\Livewire;

use App\Models\Complaint;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class TableComplaints extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Complaint::query())
            ->columns([
                TextColumn::make('employee.name')->label('Pelapor')->searchable()->sortable(),
                TextColumn::make('title')->label('Judul Keluhan')->searchable(),
                TextColumn::make('priority')->label('Prioritas')->badge(),
                TextColumn::make('status')->label('Status')->badge(),
            ])
            ->actions([
                EditAction::make('edit')
                    ->modalHeading('Edit Keluhan')
                    ->modalSubmitActionLabel('Simpan Perubahan')
                    ->modalCancelActionLabel('Kembali')
                    ->form([
                        // Menggunakan Grid agar form lebih proporsional
                        Grid::make(1)->schema([
                            TextInput::make('title')
                                ->label('Judul Keluhan')
                                ->required(),
                            Textarea::make('description')
                                ->label('Deskripsi Keluhan')
                                ->rows(3)
                                ->required(),
                            Grid::make(2)->schema([
                                Select::make('priority')
                                    ->options([
                                        'Low' => 'Low', 
                                        'Medium' => 'Medium', 
                                        'High' => 'High'
                                    ])
                                    ->required(),
                                Select::make('status')
                                    ->options([
                                        'Pending' => 'Pending', 
                                        'Diproses' => 'Diproses', 
                                        'Selesai' => 'Selesai'
                                    ])
                                    ->required(),
                            ]),
                        ]),
                    ])
            ]);
    }

    public function render()
    {
        return view('livewire.table-placeholder');
    }
}