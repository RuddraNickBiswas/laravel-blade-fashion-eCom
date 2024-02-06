<form action="{{ route('admin.paypal.setting.update') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')
   
    <div class="form-group">
        <label>PayPal status</label>
        <select class="form-control" name="paypal_status" >
            <option @selected(config('gatewaySettings.paypal_status') ===  false) value="0">Inactive</option>
            <option @selected(config('gatewaySettings.paypal_status') === true) value="1">Active</option>
        </select>
    </div>

 <div class="form-group">
        <label>PayPal Account Mode</label>
        <select class="form-control" name="paypal_account_mode" >
            <option @selected(config('gatewaySettings.paypal_account_mode' ) ===  'sandbox') value="sandbox">Sandbox</option>
            <option  @selected(config('gatewaySettings.paypal_account_mode' ) ===  'live') value="live">Live</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">PayPal Country Name</label>
        <select name="paypal_country_name" class="form-control select2" id="">
            @foreach (config('country_list') as $key => $country)
            <option  @selected(config('gatewaySettings.paypal_country_name' ) ===  $key) value="{{ $key }}">{{ $country }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">PayPal Country</label>
        <select name="paypal_currency" class="form-control select2" id="">
            @foreach (config('currencys.currency_list') as $currency)
            <option @selected(config('gatewaySettings.paypal_currency' ) ===  $currency) value="{{ $currency }}">{{ $currency }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="">Currency rate (per {{ config('settings.site_currency') }})</label>
        <input class="form-control" type="number" name="paypal_currency_rate" 
        value="{{ config('gatewaySettings.paypal_currency_rate') }}"
        >
    </div>
  <div class="form-group">
        <label for="">PayPal Client Id</label>
        <input class="form-control" type="text" name="paypal_client_id"
        value="{{ config('gatewaySettings.paypal_client_id') }}"
        >
    </div>
    <div class="form-group">
        <label for="">PayPal Secret Key</label>
        <input class="form-control" type="text" name="paypal_secret_key"
        value="{{ config('gatewaySettings.paypal_secret_key') }}"
        >
    </div>
      <button class="btn btn-primary" type="submit">save</button>
</form>