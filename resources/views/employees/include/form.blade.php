<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first-name">{{ __('First Name') }}</label>
            <input type="text" name="first_name" id="first-name" class="form-control @error('first_name') is-invalid @enderror" value="{{ isset($employee) ? $employee->first_name : old('first_name') }}" placeholder="{{ __('First Name') }}" required />
            @error('first_name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="last-name">{{ __('Last Name') }}</label>
            <input type="text" name="last_name" id="last-name" class="form-control @error('last_name') is-invalid @enderror" value="{{ isset($employee) ? $employee->last_name : old('last_name') }}" placeholder="{{ __('Last Name') }}" required />
            @error('last_name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="company">{{ __('Company') }}</label>
            <select class="form-select @error('company') is-invalid @enderror" name="company" id="company" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select company') }} --</option>
                
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ isset($employee) && $employee->company == $company->id ? 'selected' : (old('company') == $company->id ? 'selected' : '') }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
            </select>
            @error('company')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($employee) ? $employee->email : old('email') }}" placeholder="{{ __('Email') }}" required />
            @error('email')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ isset($employee) ? $employee->phone : old('phone') }}" placeholder="{{ __('Phone') }}" required />
            @error('phone')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>