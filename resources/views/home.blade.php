@extends('layouts.app')

@section('content')



<!-- Judul dengan efek ketik otomatis -->
<h1
  class="text-4xl font-bold text-utama mb-12 text-center
         md:whitespace-nowrap md:overflow-hidden"
  x-data="{
    texts: ['Kandidat Ketua Umum & Wakil', 'HIMSI UMDP Periode 2025/2026'],
    displayText: '',
    indexText: 0,
    indexChar: 0,
    forward: true,
    delayAfterComplete: 3000,
    startTyping() {
      const typeInterval = 120;
      const delay = this.delayAfterComplete;
      const loop = () => {
        const text = this.texts[this.indexText];
        if (this.forward) {
          if (this.indexChar < text.length) {
            this.displayText += text[this.indexChar];
            this.indexChar++;
            setTimeout(loop, typeInterval);
          } else {
            setTimeout(() => {
              this.forward = false;
              loop();
            }, delay);
          }
        } else {
          if (this.indexChar > 0) {
            this.displayText = this.displayText.slice(0, -1);
            this.indexChar--;
            setTimeout(loop, typeInterval / 2);
          } else {
            this.forward = true;
            this.indexText = (this.indexText + 1) % this.texts.length;
            setTimeout(loop, typeInterval);
          }
        }
      };
      loop();
    }
  }"
  x-init="startTyping()"
  x-text="displayText"
></h1>

<div
  x-data="{
    hoverKetua: false,
    hoverWakil: false,
    toggleHover(target) {
      if (target === 'ketua') {
        this.hoverKetua = !this.hoverKetua;
        this.hoverWakil = false;
      } else if (target === 'wakil') {
        this.hoverWakil = !this.hoverWakil;
        this.hoverKetua = false;
      }
    },
    resetHover() {
      this.hoverKetua = false;
      this.hoverWakil = false;
    },
    typewriter(text) {
      return {
        fullText: text,
        displayText: '',
        currentIndex: 0,
        visible: false,
        init() {
          this.visible = true;
          this.type();
        },
        type() {
          if (this.currentIndex < this.fullText.length) {
            this.displayText += this.fullText[this.currentIndex++];
            setTimeout(() => this.type(), 30);
          }
        }
      }
    }
  }"
  @click.outside="resetHover"
  class="flex flex-col md:flex-row items-start justify-center gap-y-1 md:gap-y-0 md:gap-x-10 max-w-4xl mx-auto px-4 relative pt-24 md:pt-0"
