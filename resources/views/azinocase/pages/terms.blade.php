@extends('azinocase.layout')

@section ('title')
{{ __('Terms of use') }}
@stop

@section ('content')
<div class="content">
    <div class="container">
        <div class="terms">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                    <div class="terms__header">
                        <div class="terms__header-line"> </div>
                        <div class="terms__header-text"> {!! __('User <span> agreement </span>') !!} </div>
                        <div class="terms__header-line"> </div>
                    </div>
                    <div class="terms__block">
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('1. General Terms and Conditions') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('1.1. This document is an agreement to use the Azino-Case.com Service. The following are the terms and conditions of use of the Service. Please read them carefully.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('1.2. The service can be used by people over 18 years old.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('1.3. Service Azino-Case.com - a win-win online game belonging to the organizer and located at the address on the Internet Azino-Case.com. The organizer provides services for the organization of entertainment, leisure and recreation.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('1.4. The organizers of the win-win online game Azino-Case.com do not oblige anyone to spend their leisure time with the Service.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('2. Account, Password, Security') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('2.1. To open an Account, a user must log in via social networks Vkontakte, Facebook or Odnoklassniki.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('2.2. The user is fully responsible for the storage of his confidential information, for the loss of access to his Account.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('2.3. The user is fully responsible for any actions committed by him.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('2.4. The service is not responsible for the acts committed by the User in relation to third parties.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('2.5. The User shall inform the Service of any unauthorized use of his Account.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('3. User') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('3.1. The Service reserves the right to block the User at any time in connection with a violation of the rules for using the Service or the law.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('3.2. Attempts of unauthorized access, attempts to harm the Service are unacceptable.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('3.3. When adding any information to the site, insults, extortion, defamation, bluffing, messages containing malicious information (including viruses, trojans, worms, etc.), as well as information that can harm third parties, are prohibited.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('4. Forbidden') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.1. It is forbidden to publish falsified data.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.2. The transfer of any materials that may violate the intellectual property of third parties is prohibited.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.3. Fake publication of information is prohibited in order to obtain unauthorized access to information or data of third parties.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.4. It is forbidden to publish information of a religious and political nature.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.5. It is forbidden to register more than one Account.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.6. It is forbidden to transfer data to access the Account to third parties.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.7. It is forbidden to insult, call names, question the professional qualifications and integrity of individuals and legal entities, including users of the Service and the Administration of the Service.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('4.8. It is forbidden to choose avatars containing scenes of violence, threats, profanity, debauchery (pornography), discrimination of any kind, commercial advertising and advertising texts.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('5. Responsibility of the parties') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('5.1. Replenishing the balance on the site with any payment systems, you take full responsibility for your actions. The service does not force or insist on doing any actions.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('5.2. Opening an egg or spending money from your balance in any other way, you take full responsibility for your actions.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('5.3. The service does not call or motivate to increase your funds.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('5.4. The service does not give a 100% guarantee that opening eggs will provide an opportunity to increase your funds on the balance sheet.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('5.5. Service in no case obliges or forces to perform certain actions. All actions performed by you in the Service are carried out solely at your responsibility.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('6. Acceptance of the terms of the agreement (acceptance of the offer)') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('6.1. Using and / or visiting any sections of the Service, you agree to accept and abide by the terms of this Agreement and you respectively agree to use electronic communication tools to conclude contracts, you also refuse any rights or requirements applicable in this case that require a handwritten signature, in that the extent to which this is permitted by any applicable law.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('6.2. If you do not agree to accept and further follow the terms of this Agreement, please do not register an account and / or stop using your account. Further use of the Service will be considered as your acceptance of the terms of this Agreement.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m"> {{ __('7. Rights') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('7.1. The exclusive right to the Service belongs to the Service.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray"> {{ __('7.2. All rights to the materials presented on our website belong to the copyright holders.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop