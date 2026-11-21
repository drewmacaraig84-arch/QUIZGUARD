<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - DWCC QuizGuard</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Using CDN for easy student preview without requiring node build step) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        dwcc: {
                            green: '#11422d',
                            dark: '#0d3423',
                            light: '#185c3f',
                            sage: '#e2ece7',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex">

    <!-- ========================================== -->
    <!-- 1. LEFT SIDEBAR (DWCC Forest Green Theme)  -->
    <!-- ========================================== -->
    <aside class="w-64 bg-[#11422d] text-white min-h-screen flex flex-col justify-between p-4 shrink-0 shadow-lg">
        <div>
            <!-- DWCC Brand / Logo Section -->
            <div class="flex items-center gap-3 px-2 py-3 mb-6">
                <!-- White square logo with bold green Q -->
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-md shrink-0">
                    <span class="text-[#11422d] font-black text-xl tracking-tight">Q</span>
                </div>
                <div>
                    <h1 class="text-sm font-bold tracking-wide uppercase leading-tight text-white">DWCC QuizGuard</h1>
                    <p class="text-[9px] text-emerald-200/70 font-medium tracking-wider uppercase mt-0.5">Divine Word College of Calapan</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div>
                <p class="text-[10px] uppercase font-bold text-emerald-300/50 tracking-wider px-3 mb-2">Menu</p>
                <nav class="space-y-1">
                    <!-- 1. Dashboard / System Health Link -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white shadow-xs' : 'text-emerald-100/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- 2. Users Link -->
                    <a href="{{ route('admin.users') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.users') ? 'bg-white/15 text-white shadow-xs' : 'text-emerald-100/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>

                    <!-- 3. Sections & Subjects Link -->
                    <a href="{{ route('admin.sections_subjects') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.sections_subjects') ? 'bg-white/15 text-white shadow-xs' : 'text-emerald-100/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Sections & Subjects
                    </a>

                    <!-- 4. System Logs Link -->
                    <a href="{{ route('admin.logs') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.logs') ? 'bg-white/15 text-white shadow-xs' : 'text-emerald-100/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        System Logs
                    </a>
                </nav>
            </div>
        </div>

        <!-- Bottom User Profile Card -->
        <div class="bg-white/10 rounded-2xl p-3 flex items-center justify-between border border-white/10">
            <div class="flex items-center gap-2.5 min-w-0">
                <!-- Avatar circle with initials EB -->
                <div class="w-9 h-9 rounded-full bg-white text-[#11422d] font-bold text-xs flex items-center justify-center shrink-0 shadow-xs">
                    EB
                </div>
                <div class="truncate">
                    <p class="text-xs font-semibold text-white leading-tight truncate">Elena Bautista</p>
                    <p class="text-[10px] text-emerald-200/70 font-medium truncate">System Administrator</p>
                </div>
            </div>
            <!-- Logout Action -->
            <form action="{{ url('/logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" title="Logout" class="text-emerald-200/70 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- ========================================== -->
    <!-- 2. MAIN APPLICATION CONTENT AREA           -->
    <!-- ========================================== -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- Top Navigation Header -->
        <header class="bg-white border-b border-gray-100 px-8 py-3.5 flex items-center justify-between sticky top-0 z-20">
            <!-- Global Search Bar -->
            <div class="relative w-80 lg:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" 
                       placeholder="Search users, quizzes, logs..." 
                       class="w-full bg-[#f8fafc] text-sm text-slate-700 pl-10 pr-4 py-2 rounded-xl border border-transparent hover:border-gray-200 focus:border-emerald-600 focus:bg-white focus:outline-none transition placeholder-slate-400">
            </div>

            <!-- Right Controls: Notification & Avatar -->
            <div class="flex items-center gap-3">
                <!-- Notifications Bell -->
                <button type="button" class="w-9 h-9 rounded-full bg-slate-50 hover:bg-slate-100 border border-slate-200/60 flex items-center justify-center text-slate-600 transition relative">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <!-- Small Alert Dot -->
                    <span class="w-2 h-2 rounded-full bg-emerald-500 absolute top-1.5 right-1.5 ring-2 ring-white"></span>
                </button>

                <!-- Profile Badge Initial -->
                <div class="w-9 h-9 rounded-full bg-[#11422d] text-white font-bold text-xs flex items-center justify-center shadow-xs">
                    EB
                </div>
            </div>
        </header>

        <!-- Page Specific Body Content -->
        <main class="p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>

