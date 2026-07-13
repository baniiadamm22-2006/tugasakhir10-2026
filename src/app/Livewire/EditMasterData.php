<?php

namespace App\Livewire;

use App\Models\Division;
use App\Models\Employee;
use App\Models\Complaint;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Livewire\Component;

class EditMasterData extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        // Kita gunakan salah satu model sebagai basis utama, 
        // namun kita bisa atur agar tab ini menjadi navigator data
        return $table
            ->query(Division::query()) 
            ->columns([
                TextColumn::make('name')->label('Nama Divisi')->searchable(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public function render()
    {
        // Karena Filament Tables standar hanya bisa 1 model per komponen,
        // cara terbaik di blade adalah memanggil 3 tabel terpisah seperti di bawah.
        return view('livewire.edit-master-data');
    }
}