>

  <!-- Nomor Urut Tengah -->
  <div class="absolute left-1/2 -translate-x-1/2 -top-2 md:top-0 text-7xl font-extrabold text-utama select-none pointer-events-none z-10">
    03
  </div>

  <!-- Ketua -->
  <div
    @mouseenter="hoverKetua = true"
    @mouseleave="hoverKetua = false"
    @click="toggleHover('ketua')"
    class="group cursor-pointer w-[180px] relative z-20 transition-all duration-300 ease-in-out mx-auto md:mx-0 md:mr-0 p-2"
    :class="hoverWakil ? 'opacity-60 scale-95 blur-sm' : (hoverKetua ? 'scale-105 z-30 blur-none' : 'scale-100')"
    x-data="{ isPlaying: false }"
  >
    <!-- Sambutan Ketua Desktop -->
    <div
      x-show="hoverKetua"
      x-transition.opacity.duration.300ms
      class="hidden md:block bg-white text-gray-800 p-4 rounded-lg shadow-lg text-sm md:text-base max-w-[280px] absolute left-[-320px] top-1/2 -translate-y-1/2"
      style="backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);"
    >
      <h4 class="font-semibold text-lg mb-2">Kata Sambutan Calon Ketua</h4>
      <div x-data="typewriter('Halo teman-teman SI! Saya Darren Lowell, siap membawa Kabinet Inertia Bhaskara — Integritas, Aksi, dan Energi Nyata. Bersama, kita wujudkan HIMSI yang aktif, inklusif, dan progresif sebagai ruang tumbuh bagi seluruh potensi mahasiswa SI.')" x-init="init()">
        <p x-show="visible" x-text="displayText" class="leading-relaxed"></p>
      </div>
    </div>

    <!-- Gambar Ketua -->
    <div class="relative w-[180px] mx-auto md:mx-0" style="height: 380px;">
      <img
        src="{{ asset('images/photo-darren.png') }}"
        alt="Ketua Umum"
        class="w-[180px] h-full object-cover rounded-2xl transition-transform duration-500 group-hover:scale-110"
      />

      <!-- Tombol Audio Ketua di pojok kanan bawah dalam gambar -->
      <button
        @click.prevent="
          if ($refs.audio.paused) {
            $refs.audio.play();
            isPlaying = true;
          } else {
            $refs.audio.pause();
            isPlaying = false;
          }
        "
        :class="isPlaying ? 'text-emas bg-white shadow-lg' : 'text-gray-600 bg-white shadow'"
        class="absolute bottom-3 right-3 rounded-full p-2 cursor-pointer hover:bg-emas hover:text-white transition-colors duration-300"
        aria-label="Play/Pause Audio Ketua"
      >
        <template x-if="!isPlaying">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.518-3.752v7.484l6.518-3.732z" />
          </svg>
        </template>
        <template x-if="isPlaying">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" stroke="none">
            <rect x="6" y="5" width="4" height="14"></rect>
            <rect x="14" y="5" width="4" height="14"></rect>
          </svg>
        </template>
      </button>

      <!-- Sambutan Ketua Mobile -->
      <div
        x-show="hoverKetua"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="md:hidden absolute -bottom-[130px] left-1/2 -translate-x-1/2 w-[90vw] max-w-sm z-30 rounded-xl p-4 text-sm text-gray-900 pointer-events-none"
        style="background: rgba(255, 255, 255, 0.25); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);"
      >
        <h4 class="font-semibold mb-1">Kata Sambutan Calon Ketua</h4>
        <div x-data="typewriter('Halo teman-teman SI! Saya Darren Lowell, siap membawa Kabinet Inertia Bhaskara — Integritas, Aksi, dan Energi Nyata. Bersama, kita wujudkan HIMSI yang aktif, inklusif, dan progresif sebagai ruang tumbuh bagi seluruh potensi mahasiswa SI.')" x-init="init()">
          <p x-show="visible" x-text="displayText" class="leading-relaxed"></p>
        </div>
        <div class="absolute top-full left-1/2 -translate-x-1/2 w-4 h-4 bg-white/30 backdrop-blur-sm rotate-45"></div>
      </div>
    </div>



    <h3 class="mt-4 md:mt-5 text-utama font-bold text-2xl tracking-wide group-hover:text-emas transition-colors duration-300 text-center whitespace-nowrap">
      Darren Lowell
    </h3>

    <p
        x-data="{ showAlt: false }"
        @mouseenter="showAlt = true"
        @mouseleave="showAlt = false"
        class="text-center text-gray-600 mt-2 transition-all duration-500"
    >
        <template x-if="!showAlt">
            <span x-transition.opacity.duration.300 class="block">
                Calon Ketua Umum
            </span>
        </template>

        <template x-if="showAlt">
            <span x-transition.opacity.duration.300 class="block">
                Pemimpin hebat tak hanya buat program, tapi ciptakan ruang untuk semua bersinar.
            </span>
        </template>
    </p>

    <!-- Tombol Audio Ketua -->
    <audio x-ref="audio" src="{{ asset('audio/Kami Belum Tentu.mp3') }}" preload="auto" @ended="isPlaying = false"></audio>

  </div>

  <!-- Wakil -->
  <div
    @mouseenter="hoverWakil = true"
    @mouseleave="hoverWakil = false"
    @click="toggleHover('wakil')"
    class="group cursor-pointer w-[180px] relative z-20 transition-all duration-300 ease-in-out mx-auto md:mx-0 md:ml-0 p-2"
    :class="hoverKetua ? 'opacity-60 scale-95 blur-sm' : (hoverWakil ? 'scale-105 z-30 blur-none' : 'scale-100')"
    x-data="{ isPlaying: false }"
  >
    <!-- Sambutan Wakil Desktop -->
    <div
      x-show="hoverWakil"
      x-transition.opacity.duration.300ms
      class="hidden md:block bg-white text-gray-800 p-4 rounded-lg shadow-lg text-sm md:text-base max-w-[280px] absolute right-[-320px] top-1/2 -translate-y-1/2"
      style="backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);"
    >
      <h4 class="font-semibold text-lg mb-2">Kata Sambutan Calon Wakil</h4>
      <div x-data="typewriter('Halo teman-teman Sistem Informasi, Saya Adit Jansa. Dengan semangat baru, saya menyambut HIMSI yang lebih kolaboratif, aktif dan kreatif di media sosial, dan siap menghadirkan inovasi-inovasi segar. Kabinet Inertia Bhaskara kami hadir dengan semangat kekompakan, kesediaan untuk mendengarkan, dan komitmen membangun HIMSI sebagai wadah yang mendorong kita semua untuk berani mengambil setiap peluang belajar yang ada.')" x-init="init()">
        <p x-show="visible" x-text="displayText" class="leading-relaxed"></p>
      </div>
    </div>

    <!-- Gambar Wakil -->
    <div class="relative w-[180px] mx-auto md:mx-0" style="height: 380px;">
      <img
        src="{{ asset('images/photo-adit.png') }}"
        alt="Wakil Ketua"
        class="w-[180px] h-full object-cover rounded-2xl transition-transform duration-500 group-hover:scale-110"
      />

      
    <!-- Tombol Audio Wakil di pojok kanan bawah dalam gambar -->
    <button
      @click.prevent="
        if ($refs.audioWakil.paused) {
          $refs.audioWakil.play();
          isPlaying = true;
        } else {
          $refs.audioWakil.pause();
          isPlaying = false;
        }
      "
      :class="isPlaying ? 'text-emas bg-white shadow-lg' : 'text-gray-600 bg-white shadow'"
      class="absolute bottom-3 right-3 rounded-full p-2 cursor-pointer hover:bg-emas hover:text-white transition-colors duration-300"
      aria-label="Play/Pause Audio Wakil"
    >
      <template x-if="!isPlaying">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.518-3.752v7.484l6.518-3.732z" />
        </svg>
      </template>
      <template x-if="isPlaying">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" stroke="none">
          <rect x="6" y="5" width="4" height="14"></rect>
          <rect x="14" y="5" width="4" height="14"></rect>
        </svg>
      </template>
    </button>

      <!-- Sambutan Wakil Mobile -->
      <div
        x-show="hoverWakil"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="md:hidden absolute -bottom-[130px] left-1/2 -translate-x-1/2 w-[90vw] max-w-sm z-30 rounded-xl p-4 text-sm text-gray-900 pointer-events-none"
        style="background: rgba(255, 255, 255, 0.25); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);"
      >
        <h4 class="font-semibold mb-1">Kata Sambutan Calon Wakil</h4>
        <div x-data="typewriter('Halo teman-teman Sistem Informasi, Saya Adit Jansa. Dengan semangat baru, saya menyambut HIMSI yang lebih kolaboratif, aktif dan kreatif di media sosial, dan siap menghadirkan inovasi-inovasi segar. Kabinet Inertia Bhaskara kami hadir dengan semangat kekompakan, kesediaan untuk mendengarkan, dan komitmen membangun HIMSI sebagai wadah yang mendorong kita semua untuk berani mengambil setiap peluang belajar yang ada.')" x-init="init()">
          <p x-show="visible" x-text="displayText" class="leading-relaxed"></p>
        </div>
        <div class="absolute top-full left-1/2 -translate-x-1/2 w-4 h-4 bg-white/30 backdrop-blur-sm rotate-45"></div>
      </div>
    </div>



    <h3 class="mt-4 md:mt-5 text-utama font-bold text-2xl tracking-wide group-hover:text-emas transition-colors duration-300 text-center">
      Adit Jansa
    </h3>
    <p
        x-data="{ showAlt: false }"
        @mouseenter="showAlt = true"
        @mouseleave="showAlt = false"
        class="text-center text-gray-600 mt-2 transition-all duration-500"
    >
        <template x-if="!showAlt">
            <span x-transition.opacity.duration.300 class="block">
                Calon Wakil Ketua
            </span>
        </template>

        <template x-if="showAlt">
            <span x-transition.opacity.duration.300 class="block">
                Mendengarkan adalah fondasi dari organisasi yang kuat.
            </span>
        </template>
    </p>



    <audio x-ref="audioWakil" src="{{ asset('audio/Basket Case.mp3') }}" preload="auto" @ended="isPlaying = false"></audio> 
  </div>

