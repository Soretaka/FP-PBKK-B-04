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

