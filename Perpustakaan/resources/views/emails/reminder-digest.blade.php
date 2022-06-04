@component('mail::message')
# Jangan lupa untuk mengembalikan buku
@foreach($reminders as $reminder)
halo {{ $reminder->user->name }} !
Berikut adalah daftar buku yang harus anda kembalikan:
@component('mail::table')

|judul_buku|tanggal peminjaman|tanggal pengembalian|
|:---------|:-----------------|:-------------------|
|{{ $reminder->book->judul}}|{{ $reminder->tanggal_peminjaman }}|{{ $reminder->tanggal_kembali }}|
@endforeach
@endcomponent

Jangan sampai telat ya!<br>
@endcomponent
