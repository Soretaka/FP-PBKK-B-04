# FP-PBKK-B-04 | Sistem Informasi Manajemen Perpustakaan

Nama Anggota Kelompok: 

-
-
-
- Nur Hidayati (05111940000028)

---

## Laravel Model, Eloquent and Query Builder

Pada sistem informasi perpustakaan ini, kami akan mengambil contoh salah satu fitur yang mengimplementasikan penggunaan model dan eloquent, yaitu fitur peminjaman. Adapun model-model yang terlibat dalam fitur peminjaman diantaranya `User`, `Borrow`, `BorrowDetails`, `Book`, dan `Category`. Skenario yang kami terapkan pada fitur peminjaman yaitu setiap member dapat meminjam lebih dari satu buku tetapi tidak boleh lebih dari tiga buku, dengan ini tentunya akan ada detail peminjaman yang akan menangani masing-masing buku yang dipinjam. Setiap transaksi peminjaman hanya dapat ditangani oleh satu admin. Setiap buku yang ada di perpustakaan hanya memiliki satu kategori. Dengan skenario tersebut berikut merupakan struktur model-model yang terlibat dalam fitur peminjaman. 

Model `User`
```ruby
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
        'TL',
        'Alamat',
        'JK',
        'NIS'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function borrow() {
        return $this->hasMany(Borrow::class);
    }
}
```
Terkait atribut-atribut yang akan digunakan maka harus didefinisikan terlebih dahulu seperti yang terlihat pada variabel `$fillable`. Relasi antara user dengan peminjaman yaitu one to many dikarenakan setiap member boleh meminjam lebih dari satu buku dan setiap transaksi peminjaman hanya dilayani oleh satu admin. Dengan demikian pada model User relasinya yaitu `hasMany` sedangkan inversenya terdapat pada model Borrow dengan relasi `belongsTo`.

Model `Borrow`
```ruby
class Borrow extends Model
{
    use HasFactory;
    protected $table = "Borrows";
    protected $fillable = [
        'admin_id',
        'user_id',
        'must_return_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function borrowdetails(){
        return $this->hasMany(BorrowDetails::class);
    }
}
```
Pada model borrow, kami definisikan atribut-atribut yang akan digunakan yaitu pada variable `$fillable`. Relasi antara peminjaman dan detail peminjaman yaitu one to many dimana setiap peminjaman memiliki banyak detail peminjaman. Oleh karena itu relasi antara model Borrow dengan model BorrowDetails adalah `hasMany` dengan inversnya pada model BorrowDetails yaitu `belongsTo`.

Model `BorrowDetails`
```ruby
class BorrowDetails extends Model
{
    use HasFactory;
    protected $table = "borrow_details";
    protected $fillable = [
        'borrow_id',
        'book_id',
        'return_date',
        'denda',
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function borrow() {
        return $this->belongsTo(Borrow::class);
    }
}
```
Selanjutnya, relasi antara model BorrowDetails dengan model Book adalah one to one dikarenakan setiap buku hanya terdapat pada satu detail peminjaman, begitu pula sebaliknya. Untuk mengimplementasikan relasi tersebut, pada model Book menggunakan keyword `hasOne` dengan inversenya pada model BorrowDetails yaitu `belongsTo`.

Model `Book`
```ruby
class Book extends Model
{
    use HasFactory;
    protected $table = "Books";
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
    public function borrow_details() {
        return $this->hasOne(BorrowDetails::class);
    }
}
```

Model `Category`
```ruby
class Category extends Model
{
    use HasFactory;
    protected $table = "Categories";

    protected $fillable = [
        'kategori_buku'
    ];
}
```
Selanjutnya yang kami bahas yaitu mengenai relasi antara buku dengan kategori dimana setiap buku hanya memiliki satu kategori sedangkan setiap kategori pasti memiliki banyak buku. Dengan demikian, relasinya adalah one to many. Pada model Book menggunakan keyword `belongsTo` yang menjadi inversenya.

