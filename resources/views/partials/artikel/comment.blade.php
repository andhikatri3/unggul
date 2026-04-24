@if ($single_artikel['boleh_komentar'] == 1)
<div class="bg-white rounded-lg shadow-md p-6 mb-6" id="kolom-komentar">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Kirim Komentar</h3>

    @php
        $notif = session('notif');
        $label = isset($notif['status']) && $notif['status'] == -1 ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700';
    @endphp
    @if ($notif)
        <div class="rounded-lg p-3 mb-4 text-sm {{ $label }}">{{ $notif['pesan'] }}</div>
    @endif

    <form id="validasi" name="form" action="{{ ci_route("add_comment.{$single_artikel['id']}") }}" method="POST" onSubmit="return validasi(this);" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary required" type="text" name="owner" maxlength="50" placeholder="Ketik di sini" value="{{ $notif['data']['owner'] ?? '' }}">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. Hp</label>
            <input class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary number required" type="text" name="no_hp" maxlength="15" placeholder="Ketik di sini" value="{{ $notif['data']['no_hp'] ?? '' }}">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary email" type="text" name="email" maxlength="50" placeholder="email@gmail.com" value="{{ $notif['data']['email'] ?? '' }}">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan</label>
            <textarea class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary required" name="komentar" rows="4">{{ $notif['data']['komentar'] ?? '' }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Captcha</label>
            <div class="flex items-center space-x-3">
                <a href="#" class="inline-block">
                    <img id="captcha" src="{{ ci_route('captcha') }}" onclick="document.getElementById('captcha').src = '{{ ci_route('captcha') }}?' + Math.random();" alt="CAPTCHA Image" class="rounded border" />
                </a>
                <input type="text" name="captcha_code" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary required" maxlength="6" placeholder="Masukkan kode" />
            </div>
        </div>
        <div>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                <i class="fas fa-paper-plane mr-1"></i> Kirim Komentar
            </button>
        </div>
    </form>
</div>
@endif
