@extends('admin.layouts.master')
@section('page_title', 'General Setting')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">General Setting Form</h5>
                    <small class="text-muted float-end">
                        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i>
                            Back
                            to Dashboard</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.general.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="site_title">Site Title</label>
                            <input type="text" name="site_title" value="{{ setting('site_title') }}"
                                class="form-control  @error('site_title')is-invalid @enderror" id="site_title"
                                placeholder="Site title">
                            @error('site_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_address">Site Address</label>
                            <input type="text" name="site_address" value="{{ setting('site_address') }}"
                                class="form-control  @error('site_address')is-invalid @enderror" id="site_address"
                                placeholder="Site address">
                            @error('site_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_phone">Phone Number</label>
                            <i class="menu-icon tf-icons bx bxl-cont"></i>
                            <input type="phone" name="site_phone" value="{{ setting('site_phone') }}"
                                class="form-control  @error('site_phone')is-invalid @enderror" id="site_phone"
                                placeholder="Contact number">
                            @error('site_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="menu-icon tf-icons bx bxl-facebook-square"></i><label class="form-label"
                                for="site_facebook_link">Facebook Link</label>
                            <input type="text" name="site_facebook_link" value="{{ setting('site_facebook_link') }}"
                                class="form-control  @error('site_facebook_link')is-invalid @enderror"
                                id="site_facebook_link" placeholder="Facebook link">
                            @error('site_facebook_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="menu-icon tf-icons bx bxl-instagram-alt"></i><label class="form-label"
                                for="site_instagram_link">Instagram Link</label>
                            <input type="text" name="site_instagram_link" value="{{ setting('site_instagram_link') }}"
                                class="form-control  @error('site_instagram_link')is-invalid @enderror"
                                id="site_instagram_link" placeholder="Instagram link">
                            @error('site_instagram_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="menu-icon tf-icons bx bxl-linkedin-square"></i><label class="form-label"
                                for="site_linkedin_link">LinkedIn Link</label>
                            <input type="text" name="site_linkedin_link" value="{{ setting('site_linkedin_link') }}"
                                class="form-control  @error('site_linkedin_link')is-invalid @enderror"
                                id="site_linkedin_link" placeholder="LinkedIn link">
                            @error('site_linkedin_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <i class="menu-icon tf-icons bx bxl-youtube"></i><label class="form-label"
                                for="site_youtube_link">Youtube Link</label>
                            <input type="text" name="site_youtube_link" value="{{ setting('site_youtube_link') }}"
                                class="form-control  @error('site_youtube_link')is-invalid @enderror" id="site_youtube_link"
                                placeholder="Youtube link">
                            @error('site_youtube_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_description">Site Description</label>
                            <textarea name="site_description" class="form-control  @error('site_description')is-invalid @enderror"
                                id="site_description" cols="30" rows="6" placeholder="Write your site description here">{{ setting('site_description') }}</textarea>
                            @error('site_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
@endpush
