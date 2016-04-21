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
		transform: translateX(80%);
		transition: transform 0.3s;
	}

	.totc-demo-bar.arrive {
		transform: translateX(0);
	}

	.totc-demo-bar.initial {
		transform: translateX(110%);
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
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var totcdb = $( '#totcdb' );
		setTimeout( function() {
			totcdb.removeClass( 'initial' );
			totcdb.addClass( 'arrive' );
		}, 2000 );
		totcdb.click( function(e) {
			if ( $( e.target ).hasClass( 'totcdb-button' ) ) {
				$( e.target ).attr( 'disabled', 'disabled' );
				return;
			}
			if ( $(this).hasClass( 'arrive' ) ) {
				$(this).removeClass( 'arrive' );
			} else {
				$(this).addClass( 'arrive' );
			}
		} );
	} );
</script>
<div id="totcdb" class="totc-demo-bar initial">
	<a class="totcdb-logo" href="<?php echo esc_url( $this->store_url ); ?>">
		<img src="<?php echo esc_url( self::$plugin_url . '/assets/img/logo-white-390x60.png' ); ?>" alt="<?php echo esc_html( $this->store_name ); ?>">
	</a>
	<div class="totcdb-body">
		<p><strong>30-day money-back guarantee.</strong></p>
	</div>
	<div class="totcdb-footer">
		<a class="totcdb-button" href="<?php echo esc_url( $this->store_url . '?edd_action=add_to_cart&download_id=' . absint( $this->download_id ) ) ?>">Buy Now</a>
	</div>
</div>
