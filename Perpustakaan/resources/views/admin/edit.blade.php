@extends('layout.app')

@section('container')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{__('admin.edit_profile')}}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.update-data', auth()->user()->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{__('admin.name')}}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ auth()->user()->name }}" required autofocus>
                        @error('name')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{__('admin.name_field')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}" required autofocus>
                        @error('email')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{__('admin.field_email')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="TL" class="col-sm-2 col-form-label">{{__('admin.tanggal_lahir')}}</label>
                    <div class="col-sm-3">
                        <input type="text" class="datepicker-here form-control @error('TL') is-invalid @enderror" id="TL" name="TL" data-language="en" data-position="top left" value="{{ auth()->user()->TL }}" required autofocus>
                        @error('TL')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{__('admin.field_tanggal')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">{{__('admin.address')}}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('Alamat') is-invalid @enderror" id="Alamat" name="Alamat" value="{{ auth()->user()->Alamat }}" required autofocus>
                        @error('Alamat')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{__('admin.field_address')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="JK" class="col-sm-2 col-form-label">{{__('admin.gender.gender')}}</label>
                    <div class="col-sm-3">
                        <select class="form-control @error('JK') is-invalid @enderror" id="JK" name="JK" required autofocus>
                            <option value="">{{__('admin.gender.select')}}</option>
                            <option value="Laki-laki" @if(auth()->user()->JK == 'Laki-laki' || 'Male') selected @endif>{{__('admin.gender.man')}}</option>
                            <option value="Perempuan" @if(auth()->user()->JK == 'Perempuan' || 'Female') selected @endif>{{__('admin.gender.woman')}}</option>
                        </select>
                        @error('JK')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">{{__('admin.gender.field')}}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <button type="submit" class="btn btn-primary float-right">{{__('admin.save')}}</button>
                    <a class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#modalBackHome">{{__('admin.back')}}</a>
                    @include('member.backhome-modal')
                </div>
            </form>
        </div>
    </div>
@endsection