
<!DOCTYPE html>
<html lang="en" data-theme="material">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Material Tailwind + DaisyUI</title>
  @vite('resources/css/app.css') {{-- or mix if you're using Laravel Mix --}}
</head>
<body class="min-h-screen bg-base-100 text-base-content">

  {{-- Navbar --}}
  <div class="navbar bg-primary text-white">
    <div class="flex-1">
      <a class="btn btn-ghost text-xl">MaterialDash</a>
    </div>
    <div class="flex-none gap-2">
      <button class="btn btn-secondary">Login</button>
    </div>
  </div>

  {{-- Hero Section --}}
  <div class="hero min-h-[60vh] bg-gradient-to-r from-primary to-secondary text-white">
    <div class="hero-content text-center">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">Welcome to MaterialDash</h1>
        <p class="py-6 text-lg">Built with Tailwind CSS + DaisyUI using Material Design colors and principles.</p>
        <button class="btn btn-accent">Get Started</button>
      </div>
    </div>
  </div>

  {{-- Features Section --}}
  <div class="p-10 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="card bg-base-200 shadow-md">
      <div class="card-body">
        <h2 class="card-title">Fast Setup</h2>
        <p>Use DaisyUI with your Laravel + Tailwind app instantly.</p>
      </div>
    </div>
    <div class="card bg-base-200 shadow-md">
      <div class="card-body">
        <h2 class="card-title">Material Theme</h2>
        <p>Customize your app with Material colors and responsive UI.</p>
      </div>
    </div>
    <div class="card bg-base-200 shadow-md">
      <div class="card-body">
        <h2 class="card-title">Mobile Ready</h2>
        <p>Responsive by default with Tailwind and DaisyUI utilities.</p>
      </div>
    </div>
  </div>

  {{-- Footer --}}
  <footer class="footer p-10 bg-neutral text-neutral-content">
    <div>
      <span class="footer-title">Services</span> 
      <a class="link link-hover">Branding</a> 
      <a class="link link-hover">Design</a> 
      <a class="link link-hover">Marketing</a> 
    </div> 
    <div>
      <span class="footer-title">Company</span> 
      <a class="link link-hover">About us</a> 
      <a class="link link-hover">Contact</a> 
    </div>
  </footer>

</body>
</html>