</div>

<!-- // -->

<!-- Tambahan Jarak Khusus Mobile -->
<div class="block md:hidden h-12"></div>
<!-- Spacer hanya di desktop -->
<div class="hidden md:block h-14"></div>


<div class="flex justify-center items-center mb-6 md:mb-10">
  <img 
    src="{{ asset('images/Logo-HIMSI-Color.png') }}" 
    alt="Logo HIMSI" 
    class="w-24 md:w-32 h-auto"
  />
</div>

<!-- Spacer hanya di desktop -->
<div class="hidden md:block h-2"></div>

<div class="flex justify-center items-center mb-6 md:mb-10">
  <img 
    src="{{ asset('images/kabinet.png') }}" 
    alt="Logo HIMSI" 
    class="w-24 md:w-32 h-auto"
  />
</div>


<!-- Video Perkenalan Kandidat -->
<!-- <div class="max-w-4xl mx-auto mt-12 mb-10 md:mb-16 px-4">
  <h2 class="text-2xl font-bold mb-4 text-utama text-center">Video Perkenalan Kandidat</h2>
  <div 
    class="relative rounded-xl overflow-hidden shadow-lg aspect-w-16 aspect-h-9 min-h-[200px] md:min-h-[400px]"
  >
    <iframe
      src="https://www.youtube.com/embed/FnSsEIfUgqE"
      title="Video Perkenalan Kandidat"
      allowfullscreen
      class="absolute top-0 left-0 w-full h-full"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    ></iframe>
  </div>
