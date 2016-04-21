<?php
/**
 * Add a setting to Simple Admin Pages to select an EDD Product
 *
 * This class is modelled on AdminPageSetting.class.php in the Simple
 * Admin Pages library. It should work just like an extended class, but
 * due to the way the library embeds the version into the class name,
 * that could cause problems if the library is updated in the parent
 * plugin.
 *
 * See: https://github.com/NateWr/simple-admin-pages
 */
if ( class_exists( 'sapAdminPageSetting_2_0' ) ) {

	class totcdbAdminPageSettingEDDProduct extends sapAdminPageSetting_2_0 {

		/**
		* URL to your EDD store
		*
		* @see config.php
		* @since 0.1
		*/
		public $store_url = '';

		/**
		* EDD API Public Key
		*
		* @see config.php
		* @since 0.1
		*/
		public $public_key = '';

		/**
		* EDD API Token
		*
		* @see config.php
		* @since 0.1
		*/
		public $token = '';

		/**
		 * Array of downloads
		 *
		 * null if not yet fetched
		 *
		 * @since 0.1
		 */
		public $downloads = null;

		/**
		 * Function to use when sanitizing the data
		 *
		 * @since 0.1
		 */
		public $sanitize_callback = 'absint';

		/**
		 * Escape the value to display it in text fields and other input fields
		 *
		 * @since 0.1
		 */
		public function esc_value( $val ) {
			return absint( $val );
		}

		/**
		 * Display this setting
		 *
		 * @since 0.1
		 */
		public function display_setting() {

			$downloads = $this->get_downloads();
			?>
				<select name="<?php echo esc_attr( $this->get_input_name() ); ?>" id="<?php echo esc_attr( $this->id ); ?>">
					<option></option>
					<?php foreach( $downloads as $id => $name ) : ?>
						<option value="<?php echo absint( $id ); ?>"<?php if ( $this->value == $id ) : ?> selected="selected"<?php endif; ?>><?php esc_attr_e( $name ); ?></option>
					<?php endforeach; ?>
				</select>
			<?php

			$this->display_description();
		}

		/**
		 * Retrieve the downloads
		 *
		 * @since 0.1
		 */
		public function get_downloads( $refresh = false ) {

			if ( !$refresh && !is_null( $this->downloads ) ) {
				return $this->downloads;
			}

			$url = add_query_arg(
				array(
					'key' => $this->public_key,
				 	'token' => $this->token,
				),
				trailingslashit( $this->store_url ) . 'edd-api/products/'
			);
			$response = wp_remote_get( $url );

			if ( empty( $response['body'] ) ) {
				return array();
			}

			$products = json_decode( $response['body'] );
			$downloads = array();
			foreach( $products->products as $product ) {
				$downloads[ $product->info->id ] = $product->info->title;
			}

			$this->downloads = $downloads;

			return $this->downloads;
		}
	}
}
