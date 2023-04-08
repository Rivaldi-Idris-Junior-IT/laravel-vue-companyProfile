@extends('layouts.app', ['title' => 'Tambah Company'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-folder"></i> TAMBAH COMPANY</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.company.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>NAMA PERUSAHAAN</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Perusahaan" class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>EMAIL PERUSAHAAN</label>
                            <input type="text" name="email_company" value="{{ old('email_company') }}" placeholder="Masukkan Email Perusahaan" class="form-control @error('email_company') is-invalid @enderror">

                            @error('email_company')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TENTANG PERUSAHAAN</label>
                            <textarea class="form-control about @error('about') is-invalid @enderror" name="about" rows="6"
                                placeholder="Deskripsi Produk">{{ old('about') }}</textarea>
                            @error('about')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ALAMAT PERUSAHAAN</label>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="Masukkan Alamat Perusahaan" class="form-control @error('address') is-invalid @enderror">

                            @error('address')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NO. TELP PERUSAHAAN</label>
                            <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Masukkan No. Telp Perusahaan" class="form-control @error('phone') is-invalid @enderror">

                            @error('phone')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PEMILIK PERUSAHAAN</label>
                            <select name="owner_id" class="form-control">
                                <option value="">-- PILIH OWNER --</option>
                                @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>

                            @error('owner_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>LAYANAN PERUSAHAAN</label>
                            <select name="company_service_id" class="form-control">
                                <option value="">-- PILIH LAYANAN --</option>
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name_service }}</option>
                                @endforeach
                            </select>

                            @error('company_service_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>SOCIAL MEDIA PERUSAHAAN</label>
                            <select name="company_social_media_id" class="form-control">
                                <option value="">-- PILIH LAYANAN --</option>
                                @foreach ($socials as $social)
                                <option value="{{ $social->id }}">{{ $social->name }}</option>
                                @endforeach
                            </select>

                            @error('company_social_media_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.4/tinymce.min.js"></script>
<script>
    var editor_config = {
        selector: "textarea.about",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
</script>
@endsection
