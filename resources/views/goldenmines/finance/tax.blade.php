<div class="row">
    <div class="col-xs-12">
        <div class="commission-block text-center">
            <p><strong>{{ __('Dear player') }}! </strong></p>
            <p>{{ __('messages.tax_description', ['tax' => $settings->tax]) }}</p>
            <div class="commission-block__btns">
                <div class="text-center">
                    {{-- <span class="h4 text-center">{{ $tax_amount }}$</span>--}}
                    <a data-type="tax" data-amount="{{ $tax_amount }}" data-toggle="add-tax" class="alert-link modal-toggle user-block__cashin" href="#">
                        {{ __('To pay') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>