<?php

namespace App\Livewire;

use App\Models\Division;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class TableDivisions extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Division::query())
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Divisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('manager_name')
                    ->label('Nama Manager')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make('edit')
                    ->modalHeading('Edit Divisi')
                    ->modalSubmitActionLabel('Save changes')
                    ->modalCancelActionLabel('Cancel')
                    ->form([
                        // Grid 1 kolom untuk form yang rapi di dalam modal
                        Grid::make(1)->schema([
                            TextInput::make('name')
                                ->label('Nama Divisi')
                                ->required(),
                            TextInput::make('manager_name')
                                ->label('Nama Manager')
                                ->required(),
                        ]),
                    ])
            ]);
    }

    public function render()
    {
        return view('livewire.table-placeholder');
    }
}