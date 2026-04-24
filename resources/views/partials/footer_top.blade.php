@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

@if (!is_null($transparansi))
    @include('theme::partials.apbdesa-tema', $transparansi)
@endif

<!-- Sunset Decoration (Desktop only) -->
<section class="relative overflow-hidden hidden md:block">
    <div class="h-20 md:h-32 w-full" style="background: linear-gradient(180deg, #fde68a 0%, #f59e0b 45%, #7c3aed 100%);"></div>
    <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1200 90" preserveAspectRatio="none">
        <path d="M0,40 C200,90 400,0 600,40 C800,80 1000,20 1200,60 L1200,90 L0,90 Z" fill="#1f2937"/>
    </svg>
</section>

<!-- Footer (Desktop only) -->
<footer class="bg-gray-800 text-white hidden md:block">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ gambar_desa($desa['logo']) }}" alt="Logo" class="w-16 h-16 object-contain">
                    <div>
                        <h3 class="font-bold text-lg">{{ ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) }}</h3>
                        <p class="text-sm text-gray-300">{{ ucwords(setting('sebutan_kecamatan_singkat') . ' ' . $desa['nama_kecamatan']) }}</p>
                        <p class="text-sm text-gray-300">{{ ucwords(setting('sebutan_kabupaten_singkat') . ' ' . $desa['nama_kabupaten']) }}</p>
                    </div>
                </div>
                <p class="text-gray-300 text-sm mb-4">
                    {{ $desa['alamat_kantor'] }}<br>
                    {{ ucwords(setting('sebutan_kecamatan') . ' ' . $desa['nama_kecamatan']) }}, {{ ucwords(setting('sebutan_kabupaten') . ' ' . $desa['nama_kabupaten']) }}<br>
                    Provinsi {{ $desa['nama_propinsi'] }} Kode Pos {{ $desa['kode_pos'] }}
                </p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($sosmed as $data)
                        @if (!empty($data['link']))
                            @php
                                $namaLower = strtolower($data['nama']);
                                $iconMap = [
                                    'facebook' => 'fab fa-facebook', 'twitter' => 'fab fa-twitter', 'x' => 'fab fa-x-twitter',
                                    'instagram' => 'fab fa-instagram', 'youtube' => 'fab fa-youtube', 'whatsapp' => 'fab fa-whatsapp',
                                    'telegram' => 'fab fa-telegram-plane', 'tiktok' => 'fab fa-tiktok', 'linkedin' => 'fab fa-linkedin-in',
                                ];
                                $faIcon = $iconMap[$namaLower] ?? 'fab fa-' . $namaLower;
                            @endphp
                            <a href="{{ $data['link'] }}" title="{{ $data['nama'] }}" rel="noopener noreferrer" target="_blank"
                               class="w-10 h-10 rounded-full bg-gray-700 hover:bg-primary flex items-center justify-center transition-colors">
                                <i class="{{ $faIcon }} text-lg text-white"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <h4 class="font-bold text-lg mb-4">Kategori</h4>
                <ul class="space-y-2">
                    @foreach ($menu_kiri as $data)
                    <li><a href="{{ site_url('artikel/kategori/' . $data['slug']) }}" class="text-gray-300 hover:text-primary transition-colors text-sm no-underline">{{ $data['kategori'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="font-bold text-lg mb-4">Kontak Kami</h4>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-primary mt-1"></i>
                        <p class="text-sm text-gray-300">
                            {{ $desa['alamat_kantor'] }}<br>
                            Provinsi {{ $desa['nama_propinsi'] }} Kode Pos {{ $desa['kode_pos'] }}
                        </p>
                    </div>
                    @if (!empty($desa['telepon']))
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-primary"></i>
                        <span class="text-sm text-gray-300">{{ $desa['telepon'] }}</span>
                    </div>
                    @endif
                    @if (!empty($desa['email_desa']))
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-primary"></i>
                        <span class="text-sm text-gray-300">{{ $desa['email_desa'] }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Statistik Pengunjung -->
            <div>
                @if (setting('tte'))
                    <img src="{{ asset('assets/images/bsre.png?v', false) }}" alt="Bsre" class="mb-4" style="width: 185px;" />
                @endif
                <h4 class="font-bold text-lg mb-4">Statistik Pengunjung</h4>
                <div class="space-y-3">
                    @foreach ([
                        ['icon' => 'fa-eye',           'label' => 'Hari ini',       'value' => number_format($statistik_pengunjung['hari_ini'])],
                        ['icon' => 'fa-history',       'label' => 'Kemarin',        'value' => number_format($statistik_pengunjung['kemarin'])],
                        ['icon' => 'fa-users',         'label' => 'Total',          'value' => number_format($statistik_pengunjung['total'])],
                        ['icon' => 'fa-desktop',       'label' => 'Sistem Operasi', 'value' => $statistik_pengunjung['os']],
                        ['icon' => 'fa-network-wired', 'label' => 'IP Address',     'value' => $statistik_pengunjung['ip_address']],
                        ['icon' => 'fa-globe',         'label' => 'Browser',        'value' => $statistik_pengunjung['browser']],
                    ] as $row)
                    <div class="flex items-center space-x-3">
                        <i class="fas {{ $row['icon'] }} text-primary w-4 flex-shrink-0"></i>
                        <span class="text-sm text-gray-300">{{ $row['label'] }}: <span class="text-white font-medium">{{ $row['value'] }}</span></span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