Setelah membahas mengenai model dan eloquent, selanjutnya kami akan membahas mengenai query builder. Untuk implementasi dari query builder, kami akan menggunakan menu dashboard sebagai contohnya. Pada menu dashboard, kami menampilkan jumlah kategori buku, jumlah buku yang tersedia, jumlah member perpustakaan, dan jumlah peminjaman yang statusnya belum dikembalikan.

```ruby
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function indexAdm() {
        $categories_count = DB::table('categories')
                                ->select(DB::raw("COUNT(categories.id) as count"))
                                ->get();
        
        $books_count = DB::table('books')
                            ->select(DB::raw("COUNT(books.id) as count"))
                            ->where('status', 'Tersedia')
                            ->get();
        
        $members_count = DB::table('users')
                            ->select(DB::raw("COUNT(users.id) as count"))
                            ->where('isAdmin', 0)
                            ->get();
        
        $borrows_count = DB::table('borrows')
                            ->select(DB::raw("COUNT(borrows.id) as count"))
                            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
                            ->whereNull('borrow_details.return_date')
                            ->get();
                                
        return view('admin.dashboard', [
            "title" => "Dashboard",
            "categories_count" => $categories_count[0]->count,
            "books_count" => $books_count[0]->count,
            "members_count" => $members_count[0]->count,
            "borrows_count" => $borrows_count[0]->count,
        ]);
    }
}
```

Adapun untuk tampilan dashboard pada admin sebagai berikut:

![image](https://drive.google.com/uc?export=view&id=169yzH60JLptixLvVJaUhksX7tMp8q1eh)

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

## Session and Caching
### Session
Pada projek ini di session digunakan untuk localization seperti ini

```
public function index($locale){
  App::setlocale($locale);
  session()->put('locale', $locale);
  return redirect()->back();
}
```
### Caching
Caching yang digunakan terletak pada folder berikut

![image](https://user-images.githubusercontent.com/85062827/172189369-8dd2df94-537c-4423-85c9-4d4ec9a941bd.png)

pada `/bootstrap/cache/config.php` codenya seperti ini

```
<?php return array (
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'Asia/Jakarta',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:3rIXhOq9R80uCDClDbqdCeluEW220gwiShmDWTu3E4o=',
    'cipher' => 'AES-256-CBC',
...
```

pada  `/bootstrap/cache/route-v7.php` potongan codenya seperti ini
```
...
'/adminDashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard-index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/category/input-form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.input-data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
...
```

##  Route, Controller and Middleware
Diambil dari salah satu contoh yaitu BookController

Pertama untuk membuat controller, dapat menjalankan command berikut
```
php artisan make:controller BookController --resource
```

Kemudian tambahkan fungsi dibawah ini pada `BookController.php`

- Fungsi `index` untuk menampilkan halaman utama untuk book
```
public function index() {
        $books = Book::all();
        if(Auth::user()->isAdmin){
        return view('book.index', [
            "title" => "Book",
            "books" => $books
        ]);
        }else{
            return view('user.buku',[
                "title" => "Book",
                "books" => $books
            ]);
        }
    }
```

- Fungsi `showInputForm` untuk menampilkan halaman formulir penambahan buku
```
public function showEditForm($id) {
        $book = Book::where('id', $id)->first();
        $categories = Category::all();

        return view('book.edit', [
            "title" => "Book Edit Form",
            "book" => $book,
            "categories" => $categories
        ]);
    }
```

- Fungsi `store` untuk menyimpan buku. Nanti divalidasi apakah data yang sudah diisi sudah lengkap melalui `$request->validate` dan `$request->file('image')` untuk gambar. Lalu data dimasukkan ke database dan diredirect ke `book.index` dengan status `Data buku berhasil ditambah!`.
```
// store data
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

- Fungsi `detail` untuk menampilkan detail buku
```
// show detail 
    public function detail($id) {
        $book = Book::where('id', $id)->first();

        return view('book.detail', [
            "title" => "Book Detail",
            "book" => $book
        ]);
    }
``` 

- Fungsi `edit` untuk menampilkan halaman edit buku.
```
// show edit form 
    public function showEditForm($id) {
        $book = Book::where('id', $id)->first();
        $categories = Category::all();

        return view('book.edit', [
            "title" => "Book Edit Form",
            "book" => $book,
            "categories" => $categories
        ]);
    }
```

- Fungsi `update` untuk mengupdate data buku.
```
public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
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
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('book-image');
        }
        $book->update($validateData);
        
        return redirect()->route('book.index')->with('status', 'Data buku berhasil diedit!');
    }
