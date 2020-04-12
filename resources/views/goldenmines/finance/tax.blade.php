<div class="row">
    <div class="col-xs-12">
        <div class="commission-block text-center">
            <p><strong>{{ __('Dear player') }}! </strong></p>
            <p>{{ __('To credit funds to your account, you need to pay a winnings tax of 13% to the Commission for the control of gambling. This fee is regulated by the Government of Malta in accordance with the legal provisions of the Malta Gambling Ordinance, which applies to the management and offer of online gambling services, including, but not limited to, casino, poker, sports betting and bingo betting.') }}</p>
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