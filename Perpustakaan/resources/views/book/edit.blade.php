@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('book.edit') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('book.update-data', $book->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">{{ __('book.image') }}</label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="imagePreview()" autofocus>
                        <input type="hidden" name="oldImage" value="{{ $book->image }}">
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="img-preview img-fluid mt-3 col-sm-5">
                        @else
                            <img class="img-preview img-fluid mt-3 col-sm-5">
                        @endif
                        @error('image')
                            <div id="imageFeedback" class="invalid-feedback">{{ __('book.format') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label @error('judul') is-invalid @enderror">{{ __('book.title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $book->judul }}" autofocus>
                        @error('judul')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.title_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label  @error('penulis') is-invalid @enderror">{{ __('book.author') }}</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $book->penulis }}" autofocus>
                        @error('penulis')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.author_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label @error('penerbit') is-invalid @enderror">{{ __('book.publisher') }}</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $book->penerbit }}" autofocus>
                        @error('penerbit')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.publisher_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">{{ __('book.date') }}</label>
                    <div class="col-sm-2">
                        <select class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" autofocus>
                            <option value="">{{ __('book.year') }}</option>
                            <?php
                                $tahun = date("Y");
                                $tahun2 = $book->tahun_terbit;
                                for ($i=$tahun-20; $i <= $tahun; $i++) {
                                    if ($i == $tahun2) {
                                        echo "<option value='$i' selected>$i</option>";
                                    }
                                    else {
                                        echo "<option value='$i'>$i</option>";
                                    }
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
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ $book->isbn }}" autofocus>
                        @error('isbn')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.isbn_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" autofocus>
                            <option value="">{{ __('book.status.select') }}</option>
                            <option value="Tersedia" @if($book->status == 'Tersedia') selected @endif>{{ __('book.status.available') }}</option>
                            <option value="Tidak tersedia" @if($book->status == 'Tidak tersedia') selected @endif>{{ __('book.status.not_available') }}</option>
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
                                <option value="{{ $category->id }}" {{ $book->kategori_id == $category->id ? 'selected' : null}}>{{ $category->kategori_buku }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('book.category_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-warning float-right">Edit</button>
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