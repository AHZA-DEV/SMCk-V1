
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Sistem Manajemen Cuti</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
  <!-- Background decorations -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-32 w-80 h-80 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-gradient-to-br from-indigo-400 to-blue-400 rounded-full opacity-20 blur-3xl"></div>
  </div>

  <div class="relative w-full max-w-md">
    <!-- Login Form -->
    <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-white/20 p-8">
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-2">Sistem Manajemen Cuti</h2>
        <p class="text-slate-600">Silakan masuk untuk melanjutkan</p>
      </div>

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6" role="alert">
          @foreach ($errors->all() as $error)
            <span class="block sm:inline">{{ $error }}</span>
          @endforeach
        </div>
      @endif
      
      <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-slate-700">Email</label>
          <div class="relative">
            <input type="email" name="email" required placeholder="Masukkan email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/50 backdrop-blur-sm transition-all duration-200">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-envelope text-slate-400"></i>
            </div>
          </div>
        </div>
        
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-slate-700">Password</label>
          <div class="relative">
            <input id="password" type="password" name="password" required placeholder="Masukkan password" class="w-full pl-10 pr-12 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/50 backdrop-blur-sm transition-all duration-200">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-lock text-slate-400"></i>
            </div>
            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
              <i id="toggleIcon" class="fas fa-eye text-slate-400 hover:text-slate-600 transition-colors duration-200"></i>
            </button>
          </div>
        </div>
        
        <div class="flex items-center justify-between">
          <label class="flex items-center">
            <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
            <span class="ml-2 text-sm text-slate-600">Ingat saya</span>
          </label>
        </div>
        
        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-4 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
          <span class="flex items-center justify-center">
            <i class="fa fa-sign-in mr-2" aria-hidden="true"></i>
            Masuk
          </span>
        </button>
      </form>
      
      <div class="mt-8 pt-6 border-t border-slate-200">
        <div class="text-center space-y-4">
          <div class="text-sm text-slate-600">
            <p class="font-semibold mb-2">Akun Demo:</p>
            <ul class="list-none space-y-1">
              <li><strong>Admin:</strong> admin@gmail.com / password</li>
              <li><strong>HRD:</strong> ani.wulandari@perusahaan.com / password</li>
              <li><strong>Karyawan:</strong> budi.santoso@perusahaan.com / password</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.className = 'fas fa-eye-slash text-slate-400 hover:text-slate-600 transition-colors duration-200';
      } else {
        passwordInput.type = 'password';
        toggleIcon.className = 'fas fa-eye text-slate-400 hover:text-slate-600 transition-colors duration-200';
      }
    }
  </script>
</body>
</html>