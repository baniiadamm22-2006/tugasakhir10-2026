<?php

namespace App\Livewire;

use App\Models\Employee;
use Filament\Forms\Components\Select;
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

class TableEmployees extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Employee::query())
            ->columns([
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('division.name')->label('Division'),
                TextColumn::make('role')->label('Role'),
                TextColumn::make('performance_score')->label('Performance Score'),
                // Menggunakan badge agar status lebih terlihat profesional
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Active' => 'success',
                        'Inactive' => 'danger',
                    }),
            ])
            ->actions([
                EditAction::make('edit')
                    ->modalHeading('Edit Employee')
                    ->modalSubmitActionLabel('Save changes')
                    ->modalCancelActionLabel('Cancel')
                    ->form([
                        Grid::make(2)->schema([
                            TextInput::make('name')->required(),
                            Select::make('division_id')
                                ->relationship('division', 'name')
                                ->required(),
                            TextInput::make('role')->required(),
                            TextInput::make('performance_score')->numeric()->required(),
                            Select::make('status')
                                ->options(['Active' => 'Active', 'Inactive' => 'Inactive'])
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