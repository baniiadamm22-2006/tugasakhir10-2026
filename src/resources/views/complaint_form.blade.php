<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Keluhan</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-gray-50 dark:bg-slate-900 min-h-screen flex flex-col items-center justify-center p-6 transition-colors">

    <div class="absolute top-6 right-6 flex gap-4">
        <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';" 
                class="px-4 py-2 bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-lg text-sm shadow-sm transition">
            Toggle Theme
        </button>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium shadow-sm transition">
                Logout
            </button>
        </form>
    </div>

    <div class="w-full max-w-lg bg-white dark:bg-slate-800 p-8 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-slate-800 dark:text-white">Tambah Keluhan Baru</h2>
        
        <form action="/complaint/store" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Judul Keluhan</label>
                <input type="text" name="title" required 
                       class="w-full border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-900 border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-900 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Kejadian</label>
                <input type="date" name="created_at" required 
                       class="w-full border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-900 border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-900 dark:text-white">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" required 
                          class="w-full border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-900 border p-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-slate-900 dark:text-white"></textarea>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition">
                Simpan Keluhan
            </button>
        </form>
    </div>

</body>
</html>