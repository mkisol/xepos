<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($company) ? $company->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($company) ? $company->email : old('email') }}" placeholder="{{ __('Email') }}" required />
            @error('email')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    @isset($company)
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($company->logo == null)
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Logo" class="rounded mb-2 mt-2" alt="Logo" width="200" height="150" style="object-fit: cover">
                    @else
                        <img src="{{ asset('storage/uploads/logos/' . $company->logo) }}" alt="Logo" class="rounded mb-2 mt-2" width="200" height="150" style="object-fit: cover">
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="form-group ms-3">
                        <label for="logo">{{ __('Logo') }}</label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo">

                        @error('logo')
                          <span class="text-danger">
                                {{ $message }}
                           </span>
                        @enderror
                        <div id="logoHelpBlock" class="form-text">
                            {{ __('Leave the logo blank if you don`t want to change it.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6">
            <div class="form-group">
                <label for="logo">{{ __('Logo') }}</label>
                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" required>

                @error('logo')
                   <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    @endisset
    <div class="col-md-6">
        <div class="form-group">
            <label for="website">{{ __('Website') }}</label>
            <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ isset($company) ? $company->website : old('website') }}" placeholder="{{ __('Website') }}" required />
            @error('website')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>