```

- Fungsi `destroy` untuk menghapus data buku.
```
// delete
    public function destroy($id) {
        $book = Book::findOrFail($id);
        if($book->image) {
            Storage::delete($book->image);
        }
        $book->delete();

        return redirect()->route('book.index')->with('status', 'Data buku berhasil dihapus!');
    }
```

### Laravel request, validation and response
Diambil dari salah satu contoh yaitu Book

Pertama, buat form penambahan buku di `resources\views\book\create.blade.php`
```
@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('book.add_book') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('book.store-data') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">{{ __('book.title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" autofocus>
                        @error('judul')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.title_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">{{ __('book.author') }}</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}" autofocus>
                        @error('penulis')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.author_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">{{ __('book.publisher') }}</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" autofocus>
                        @error('penerbit')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.publisher_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">{{ __('book.date') }}</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" autofocus>
                            <option value="">{{ __('book.year') }}</option>
                            <?php
                                $tahun = date("Y");
                                for ($i=$tahun-20; $i <= $tahun; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>
                        @error('tahun_terbit')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.date_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}" autofocus>
                        @error('isbn')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.isbn_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">{{ __('book.status.select') }}</option>
                            <option value="Tersedia">{{ __('book.status.available') }}</option>
                            <option value="Tidak Tersedia">{{ __('book.status.not_available') }}</option>
                        </select>
                        @error('status')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.status.field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="kategori_id" class="col-sm-2 col-form-label">{{ __('book.category') }}</label>
                    <div class="col-sm-5">
                        <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" autofocus>
                            <option value="">{{ __('book.select_category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->kategori_buku }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.category_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary float-right">{{ __('book.save') }}</button>
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">{{ __('book.back') }}</a>
                    @include('book.backhome-modal')
                </div>
            </form>
        </div>
    </div>

    <script>
        function imagePreview() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
```

Penjelasan untuk pesan error
```
<div class="col-sm-5">
    <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}" autofocus>
    @error('penulis')
        <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.author_field') }}</div>
    @enderror
</div>
```
Halaman akan menampilkan pesan error jika validasi tidak terpenuhi

Lalu, buat controller `app\Http\Controllers\BookController.php`(sudah dijelaskan di bagian Laravel Route, Middleware, and Controller)
```
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{
    // index
    public function index() {
        $books = Book::all();
        if(Auth::user()->isAdmin){
        return view('book.index', [
            "title" => "Book",
            "books" => $books
        ]);
        }else{
            return view('user.buku',[
                "title" => "Book",
                "books" => $books
            ]);
        }
    }

    // show input form 
    public function showInputForm() {
        $categories = Category::all();

        return view('book.create', [
            "title" => "Book Input Form",
            "categories" => $categories
        ]);
    }

    // store data
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

    // show detail 
    public function detail($id) {
        $book = Book::where('id', $id)->first();

        return view('book.detail', [
            "title" => "Book Detail",
            "book" => $book
        ]);
    }

    // show edit form 
    public function showEditForm($id) {
        $book = Book::where('id', $id)->first();
        $categories = Category::all();

        return view('book.edit', [
            "title" => "Book Edit Form",
            "book" => $book,
            "categories" => $categories
        ]);
    }

    // store edit data
    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
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
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('book-image');
        }
        $book->update($validateData);
        
        return redirect()->route('book.index')->with('status', 'Data buku berhasil diedit!');
    }

    // delete
    public function destroy($id) {
        $book = Book::findOrFail($id);
        if($book->image) {
            Storage::delete($book->image);
        }
        $book->delete();

        return redirect()->route('book.index')->with('status', 'Data buku berhasil dihapus!');
    }
}
```

Penjelasan untuk validation
 ```
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
 ```
 Fungsi validasi digunakan untuk mempermudah validasi dan mengambil pesan error apabilai syarat validasi tidak dipenuhi.

Ketiga, tambahkan route pada `routes\web.php`. Untuk mengakses formulir, bisa digunakan method GET. Untuk memproses penambahan dan edit form, bisa digunakan method POST.
```
// book
    Route::group(['prefix' => 'book', 'as' => 'book.'], function(){
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/input-form', [BookController::class, 'showInputForm'])->name('input-data');
        Route::post('/store', [BookController::class, 'store'])->name('store-data');
        Route:: get('/detail/{id}', [BookController::class, 'detail'])->name('detail-data');
        Route::get('/edit/{id}', [BookController::class, 'showEditForm'])->name('edit-form');
        Route::post('/update/{id}', [BookController::class, 'update'])->name('update-data');
        Route::delete('/delete/{id}', [BookController::class, 'destroy'])->name('delete-data');
    });
