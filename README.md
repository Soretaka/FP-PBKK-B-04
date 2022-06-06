# FP-PBKK-B-04

## Localization and File Storage
### Localization
Diambil salah satu contoh yaitu pada bagian layout.

pertama tama kita buat file baru untuk menyimpan string terjemahan Inggris dan Indonesia
`resources/lang/en/layout.php` `resources/lang/id/layout.php`

```
<?php

// resources/lang/en/layout.php

return [
    'menu' => 'Main Menu',
    'select' => 'Select Menu',
    'settings' => 'Account Setting',
    'report' => 'Generate Report',
    'profile' => 'Profile',
    'setting'=> 'Settings',
    'activity_log'=>'Activity Log',
    'logout'=>'Logout',
    'ready_to_leave' => 'Ready to Leave?',
    'select_logout' => 'Select "Logout" below if you are ready to end your current session.',
    'logged' => 'You\'re logged in!',
    'cancel' => 'cancel',
    'category' => 'Book Category',
    'book' => 'Book Data',
    'member' => 'Member Data',
    'borrow' => 'Borrowing',
    'trend' => 'Trending Books'

];
```

```
resources/lang/id/layout.php

<?php

return [
    'menu' => 'Menu Utama',
    'select' => 'Pilih Menu',
    'settings' => 'Pengaturan Akun',
    'report' => 'Cetak Laporan',
    'profile' => 'Profil',
    'setting'=> 'Pengaturan',
    'activity_log'=>'Log Aktifitas',
    'logout'=>'Keluar',
    'ready_to_leave' => 'Siap untuk Meninggalkan?',
    'select_logout' => 'Pilih "Keluar" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.',
    'logged' => 'Anda masuk!',
    'cancel' => 'Batal',
    'category' => 'Kategori Buku',
    'book' => 'Data Buku',
    'member' => 'Data Anggota',
    'borrow' => 'Peminjaman',
    'trend' => 'Buku Teratas'
];

```
Pada view ubah menjadi
`{{__('layout.xxx')}}`
xxx diganti sesuai dengan keinginan

contoh pada `/layout/app.blade,php`

```
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ ($title === "Dashboard") ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard-index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Menu Utama-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu"
            aria-expanded="true" aria-controls="menu">
            <i class="fas fa-fw fa-folder"></i>
            <span>{{__('layout.menu')}}</span>
        </a>
        <div id="menu" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{__('layout.select')}}:</h6>
                <a class="collapse-item {{ ($title === "Category") ? 'active' : '' }}" href="{{ route('category.index') }}">{{__('layout.category')}}</a>
                <a class="collapse-item {{ ($title === "Book") ? 'active' : '' }}" href="{{ route('book.index') }}">{{__('layout.book')}}</a>
                <a class="collapse-item {{ ($title === "Member") ? 'active' : '' }}" href="{{ route('member.index') }}">{{__('layout.member')}}</a>
                <a class="collapse-item {{ ($title === "Borrow") ? 'active' : '' }}" href="{{ route('borrow.index') }}">{{__('layout.borrow')}}</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pengaturan Akun -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.profile', auth()->user()->id) }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{__('layout.settings')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
```

Kemudian untuk route dibuat seperti ini
```
    Route::get('/form/{locale}', 'App\Http\Controllers\LocalizationController@index');

```

`Localization Controller.php`

```
    public function index($locale){
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

```

pada middleware di `middleware/Localization.php` tambahkan kode berikut

```
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setlocale(session()->get('locale'));
        }
        return $next($request);
    }

```
dan tambahkan middleware ke `kernel.php`

```
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\Localization::class,
        ],
```

tambahkan kode berikut pada view `topbar.blade.php`

```
<div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav ml-auto">
            @php $locale = session()->get('locale'); @endphp
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
       @switch($locale)
                        @case('en')
                        English
                        @break
                        @case('id')
                        Indonesia
                        @break
                        @default
                        English
                    @endswitch    
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/form/en"> English</a>
                    <a class="dropdown-item" href="/form/id"> Indonesia</a>
                </div>
            </li>
        </ul>
    </div>
```
hasil ketika dijalankan seperti ini
- English
![image](https://user-images.githubusercontent.com/85062827/172169201-e1f3f0e4-587b-403f-9fa4-fed81907784d.png)
- Indonesia
![image](https://user-images.githubusercontent.com/85062827/172169349-ed2fe4d8-0bbe-4d4c-b854-6b183a0238b8.png)


### File Storage
Kita ambil contoh ketika ingin mengupload file buku saat mengisi form. Pertama tama kita tulis kode berikut di `/book/create.blade.php`

```
<div class="form-group row">
     <label for="image" class="col-sm-2 col-form-label">{{ __('book.image') }}</label>
     <div class="col-sm-5">
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="imagePreview()" autofocus>
        <img class="img-preview img-fluid mt-3 col-sm-5">
        @error('image')
            <div id="imageFeedback" class="invalid-feedback">{{ __('book.format') }}</div>
        @enderror
     </div>
 </div>
```
kemudian pada `BookController.php` pada fungsi store kita tambahkan

```
    public function store(Request $request) {
        $validateData = $request->validate([
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'status' => 'required',
            'kategori_id' => 'required'
        ]);
        if($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('book-image');
        }
        Book::create($validateData);

        return redirect()->route('book.index')->with('status', 'Data buku berhasil ditambah!');
    }
```
ubah FILESYSTEM_DISK pada environtment di `.env` kita menjadi `FILESYSTEM_DISK=public`

jalankan `php artisan storage:link` pada terminal

pada form penginputan buku tampilannya seperti ini
![image](https://user-images.githubusercontent.com/85062827/172171396-6a427ebf-e4c2-4328-8b09-f6e7c85501ef.png)

apabila berhasil akan tampil seperti ini
![image](https://user-images.githubusercontent.com/85062827/172171205-f5c80805-d458-4dba-888f-3395af26797c.png)


