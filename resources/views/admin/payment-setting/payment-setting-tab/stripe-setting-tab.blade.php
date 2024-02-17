<form class="active" action="{{ route('admin.stripe.setting.update') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')
   
    <div class="row">
        <div class="col-12 form-group">
            <label>PayPal status</label>
            <select class="form-control" name="stripe_status" >
                <option @selected(config('gatewaySettings.stripe_status') ===  false) value="0">Inactive</option>
                <option @selected(config('gatewaySettings.stripe_status') === true) value="1">Active</option>
            </select>
        </div>
        {{-- <div class="col-12 form-group">
            <label>PayPal Account Mode</label>
            <select class="form-control" name="paypal_account_mode" >
                <option @selected(config('gatewaySettings.paypal_account_mode' ) ===  'sandbox') value="sandbox">Sandbox</option>
                <option  @selected(config('gatewaySettings.paypal_account_mode' ) ===  'live') value="live">Live</option>
            </select>
        </div> --}}
        <div class="col-12 form-group"> 
            <label for="">PayPal Country Name</label>
            <select name="stripe_country_name" class="form-control select2" style="width: 100%">
                @foreach (config('country_list') as $key => $country)
                <option  @selected(config('gatewaySettings.stripe_country_name' ) ===  $key) value="{{ $key }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 form-group">
            <label for="">PayPal Country</label>
            <select name="stripe_currency" class="form-control select2" style="width: 100%">
                @foreach (config('currencys.currency_list') as $currency)
                <option @selected(config('gatewaySettings.stripe_currency' ) ===  $currency) value="{{ $currency }}">{{ $currency }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 form-group">
            <label for="">Currency rate (per {{ config('settings.site_currency') }})</label>
            <input class="form-control" type="number" name="stripe_currency_rate" 
            value="{{ config('gatewaySettings.stripe_currency_rate') }}"
            >
        </div>
        <div class="col-12 form-group">
            <label for="">PayPal Client Id</label>
            <input class="form-control" type="text" name="stripe_api_key"
            value="{{ config('gatewaySettings.stripe_api_key') }}"
            >
        </div>
        <div class="col-12 form-group">
            <label for="">PayPal Secret Key</label>
            <input class="form-control" type="text" name="stripe_secret_key"
            value="{{ config('gatewaySettings.stripe_secret_key') }}"
            >
        </div>
     
    </div>

      <button class="btn btn-primary" type="submit">save</button>
</form>