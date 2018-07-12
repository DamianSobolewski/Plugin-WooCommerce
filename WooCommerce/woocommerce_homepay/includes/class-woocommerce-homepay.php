<?php
if (! defined ( 'ABSPATH' ))
	exit ();
class WC_Gateway_Homepay extends WC_Payment_Gateway {
	public function __construct() {
		$this->id = 'homepay';
		$this->icon = apply_filters ( 'woocommerce_homepay_icon', plugins_url ( 'images/button.png', __FILE__ ) );
		$this->order_button_text = __ ( 'Zapłać z Homepay', 'woocommerce' );
		$this->method_description = sprintf ( __ ( 'Płatność wspierana przez Homepay' ) );
		$this->method_title = 'Homepay';
		$this->has_fields = true;
		$this->init_form_fields ();
		$this->init_settings ();
		$this->title = $this->get_option ( 'title' );
		$this->description = $this->get_option ( 'description' );
		$this->user_id = $this->get_option ( 'user_id' );
		$this->public_key = $this->get_option ( 'public_key' );
		$this->private_key = $this->get_option ( 'private_key' );
		
		add_action ( 'woocommerce_update_options_payment_gateways_' . $this->id, array (
				$this,
				'process_admin_options' 
		) );
		add_action ( 'woocommerce_api_wc_gateway_homepay', array (
				$this,
				'gateway_handler' 
		) );
	}
	function init_form_fields() {
		$this->form_fields = require ('form-fields.php');
	}
	function admin_options() {
		?>
<h2><?php _e('Homepay','homepay'); ?></h2>
<table class="form-table">
            <?php $this->generate_settings_html(); ?>
            </table>
<?php
	}
	function process_payment($order_id) {
		global $woocommerce;
		
		$order = new WC_Order ( $order_id );
		
		$totalamount = floatval ( preg_replace ( '#[^\d.]#', '', $woocommerce->cart->get_cart_total () ) );
		
		$website_url = home_url ( '/' );
		
		$order->update_status ( 'on-hold', __ ( 'Awaiting homepay payment', 'woocommerce' ) );
		
		return array (
				'result' => 'success',
				'redirect' => '' . $website_url . 'wc-api/WC_Gateway_Homepay?orderId=' . $order_id . '&amount=' . $totalamount 
		);
	}
	function gateway_handler() {
		global $woocommerce;
		
		$orderId = $_GET ["orderId"];
		
		$userid = $this->user_id;
		$publickey = $this->public_key;
		$privatekey = $this->private_key;
		
		$homepayPage = "https://homepay.pl/przelew/";
		
		$notifyPage = home_url ( '/wp-content/plugins/woocommerce_homepay/includes/notify.php' );
		
		$total = $this->get_order_total ();
		$data = array (
				'uid' => $userid,
				'public_key' => $publickey,
				'amount' => $total * 100,
				'mode' => 0,
				'control' => $orderId,
				'success_url' => urlencode ( home_url ( '/' ) ),
				'failure_url' => urlencode ( '' ),
				'notify_url' => urlencode ( $notifyPage ) 
		);
		$data ['crc'] = md5 ( join ( '', $data ) . $privatekey );
		
		?>

<form name="homepayform" method="post"
	action="<?php echo $homepayPage ?>">
		 <?php foreach ($data as $field => $value){ ?>
		<input type="hidden" name=<?php echo $field ?>
		value=<?php echo $value ?>>
		 <?php } ?>
	</form>

<script type="text/javascript">
                    document.homepayform.submit();
    </script>

<?php
		
		$woocommerce->cart->empty_cart ();
		
		exit ();
	}
}



