</div> -->





<!-- Tambahan Jarak Khusus Mobile -->
<!-- <div class="block md:hidden h-16"></div> -->

<!-- PPT Perkenalan -->

<div class="max-w-4xl mx-auto mt-16 px-4">
  <h2 class="text-2xl font-bold mb-4 text-utama text-center">Preview PDF Pencalonan</h2>

  <!-- Iframe hanya tampil di desktop -->
  <div class="hidden md:block relative rounded-xl overflow-hidden shadow-lg aspect-w-16 aspect-h-9 min-h-[250px] md:min-h-[500px]">
    <iframe 
      src="{{ asset('images/Inertia.pdf') }}" 
      class="absolute top-0 left-0 w-full h-full border rounded-xl"
    ></iframe>
  </div>


  <!-- Untuk Mobile: link fallback -->
  <div class="block md:hidden text-center mt-6">
    <p class="text-gray-600 mb-2">PDF tidak bisa ditampilkan di perangkat Anda.</p>
    <a 
      href="{{ asset('images/Inertia.pdf') }}" 
      target="_blank"
      class="text-utama underline font-semibold"
    >
      📄 Ketuk di sini untuk melihat PDF di tab baru
    </a>
  </div>


  <div class="text-center mt-6">
    <a 
      href="{{ asset('images/Inertia.pdf') }}" 
      download 
      class="inline-block bg-utama text-white font-semibold px-6 py-3 rounded-xl shadow-md hover:bg-utama/90 transition-colors"
    >
      📄 Unduh PPT Pencalonan
    </a>
  </div>
</div>



