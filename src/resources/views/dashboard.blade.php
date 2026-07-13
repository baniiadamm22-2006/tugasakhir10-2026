<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD HRIS | by bani </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @filamentStyles
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
                    <a href="/" class="flex items-center gap-3 py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition shadow-md shadow-blue-600/10 text-sm">
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

                    <a href="/pengaturan" class="flex items-center gap-3 py-2 px-3 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition text-sm font-medium">
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

        <main class="flex-1 p-6 overflow-y-auto h-screen flex flex-col justify-between">
            <div>
                <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b pb-4 border-gray-200 dark:border-slate-800">
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white">MONITORING KINERJA</h2>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5 font-medium flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            PERIODE SCOUTING: <span class="font-bold text-blue-600 dark:text-blue-400 uppercase">{{ date('F Y', strtotime($selectedMonth)) }}</span>
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                        <form action="/" method="GET" class="m-0">
                            <input type="month" name="month" value="{{ $selectedMonth }}" 
                                   class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 px-3 py-1.5 rounded-xl text-xs font-semibold shadow-sm cursor-pointer hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   onchange="this.form.submit()">
                        </form>
                        
                        <form action="{{ route('dashboard.pdf') }}" method="GET" class="m-0">
                            <input type="hidden" name="month" value="{{ $selectedMonth }}">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-sm shadow-emerald-600/10 transition flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh PDF
                            </button>
                        </form>

                        <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';" 
                                class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 p-1.5 rounded-xl text-xs shadow-sm text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                            <svg class="w-4 h-4 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg class="w-4 h-4 hidden dark:block text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 17.95a1 1 0 011.414 0l.707-.707a1 1 0 01-1.414-1.414l-.707.707a1 1 0 010 1.414zm2.12-14.14a1 1 0 011.414 0l-.707.707a1 1 0 11-1.414-1.414l.707-.707zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </header>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Total Karyawan Aktif</p>
                            <h3 class="text-2xl font-black mt-0.5 text-slate-800 dark:text-white tracking-tight">{{ $totalKaryawan }}</h3>
                        </div>
                        <div class="p-2.5 rounded-lg bg-blue-50 text-blue-600 dark:bg-slate-700/50 dark:text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Rata-rata Skor Kinerja</p>
                            <h3 class="text-2xl font-black mt-0.5 text-slate-800 dark:text-white tracking-tight">
                                {{ number_format($rataKinerja, 1) }} <span class="text-xs font-normal text-slate-400">/ 100</span>
                            </h3>
                        </div>
                        <div class="p-2.5 rounded-lg bg-emerald-50 text-emerald-600 dark:bg-slate-700/50 dark:text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-rose-100 dark:border-rose-950/40 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs text-rose-500 font-bold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-ping"></span>
                                Tindakan Kritis (High)
                            </p>
                            <h3 class="text-2xl font-black mt-0.5 text-rose-600 dark:text-rose-400 tracking-tight">{{ $keluhanHigh }}</h3>
                        </div>
                        <div class="p-2.5 rounded-lg bg-rose-50 text-rose-600 dark:bg-rose-950/20 dark:text-rose-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2zm0 0h5a2 2 0 002-2v-3a2 2 0 00-2-2h-5m5 0V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
                                Rata-rata Skor Performa per Divisi
                            </h3>
                            <div class="relative h-44"> <canvas id="divisiChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm max-h-64 overflow-y-auto custom-scroll">
                                <div class="border-b pb-2 mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase">Tambah Divisi Baru</h4>
                                </div>
                                <livewire:create-division />
                            </div>
                            <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm max-h-64 overflow-y-auto custom-scroll">
                                <div class="border-b pb-2 mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase">Tambah Profil Karyawan</h4>
                                </div>
                                <livewire:create-employee />
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm flex flex-col justify-between max-h-[430px]">
                        <div>
                            <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.07 6.07 0 00-1-3.5M9 17v1a3 3 0 01-6 0v-1m6 0H3m13-7a3 3 0 01-3 3H9a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1z"></path></svg>
                                URGENCY MONITOR (REAL-TIME)
                            </h3>
                            <div class="space-y-2 max-h-36 overflow-y-auto custom-scroll pr-1">
                                @forelse($urgentComplaints as $complaint)
                                    <div class="p-2.5 bg-slate-50 dark:bg-slate-900 rounded-lg border border-gray-100 dark:border-slate-700 flex justify-between items-start gap-2">
        <div class="min-w-0">
            <p class="text-xs font-bold text-slate-800 dark:text-white truncate">{{ $complaint->title }}</p>
            <p class="text-[10px] text-gray-400 mt-0.5 font-medium truncate">
                {{ $complaint->employee->name ?? 'Anonim' }} • {{ $complaint->division->name ?? 'Tanpa Divisi' }}
            </p>
            <p class="text-[9px] font-semibold mt-0.5 {{ ($complaint->employee->performance_score ?? 100) < 60 ? 'text-rose-500' : 'text-emerald-500' }}">
                Skor Saat Ini: {{ $complaint->employee->performance_score ?? '-' }}
            </p>
        </div>

            @if($complaint->employee && $complaint->employee->whatsapp_number)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $complaint->employee->whatsapp_number) }}?text=Halo%20{{ urlencode($complaint->employee->name) }},%20kami%20dari%20Tim%20HR%20ingin%20meminta%20klarifikasi%20terkait%20keluhan%20kinerja%20berikut:%20*{{ urlencode($complaint->title) }}*.%20Mohon%20segera%20merespons%20pesan%20ini."
                                               target="_blank" 
                                               title="Hubungi {{ $complaint->employee->name }} via WhatsApp"
                                               class="text-[9px] flex-shrink-0 font-bold bg-rose-100 text-rose-700 hover:bg-emerald-600 hover:text-white dark:bg-rose-950/50 dark:text-rose-400 dark:hover:bg-emerald-600 dark:hover:text-white px-2 py-1 rounded-full uppercase tracking-wide flex items-center gap-1 transition-all duration-200">
                                               <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.666.988 3.311 1.485 5.358 1.486 5.539 0 10.051-4.512 10.055-10.055.002-2.686-1.043-5.212-2.943-7.114C17.159 3.568 14.63 2.521 11.956 2.52 6.423 2.52 1.91 7.032 1.907 12.57c-.001 2.088.547 4.129 1.587 5.892l-.34 1.24-.344 1.258 1.288-.338 1.15-.302z"/></svg>
                                               {{ $complaint->status }}
                                            </a>
        @else
            <span class="text-[9px] flex-shrink-0 font-bold bg-rose-50 text-rose-600 dark:bg-rose-950/50 dark:text-rose-400 px-2 py-0.5 rounded-full uppercase tracking-wide">
                {{ $complaint->status }}
            </span>
        @endif
    </div>
@empty
    <div class="text-center py-6">
        <p class="text-xs text-gray-400 font-medium">Clear! Tidak ada keluhan mendesak.</p>
    </div>
@endforelse

                        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-slate-700">
                            <h3 class="text-xs font-bold mb-2 text-slate-700 dark:text-slate-300 uppercase flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                INPUT KELUHAN BARU
                            </h3>
                            <div class="max-h-40 overflow-y-auto custom-scroll">
                                <livewire:create-complaint-front />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @filamentScripts
    <script>
        const ctx = document.getElementById('divisiChart').getContext('2d');
        const labels = {!! json_encode($divisiList->pluck('name')->values()) !!};

            
const dataSkor = {!! json_encode($divisiList->map(function($divisi) {
    return round($divisi->employees->avg('performance_score'), 1) ?? 0;
})->values()) !!};


        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Rata-rata',
                    data: dataSkor,
                    backgroundColor: 'rgba(59, 130, 246, 0.85)',
                    hoverBackgroundColor: '#2563eb',
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Sembunyikan legend untuk menghemat space
                },
              scales: { 
                    x: { grid: { display: false } },
                    y: { 
                        beginAtZero: true 
                    } 
                }
            }
        });
    </script>
</body>
</html>


