<style>
    .button-as-text {
        background:none;
        border:none;
        margin:0;
        padding:0;
        cursor: pointer;
    }

    #domain-name {
        display: block;
        position: absolute;
        cursor: pointer;
        color: blue;
        text-underline: blue;
    }
    #domain-name:before {
        content: '';
        display: none;
        position: absolute;
        z-index: 9998;
        top: 35px;
        left: 15px;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 5px solid rgba(0, 0, 0, .72);
    }
    #domain-name:after {
        content: 'Copy to Clipboard';
        display: none;
        position: absolute;
        z-index: 9999;
        top: 40px;
        left: -37px;
        width: 114px;
        height: 36px;
        color: #fff;
        font-size: 10px;
        line-height: 36px;
        text-align: center;
        background: rgba(0, 0, 0, .72);
        border-radius: 3px;
    }
    #domain-name:hover {
        background-color: #eee;
    }
    #domain-name:hover:before, #domain-name:hover:after {
        display: block;
    }
    #domain-name:active, #domain-name:focus {
        outline: none;
    }
    #domain-name:active:after, #domain-name:focus:after {
        content: 'Copied!';
    }

</style>
<h1><?php esc_html_e("Joyn loyalty", wp_joyn_wc_txt_domain()) ?></h1>
<p><?php esc_html_e("With Joyn's loyalty programme, your customers enjoy unique advantages and with each one of their purchases, they'll save points for cool rewards and extra discounts.", wp_joyn_wc_txt_domain()) ?></p>
<p><?php esc_html_e("Install the Joyn for WooCommerce plug-in so your customers can save points when shopping in your WooCommerce webshop.", wp_joyn_wc_txt_domain()) ?></p>
<p>
    <?php esc_html_e("Generate your unique integration code on the Joyn Merchant Portal and enter it on this page to link your webshop to your Joyn account.", wp_joyn_wc_txt_domain()) ?><br/>
    <?php esc_html_e("Next, copy the below web domain and enter it on the Joyn Merchant Portal.", wp_joyn_wc_txt_domain()) ?>
</p>
<form method="post" action="options.php">
    <?php settings_fields('joyn_plugin_settings'); ?>
    <?php do_settings_sections('joyn_plugin_settings'); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php esc_html_e("Domain name", wp_joyn_wc_txt_domain()) ?>:</th>
            <td><button type="button" id="domain-name" class="button-as-text" onclick="copyToClipboard()"><?php echo wp_joyn_wc_get_domain_name(); ?></button></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php esc_html_e("API token", wp_joyn_wc_txt_domain()) ?>:</th>
            <td><input type="text" name="joyn_api_key" value="<?php echo esc_attr(get_option('joyn_api_key')); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php esc_html_e("Show QR on thank you page", wp_joyn_wc_txt_domain()) ?>:</th>
            <td><input type="checkbox" name="joyn_show_on_thankyou" value="1" <?php checked( 1, esc_attr(get_option('joyn_show_on_thankyou')), true ); ?> /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php esc_html_e("Show QR on order", wp_joyn_wc_txt_domain()) ?>:</th>
            <td><input type="checkbox" name="joyn_show_on_order" value="1" <?php checked( 1, esc_attr(get_option('joyn_show_on_order')), true ); ?> /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php esc_html_e("Show QR in mail", wp_joyn_wc_txt_domain()) ?>:</th>
            <td><input type="checkbox" name="joyn_show_in_mail" value="1" <?php checked( 1, esc_attr(get_option('joyn_show_in_mail')), true ); ?> /></td>
        </tr>
    </table>
    <?php submit_button(__('Save Changes', wp_joyn_wc_txt_domain())); ?>
</form>
<script>
    function copyToClipboard() {
        let element = document.getElementById("domain-name");
        let text = element.innerText;
        navigator.clipboard.writeText(text)
    }
</script>