<section class="max-w-xl mx-auto px-4 sm:px-6 mt-20 mb-20" x-data="testimonialPagination()" x-init="startAutoScroll()">
  <h2 class="text-3xl font-semibold text-utama mb-10 text-center">Apa Kata Mereka?</h2>

  <div class="flex items-center justify-center gap-4 sm:gap-6">
    <!-- Tombol Prev -->
    <button
      @click="prevPageManual()"
      class="p-2 sm:p-3 rounded-full bg-white border border-gray-300 shadow-md hover:bg-white/80 transition duration-300"
      :class="{'opacity-50 cursor-not-allowed': currentPage === 1}"
      :disabled="currentPage === 1"
      aria-label="Previous Page"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-utama" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <!-- Testimoni Card -->
    <template x-for="item in pagedTestimonials" :key="item.id">
      <div
        class="bg-white rounded-xl shadow-md p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300 cursor-pointer w-full max-w-md sm:max-w-xl"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-x-10"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-10"
      >
        <div class="flex items-center space-x-3 sm:space-x-4 mb-3 sm:mb-4">
          <!-- Jika ada photoUrl, tampilkan gambar, kalau tidak tampilkan placeholder inisial -->
          <template x-if="item.photo && item.photo.startsWith('http') || item.photo && item.photo.includes('.')">
            <img :src="item.photo" alt="Foto Mahasiswa" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover border-2 border-emas" />
          </template>
          <template x-if="!item.photo || !(item.photo.startsWith('http') || item.photo.includes('.'))">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-emas bg-utama text-white flex items-center justify-center font-bold text-lg sm:text-xl select-none" x-text="item.initials"></div>
          </template>

          <div>
            <p class="font-semibold text-utama text-sm sm:text-base" x-text="item.name"></p>
            <p class="text-gray-500 text-xs sm:text-sm" x-text="item.role"></p>
          </div>
        </div>
        <p class="text-gray-700 text-xs sm:text-sm italic leading-relaxed" x-text="item.message"></p>
      </div>
    </template>

    <!-- Tombol Next -->
    <button
      @click="nextPageManual()"
      class="p-2 sm:p-3 rounded-full bg-white border border-gray-300 shadow-md hover:bg-white/80 transition duration-300"
      :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages}"
      :disabled="currentPage === totalPages"
      aria-label="Next Page"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-utama" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>

  <!-- Pagination Dots -->
  <div class="flex justify-center mt-8 space-x-2">
    <template x-for="page in totalPages" :key="page">
      <button
        @click="goToPageManual(page)"
        class="w-3 h-3 rounded-full"
        :class="page === currentPage ? 'bg-utama' : 'bg-gray-300 hover:bg-utama/70 transition-colors'"
        :aria-label="'Go to page ' + page"
      ></button>
    </template>
  </div>
</section>

