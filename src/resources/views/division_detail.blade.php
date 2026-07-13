<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Divisi | {{ $division->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
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
        /* Custom scrollbar halus untuk navigasi divisi */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
    <script>
        // Konfigurasi Dark Mode
        tailwind.config = { darkMode: 'class' };
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 transition-colors overflow-x-hidden" x-data="{ modal: false, complaint: {} }">
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
                        <div class="space-y-1 max-h-48 overflow-y-auto custom-scroll pr-1">
                            @foreach($divisiList as $divisi)
                                <a href="/divisi/{{ $divisi->id }}" class="flex items-center gap-2.5 py-1.5 px-3 {{ $division->id == $divisi->id ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-white hover:bg-slate-900' }} rounded-lg transition text-xs group">
                                    <span class="w-5 h-5 text-[9px] font-black {{ $division->id == $divisi->id ? 'bg-blue-700 text-white' : 'bg-slate-800 group-hover:bg-blue-600 group-hover:text-white' }} flex items-center justify-center rounded transition">{{ strtoupper(substr($divisi->name, 0, 2)) }}</span>
                                    <span class="truncate">{{ $divisi->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
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

        <main class="flex-1 p-6 overflow-y-auto h-screen flex flex-col justify-between">
            <div>
                <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b pb-4 border-gray-200 dark:border-slate-800">
                    <div class="flex items-center gap-3">
                        <a href="/" class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 p-2 rounded-xl text-xs font-bold shadow-sm text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700 transition flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white uppercase">DETAIL DIVISI: {{ $division->name }}</h2>
                            <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5 font-medium flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                PERIODE MONITORING: <span class="font-bold text-blue-600 dark:text-blue-400 uppercase">{{ date('F Y', strtotime($selectedMonth)) }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                        <form action="/divisi/{{ $division->id }}" method="GET" class="m-0">
                            <input type="month" name="month" value="{{ $selectedMonth }}" 
                                   class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 px-3 py-1.5 rounded-xl text-xs font-semibold shadow-sm cursor-pointer hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   onchange="this.form.submit()">
                        </form>
                        
                        <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';" 
                                class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 p-1.5 rounded-xl text-xs shadow-sm text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                            <svg class="w-4 h-4 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg class="w-4 h-4 hidden dark:block text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 17.95a1 1 0 011.414 0l.707-.707a1 1 0 01-1.414-1.414l-.707.707a1 1 0 010 1.414zm2.12-14.14a1 1 0 011.414 0l-.707.707a1 1 0 11-1.414-1.414l.707-.707zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </header>

                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm mb-6 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-16 h-16 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white text-xl font-black shadow-md shadow-blue-600/20">
                        {{ strtoupper(substr($division->name, 0, 2)) }}
                    </div>
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-extrabold tracking-tight text-slate-800 dark:text-white">{{ $division->name }}</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-medium bg-slate-100 dark:bg-slate-900 px-2 py-0.5 rounded-md inline-block">
                            Manager: <span class="font-bold text-slate-700 dark:text-slate-200">{{ $division->manager_name ?? 'Belum Ditentukan' }}</span>
                        </p>
                    </div>
                    <div class="flex gap-8 ml-auto text-center border-t md:border-t-0 pt-4 md:pt-0 w-full md:w-auto justify-around md:justify-end">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Total Staf</p>
                            <p class="text-xl font-black text-slate-800 dark:text-white mt-0.5">{{ $division->employees->count() }}</p>
                        </div>
                        <div class="border-x border-gray-100 dark:border-slate-700 px-6">
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Rata-rata Skor</p>
                            <p class="text-xl font-black text-blue-600 dark:text-blue-400 mt-0.5">{{ number_format($division->employees->avg('performance_score'), 1) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Keluhan Aktif</p>
                            <p class="text-xl font-black text-rose-600 dark:text-rose-400 mt-0.5">{{ $division->active_complaints_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    
                    <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-4 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Kinerja Karyawan
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="text-slate-400 dark:text-slate-500 text-[10px] uppercase font-bold tracking-wider border-b border-gray-100 dark:border-slate-700/50">
                                        <th class="pb-3 pl-2">Nama</th>
                                        <th class="pb-3">Role / Jabatan</th>
                                        <th class="pb-3">Skor</th>
                                        <th class="pb-3">Tren</th>
                                        <th class="pb-3 pr-2 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 dark:divide-slate-700/40 text-xs font-medium">
                                    @forelse($division->employees as $emp)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition">
                                        <td class="py-3 pl-2 font-bold text-slate-800 dark:text-white">{{ $emp->name }}</td>
                                        <td class="py-3 text-slate-500 dark:text-slate-400 font-normal">{{ $emp->role }}</td>
                                        <td class="py-3 font-black text-blue-600 dark:text-blue-400">{{ $emp->performance_score }}</td>
                                        <td class="py-3 {{ $emp->trend_color ?? 'text-gray-400' }}">{{ $emp->trend ?? '-' }}</td>
                                        <td class="py-3 pr-2 text-right">
                                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                                {{ $emp->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-400 dark:text-slate-500 font-normal">Belum ada data staf untuk divisi ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-4 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Log Keluhan Divisi
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs font-medium">
                                <thead>
                                    <tr class="text-slate-400 dark:text-slate-500 text-[10px] uppercase font-bold tracking-wider border-b border-gray-100 dark:border-slate-700/50">
                                        <th class="pb-3 pl-2">Judul Keluhan</th>
                                        <th class="pb-3">Kategori</th>
                                        <th class="pb-3">Prioritas</th>
                                        <th class="pb-3">Status</th>
                                        <th class="pb-3 pr-2 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 dark:divide-slate-700/40">
                                    @forelse($division->complaints as $comp)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition">
                                        <td class="py-3 pl-2 font-bold text-slate-800 dark:text-white truncate max-w-[180px]">{{ $comp->title }}</td>
                                        <td class="py-3 text-slate-500 dark:text-slate-400 font-normal">{{ $comp->category }}</td>
                                        <td class="py-3">
                                            <span class="font-bold {{ $comp->priority == 'High' ? 'text-rose-500' : 'text-amber-500' }}">
                                                {{ $comp->priority }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <span class="inline-flex items-center gap-1 text-slate-600 dark:text-slate-300">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $comp->priority == 'High' ? 'bg-rose-500' : 'bg-amber-500' }}"></span>
                                                {{ $comp->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 pr-2 text-right">
                                            <button @click="modal=true; complaint={
                                                id:'{{ $comp->id }}', title:'{{ $comp->title }}', category:'{{ $comp->category }}', 
                                                priority:'{{ $comp->priority }}', status:'{{ $comp->status }}', date:'{{ $comp->month_year }}',
                                                employee_name:'{{ $comp->employee->name ?? 'Anonim' }}',
                                                desc:'{{ $comp->description ?? 'Tidak ada deskripsi tersedia.' }}'
                                            }" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-bold underline transition">
                                                Lihat Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-400 dark:text-slate-500 font-normal">Tidak ada keluhan terekam untuk bulan ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="mt-8 pt-4 border-t border-gray-200 dark:border-slate-800 text-center">
                <p class="text-[10px] font-bold text-slate-400 tracking-wide uppercase">HRIS Dashboard &bull; Powered by Bani &copy; 2026</p>
            </footer>
        </main>
    </div>

    <div x-show="modal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
        
        <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-lg p-6 shadow-xl border border-gray-100 dark:border-slate-700 flex flex-col justify-between" 
             @click.away="modal=false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4">
             
            <div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Keluhan #<span x-text="complaint.id"></span></p>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white mt-0.5 tracking-tight" x-text="complaint.title"></h3>
                    </div>
                    <button @click="modal=false" class="text-gray-400 hover:text-gray-600 dark:hover:text-white text-xl font-bold p-1 leading-none">&times;</button>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mb-4 bg-slate-50 dark:bg-slate-900/50 p-3 rounded-xl border border-gray-100 dark:border-slate-700/50 text-xs font-semibold">
                    <div><p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Status</p><p class="text-rose-500 mt-0.5" x-text="complaint.status"></p></div>
                    <div><p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Prioritas</p><p class="text-slate-700 dark:text-slate-300 mt-0.5" x-text="complaint.priority"></p></div>
                    <div><p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Kategori</p><p class="text-slate-700 dark:text-slate-300 mt-0.5" x-text="complaint.category"></p></div>
                    <div><p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Tanggal Masuk</p><p class="text-slate-700 dark:text-slate-300 mt-0.5" x-text="complaint.date"></p></div>
                    <div class="col-span-2 border-t border-gray-100 dark:border-slate-700/60 pt-2"><p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Nama Karyawan Yang Bersangkutan</p><p class="text-blue-600 dark:text-blue-400 font-bold mt-0.5" x-text="complaint.employee_name"></p></div>
                </div>
                
                <div class="bg-slate-50 dark:bg-slate-900 p-3 rounded-xl mb-6 border border-gray-100 dark:border-slate-700/40">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider mb-1.5">Deskripsi Masalah / Kasus</p>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed font-medium" x-text="complaint.desc"></p>
                </div>
            </div>

            <div class="flex gap-2">
                <button @click="modal=false" class="flex-1 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 py-2.5 rounded-xl text-xs font-bold text-center transition">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>
</body>
</html>