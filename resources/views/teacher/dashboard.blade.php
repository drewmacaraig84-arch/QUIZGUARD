<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - DWCC QuizGuard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 p-8 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-lg border border-slate-200 text-center space-y-4">
        <div class="w-12 h-12 bg-[#11422d] text-white font-bold text-xl rounded-2xl flex items-center justify-center mx-auto">
            Q
        </div>
        <h1 class="text-2xl font-bold text-slate-900">Teacher Dashboard</h1>
        <p class="text-sm text-slate-500">Welcome, {{ auth()->user()->first_name ?? 'Teacher' }}!</p>
        <div class="grid grid-cols-2 gap-4 text-left pt-4">
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl">
                <p class="text-xs text-emerald-800 font-semibold uppercase">Question Banks</p>
                <p class="text-2xl font-black text-emerald-950 mt-1">{{ $banks ?? 0 }}</p>
            </div>
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl">
                <p class="text-xs text-emerald-800 font-semibold uppercase">Quizzes Created</p>
                <p class="text-2xl font-black text-emerald-950 mt-1">{{ $quizzes ?? 0 }}</p>
            </div>
        </div>
        <div class="pt-6">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition">
                    Log out
                </button>
            </form>
        </div>
    </div>
</body>
</html>

