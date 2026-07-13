<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Master Data | HRIS PANEL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    @filamentStyles
    
    <style>
        /* Teks form input di dark mode */
        .dark .fi-fo-component,
        .dark .fi-fo-field-wrp-label,
        .dark .fi-fo-text-input-input,
        .dark .fi-fo-select-input {
            color: #ffffff !important;
        }
        .dark .fi-fo-text-input-input,
        .dark .fi-fo-select-input {
            background-color: #1e293b !important;
            border-color: #475569 !important;
        }

        /* PERBAIKAN TOMBOL MODAL FILAMENT: Memaksa tombol utama (Simpan/Save) agar muncul warna & teksnya */
        .fi-modal-actions button[type="submit"],
        .fi-modal-actions button.fi-ac-action,
        button[type="submit"].fi-ac-btn-action {
            color: #ffffff !important;
            background-color: #2563eb !important;
        }
        .fi-modal-actions button[type="submit"]:hover,
        button[type="submit"].fi-ac-btn-action:hover {
            background-color: #1d4ed8 !important;
        }
        
        /* Tombol Batal / Cancel agar tetap kontras dan tidak ikut membiru */
        .fi-modal-actions button[class*="gray"],
        .fi-modal-actions button[color="gray"],
        button.fi-ac-btn-cancel {
            color: #1e293b !important;
            background-color: #f1f5f9 !important;
        }
        .dark .fi-modal-actions button[class*="gray"],
        .dark button.fi-ac-btn-cancel {
            color: #ffffff !important;
            background-color: #334155 !important;
        }

        /* Custom scrollbar halus untuk daftar divisi */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
    <script>
        tailwind.config = { darkMode: 'class' };
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 transition-colors overflow-x-hidden">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-950 text-white p-5 flex flex-col justify-between border-r border-slate-800 flex-shrink-0">
            <div>
                <div class="flex items-center gap-3 mb-6 bg-slate-900/50 p-3 rounded-xl border border-slate-800">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center font-black text-white shadow-lg shadow-blue-500/20">HR</div>
                    <div>
                        <h1 class="text-sm font-bold tracking-tight leading-none">HRIS PANEL</h1>
                        <p class="text-[10px] text-slate-500 mt-1">Information System</p>
                    </div>
                </div>
                
                <nav class="space-y-4">
                    <a href="/" class="flex items-center gap-3 py-2 px-3 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        Dashboard Utama
                    </a>

                    <div>
                        <p class="text-[10px] uppercase font-bold text-slate-500 mb-2 px-3 tracking-wider">Daftar Divisi Aktif</p>
                        <div class="space-y-1 max-h-40 overflow-y-auto custom-scroll pr-1">
                            @foreach($divisiList as $divisi)
                                <a href="/divisi/{{ $divisi->id }}" class="flex items-center gap-2.5 py-1.5 px-3 text-slate-400 hover:text-white hover:bg-slate-900 rounded-lg transition text-xs group">
                                    <span class="w-5 h-5 text-[9px] font-black bg-slate-800 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center rounded transition">{{ strtoupper(substr($divisi->name, 0, 2)) }}</span>
                                    <span class="truncate">{{ $divisi->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="/pengaturan" class="flex items-center gap-3 py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition shadow-md shadow-blue-600/10 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Edit Master Data
                    </a>
                </nav>
            </div>
            
            <div class="pt-4 border-t border-slate-800 bg-slate-950">
                <div class="flex items-center gap-3 p-1 rounded-xl">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-xs shadow-md">HD</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold truncate">Administrator</p>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="text-[10px] text-rose-400 hover:text-rose-300 transition font-bold block mt-0.5">Keluar Aplikasi &rarr;</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-6 overflow-y-auto h-screen flex flex-col justify-between" x-data="{ activeTab: 'divisions' }">
            <div>
                <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b pb-4 border-gray-200 dark:border-slate-800">
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white">PENGATURAN MASTER DATA</h2>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5 font-medium uppercase">
                            Manajemen Kelola Tabel Divisi, Staf Karyawan, dan Log Keluhan
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';" 
                                class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 p-1.5 rounded-xl text-xs shadow-sm text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                            <svg class="w-4 h-4 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg class="w-4 h-4 hidden dark:block text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 17.95a1 1 0 011.414 0l.707-.707a1 1 0 01-1.414-1.414l-.707.707a1 1 0 010 1.414zm2.12-14.14a1 1 0 011.414 0l-.707.707a1 1 0 11-1.414-1.414l.707-.707zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </header>

                <div class="flex gap-2 p-1 bg-gray-200/60 dark:bg-slate-950 rounded-xl mb-6 max-w-md border border-gray-100 dark:border-slate-800">
                    <button @click="activeTab = 'divisions'" 
                            class="flex-1 py-2 px-3 rounded-lg text-xs font-bold transition-all duration-150"
                            :class="activeTab === 'divisions' ? 'bg-white dark:bg-slate-800 text-blue-600 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200'">
                        Divisi
                    </button>
                    <button @click="activeTab = 'employees'" 
                            class="flex-1 py-2 px-3 rounded-lg text-xs font-bold transition-all duration-150"
                            :class="activeTab === 'employees' ? 'bg-white dark:bg-slate-800 text-blue-600 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200'">
                        Karyawan
                    </button>
                    <button @click="activeTab = 'complaints'" 
                            class="flex-1 py-2 px-3 rounded-lg text-xs font-bold transition-all duration-150"
                            :class="activeTab === 'complaints' ? 'bg-white dark:bg-slate-800 text-blue-600 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200'">
                        Keluhan
                    </button>
                </div>

                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <div x-show="activeTab === 'divisions'"><livewire:table-divisions /></div>
                    <div x-show="activeTab === 'employees'"><livewire:table-employees /></div>
                    <div x-show="activeTab === 'complaints'"><livewire:table-complaints /></div>
                </div>
            </div>

            <footer class="mt-8 pt-4 border-t border-gray-200 dark:border-slate-800 text-center">
                <p class="text-[10px] font-bold text-slate-400 tracking-wide uppercase">HRIS Dashboard &bull; Powered by Bani &copy; 2026</p>
            </footer>
        </main>
    </div>

    @filamentScripts
    @livewireScripts
</body>
</html>