<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - DWCC QuizGuard</title>

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
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Login Container Card -->
    <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200/80 shadow-2xl p-8 space-y-6">

        <!-- Top Header / DWCC Logo -->
        <div class="text-center space-y-2">
            <div class="w-14 h-14 bg-[#11422d] rounded-2xl flex items-center justify-center mx-auto shadow-md text-white font-black text-2xl">
                Q
            </div>
            <div>
                <h1 class="text-xl font-extrabold tracking-tight text-slate-900 uppercase">DWCC QuizGuard</h1>
                <p class="text-[11px] font-semibold text-emerald-800 tracking-wider uppercase mt-0.5">Divine Word College of Calapan</p>
            </div>
            <p class="text-xs text-slate-500 pt-1">Sign in with your institutional account</p>
        </div>

        <!-- Validation Error Message -->
        @if ($errors->any())
        <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200/80 flex items-start gap-2.5 text-xs text-rose-700">
            <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                @foreach ($errors->all() as $error)
                    <p class="font-medium">{{ $error }}</p>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Session Status / Success Messages -->
        @if (session('status'))
        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-2 text-xs font-semibold text-emerald-800">
            <span>✓</span>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        <!-- Login Form -->
        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- DWCC Email Field -->
            <div class="space-y-1.5">
                <label for="dwcc_email" class="text-xs font-semibold text-slate-700 block">
                    DWCC Institutional Email
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </span>
                    <input type="email" 
                           id="dwcc_email" 
                           name="dwcc_email" 
                           value="{{ old('dwcc_email') }}" 
                           placeholder="username@dwcc.edu.ph" 
                           required 
                           autofocus
                           class="w-full bg-slate-50 text-xs text-slate-800 pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#11422d] focus:outline-none transition">
                </div>
            </div>

            <!-- Password Field -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-xs font-semibold text-slate-700 block">
                        Password
                    </label>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="••••••••" 
                           required 
                           class="w-full bg-slate-50 text-xs text-slate-800 pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#11422d] focus:outline-none transition">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full py-3.5 bg-[#11422d] hover:bg-[#0d3423] text-white font-bold text-xs rounded-xl transition shadow-md flex items-center justify-center gap-2">
                <span>Sign In to QuizGuard</span>
                <span>→</span>
            </button>
        </form>

        <!-- Quick Links / Verification Note -->
        <div class="pt-4 border-t border-slate-100 text-center space-y-2 text-xs">
            <p class="text-slate-500">
                Received an activation OTP?
                <a href="{{ url('/verify-otp') }}" class="font-bold text-emerald-800 hover:text-emerald-950 transition">
                    Verify Code
                </a>
            </p>

            <div class="pt-3 text-[11px] text-slate-400 bg-slate-50 p-3 rounded-xl text-left border border-slate-100">
                <p class="font-bold text-slate-700 mb-1">💡 Quick UI Navigation:</p>
                <p>• Admin Portal: <a href="{{ route('admin.dashboard') }}" class="text-emerald-800 underline font-medium">/admin/dashboard</a></p>
                <p>• Student Portal: <a href="{{ route('student.quizzes') }}" class="text-emerald-800 underline font-medium">/student/quizzes</a></p>
            </div>
        </div>

    </div>

</body>
</html>

