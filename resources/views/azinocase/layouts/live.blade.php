<div class="live-win">
    <div class="container">
        <div class="live-win__header">
            <div class="live-win__header-text">{{ trans('Live') }}</div>
        </div>
		<?php
			$users = \DB::table('users')->count();
			$drops = \DB::table('games')->count();
			$last_drop = \DB::table('games')->orderBy('id', 'desc')->limit(15)->get();
			foreach($last_drop as $d)
			{
				$item = \DB::table('items')->where('id', $d->drop_item)->first();
				$user = \DB::table('users')->where('id', $d->user)->first();
				
				$d->price = $item->cost;
				$d->avatar = "/img/avatar".SITE_ID.".png";
			}
		?>
        <div class="live-win__stat-wrapper">
                        <div class="live-win__stat-line">
                <div class="live-win__stat-block live-win__stat-block_gold">
                    <div class="live-win__stat-key">{{ trans('Online') }}:&nbsp;</div>
                    <div id="online-counter" class="live-win__stat-value" data-value="201">201</div>
                </div>
                <div class="live-win__stat-block live-win__stat-block_red">
                    <div class="live-win__stat-key">{{ trans('Users') }}:&nbsp;</div>
                    <div id="user-counter" class="live-win__stat-value" data-value="{{169000 + $users}}">{{ 169000 + $users}}</div>
                </div>
                <div class="live-win__stat-block live-win__stat-block_blue">
                    <div class="live-win__stat-key">{{ trans('Games') }}:&nbsp;</div>
                    <div id="case-counter" class="live-win__stat-value" data-value="{{2780000 + $drops}}">{{2780000 + $drops}}</div>
                </div>
            </div>
        </div>
                <div class="live-win__wrapper">
            <div class="live-win__block-shadow_right"></div>
            <div class="live-win__block-shadow_left"></div>
            <div class="live-win__coins-wrapper">
                <div class="coin-block-min coin-block-min__new_min"></div>
                <div class="coin-block-min coin-block-min__new"></div>
					@foreach($last_drop as $d)
					<div class="coin-block-min coin-block-min_none">
                        <div class="coin-block-min__coin-glow"></div>
                        <img src="/img/coins/90/{{str_replace('.', '_', $d->price)}}.png" alt="" class="coin-block-min__coin-img"/>
                        <div class="coin-block-min__ava-link">
                            <div class="circle-ava">
                                <a href="/user/{{$d->user}}">
                                    <img src="{{$d->avatar}}" alt="" class="circle-ava__img"/>
                                </a> 
                            </div>
                        </div>
                    </div>
					@endforeach
			</div>
        </div>
    </div>
</div>  