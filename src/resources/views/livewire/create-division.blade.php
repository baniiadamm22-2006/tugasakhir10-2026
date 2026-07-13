<div class="w-full">
    <h3 class="font-bold mb-4 text-slate-900 dark:text-white">Tambah Data</h3>
    <div class="text-slate-900 dark:text-slate-100">
        {{ $this->form }}
    </div>
    
    <button wire:click="save" type="button" 
        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition">
        Simpan Data
    </button>
</div>