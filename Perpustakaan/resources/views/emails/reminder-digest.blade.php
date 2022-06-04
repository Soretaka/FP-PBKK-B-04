@component('mail::message')
# Jangan lupa untuk mengembalikan buku
@foreach($reminders as $reminder)
halo {{ $reminder->user->name }} !
Berikut adalah daftar buku yang harus anda kembalikan sebelum tanggal {{ date('d-m-Y',strtotime($reminder->must_return_date)) }}:
@component('mail::table')
|judul_buku|
|:---------:|
    @foreach($reminder->borrowDetails as $borrowDetails)
    |{{ $borrowDetails->book->judul}}
    @endforeach
@endforeach
@endcomponent

Jangan sampai telat ya!<br>
@endcomponent
