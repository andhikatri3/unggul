@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<section class="py-16 bg-gray-50 min-h-[40vh] flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-xl shadow-md p-10 text-center">
                <div class="w-16 h-16 bg-yellow-50 border border-yellow-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-exclamation-triangle text-2xl text-yellow-400"></i>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Pemberitahuan</p>
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    {{ $judulPesan ?: 'Menu Belum Aktif' }}
                </h3>
                <p class="text-sm text-gray-500 leading-relaxed">
                    {!! $isiPesan ?: "Ikut panduan berikut untuk mengaktifkan Menu Dinamis.<br><a href='https://panduan.opendesa.id/opensid/halaman-administrasi/admin-web/menu' target='_blank' class='text-primary hover:underline font-medium'>Lihat Panduan &rarr;</a>" !!}
                </p>
            </div>
        </div>
    </div>
</section>
