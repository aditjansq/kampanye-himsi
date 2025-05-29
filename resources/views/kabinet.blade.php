@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto px-4 py-12 text-center">
    <h1 id="title" class="text-4xl font-bold text-utama mb-6 opacity-0 transition-opacity duration-700">Inertia Bhaskara</h1>
    
    <!-- Gambar kabinet tanpa shadow -->
    <div id="image-container" class="mb-8 opacity-0 transition-opacity duration-700">
      <img src="{{ asset('images/kabinet.png') }}" alt="Ilustrasi Kabinet" class="mx-auto w-48 h-auto rounded-lg" />
    </div>
    
    <!-- Penjelasan kabinet dengan typewriter -->
    <p id="typewriter-text" class="text-gray-700 text-lg leading-relaxed max-w-3xl mx-auto text-justify min-h-[120px]"></p>
  </div>
<script>
  const text = `INERTIA:
Inspiring New Era Through Innovation & Academic Excellence
Definisi: Kabinet INERTIA adalah gerakan yang mendorong perubahan dinamis dengan tetap menjaga konsistensi kualitas. Seperti prinsip "inertia" dalam fisika yang menjaga gerak atau keadaan diam kecuali ada gaya luar, kabinet ini sebagai gaya pendorong yang membawa mahasiswa Sistem Informasi menuju gerakan baru: lebih aktif, inovatif, dan unggul dalam bidang akademik maupun non-akademik.

Bhaskara:
"Bhāskara" (भास्कर) berarti "matahari" atau "pemberi cahaya".

"Bhās" = bersinar / bercahaya
"Kara" = pelaku / pembuat`;

  const container = document.getElementById('typewriter-text');
  const title = document.getElementById('title');
  const imageContainer = document.getElementById('image-container');
  let index = 0;

  // Tampilkan judul dan gambar dengan fade in
  window.addEventListener('DOMContentLoaded', () => {
    title.classList.remove('opacity-0');
    imageContainer.classList.remove('opacity-0');
    typeWriter();
  });

  function typeWriter() {
    if (index < text.length) {
      const char = text.charAt(index);
      if (char === '\n') {
        container.innerHTML += '<br>';
      } else {
        container.innerHTML += char;
      }
      index++;
      setTimeout(typeWriter, 20); // lebih cepat: 20ms per karakter
    }
  }
</script>

@endsection
