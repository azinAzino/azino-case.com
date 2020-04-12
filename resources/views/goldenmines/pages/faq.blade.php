@extends('goldenmines.layout')

@section ('title')
{{ __('FAQ') }}
@stop

@section ('faq')
nav-line__link_active
@stop



@section ('content')
<div class="content">
	<div id="react">
		<div data-reactroot="" class="Container" style="position: relative;">
			<div class="HelpMd">
				<div class="HelpMd__wrapper">
					<div class="HelpMd__header"> {{ __('FAQ') }} </div>
					<div class="HelpMd__faq-row">
						<div class="HelpMd__faq-col">
							<div class="Faq">
								<div class="Faq__block">
									<div class="Faq__header"> {{ __('Game') }} </div>
									<div>
										<div name="qa-1">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('Game') }}? </span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('Click the Login or Register button in the upper right corner of the site. Choose your favorite social network: VKontakte, Facebook or Odnoklassniki, after which you will be taken to a special access confirmation page. Click the "Confirm" button and registration will automatically end. In the future, to log in you just have to click on the login button and select the social network that you used when registering.') }} </div>
												</div>
											</div>
										</div>
									</div>
									{{-- <div>
										<div name="qa-2">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How to try the game for free?') }}</span></div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('When you register, you will receive 1000 bonus rubles. You have access to all the functions of the site, except for withdrawing funds. To enter the game for money, it’s enough to replenish the balance for any amount. All bonuses will be automatically deducted and the withdrawal function will be activated.') }}</div>
												</div>
											</div>
										</div>
									</div> --}}
									<div>
										<div name="qa-3">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('What is the essence of the game?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('The main page contains a list of all cases. Each case has 12 cells. Click the "Start Game" button and click on any of the 12 cells in the playing field. After that, the cell will open and you will see which of the guaranteed winnings received. Winnings are automatically credited to your balance. You can open the next cell on the field or see what the other winnings were. The cost of opening each subsequent cell is increased by 20%.') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-4">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How many cells can be opened in 1 game?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('You can open 1 to 3 cells in one game session. Winnings are not repeated. Accordingly, each discovery increases your chance of getting the maximum win!') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-5">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How is the "Rating" page and TOP-10 formed on the main page?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('The ranking position is calculated based on the total winnings. Thus, the more you win, the higher your position in the ranking. Only the top ten best players appear on the home page.') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-6">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('Can I register more than 1 account?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('No, each user can register only one account. For multiple registration, we can block all user accounts. The withdrawal of the balance on blocked accounts is not performed.') }}</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="Faq__block">
									<div class="Faq__header"> {{ __('Deposits and Withdrawals') }}</div>
									<div>
										<div name="qa-7">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How to replenish the balance?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('Click the "Refill" button in the upper right corner of the screen. Enter the payment amount in numbers without spaces, periods or commas. Choose a convenient payment system and click the "Recharge" button. After that, you will be redirected to the site of the payment system, where you need to complete the payment. After the payment is completed, you will be redirected back to Egger.') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-8">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('Minimum balance replenishment amount?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('The minimum replenishment amount is 250 dollars.') }}</div>
												</div>
											</div>
										</div>
									</div>
									{{-- <div>
										<div name="qa-9">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How long does the withdrawal take?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('Most payments are automatically processed within 1-2 minutes. Some payments are checked manually by the administration, so the maximum payment period is 24 hours.') }}</div>
												</div>
											</div>
										</div>
									</div> --}}
									<div>
										<div name="qa-10">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How to withdraw winnings?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('Click the "Output" button in the upper right corner of the screen. Enter the amount to pay out, wallet number and select a payment system. Press the "Withdraw" button, after which the funds will be debited from the balance and your payment order will immediately go into processing.') }}</div>
												</div>
											</div>
										</div>
									</div>
									{{-- <div>
										<div name="qa-11">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('Can I withdraw bonus rubles received during registration?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('None. Bonuses cannot be withdrawn, but can be spent on opening cases.') }}</div>
												</div>
											</div>
										</div>
									</div> --}}
									<div>
										<div name="qa-12">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How to track the payment status?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('The status of the payment ordered can always be found on the "Finance" page, the link to which is located on the "My profile" page.') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-13">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('Minimum payout amount?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('The minimum payout amount is $1500.') }}</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								{{-- <div class="Faq__block">
									<div class="Faq__header"> {{ __('Affiliate Program ') }}</div>
									<div>
										<div name="qa-14">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How does the affiliate program work?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('In the "Affiliate Program" section of your profile, you can get your own link to attract new players. Each player who registers using your link automatically becomes your referral and is displayed in the "Attracted Players" table. Each time a player attracted by you replenishes his balance, you get 5% of this amount in your balance! The received reward can be withdrawn to your electronic wallet or used to open cases.') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-15">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('What gives registration by my link?') }}</span></div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('All users who register using your link will receive 1000 rubles as a bonus. Be sure to tell everyone about the bonus, this will make your ad more attractive!') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-16">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How to withdraw earned money through an affiliate program?') }}</span> </div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('Click the "Output" button in the upper right corner of the screen. Enter the amount to pay out, wallet number and select a payment system. Press the "Withdraw" button, after which the funds will be debited from the balance and your payment order will immediately go into processing. The minimum payment amount is 100 rubles.') }}</div>
												</div>
											</div>
										</div>
									</div>
									<div>
										<div name="qa-17">
											<div class="Faq__qa">
												<div class="Faq__q"> <span role="button" class="Faq__q-text"> {{ __('How to attract new players?') }}</span></div>
												<div class="Faq__a">
													<div class="Faq__a-text"> {{ __('You can send your affiliate link to friends and acquaintances on social networks. Take a video review of our site, put it on Youtube and post a link in the description. Write a post on a forum or group in a social network with a story about Egger, do not forget to add your affiliate link.') }}</div>
												</div>
											</div>
										</div>
									</div>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section ('foo_help')
footer__nav-link_active
@stop

@section ('header_help')
header-menu__link_active
@stop