@extends('goldenmines.layout')

@section ('title')
{{ __('Privacy Policy') }}
@stop



@section ('content')
<div class="content">
    <div class="container">
        <div class="terms">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                    <div class="terms__header">
                        <div class="terms__header-line"></div>
                        <div class="terms__header-text"><span>{{ __('Privacy Policy') }}</span></div>
                        <div class="terms__header-line"></div>
                    </div>
                    <div class="terms__block">
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m">{{ __('1. What information is to be collected') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('1.1. Only information that provides the ability to support user feedback is subject to collection.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('1.2. Some user actions are automatically saved in server logs:') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('1.2.1. IP address, browser type details;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('1.2.2. add-ons, request time, etc.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m">{{ __('2. How is the information received used') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('2.1. The information provided by the user is used to contact him, including for sending notifications.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m">{{ __('3. Personal Information Management') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __("3.1. Personal data is available for viewing, changing and deleting in the user's personal account.") }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __("3.2. In order to prevent accidental deletion or corruption of data, information is stored in backups for 7 days and can be restored at the user's request.") }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m">{{ __('4. Providing data to third parties') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('4.1. Personal data of users can be transferred to persons not associated with this site, if necessary: ​​') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('4.1.1. to comply with the law, regulatory act, enforcement of court decisions;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('4.1.2. to detect or prevent fraud;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('4.1.3. to fix technical malfunctions in the site;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('4.1.4. to provide information based on a request from authorized government agencies.') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('4.6. In the case of the sale of this site, users must be notified about this no later than 10 days before the transaction.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m">{{ __('5. Data Security') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('5.1. The site administration takes all measures to protect user data from unauthorized access, in particular:') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('5.1.1. regular updating of services and systems for managing the site and its contents;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('5.1.2. encryption of archived copies of the resource;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('5.1.3. regular checks for malicious codes;') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('5.1.4. using a virtual dedicated server to host the site.') }}</div>
                        <div class="terms__paragraph-title text-block text-block_tf_up text-block_fs_m">{{ __('6. Changes') }}</div>
                        <div class="terms__paragraph text-block text-block_fs_m text-block_color_gray">{{ __('6.1. Privacy policy updates are published on this page.') }}</div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@stop