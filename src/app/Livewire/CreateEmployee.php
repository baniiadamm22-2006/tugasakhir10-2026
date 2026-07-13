<?php

namespace App\Livewire;

use App\Models\Employee;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Livewire\Component;

class CreateEmployee extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void 
    { 
        $this->form->fill(); 
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Karyawan')
                ->required(),

            TextInput::make('whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->placeholder('Contoh: 628123456xxx')
                    ->tel() // Biar kalau dibuka di HP, keyboard yang muncul otomatis angka/telepon
                    ->numeric() // Mencegah user mengetik huruf atau spasi
                    ->required(),
            
            Forms\Components\Select::make('division_id')
                ->relationship('division', 'name')
                ->label('Divisi')
                ->required(),
            
            Forms\Components\TextInput::make('role')
                ->label('Jabatan')
                ->required(),

            Forms\Components\TextInput::make('performance_score')
                ->label('Skor Performa')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'Active' => 'Active',
                    'Leave' => 'Leave',
                ])
                ->required(),
        ])->statePath('data')->model(Employee::class);
    }

    public function save()
    {
        Employee::create($this->form->getState());
        $this->form->fill();
        session()->flash('message', 'Karyawan berhasil ditambahkan!');
    }

    public function render() 
    { 
        return view('livewire.create-employee'); 
    }
}