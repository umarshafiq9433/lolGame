
    <!-- Footer Area Start -->
    <footer>
      <div class="footer-bg">
        <div class="container">
          <div class="footer-area pb-30">
            <div class="row">
              <div class="col-xl-5 col-lg-5 col-md-10">
                <div class="footer-widget mb-30">
                  <div class="header-logo">
                    <a href="#"
                      ><img
                        src="assets/image/logo-2.png"
                        class="img-fluid"
                        alt=""
                    /></a>
                  </div>
                  <p>
                    SmurfBuddy.com is a veteran League of Legends elo boosting
                    website. We require each booster to undergo verification so
                    we know your account is in good hands. We offer an array of
                    services, including smurf accounts and coaching.
                  </p>
                </div>
              </div>
              <div class="col-xl-4 col-lg-3 col-md-6">
                <div class="footer-widget mb-30">
                  <h4>Popular Links</h4>
                  <ul>
                    <li><a href="#">--About Us</a></li>
                    <li><a href="#">--Join Us</a></li>
                    <li><a href="#">--Refund Policy</a></li>
                    <li><a href="#">--Terms of Service</a></li>
                    <li><a href="#">--Privacy Policy</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="footer-widget mb-30">
                  <h4>Contact Us</h4>
                  <ul>
                    <li>Phone: Mon-Fri 9am-5pm EST</li>
                    <li>1-234-567-8910</li>
                    <li>Email: 24/7 (reply within 24 hr)</li>
                    <li>
                      <a href="mailto:example@SmurfBuddy.com"
                        >example@SmurfBuddy.com</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="copyright-area">
            <div class="row align-items-center">
              <div class="col-md-8 order-2 order-md-1">
                <div class="copyright-text">
                  <span
                    >Copyright © 2020-2021 SmurfBuddy. All Rights Reserved</span
                  >
                </div>
              </div>
              <div class="col-md-4 order-1 order-md-2">
                <div class="copyright-social text-right">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-youtube"></i></a>
                  <a href="#"><i class="fab fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Area End -->

    <div class="modal fade wrapperrr" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel" style="color: #000">CHECK OUT</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3 col-lg-3 col-xs-12 text-center review-order-border">
							<p class="review">Review Your Order</p>
							<span id="review_type" class="boost-type" style="color:white";>Division Boost</span>
							<small style="display: block; margin-top: 20px;">Desired</small>
							<p id="review_boost" class="order-review-p">Silver IV 0-20 LP  to Master I</p>
							<small>Your Server</small>
							<p id="review_server" class="order-review-p">EUW</p>
							<small>Total Price</small>
							<p class="total-price order-review-p">
								<span id="review_price" class="review_price" style="font-size:200%";>1101</span>
								<span>$</span>
							</p>
						</div>
						<div class="col-md-9 col-lg-9 col-xs-12 text-center">
							<!-- LoL account -->
							<form id="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="POST">

								<!-- PAYPAL CALL -->
								<input type="hidden" id="cmd" name="cmd" value="<?php echo $paypal[ 'cmd' ]; ?>">
								<input type="hidden" id="return" name="return" value="<?php echo $paypal[ 'return' ]; ?>">
								<input type="hidden" id="currency_code" name="currency_code" value="<?php echo $paypal[ 'currency_code' ]; ?>">
								<input type="hidden" id="business" name="business" value="<?php echo $paypal[ 'business' ]; ?>">
								<input type=hidden name="notify_url" id="notify_url" value="<?php echo $paypal[ 'IPN' ]; ?>">
								<input type="hidden" id="item_name" name="item_name">
								<input type="hidden" name="custom" id="custom" />
								<!-- END PAYPAL CALL -->

								<input type="hidden" id="amount" name="amount" />

								<!-- Skrill Form -->
								<input type="hidden" name="pay_to_email" value="<?php echo $skrill[ 'merchant_email' ]; ?>" />
								<input type="hidden" name="pay_from_email" class="user_payment_email" />
								<input type="hidden" name="currency" value="<?php echo $skrill[ 'currency_code' ]; ?>">
								<input type="hidden" name="return_url" value="<?php echo $skrill[ 'return_url' ]; ?>" />
								<input type="hidden" name="cancel_url" value="<?php echo $skrill[ 'cancel_url' ]; ?>" />
								<input type="hidden" name="status_url" value="<?php echo $skrill[ 'status_url' ]; ?>" />
								<input type="hidden" name="logo_url" value="<?php echo $skrill[ 'logo_url' ]; ?>" />
								<input type="hidden" name="detail1_description" class="payment_description" />
								<input type="hidden" name="merchant_fields" value="<?php echo $skrill[ 'merchant_fields' ]; ?>" />
								<input type="hidden" name="Field1" class="payment_description" />
								<input type="hidden" name="Field2" class="review_boost" />
								<!-- .:Skrill Form -->

								<!-- G2A Form -->
								<input type="hidden" name="order_id" value="<?php echo $g2a[ 'order_id' ]; ?>" />
								<input type="hidden" name="email" value="<?php echo $g2a[ 'merchant_email' ]; ?>" />
								<input type="hidden" name="cy" value="<?php echo $g2a[ 'currency_code' ]; ?>">
								<input type="hidden" name="url_failure" value="<?php echo $g2a[ 'url_failure' ]; ?>" />
								<input type="hidden" name="url_ok" value="<?php echo $g2a[ 'url_ok' ]; ?>" />
								<input type="hidden" name="api_hash" value="<?php echo $g2a[ 'api_hash' ]; ?>" />
								<input type="hidden" name="hash" value="<?php echo $g2a[ 'hash' ]; ?>" />
								<input type="hidden" name="items" value='[<?php echo json_encode( $g2a[ 'items' ] ); ?>]' />
								<!-- .:G2A Form -->
