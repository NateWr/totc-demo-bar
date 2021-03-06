<style type="text/css">
	.totc-demo-bar {
		position: fixed;
		top: 100px;
		right: 0;
		width: 200px;
		background: #333;
		border-top-left-radius: 4px;
		border-bottom-left-radius: 4px;
		text-align: center;
		z-index: 99999;
		box-shadow: 0 0 10px rgba(0,0,0,0.3);
		transform: translateX(90%);
		transition: transform 0.3s;
	}

	.totcdb-close,
	.totcdb-open {
		display: block;
		position: absolute;
		top: 0;
		left: -10px;
		height: 38px;
		line-height: 38px;
		font-size: 18px;
		padding: 0 0.5em;
		color: rgba(255,255,255,0.8);
		text-decoration: none;
		background: #555;
		border-radius: 4px;
	}

	.totcdb-close {
		display: none;
	}

	.totc-demo-bar.open {
		transform: translateX(0);
	}

	.totc-demo-bar.initial {
		transform: translateX(110%);
	}

	.totc-demo-bar.open .totcdb-close {
		display: block;
	}

	.totc-demo-bar.open .totcdb-open {
		display: none;
	}

	.totcdb-logo {
		display: block;
		width: 100%;
		padding: 10px;
		background:  #444;
		border-top-left-radius: 4px;
	}

	.totcdb-logo img {
		display: block;
		width: 65%;
		height: auto;
		margin: 0 auto;
	}

	.totcdb-body {
		padding: 10px;
		font-size: 12px;
		font-weight: 400;
		line-height: 20px;
		color: #fff;
	}

	.totcdb-body p {
		margin: 1em 0;
	}

	.totcdb-body p:first-child {
		margin-top: 0;
	}

	.totcdb-body p:last-child {
		margin-bottom: 0;
	}

	.totcdb-footer {
		padding: 5px;
		text-align: center;
	}

	.totcdb-button {
		display: block;
		height: 30px;
		padding-left: 1em;
		padding-right: 1em;
		line-height: 30px;
		border-radius: 3px;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 18px;
		font-weight: 600;
		text-transform: uppercase;
		text-decoration: none;
		background: #d2bc2b;
		color: #000;
	}

	.totcdb-button:hover,
	.totcdb-button:focus {
		color: #000;
		background: #EFD94E;
	}

	.totcdb-button[disabled] {
		background: #bbb;
		color:  #555;
		cursor: progress;
	}
</style>
<div id="totcdb" class="totc-demo-bar initial">
	<a class="totcdb-close" href="#">&rarr;</a>
	<a class="totcdb-open" href="#">&larr;</a>
	<a class="totcdb-logo" href="<?php echo esc_url( $this->store_url ); ?>">
		<img src="<?php echo esc_url( self::$plugin_url . '/assets/img/logo-white-390x60.png' ); ?>" alt="<?php echo esc_html( $this->store_name ); ?>">
	</a>
	<div class="totcdb-body">
		<p><strong>30-day money-back guarantee.</strong></p>
	</div>
	<div class="totcdb-footer">
		<?php
			// Compile the buy button
			$url = add_query_arg(
				array(
					'buy_now' => 1
				),
				$this->product_url
			);

			// Add affiliate referral link
			if ( !empty( $this->affiliate_referral ) ) {
				$url = add_query_arg( 'ref', $this->affiliate_referral, $url );
			}

			// Add campaign tracking
			if ( !empty( $this->campaign_medium ) ) {
				$url = add_query_arg(
					array(
						'utm_source' => urlencode( 'Theme Demo' ),
						'utm_medium' => urlencode( $this->campaign_medium ),
						'utm_campaign' => urlencode( 'Demo Bar - Buy Button' ),
					),
					$url
				);
			}
		?>
		<a class="totcdb-button" href="<?php echo esc_url( $url ) ?>">Buy Now</a>
	</div>
</div>
<script type="text/javascript">
	var totcdb = document.getElementById('totcdb');
	setTimeout( function() {
		totcdb.className = 'totc-demo-bar open';
	}, 2000 );
	totcdb.onclick = function(e) {
		if ( e.target.className == 'totcdb-close' ) {
			totcdb.className = 'totc-demo-bar';
		} else if ( e.target.className = 'totcdb-open' ) {
			totcdb.className = 'totc-demo-bar open';
		}
	};
</script>
