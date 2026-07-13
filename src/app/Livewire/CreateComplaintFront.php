<?php

namespace App\Livewire;

use App\Models\Complaint;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Livewire\Component;

class CreateComplaintFront extends Component implements HasForms
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
            Forms\Components\Select::make('employee_id')
                ->relationship('employee', 'name')
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

            // Menambahkan field yang ada di Resource tapi belum ada di Livewire
            Forms\Components\TextInput::make('category')
                ->label('Kategori')
                ->required()
                ->maxLength(255),

            Forms\Components\DatePicker::make('month_year')
                ->label('Pilih Bulan & Tahun')
                ->required()
                ->format('F Y')
                ->displayFormat('F Y')
                ->native(false),

            Forms\Components\TextInput::make('title')
                ->required()
                ->label('Judul Keluhan'),

            Forms\Components\Textarea::make('description')
                ->required()
                ->rows(5)
                ->label('Deskripsi Keluhan'),

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
                    'Processed' => 'Diproses',     // Sesuai ComplaintResourc
                    'Resolved' => 'Selesai',       // Sesuai ComplaintResource
                ])
                ->default('Pending')
                ->required()
                ->label('Status'),
        ])->statePath('data')->model(Complaint::class);
    }

    public function create()
    {
        Complaint::create($this->form->getState());
        
        $this->form->fill(); 
        session()->flash('message', 'Keluhan berhasil dikirim!');
    }

    public function render() 
    { 
        return view('livewire.create-complaint-front'); 
    }
}