<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="lol_account">LoL account</label>
										<input id="lol_account" type="text" class="form-control" placeholder="If solo boost">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="lol_password">LoL password</label>
										<input id="lol_password" type="password" class="form-control" placeholder="If solo boost">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="lol_summonername">Summoner</label>
										<input id="lol_summonername" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<select id="order_queue" class="form-control modalForm">
											<option value="Solo/Duo (5v5)" selected="">Solo/Duo (5v5)</option>
											<option value="Flex (5v5)">Flex (5v5)</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group"><select id="order_flash" class="form-control modalForm">
										<option value="Flash_D" selected="">Flash on D</option>
										<option value="Flash_F">Flash on F</option>
									</select> </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input id="email" placeholder="Email" type="email" class="form-control validate" required="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="booster_notes">Notes for booster</label>
										<textarea id="booster_notes" class="form-control"></textarea>
									</div>
								</div>
                </div>
								<div class="row">

									<h3 class="title">Payment Method:</h3>

									<div class="col-10 offset-sm-1 select-payment">

										<?php if ( $skrill[ 'enabled' ] ) { ?>
											<label class="radio-container">
												<input name="payment_method" value="skrill" type="radio" class="__radio_payment radio-hidden" />
												<div style="background-image: url(./boostpanel/assets/img/payment/skrill.png);" class="radio-image"></div>
											</label>
										<?php } ?>

										<?php if ( $paypal[ 'enabled' ] ) { ?>
											<label class="radio-container">
												<input name="payment_method" value="paypal" type="radio" class="__radio_payment radio-hidden" />
												<div style="background-image: url(./boostpanel/assets/img/payment/paypal.png);" class="radio-image"></div>
											</label>
										<?php } ?>

										<?php if ( $g2a[ 'enabled' ] ) { ?>
											<label class="radio-container">
												<input name="payment_method" value="g2a" type="radio" class="__radio_payment radio-hidden" />
												<div style="background-image: url(./boostpanel/assets/img/payment/g2a.png);" class="radio-image"></div>
											</label>
										<?php } ?>

									</div>

									<!-- <p id="__payment_description">Description</p> -->

								</div>

							</form>
						</div>
					</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" onclick="__paymentAIO()" class="btn btn-primary" style="color:white";>Pay</button>

					</div>
				</div>
			</div>
	</div>

    <!-- JS here -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/jquery.scrollUp.js"></script>
    <script src="assets/js/sticky.js"></script>
    <script src="assets/js/jquery-ui-slider-range.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- <script src="assets/js/newScripts/netWins.js"></script>
    <script src="assets/js/newScripts/normalWins.js"></script>
    <script src="assets/js/newScripts/placement.js"></script>
    <script src="assets/js/newScripts/champion.js"></script> -->

    <script>
      //jquery nice select activation
      $("select").not("select.modalForm").niceSelect();
    </script>
