@extends('layouts.teacher')

@section('title', 'Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Settings</h1>
    <p class="text-xs text-slate-500 mt-1">Your profile and password.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6">
        <h2 class="text-base font-bold text-slate-900 mb-4">Profile</h2>
        <dl class="space-y-3 text-sm">
            <div><dt class="text-xs text-slate-400">Full name</dt><dd class="font-semibold text-slate-900">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</dd></div>
            <div><dt class="text-xs text-slate-400">Employee ID</dt><dd class="font-semibold text-slate-900">{{ $user->school_id_num }}</dd></div>
            <div><dt class="text-xs text-slate-400">DWCC email</dt><dd class="font-semibold text-slate-900">{{ $user->dwcc_email }}</dd></div>
            <div><dt class="text-xs text-slate-400">Department</dt><dd class="font-semibold text-slate-900">{{ $user->department }}</dd></div>
        </dl>
        <p class="text-[11px] text-slate-400 mt-4">To change these details, ask the admin.</p>
    </div>

    <form method="POST" action="/teacher/settings/password" class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-4">
        @csrf
        <h2 class="text-base font-bold text-slate-900">Change password</h2>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Current password</label>
            <input type="password" name="current_password" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">New password (min 8)</label>
            <input type="password" name="password" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Confirm new password</label>
            <input type="password" name="password_confirmation" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
        </div>
        <button type="submit" class="px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">Save password</button>
    </form>
</div>
@endsection