@if (Auth::check())  <!-- Kiểm tra nếu người dùng đã đăng nhập -->
<h1>Welcome, {{ Auth::user()->name }}!</h1>
<p>Email: {{ Auth::user()->email }}</p>
<p>Joined at: {{ Auth::user()->created_at }}</p>
@else
<p>Please log in to access the dashboard.</p>
@endif