<form action="{{ route('admin.general.setting.update') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')
   
    <div class="form-group">
        <label>Site Name</label>
        <input type="text" name="site_name" class="form-control" value="{{ config('settings.site_name') }}">
    </div>
    <div class="form-group">
        <label>Default Currency</label>
        <select name="site_currency" class="form-control select2">
            @foreach (config('currencys.currency_list') as $currency)
            <option @selected(config('settings.site_currency') === $currency)  value="{{ $currency }}">{{ $currency }}</option>
                
            @endforeach
        </select>
    </div>

    <div class="row form-group">
        <div class="col-md-6">
            <label>Currency Icon</label>
            <input type="text" class="form-control" name="site_currency_symbol"
                value="{{ config('settings.site_currency_symbol') }}">
        </div>
     

        <div class="col-md-6">
            <label>Currency Icon Position</label>
            <select name="site_currency_position" class="form-control">
                </option>
              
                    <option @selected(config('settings.site_currency_position') === 'right' ) value="right">
                        Right
                    </option>
                    <option @selected(config('settings.site_currency_position') === 'left' ) value="left">
                        Left
                    </option>
                   
             
            </select>
        </div>
    </div>

   


    <button class="btn btn-primary" type="submit">save</button>
</form>