<!DOCTYPE html>
<html lang="en" x-data="{ openHamburger: false }" x-cloak>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HIMSI 2025</title>

  <!-- Tailwind & Alpine -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  
  <!-- Tambahkan ini jika kamu pakai Laravel Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    [x-cloak] { display: none !important; }
    :root {
      --color-utama: #0a3763;
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            utama: 'var(--color-utama)',
          }
        }
      }
    }
  </script>
</head>
<body class="font-montserrat bg-gray-100 text-gray-900 flex flex-col min-h-screen">

<nav class="bg-utama text-white shadow sticky top-0 z-50" x-data>
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between relative">

    <!-- Hamburger -->
    <button
      @click="openHamburger = !openHamburger"
      class="md:hidden text-white hover:text-yellow-500 focus:outline-none z-30"
      aria-label="Toggle menu"
    >
      <svg x-show="!openHamburger" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <svg x-show="openHamburger" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>


    <!-- Logo -->

  
    <a href="/" class="flex items-center gap-2 font-semibold text-white text-xl md:text-2xl select-none mx-auto md:mx-0">
      <img src="{{ asset('images/Logo-HIMSI-Color.png') }}" alt="Logo HIMSI" class="w-10 h-10 md:w-12 md:h-12 object-contain" />
      <span>HIMSI 2025-2026</span>
    </a>


    <!-- Spacer -->
    <div class="w-8 md:hidden"></div>

    <!-- Desktop menu -->
    <ul class="hidden md:flex space-x-10 font-semibold text-lg items-center select-none">
      <li><a href="{{ url('/') }}" class="hover:text-yellow-500 transition duration-300">Home</a></li>

      <!-- Tentang Kami with submenu -->
      <li x-data="{ open: false }" class="relative">
        <button
          @click="open = !open"
          @keydown.escape="open = false"
          type="button"
          class="flex items-center space-x-1 hover:text-yellow-500 focus:outline-none"
          aria-haspopup="true"
          :aria-expanded="open.toString()"
        >
          Tentang Kami
          <svg
            :class="open ? 'rotate-180' : ''"
            class="w-4 h-4 transition-transform duration-300"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>

        <ul
          x-show="open"
          x-transition
          @click.outside="open = false"
          class="absolute left-0 mt-2 w-40 bg-utama rounded shadow-lg text-yellow-300 font-normal"
          style="display: none;"
        >
          <li><a href="{{ url('/kabinet') }}" class="block px-4 py-2 hover:bg-yellow-500 hover:text-utama transition">Kabinet</a></li>
          <li><a href="{{ url('/gallery') }}" class="block px-4 py-2 hover:bg-yellow-500 hover:text-utama transition">Galeri</a></li>
        </ul>
      </li>

      <li><a href="{{ url('/visi-misi') }}" class="hover:text-yellow-500 transition duration-300">Visi & Misi</a></li>
      <li><a href="{{ url('/proker') }}" class="hover:text-yellow-500 transition duration-300">Proker</a></li>
    </ul>
  </div>

  <!-- Mobile menu bawah HIMSI 2025 -->
  <div class="md:hidden bg-utama px-6 pb-2 pt-0 flex justify-center space-x-6 border-b border-white/30 text-sm font-semibold select-none">
    <a href="{{ url('/') }}" class="hover:text-yellow-500 transition">Home</a>
    <a href="{{ url('/kabinet') }}" class="hover:text-yellow-500 transition">Kabinet</a>
    <a href="{{ url('/gallery') }}" class="hover:text-yellow-500 transition">Galeri</a>
    <a href="{{ url('/visi-misi') }}" class="hover:text-yellow-500 transition">Visi & Misi</a>
    <a href="{{ url('/proker') }}" class="hover:text-yellow-500 transition">Proker</a>
  </div>

  <!-- Mobile menu dropdown dengan blur dan background biru transparan -->
  <div
    class="md:hidden relative text-white backdrop-blur-md border border-white/20 bg-utama/30 z-50"
    x-show="openHamburger"
    x-transition
    @click.outside="openHamburger = false"
    style="display: none;"
  >
    <ul class="px-6 py-6 space-y-1 font-semibold">
      
      <!-- Home -->
      <li>
        <a href="{{ url('/') }}" class="block py-3 hover:text-yellow-500 transition">Home</a>
      </li>

      <!-- Kabinet with submenu -->
      <li x-data="{ openSubmenuKabinet: false }" class="relative select-none">
        <button
          @click="openSubmenuKabinet = !openSubmenuKabinet"
          class="w-full flex justify-between items-center py-3 hover:text-yellow-500 transition focus:outline-none"
          aria-haspopup="true"
          :aria-expanded="openSubmenuKabinet.toString()"
        >
          Tentang Kami
          <svg
            :class="openSubmenuKabinet ? 'rotate-180' : ''"
            class="w-4 h-4 transition-transform duration-300"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>

        <ul
          x-show="openSubmenuKabinet"
          x-transition
          @click.outside="openSubmenuKabinet = false"
          class="pl-6 mt-1 space-y-1 text-yellow-300 font-normal"
          style="display: none;"
        >
          <li><a href="{{ url('/kabinet') }}" class="block py-2 hover:text-yellow-400 transition">Kabinet</a></li>
          <li><a href="{{ url('/gallery') }}" class="block py-2 hover:text-yellow-400 transition">Galeri</a></li>
        </ul>
      </li>

      <!-- Visi & Misi -->
      <li>
        <a href="{{ url('/visi-misi') }}" class="block py-3 hover:text-yellow-500 transition">Visi & Misi</a>
      </li>

      <!-- Proker -->
      <li>
        <a href="{{ url('/proker') }}" class="block py-3 hover:text-yellow-500 transition">Proker</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Spacer -->
<div class="h-8"></div>

<!-- Main Content -->
<main class="max-w-5xl mx-auto px-6 py-10 rounded-lg flex-grow">
  @yield('content')
</main>

<!-- Scroll to Top Button -->
<button
  x-data="{ show: false }"
  x-init="window.addEventListener('scroll', () => show = window.scrollY > 300)"
  x-show="show"
  @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
  class="fixed bottom-6 right-6 bg-yellow-400 text-white p-4 rounded-full shadow-xl hover:bg-blue-600 transition z-50"
  aria-label="Scroll to top"
>
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
  </svg>
</button>


<!-- Footer Bawah -->
<footer class="bg-utama text-white text-sm text-center py-6 mt-12">
  <p>&copy; 2025 Darren & Adit. All rights reserved.</p>
</footer>

</body>
</html>