```

### Unit Testting
Diambil salah satu contoh yaitu CategoryControllerTest

Pertama untuk membuat Unit Testing, dapat menjalankan command berikut
```
    php artisan make:test Category/CategoryControllerTest --unit
```

Kemudian tambahkan fungsi dibawah ini pada `CategoryControllerTest.php` untuk menguji modul `CategoryController.php`.

- Fungsi `test_store_data_successfully_category` digunakan untuk menguji ketika kita ingin menambahkan kategori secara sukses. Kita mencoba menggunakan `$this->post` dengan memasukkan data kategori buku. ada test ini kita menggunakan `assertStatus` untuk mengecek apakah statusnya `302` karena pada `CategoryController`, kita melakukan `return redirect()->route('category.index')->with('status', 'Kategori buku berhasil ditambah!');` sehingga kita melakukan redirect yang mempunyai kode `302`. Kita juga memastikan apakah route redirectnya benar atau tidak menggunakan `assertRedirect`.
```
public function test_store_data_successfully_category()
    {
        $response = $this->post('/category/store', [
            'kategori_buku' => 'category_test'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/category');
    }
```

- Fungsi `test_store_data_failed_category` digunakan untuk menguji ketika kita ingin menambahkan kategori secara gagal. Fungsi ini mempunyai implementasi yang hampir sama tapi kita mengirimkan kategori buku yang kosong ketika di CategoryController terdapat validasi yang memerlukan nama kategori buku. Sehingga kita mengganti `asssertRedirect` dengan `/`, bukan `/category/`.
```
public function test_store_data_failed_category()
    {
        $response = $this->post('/category/store', [
            'kategori_buku' => ''
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
```

### Feature Testing
Diambil salah satu contoh yaitu BookTest

Pertama untuk membuat Feature Testing, dapat menjalankan command berikut
```
php artisan make:test BookTest
```

Kemudian tambahkan fungsi dibawah ini pada `CategoryControllerTest.php`.

- Fungsi `test_welcome_status` digunakan untuk menguji ketika membuka page dengan route `/book` menggunakan method `get`. Jika berhasil membuka page tersebut maka akan mendapatkan response status code `200`.
```
public function test_welcome_status()
    {
        $response = $this->get('/book');

        $response->assertStatus(200);
    }
```

- Fungsi `test_input_status` digunakan untuk menguji ketika membuka page dengan route `/book/input-form` menggunakan method `get`. Jika berhasil membuka page tersebut maka akan mendapatkan response status code `200`.
```
public function test_input_status()
    {
        $response = $this->get('/book/input-form');

        $response->assertStatus(200);
    }

```

- Fungsi `test_images_can_be_uploaded` digunkan untuk menguji penguploadan gamabr pada sebuah website. Fungsi ini menggunkan method `fake` dari `use Illuminate\Http\UploadedFile` untuk membuat image dummy untuk testing dan method `fake` dari `Illuminate\Support\Facades\Storage` untuk mempermudah testing upload image.
```
public function test_images_can_be_uploaded()
    {
        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/image', [
            'image' => $file,
        ]);

        Storage::disk('images')->assertExists($file->hashName());
    }
```

Untuk menjalankan HTTP test dapat menjalankan command berikut
```
php artisan test
```
