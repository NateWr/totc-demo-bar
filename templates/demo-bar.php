<style type="text/css">
	body {
		padding-top: 40px !important;
	}

	.totc-demo-bar {
		position: fixed;
		top: 0;
		width: 100%;
		height: 40px;
		overflow: hidden;
		background: #222;
		z-index: 9999;
	}

	.totcdb-logo img {
		display: block;
		float: left;
		width: auto;
		height: 30px;
		margin: 5px 20px;
	}

	.totcdb-button {
		display: block;
		position: absolute;
		right: 0;
		top: 0;
		height: 40px;
		padding-left: 20px;
		padding-right: 20px;
		line-height: 40px;
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
</style>
<div id="totcdb" class="totc-demo-bar">
	<a class="totcdb-logo" href="<?php echo esc_url( $this->store_url ); ?>">
		<img src="<?php echo esc_url( self::$plugin_url . '/assets/img/logo-white-390x60.png' ); ?>" alt="<?php echo esc_html( $this->store_name ); ?>">
	</a>
	<a class="totcdb-button" href="<?php echo esc_url( $this->store_url . '?edd_action=add_to_cart&download_id=' . absint( $this->download_id ) ) ?>">Buy Now</a>
</div>