<script>
function validateEmail( email ) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

function __paymentAIO() {
		// Check email
		var email = 0;
		var email = $( '#email' ).val();

		if( validateEmail( email ) ){
			email = 1;
			var mail = document.getElementById( 'email' ).value;
			$( '.user_payment_email' ).val( mail );

			// Insert data in hidden inputs for PayPal
			var item_name = document.getElementById( 'review_boost' ).innerHTML; // Get Item Name
			$( '.review_boost' ).val( item_name );
			document.getElementById( 'item_name' ).value = item_name; // Insert item_name
			var price = document.getElementById( 'review_price' ).innerHTML; // Get Price
			document.getElementById( 'amount' ).value = price; // Insert price

			// var isDuo = document.getElementById( 'duo' ).checked;
			// var isDuo = $( 'input[name="is_duo"]:checked' ).val();
			var isDuo = $( '#is_duo' ).val();
			var duo = 'Solo Boost';
			if( isDuo == 'duo' ) {
				duo = 'Duo Boost';
			}

			// Custom input
			// var current_rank = document.getElementById( 'current_rank' ).options[ document.getElementById( 'current_rank' ).selectedIndex ].value + ' ' + document.getElementById( 'current_division' ).options[document.getElementById( 'current_division' ).selectedIndex].value;
			// var desired_rank = document.getElementById( 'desired_rank' ).options[ document.getElementById( 'desired_rank' ).selectedIndex ].value + ' ' + document.getElementById( 'desired_division' ).options[document.getElementById( 'desired_division' ).selectedIndex].value;
			var order_account = document.getElementById( 'lol_account' ).value;
			var order_password = document.getElementById( 'lol_password' ).value;
			var order_type = document.getElementById( 'review_type' ).innerHTML;
			var order_server = document.getElementById( 'review_server' ).innerHTML; // Server
			var order_summoner = document.getElementById( 'lol_summonername' ).value; // Lol summoner
			var order_queue = document.getElementById( 'order_queue' ).options[ document.getElementById( 'order_queue' ).selectedIndex ].value; // Order Queue
			var order_flash = document.getElementById( 'order_flash' ).options[ document.getElementById( 'order_flash' ).selectedIndex ].value; // Flash

			// var notes = '';
			// if ( document.getElementById( 'offline_mode' ).checked ) {
			// 	notes += 'Appear Offline. \n';
			// }
			// if ( document.getElementById( 'summoner_spell' ).checked ) {
			// 	notes += 'Spell 1: '+ document.getElementById( 'select_spell1' ).value +' \n';
			// 	notes += 'Spell 2: '+ document.getElementById( 'select_spell2' ).value +' \n';
			// }
			// if ( document.getElementById( 'switch_role' ).checked ) {
			// 	notes += 'Specific Roles: '+ __CURRENT_ROLE.value +' \n';
			// 	notes += 'Specific Champions: '+ $( '#__select_champion' ).find( ':selected' ).val() +' \n';
			// }
			var notes = document.getElementById( 'booster_notes' ).value; // Notes

			var custom = order_type + '|' + '0' + '|' + duo + '|' + order_server + '|' + order_account + '|' + order_password + '|' + order_summoner + '|' + order_queue + '|' + order_flash + '|' + mail + '|' + notes;
			document.getElementById( 'custom' ).value = custom; // Send data

			$( '.payment_description' ).val( custom );

			// Prevent user and redirect him to paypal
			var payment_method = $( 'input[name="payment_method"]:checked' ).val();
			if ( payment_method === 'skrill' ) {
				$( '#paypal-form' ).attr( 'action', <?php echo json_encode( $skrill[ 'payment_url' ] ); ?> );
			}
			if ( payment_method === 'g2a' ) {
				$( '#paypal-form' ).attr( 'action', <?php echo json_encode( $g2a[ 'payment_url' ] ); ?> );
			}
			if ( payment_method === 'paypal' ) {
				$( '#paypal-form' ).attr( 'action', <?php echo json_encode( $paypal[ 'payment_url' ] ); ?> );
			}

			alert( 'After payment has been made, you will receive login information via your specified E-mail Address.' );
			document.getElementById( 'paypal-form' ).submit();
		} else {
			alert( 'Enter a correct E-mail Address please.' );
		}

	}
</script>

   </body>
</html>
