@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="bg-gray-900 border-t border-gray-700">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400 mb-4 md:mb-0">
                &copy; {{ date('Y') }} {{ ucwords(setting('sebutan_desa') . ' ' . $desa['nama_desa']) }}. Semua hak cipta dilindungi.
            </p>
            <div class="flex items-center space-x-4 text-sm text-gray-400">
                @if (file_exists('mitra'))
                    Hosting didukung <a href="https://my.idcloudhost.com/aff.php?aff=3172" rel="noopener noreferrer" target="_blank" class="hover:text-primary transition-colors">
                        IDCloudHost</a>
                    <span>|</span>
                @endif
                <a href="https://opendesa.id/" rel="noopener noreferrer" target="_blank" class="hover:text-primary transition-colors">OpenDesa</a>
                <span>|</span>
                <a href="https://github.com/OpenSID/OpenSID" rel="noopener noreferrer" target="_blank" class="hover:text-primary transition-colors">OpenSID {{ AmbilVersi() }}</a>
                <span>|</span>
                <a href="{{ site_url('siteman') }}" rel="noopener noreferrer" target="_blank" class="hover:text-primary transition-colors">Unggul {{ THEME_VERSION }}</a>
            </div>
        </div>
    </div>
</div>
