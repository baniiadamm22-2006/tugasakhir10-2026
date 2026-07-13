<?php

namespace App\Livewire;

use App\Models\Division;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Livewire\Component;

class CreateDivision extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void { $this->form->fill(); }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Divisi')
                ->required()
                ->unique('divisions', 'name'),


                // Tambahkan input ini
            Forms\Components\TextInput::make('manager_name')
                ->label('Nama Manajer')
                ->required()
                ->maxLength(255),
        ])->statePath('data')->model(Division::class);
    }

    public function save()
    {
        Division::create($this->form->getState());
        $this->form->fill();
        session()->flash('message', 'Divisi berhasil ditambahkan!');
    }

    public function render() { return view('livewire.create-division'); }
}