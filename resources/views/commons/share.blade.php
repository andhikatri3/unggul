@php defined('BASEPATH') || exit('No direct script access allowed'); @endphp

<div class="flex flex-wrap gap-2" style="clear:both;">
    <a href="http://www.facebook.com/sharer.php?u={{ $link }}" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel="noopener noreferrer" target="_blank" title="Facebook"
       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-colors no-underline">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="http://twitter.com/share?text={{ $judul }}%0A&url={{ $link }}" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel="noopener noreferrer" target="_blank" title="Twitter"
       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-sky-500 hover:bg-sky-600 text-white transition-colors no-underline">
        <i class="fab fa-twitter"></i>
    </a>
    <a href="https://telegram.me/share/url?url={{ $link }}&text={{ $judul }}%0A" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel="noopener noreferrer" target="_blank" title="Telegram"
       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-400 hover:bg-blue-500 text-white transition-colors no-underline">
        <i class="fab fa-telegram-plane"></i>
    </a>
    <a href="https://api.whatsapp.com/send?text={{ $judul }}%0A{{ $link }}" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel="noopener noreferrer" target="_blank" title="WhatsApp"
       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-green-500 hover:bg-green-600 text-white transition-colors no-underline">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="mailto:?subject={{ $judul }}&body={{ potong_teks($single_artikel['isi'], 1000) }} ... Selengkapnya di {{ $link }}" title="Email"
       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white transition-colors no-underline">
        <i class="fas fa-envelope"></i>
    </a>
    <a href="#" onclick="printDiv('printableArea'); return false;" title="Cetak"
       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white transition-colors no-underline">
        <i class="fas fa-print"></i>
    </a>
</div>
