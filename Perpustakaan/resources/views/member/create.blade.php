@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('member.add_member') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('member.store-data') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">{{ __('member.image') }}</label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="imagePreview()" autofocus>
                        <img class="img-preview img-fluid mt-3 col-sm-5">
                        @error('image')
                            <div id="imageFeedback" class="invalid-feedback">{{ __('member.format') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">{{ __('member.name') }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('member.name_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}">
                        @error('nis')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('member.nis_field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">{{ __('member.gender.gender') }}</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">{{ __('member.gender.select') }}</option>
                            <option value="Laki-laki">{{ __('member.gender.man') }}</option>
                            <option value="Perempuan">{{ __('member.gender.woman') }}</option>
                        </select>
                        @error('jenis_kelamin')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('member.gender.field') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tempat_lahir" class="col-sm-2 col-form-label"{{ __('member.tempat_lahir') }}></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('member.field_tempat') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">{{ __('member.tanggal_lahir') }}</label>
                    <div class="col-sm-3">
                        <input type="text" class="datepicker-here form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" data-language="en" data-position="top left" value="{{ old('tanggal_lahir') }}"/>
                        @error('tanggal_lahir')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('member.field_tanggal') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomor_hp" class="col-sm-2 col-form-label">{{ __('member.hp') }}</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}">
                        @error('nomor_hp')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ __('member.field_hp') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary float-right">{{ __('member.save') }}</button>
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">{{ __('member.back') }}</a>
                    @include('member.backhome-modal')
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