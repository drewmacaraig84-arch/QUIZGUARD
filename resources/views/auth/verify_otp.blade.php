<!DOCTYPE html>
<html>
<body style="font-family:sans-serif;max-width:360px;margin:60px auto">
    <h3>Verify your account</h3>
    @if (session('success')) <p style="color:green">{{ session('success') }}</p> @endif
    @foreach ($errors->all() as $error) <p style="color:red">{{ $error }}</p> @endforeach

    <form method="POST" action="/verify-otp">
        @csrf
        <input name="dwcc_email" value="{{ old('dwcc_email') }}" placeholder="DWCC email" required><br><br>
        <input name="otp" placeholder="6-digit code" maxlength="6" required><br><br>
        <button type="submit">Verify</button>
    </form>

    <form method="POST" action="/verify-otp/resend" style="margin-top:16px">
        @csrf
        <input name="dwcc_email" placeholder="DWCC email" required>
        <button type="submit">Resend code</button>
    </form>
</body>
</html>