<div>
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('message') }}</div>
    @endif

    <form wire:submit="create">
        {{ $this->form }}
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
            Kirim Keluhan
        </button>
    </form>
    
    @filamentScripts
    @vite('resources/css/app.css')
</div>
