@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<!-- Header (Desktop only) -->
<header class="bg-white shadow-lg hidden md:block">
    <!-- Top Header -->
    <div class="bg-primary text-white py-2">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
            <!-- Kiri: Telp, Email, Sosmed -->
            <div class="flex items-center space-x-3">
                @if (!empty($desa['telepon']))
                    <a href="tel:{{ $desa['telepon'] }}" class="flex items-center gap-1 hover:text-green-200 transition-colors no-underline">
                        <i class="fas fa-phone"></i>
                        <span class="hidden sm:inline">{{ $desa['telepon'] }}</span>
                    </a>
                @endif
                @if (!empty($desa['email_desa']))
                    <a href="mailto:{{ $desa['email_desa'] }}" class="flex items-center gap-1 hover:text-green-200 transition-colors no-underline">
                        <i class="fas fa-envelope"></i>
                        <span class="hidden sm:inline">{{ $desa['email_desa'] }}</span>
                    </a>
                @endif
                <span class="border-l border-white/40 h-4 mx-0.5"></span>
                <div class="flex items-center space-x-3">
                    @foreach ($sosmed as $data)
                        @if (!empty($data['link']))
                            @php
                                $namaLower = strtolower($data['nama']);
                                $iconMap = [
                                    'facebook' => 'fab fa-facebook-f',
                                    'twitter' => 'fab fa-twitter',
                                    'x' => 'fab fa-x-twitter',
                                    'instagram' => 'fab fa-instagram',
                                    'youtube' => 'fab fa-youtube',
                                    'whatsapp' => 'fab fa-whatsapp',
                                    'telegram' => 'fab fa-telegram-plane',
                                    'tiktok' => 'fab fa-tiktok',
                                    'linkedin' => 'fab fa-linkedin-in',
                                    'pinterest' => 'fab fa-pinterest',
                                    'github' => 'fab fa-github',
                                ];
                                $faIcon = $iconMap[$namaLower] ?? 'fab fa-' . $namaLower;
                            @endphp
                            <a href="{{ $data['link'] }}" title="{{ $data['nama'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-green-200 transition-colors">
                                <i class="{{ $faIcon }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Kanan: Jam -->
            <div class="flex items-center gap-1.5 font-mono text-xs">
                <i class="fas fa-clock flex-shrink-0"></i>
                <span id="digital-clock-date" class="hidden sm:inline"></span>
                <span id="digital-clock-time" class="font-bold"></span>
            </div>
        </div>
    </div>

    <!-- Running Text -->
    @if (!empty($teks_berjalan))
    <div class="bg-green-50 border-b border-green-100 py-1">
        <div class="container mx-auto px-4">
            <marquee onmouseover="this.stop()" onmouseout="this.start()" class="text-sm text-gray-700">
                @include('theme::layouts.teks_berjalan')
            </marquee>
        </div>
    </div>
    @endif

    <!-- Main Header -->
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ site_url() }}">
                    <img src="{{ gambar_desa($desa['logo']) }}" alt="{{ $desa['nama_desa'] }}" class="w-16 h-16 md:w-20 md:h-20 object-contain">
                </a>
                <div>
                    <a href="{{ site_url() }}" class="no-underline">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800">{{ strtoupper(setting('website_title') . ' ' . ucwords(setting('sebutan_desa')) . ($desa['nama_desa'] ? ' ' . $desa['nama_desa'] : '')) }}</h1>
                        <p class="text-sm md:text-base text-gray-600">{{ ucwords(setting('sebutan_kecamatan_singkat') . ' ' . $desa['nama_kecamatan']) }} {{ ucwords(setting('sebutan_kabupaten_singkat') . ' ' . $desa['nama_kabupaten']) }}</p>
                        <p class="text-xs md:text-sm text-primary font-semibold">Provinsi {{ $desa['nama_propinsi'] }}</p>
                    </a>
                </div>
            </div>

            <!-- Search (Desktop) -->
            <div class="hidden md:block">
                <form method="get" action="{{ site_url() }}" class="flex">
                    <input type="text" name="cari" maxlength="50" value="{{ html_escape($cari) }}" placeholder="Cari Artikel..." class="border border-gray-300 rounded-l-lg px-4 py-2 text-sm focus:outline-none focus:border-primary w-48">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r-lg hover:bg-primary-dark transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            {{-- Mobile menu button ada di sticky nav --}}
        </div>
    </div>
</header>
