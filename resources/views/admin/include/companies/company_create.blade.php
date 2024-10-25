@extends('admin.tema')

@section('css')
@endsection

@section('master')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>{{ isset($company) ? 'Firmayı Güncelle' : 'Yeni Firma Oluştur' }}</h4>
        </div>
        <div class="card-body">
            <form role="form" id="companyForm" action="{{ isset($company) ? route('company-update', $company->id) : route('companies.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($company))
                    @method('PUT')
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_name">Firma Adı:</label>
                            <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                            value="{{ old('company_name', isset($company) ? $company->company_name : '') }}" placeholder="Firma Adı Giriniz" required>
                            @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Telefon:</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', isset($company) ? $company->phone : '') }}" placeholder="Telefon Giriniz">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-posta:</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', isset($company) ? $company->email : '') }}" placeholder="E-posta Giriniz" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tax_id">Vergi Kimlik Numarası:</label>
                            <input type="text" name="tax_id" class="form-control @error('tax_id') is-invalid @enderror"
                            value="{{ old('tax_id', isset($company) ? $company->tax_id : '') }}" placeholder="Vergi Kimlik Numarası Giriniz">
                            @error('tax_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Adres:</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', isset($company) ? $company->address : '') }}" placeholder="Adres Giriniz" required>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">Şehir:</label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                            value="{{ old('city', isset($company) ? $company->city : '') }}" placeholder="Şehir Giriniz" required>
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person">İlgili Kişi:</label>
                            <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror"
                            value="{{ old('contact_person', isset($company) ? $company->contact_person : '') }}" placeholder="İlgili Kişi Giriniz">
                            @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_phone">İlgili Kişi Telefon:</label>
                            <input type="text" name="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror"
                            value="{{ old('contact_phone', isset($company) ? $company->contact_phone : '') }}" placeholder="İlgili Kişi Telefonunu Giriniz">
                            @error('contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success">{{ isset($company) ? 'Firmayı Güncelle' : 'Yeni Firma Oluştur' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
