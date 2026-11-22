<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - DWCC QuizGuard</title>

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

    <!-- OTP Card -->
    <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200/80 shadow-2xl p-8 space-y-6">

        <div class="text-center space-y-2">
            <div class="w-14 h-14 bg-[#11422d] rounded-2xl flex items-center justify-center mx-auto shadow-md text-white font-black text-2xl">
                Q
            </div>
            <div>
                <h1 class="text-xl font-extrabold tracking-tight text-slate-900 uppercase">Verify Your Account</h1>
                <p class="text-[11px] font-semibold text-emerald-800 tracking-wider uppercase mt-0.5">Divine Word College of Calapan</p>
            </div>
            <p class="text-xs text-slate-500 pt-1">Enter your institutional email and the 6-digit OTP code sent to you</p>
        </div>

        @if ($errors->any())
        <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200/80 text-xs text-rose-700">
            @foreach ($errors->all() as $error)
                <p class="font-medium">• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        @if (session('success'))
        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-800">
            ✓ {{ session('success') }}
        </div>
        @endif

        <form action="{{ url('/verify-otp') }}" method="POST" class="space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label for="dwcc_email" class="text-xs font-semibold text-slate-700 block">
                    DWCC Email
                </label>
                <input type="email" 
                       id="dwcc_email" 
                       name="dwcc_email" 
                       value="{{ old('dwcc_email') }}" 
                       placeholder="username@dwcc.edu.ph" 
                       required 
                       class="w-full bg-slate-50 text-xs text-slate-800 px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#11422d] focus:outline-none transition">
            </div>

            <div class="space-y-1.5">
                <label for="otp" class="text-xs font-semibold text-slate-700 block">
                    6-Digit Verification Code
                </label>
                <input type="text" 
                       id="otp" 
                       name="otp" 
                       maxlength="6" 
                       placeholder="123456" 
                       required 
                       class="w-full bg-slate-50 text-center tracking-widest font-mono text-base font-bold text-slate-800 px-4 py-3 rounded-xl border border-slate-200 focus:bg-white focus:border-[#11422d] focus:outline-none transition">
            </div>

            <button type="submit" 
                    class="w-full py-3.5 bg-[#11422d] hover:bg-[#0d3423] text-white font-bold text-xs rounded-xl transition shadow-md">
                Verify & Activate Account
            </button>
        </form>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <a href="{{ route('login') }}" class="font-semibold text-slate-700 hover:text-slate-900 transition">
                ← Back to Login
            </a>
            
            <form action="{{ url('/verify-otp/resend') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="dwcc_email" value="{{ old('dwcc_email') }}">
                <button type="submit" class="font-bold text-emerald-800 hover:text-emerald-950 transition">
                    Resend Code
                </button>
            </form>
        </div>

    </div>

</body>
</html>