<script>
  function testimonialPagination() {
    // Data diacak dan inisial di-generate otomatis
    const rawTestimonials = [
      { 
        id: 1, 
        name: "Tri Ayu Miranda", 
        role: "Komandan Pasukan The Great MB 2024", 
        photo: "images/ate.jpg", // placeholder inisial
        message: "Kandidat ini orangnya ramah, mudah diajak diskusi, dan punya ide-ide bagus buat HIMSI ke depannya. Saya yakin mereka berdua bisa jadi pemimpin yang membawa perubahan yang baik. Ayo kita dukung sama-sama." 
      },
      { 
        id: 2, 
        name: "Georgerius Alesandro C", 
        role: "Wakil Ketua Umum Kosma 2024", 
        photo: "images/geri.jpg", // placeholder inisial
        message: "Semangat memberikan perubahan, dan dorong kemajuan menjadi kenyataan demi HIMSI lebih baik." 
      },
      { 
        id: 3, 
        name: "M. Zaky Naufal Farisky", 
        role: "Wakil Ketua Umum LDK", 
        photo: "", // placeholder inisial akan dibuat
        message: "Saya melihat potensi yang besar pada pasangan ini, ambisi yang kuat untuk membawa Himsi to the next level." 
      },
      { 
        id: 4, 
        name: "Reza Ramadani", 
        role: "Ketua Himpunan Fisika PGRI 2023", 
        photo: "images/reza.jpg", // placeholder inisial akan dibuat
        message: "Jiwa Integritas dan loyalitas tinggi adalah sifat yang harus dimiliki oleh pemimpin, dan saya melihat itu pada paslon 03 ini." 
      },
      { 
        id: 5, 
        name: "Kristian Fernando", 
        role: "Ketua UKM BASKET UMDP", 
        photo: "", // placeholder inisial akan dibuat
        message: "Pada kandidat ini terlihat jiwa wibawah yang dapat memimpin sebuah organisasi dengan menyatukan sosial antara anggota menjadi satu, dan dapat memajukan himpunan menjadi lebih baik." 
      },
      { 
        id: 6, 
        name: "Andhika Rizky Cahya P", 
        role: "KETUA UMUM HIMIF", 
        photo: "", // placeholder inisial akan dibuat
        message: "Menurut saya, paslon ini memiliki ide dan misi yang visioner untuk masa depan himsi. Paslon ini melakukan gebrakan dgn mengadakan proker inovatif BUKAN TEMPLATE BELAKA #MudaKreatifBerwawasanGlobal."
      },
      { 
        id: 7, 
        name: "Ovan Kurniawan", 
        role: "Mahasiswa SI 2022", 
        photo: "", // placeholder inisial akan dibuat
        message: "Menurut saya kandidat ini sangat komunikatif, terbuka, dan mempunyai visi dan misi yang jelas akan memberikan manfaat kepada mahasiswa SI." 
      },
      { 
        id: 8, 
        name: "Putri Aprillia", 
        role: "Ketua Umum HIMAKSI", 
        photo: "", // placeholder inisial akan dibuat
        message: "Kepemimpinan bukan hanya soal popularitas, tapi soal konsistensi, kejujuran, dan komitmen. Darren Lowell Dan Adit Jansa sudah menunjukkan semua itu dalam setiap langkahnya. bekerja tanpa banyak sorotan, dan selalu mengedepankan kepentingan bersama. Inilah saatnya kita memberi kepercayaan pada seseorang yang benar-benar layak." 
      },
      { 
        id: 9, 
        name: "Muhammad Ammar Kanz", 
        role: "Ketua Umum Himafisipal Unsri 2022-2023", 
        photo: "MAK", // placeholder inisial
        message: "HIMSI merupakan wadah sarana untuk mahasiswa jurusan SI menuangkan dan menyalurkan intelektual dan kreativitas mereka dan diperlukan calon pemimpin yg dapat mengakomodasi wadah tsb sesuai yg diharapkan, saya percaya calon kandidat ini memiliki kemampuan tsb." 
      },
      { id: 10, name: "Vicky S.", role: "Ketua Umum UKM Programming 2023-2024", photo: "", message: "Darren dan Adit merupakan sosok yang memiliki gabungan antara semangat yang membara, inisiatif yang tinggi, dan etos yang baik. Semoga karakter tersebut bisa menjadi landasan untuk membawa HIMSI terus maju." }

    ];

    // Fungsi buat ambil inisial dari nama
    function getInitials(name) {
      const parts = name.split(' ').filter(Boolean);
      if (parts.length === 1) return parts[0].charAt(0).toUpperCase();
      else return (parts[0].charAt(0) + parts[parts.length - 1].charAt(0)).toUpperCase();
    }

    // Tambah properti initials jika belum ada (foto placeholder)
    rawTestimonials.forEach(t => {
      if (!t.photo || !t.photo.includes('.')) {
        t.initials = getInitials(t.name);
      } else {
        t.initials = '';
      }
    });

    // Acak array (Fisher-Yates shuffle)
    for (let i = rawTestimonials.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [rawTestimonials[i], rawTestimonials[j]] = [rawTestimonials[j], rawTestimonials[i]];
    }

    return {
      currentPage: 1,
      perPage: 1,
      intervalId: null,
      testimonials: rawTestimonials,

      get totalPages() {
        return Math.ceil(this.testimonials.length / this.perPage);
      },

      get pagedTestimonials() {
        const start = (this.currentPage - 1) * this.perPage;
        return this.testimonials.slice(start, start + this.perPage);
      },

      nextPage() {
        this.currentPage = this.currentPage === this.totalPages ? 1 : this.currentPage + 1;
      },

      prevPage() {
        this.currentPage = this.currentPage === 1 ? this.totalPages : this.currentPage - 1;
      },

      goToPage(page) {
        this.currentPage = page;
      },

      nextPageManual() {
        this.nextPage();
        this.restartAutoScroll();
      },

      prevPageManual() {
        this.prevPage();
        this.restartAutoScroll();
      },

      goToPageManual(page) {
        this.goToPage(page);
        this.restartAutoScroll();
      },

      startAutoScroll() {
        this.intervalId = setInterval(() => {
          this.nextPage();
        }, 6000);
      },

      restartAutoScroll() {
        clearInterval(this.intervalId);
        this.startAutoScroll();
      },

      destroy() {
        clearInterval(this.intervalId);
      }
    }
  }
</script>








<!-- https://youtu.be/FnSsEIfUgqE?si=d4bR9GEv2rmy_5U5 -->

@endsection
