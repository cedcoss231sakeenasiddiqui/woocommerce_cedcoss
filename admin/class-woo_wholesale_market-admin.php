<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://cedcoss.com/
 * @since      1.0.0
 *
 * @package    Woo_wholesale_market
 * @subpackage Woo_wholesale_market/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_wholesale_market
 * @subpackage Woo_wholesale_market/admin
 * @author     Cedcoss <cedcoss@gmail.com>
 */
class Woo_wholesale_market_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// $this->init_form_fields();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_wholesale_market_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_wholesale_market_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo_wholesale_market-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_wholesale_market_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_wholesale_market_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo_wholesale_market-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * add_settings_tab
	 * function for adding a section wholesale market on setting page of woocommerce
	 * @version 1.0.0
	 * @since 1.0.0
	 * @param  mixed $settings_tabs
	 * @return void
	 */
	public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['wholesale_market'] = __( ' Wholesale Market', 'woocommerce-settings-tab-demo' );
        return $settings_tabs;
    }  
    	
	/**
	 * output_sections
	 * for creating a section in wholesale market menu
	 * @version 1.0.0
	 * @version 1.0.0
	 * @return void
	 */
	public function output_sections() {
		global $current_section;
		$sections = array(''=>'General', 'section2'=>'Inventory');
		if ( empty( $sections ) || 1 === sizeof( $sections ) ) {
			return;
		}
		echo '<ul class="subsubsub">';
		$array_keys = array_keys( $sections );
		foreach ( $sections as $id => $label ) {
			echo '<li><a href="' . admin_url( 'admin.php?page=wc-settings&tab=wholesale_market&section=' . sanitize_title( $id ) ) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end( $array_keys ) == $id ? '' : '|' ) . ' </li>';
		}
		echo '</ul><br class="clear" />';
	}

	/**
	 * get_settings
	 * function for  section content
	 * @version 1.0.0
	 * @since 1.0.0
	 * @param  mixed $current_section
	 * @return void
	 */
	public function get_settings( $current_section = '' ) {
		
		if ( 'section2' == $current_section ) {
			$settings = apply_filters( 'myplugin_section2_settings', array(
					
				array(
					'name' => __( '', 'my-textdomain' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'myplugin_group1_options',
				),

				array(
					'title'         => __( 'Mininmum quantity setting', 'woocommerce' ),
					'desc'          => __( 'Enable min. qty setting for applying wholesale price', 'woocommerce' ),
					'id'            => 'woocommerce_cart_redirect_after_add',
					'default'       => 'no',
					'type'          => 'checkbox',
					'name'          => 'min_quantity_setting',
					
					'checkboxgroup' => 'start',
				),
				array(
					'title'    => __( 'Radio button for Set Min qty', 'woocommerce' ),
					'id'       => 'woocommerce_prices_include_tax',
					'default'  => 'no',
					'type'     => 'radio',
					'desc_tip' => __( 'This option is important as it will affect how you input prices. Changing it will not update existing products.', 'woocommerce' ),
					'options'  => array(
						'yes' => __( ' Set Min qty on product level ', 'woocommerce' ),
						'no'  => __( 'Set common min qty for all products', 'woocommerce' ),
						
					),
				),
				
				array(
					'id'         => 'wocommerce_text_inventory_input_field',
					'title'       => __( 'Set Quantity', 'woocommerce' ),
					'type'        => 'text',
					'label' => __( 'Address line 1', 'woocommerce' ),
					'desc_tip' => __( 'This option is important as it will affect how you input prices. Changing it will not update existing products.', 'woocommerce' ),
					'show'  => false,
				),

				array(
					'type' => 'sectionend',
					'id'   => 'myplugin_group2_options'
				),
					
			) );
					
		} else {
			$settings = apply_filters( 'myplugin_section1_settings', array(
				
				array(
					'name' => __( '', 'my-textdomain' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'myplugin_important_options',
				),

				array(
					'title'         => __( 'wholesale pricing setting', 'woocommerce' ),
					'desc'          => __( 'Enable wholesale price setting', 'woocommerce' ),
					'id'            => 'woocommerce_wholesale_id',
					'default'       => 'no',
					'type'          => 'checkbox',
					'name'          => 'wholesale_price_checkbox_backend',
					
					'checkboxgroup' => 'start',
				),
				array(
					'title'    => __( 'Wholesale Price', 'woocommerce' ),
					'id'       => 'woocommerce_prices_include_tax',
					'default'  => 'no',
					'type'     => 'radio',
					'desc_tip' => __( 'This option is important as it will affect how you input prices. Changing it will not update existing products.', 'woocommerce' ),
					'options'  => array(
						'yes' => __( ' Display wholesale price to all users', 'woocommerce' ),
						'no'  => __( 'Display wholesale price to only wholesale customer', 'woocommerce' ),
					),
				),

				array(
					'id'         => 'wocommerce_text_inventory_id',
					'title'       => __( 'Text with whole sale price', 'woocommerce' ),
					'type'        => 'text',
					'label' => __( 'Address line 1', 'woocommerce' ),
					'desc_tip' => __( 'This option is important as it will affect how you input prices. Changing it will not update existing products.', 'woocommerce' ),
					'show'  => false,
				),

				array(
					'type' => 'sectionend',
					'id'   => 'myplugin_important_options'
				),
				
			) );
				
		}
		return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );				
	}

	/**
	 * output
	 * function for showing content of sections
	 * @version 1.0.0
	 * @since 1.0.0
	 * @return void
	 */
	public function output() {
			
		global $current_section;
				
		$settings = $this->get_settings( $current_section );
		WC_Admin_Settings::output_fields( $settings );
	}

	/**
	 * save
	 * funtion for saving the values of sections 
	 * @version 1.0.0
	 * @since 1.0.0
	 * @return void
	 */
	public function save() {
        
		global $current_section;
				
		$settings = $this->get_settings( $current_section );
		WC_Admin_Settings::save_fields( $settings );
	}
		
	/**
	 * create_custom_field
	 * function for creating custom filed wholesale price
	 * @since 1.0.0
	 * @version 1.0.0
	 * @return void
	 */
	function create_custom_field() {
		$id = get_the_ID();	
		$meta = get_post_meta($id, 'custom_price_qty_key', false);
		foreach($meta as $key=>$value){
		$args = array(
		'id' => 'custom_text_field_title',
		'label' => __( 'Wholesale Price ', 'cfwc' ),
		'desc_tip' => true,
		'description' => __( 'Enter the wholesale price', 'ctwc' ),
		'value'       => $value['ws_price'],
		);
		woocommerce_wp_text_input( $args );
	   }
	}
		
	/**
	 * create_custom_field_quantity
	 * for creating a custom field quantity on product edit page
	 * @version 1.0.0
	 * @since 1.0.0
	 * @return void
	 */
	function create_custom_field_quantity() {
		
		$id = get_the_ID();
		$meta_result = get_post_meta($id, 'custom_price_qty_key', false);
		foreach($meta_result as $key=>$value){
		$args = array(
		'id' => 'custom_text_field_quantity',
		'label' => __( 'Minimum Qty', 'qty' ),
		'desc_tip' => true,
		'description' => __( 'Enter the Quantity', 'quantity' ),
		'value'       => $value['ws_quantity'],
		);
		woocommerce_wp_text_input( $args );
	  }
	}
	   
	/**
	* save_custom_field
	* function for saving the values of custom fileds 
	* @version 1.0.0
	* @since 1.0.0
	* @param  mixed $post_id
	* @return void
	*/
	function save_custom_field( $post_id ) {

		$product = wc_get_product( $post_id );
		$wholesale_price = isset( $_POST['custom_text_field_title'] ) ? $_POST['custom_text_field_title'] : '';
		$wholesale_qty = isset( $_POST['custom_text_field_quantity'] ) ? $_POST['custom_text_field_quantity'] : '';
		$response = array('ws_price' =>$wholesale_price, 'ws_quantity' => $wholesale_qty );
		$product->update_meta_data( 'custom_price_qty_key', $response);
		$product->save();
	}
  	
	/**
	 * bbloomer_add_new_user_column
	 * function for adding new user type wholesale customer
	 * @since 1.0.0
	 * @version 1.0.0
	 * @param  mixed $columns
	 * @return void
	 */
	function bbloomer_add_new_user_column( $columns ) {
		$columns['wholesale_customer'] = 'Wholesale Customer';
		return $columns;
	}
	    	
	/**
	 * bbloomer_add_new_user_column_content
	 * functio to show activate button for user applied for wholesale
	 * @version 1.0.0
	 * @since 1.0.0
	 * @param  mixed $value
	 * @param  mixed $column_name
	 * @param  mixed $user_id
	 * @return void
	 */
	function bbloomer_add_new_user_column_content( $value, $column_name, $user_id ) {

		$user = get_user_meta( $user_id, 'user_to_wholeseller_frontend',1);
		if($user == 'yes' && $column_name == 'wholesale_customer')
		{
		return 
		'<form method="POST"> <input type="submit" name="submit_the_button" id="submit_the_button" value="Make Wholeseller">
		<input type="hidden" name="user_id" value="'.$user_id.'"> </form>';
		}	
	}
	
	/**
	* make_normal_customer_a_wholesale_customer at backend
	* function to add checkbox at user edit
	* @version 1.0.0
	* @since 1.0.0
	* @return void
	*/
	function make_normal_customer_a_wholesale_customer()
	{
		?>
		 <table class="form-table">
		<tr class="user-syntax-highlighting-wrap">
		<th scope="row"><?php _e( 'Make User Wholeseller' ); ?></th>
		<td>
		<label for="wholeseller">
		<input name="user_to_wholeseller" type="checkbox" id="user_to_wholeseller" value="yes"/>
		<?php _e( 'Enable this to make user a wholesale customer' ); ?>
		</label>
		</td>
		</tr>
		</table>
		<?php
	}
			
	/**
	 * wk_save_custom_user_profile_fields
	 * function to save value of checkbox wholeseller
	 * @since 1.0.0
	 * @version 1.0.0
	 * @param  mixed $user_id
	 * @return void
	 */
	function wk_save_custom_user_profile_fields( $user_id )
	{		
		$custom_data = $_POST['user_to_wholeseller'];
		update_user_meta( $user_id, 'user_to_wholeseller', $custom_data );
		
	}

	/**
	 * bbloomer_add_custom_field_to_variations
	 * funtion for variation wholesale price
	 * @param  mixed $loop
	 * @param  mixed $variation_data
	 * @param  mixed $variation
	 * @return void
	 */
	function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
		woocommerce_wp_text_input( array(
	    'id' => 'wholesale_custom_field[' . $loop . ']',
	 	'label' => __( 'Wholesale Price', 'woocommerce' ),
	 	'value' => get_post_meta( $variation->ID, 'wholesale_custom_field', true )
		) );	
	}
	  	  	 
	/**
	* bbloomer_save_custom_field_variations
	* function for value into postmeta 
	* @version 1.0.0
	* @since 1.0.0
	* @param  mixed $variation_id
	* @param  mixed $i
	* @return void
	*/
	function bbloomer_save_custom_field_variations( $variation_id, $i ) {
		$custom_field = $_POST['wholesale_custom_field'][$i];
		if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'wholesale_custom_field', esc_attr( $custom_field ) );
	 }
	  
	/**
	* bbloomer_add_custom_field_variation_data
	* Store custom field value into variation data
	* @version 1.0.0
	* @since 1.0.0
	* @param  mixed $variations
	* @return void
	*/
	function bbloomer_add_custom_field_variation_data( $variations ) {
		$variations['custom_field'] = '<div class="woocommerce_custom_field">Custom Field: <span>' . get_post_meta( $variations[ 'variation_id' ], 'wholesale_custom_field', true ) . '</span></div>';
		return $variations;
	}

	/**
	 * bbloomer_add_custom_field_to_variations
	 *funtion for quantity
	 * @param  mixed $loop
	 * @param  mixed $variation_data
	 * @param  mixed $variation
	 * @return void
	 */
	function add_quantity_to_variations( $loop, $variation_data, $variation ) {
		woocommerce_wp_text_input( array(
	    'id' => 'quantity_custom_field[' . $loop . ']',
	    'label' => __( 'Minimum Qty', 'woocommerce' ),
	    'value' => get_post_meta( $variation->ID, 'quantity_custom_field', true )
		));	
	}
 	  	 
	/**
	* save_quantity_field_variations
	*Save custom field on product variation save
	* @since  1.0.0
	* @version 1.0.0
	* @param  mixed $variation_id
	* @param  mixed $i
	* @return void
	*/
	function save_quantity_field_variations( $variation_id, $i ) {
		$custom_field = $_POST['quantity_custom_field'][$i];
		if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'quantity_custom_field', esc_attr( $custom_field ) );
	}
	  
	/**
	 * add_quantity_field_variation_data
	 *  Store custom field value into variation data
	 * @version 1.0.0
	 * @since 1.0.0
	 * @param  mixed $variations
	 * @return void
	 */
	function add_quantity_field_variation_data( $variations ) {
		$variations['custom_field'] = '<div class="woocommerce_custom_field">Custom Field: <span>' . get_post_meta( $variations[ 'variation_id' ], 'quantity_custom_field', true ) . '</span></div>';
		return $variations;
	}
			 
	/**
	* make_customer
	* for creating checkbox at front end register page
	*@since 1.0.0
    *@version 1.0.0
	* @return void
	*/
	function make_customer()
	{
	 	?>
		<table class="form-table">
	 	<tr class="user-syntax-highlighting-wrap">
	 	<td>
	 	<label for="wholeseller">
	 	<input name="user_to_wholeseller_frontend" type="checkbox" id="user_to_wholeseller_frontend" value="yes"/>
	 	<?php _e( 'Enable this to make user a wholesale customer' ); ?>
	 	</label>
	 	</td>
	 	</tr>
	 	</table>
	 	<?php
	}
 	
	/**
	 * wk_save_fields
	 * save value of checkbox at frontend 
	 * @version 1.0.0
	 * @since 1.0.0
	 * @param  mixed $user_id
	 * @return void
	 */
	function wk_save_fields( $user_id )
	{	 
	    $custom_data = $_POST['user_to_wholeseller_frontend'];
		update_user_meta( $user_id, 'user_to_wholeseller_frontend', $custom_data );
	}
       
    /**
    * xx__update_custom_roles
    * funtion to add user role wholeseller
	* @version 1.0.0
	* @since 1.0.0
    * @return void
    */
    function xx__update_custom_roles(){
		$result = add_role( 'client', __(
		'Wholeseller' ),			
		array(			
		'read' => true, // true allows this capability
		'edit_posts' => true, // Allows user to edit their own posts
		'edit_pages' => true, // Allows user to edit pages
		'edit_others_posts' => true, // Allows user to edit others posts not just their own
		'create_posts' => true, // Allows user to create new posts
		'manage_categories' => true, // Allows user to manage post categories
		'publish_posts' => true,
		'id'             => 'whole_seller', // Allows the user to publish, otherwise posts stays in draft mode	
		));
	}
				
	/**
	 * shop_loop_make_surplus_price_always_visible
	 * show wholesale price on front end for simple product and wholesale user
	 * @since 1.0.0
	 * @version 1.0.0
	 * @return void
	 */
	function shop_loop_make_surplus_price_always_visible(){
		$user_id = get_current_user_id();
		$result = get_option('woocommerce_wholesale_id', false);
		if($result == 'yes')
		{
		   	$response = get_option('woocommerce_prices_include_tax', false);
			if($response == 'no')
			{
				$user = wp_get_current_user();
				if ( in_array( 'client', (array) $user->roles ) ) 
				{
					if(is_user_logged_in())
					{
						global $product;
						$id = $product->get_id();	
						$res = $product->get_type();
						if($res == 'simple')
						{
							$meta = get_post_meta($id, 'custom_price_qty_key', true);
							$wholesale_price_simple = $meta['ws_price'];
							echo '<div class="product-meta" style="color:green";>Wholesale Price: ' . $meta['ws_price'] . '</div>';	
						}	
					}
				}			
			}else{
				$res = get_option('woocommerce_prices_include_tax', false);
				if($res == 'yes')
				{
					global $product;
					$id = $product->get_id();	
					$res = $product->get_type();
					if($res == 'simple')
					{
						$meta = get_post_meta($id, 'custom_price_qty_key', true);
						$wholesale_price_simple = $meta['ws_price'];
						echo '<div class="product-meta" style="color:green";>Wholesale Price: ' . $meta['ws_price'] . '</div>';	
					}
				}
			}
		}	
	}
	
	/**
	* single_product_make_surplus_price_always_visible
	* show wholesale price to a simple product and summary page 
	* @since 1.0.0
	* @version 1.0.0
	* @return void
	*/
	function single_product_make_surplus_price_always_visible(){
		$user_id = get_current_user_id();
		$result = get_option('woocommerce_wholesale_id', false);
		if($result == 'yes')
		{
		   	$response = get_option('woocommerce_prices_include_tax', false);
			if($response == 'no')
			{
				$user = wp_get_current_user();
				if ( in_array( 'client', (array) $user->roles ) ) 
				{
					if(is_user_logged_in())
					{
						global $product;
						$id = $product->get_id();	
						$res = $product->get_type();
						if($res == 'simple')
						{
							$meta = get_post_meta($id, 'custom_price_qty_key', true);
							$wholesale_price_simple = $meta['ws_price'];
							echo '<div class="product-meta" style="color:green";>Wholesale Price: ' . $meta['ws_price'] . '</div>';	
						}	
					}
				}			
			}else{
				$res = get_option('woocommerce_prices_include_tax', false);
				if($res == 'yes')
				{
					global $product;
					$id = $product->get_id();	
					$res = $product->get_type();
					if($res == 'simple')
					{
						$meta = get_post_meta($id, 'custom_price_qty_key', true);
						$wholesale_price_simple = $meta['ws_price'];
						echo '<div class="product-meta" style="color:green";>Wholesale Price: ' . $meta['ws_price'] . '</div>';	
					}
				}
			}
		}	
	}
	
	/**
	* profile_update_user_role
	* function for making customera a wholeseller
	* @version 1.0.0
	* @since 1.0.0
	* @return void
	*/
	function profile_update_user_role()
	{
		if(isset($_REQUEST['submit_the_button']))
		{
		$user_id = $_REQUEST['user_id'];
		$var = new WP_User( $user_id );	
		$var->set_role('client');
		update_user_meta( $user_id, 'user_to_wholeseller_frontend', '');
		}
	}
	
	/**
	 * shop_loop_for_variation_product
	 * @since 1.0.0
	 * @version 1.0.0
	 * @param  mixed $description
	 * @param  mixed $product
	 * @param  mixed $variation
	 * @return void
	 */
	function shop_loop_for_variation_product($description, $product, $variation)
	{
		$user_id = get_current_user_id();
		$result = get_option('woocommerce_wholesale_id', false);
		if($result == 'yes')
		{
		   	$response = get_option('woocommerce_prices_include_tax', false);
			if($response == 'no')
			{
				$user = wp_get_current_user();
				if ( in_array( 'client', (array) $user->roles ) ) 
				{
					if(is_user_logged_in())
					{
						global $product;
						$id = $product->get_id();
						$res = $product->get_type();
						if($res == 'variable')
						{
							$description['price_html'] = '<div class="product-meta" style="color:green";>Wholesale Price:'.get_post_meta($description['variation_id'], 'wholesale_custom_field', true);
						}
					}
				}
			}else{
				$res = get_option('woocommerce_prices_include_tax', false);
				if($res == 'yes')
				{
					global $product;
					$id = $product->get_id();	
					$res = $product->get_type();
					if($res == 'variable')
					{
						$description['price_html'] = '<div class="product-meta" style="color:green";>Wholesale Price:'.get_post_meta($description['variation_id'], 'wholesale_custom_field', true);
					}
				}
			}
		}
		return $description;
	}

 function cart_recalculate_price() {		
		global $woocommerce;
		$items = $woocommerce->cart->get_cart();		
        foreach($items as $item => $values) { 
			$id = $values['product_id'];	
            $_product =  wc_get_product( $values['data']->get_id()); 
			$res = $values['quantity'];
            $price = get_post_meta($values['product_id'] , '_price', true);
			$result = get_post_meta($id, 'custom_price_qty_key', false);
			foreach($result as $key=>$value){
			$response = $value['ws_quantity'];
			$val = $value['ws_price'];
			if($res > $response)
			{
				$values['data']->set_price( floatval( $val) );
			}		
			}
		} 
	}

	







				
		

	   
	






	

	


	 
	

	


}
