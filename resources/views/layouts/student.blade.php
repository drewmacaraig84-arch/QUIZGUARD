<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal') - DWCC QuizGuard</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
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
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- ============================================================ -->
    <!-- 1. DESKTOP TOP NAVIGATION BAR (Visible on md: and up)        -->
    <!-- ============================================================ -->
    @if(!isset($hideNav) || !$hideNav)
    <header class="hidden md:block w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-5">
        <div class="bg-white rounded-2xl border border-slate-200/80 px-6 py-3.5 shadow-xs flex items-center justify-between">
            <!-- Left: Brand Logo -->
            <a href="{{ route('student.quizzes') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-[#11422d] rounded-xl flex items-center justify-center shadow-xs">
                    <span class="text-white font-black text-lg">Q</span>
                </div>
                <div>
                    <h1 class="text-xs font-black tracking-wider uppercase text-slate-900 leading-tight">DWCC QuizGuard</h1>
                    <p class="text-[9px] font-semibold text-emerald-800 uppercase tracking-wider">Student Portal</p>
                </div>
            </a>

            <!-- Center: Desktop Nav Links -->
            <nav class="flex items-center gap-1 text-xs font-semibold">
                <a href="{{ route('student.quizzes') }}" 
                   class="px-4 py-2 rounded-xl transition {{ request()->routeIs('student.quizzes') || request()->routeIs('student.home') || request()->routeIs('student.dashboard') ? 'bg-[#11422d] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    My Quizzes
                </a>
                <a href="{{ route('student.reviewer') }}" 
                   class="px-4 py-2 rounded-xl transition {{ request()->routeIs('student.reviewer') ? 'bg-[#11422d] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    Reviewer
                </a>
                <a href="{{ route('student.profile') }}" 
                   class="px-4 py-2 rounded-xl transition {{ request()->routeIs('student.profile') ? 'bg-[#11422d] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    Profile & History
                </a>
            </nav>

            <!-- Right: Student Profile Pill & Logout -->
            <div class="flex items-center gap-3">
                <a href="{{ route('student.profile') }}" class="flex items-center gap-2 pl-3 border-l border-slate-200 hover:opacity-80 transition">
                    <div class="w-8 h-8 rounded-full bg-[#11422d] text-white font-bold text-xs flex items-center justify-center">
                        SB
                    </div>
                    <div class="text-left hidden lg:block">
                        <p class="text-xs font-bold text-slate-800 leading-tight">Sayo Boy</p>
                        <p class="text-[10px] text-slate-500">BSIT 3A</p>
                    </div>
                </a>

                <form action="{{ url('/logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Logout" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>
    @endif

    <!-- ============================================================ -->
    <!-- 2. MAIN APPLICATION CONTENT (Responsive width on desktop)    -->
    <!-- ============================================================ -->
    <main class="w-full max-w-6xl mx-auto flex-1 px-4 sm:px-6 lg:px-8 py-4 sm:py-6 pb-24 md:pb-10">
        @yield('content')
    </main>

    <!-- ============================================================ -->
    <!-- 3. MOBILE FIXED BOTTOM NAVIGATION (Visible only on mobile)   -->
    <!-- ============================================================ -->
    @if(!isset($hideNav) || !$hideNav)
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-slate-200/80 px-6 py-2.5 flex items-center justify-around z-30 shadow-lg">
        <!-- 1. Home Tab -->
        <a href="{{ route('student.quizzes') }}" 
           class="flex flex-col items-center gap-1 transition {{ request()->routeIs('student.home') || request()->routeIs('student.dashboard') ? 'text-[#11422d] font-bold' : 'text-slate-400 hover:text-slate-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        <!-- 2. Quizzes Tab -->
        <a href="{{ route('student.quizzes') }}" 
           class="flex flex-col items-center gap-1 transition {{ request()->routeIs('student.quizzes') ? 'text-[#11422d] font-bold' : 'text-slate-400 hover:text-slate-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-[10px] font-medium">Quizzes</span>
        </a>

        <!-- 3. Review Tab -->
        <a href="{{ route('student.reviewer') }}" 
           class="flex flex-col items-center gap-1 transition {{ request()->routeIs('student.reviewer') ? 'text-[#11422d] font-bold' : 'text-slate-400 hover:text-slate-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <span class="text-[10px] font-medium">Review</span>
        </a>

        <!-- 4. Profile Tab -->
        <a href="{{ route('student.profile') }}" 
           class="flex flex-col items-center gap-1 transition {{ request()->routeIs('student.profile') ? 'text-[#11422d] font-bold' : 'text-slate-400 hover:text-slate-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-[10px] font-medium">Profile</span>
        </a>
    </nav>
    @endif

</body>
</html>
