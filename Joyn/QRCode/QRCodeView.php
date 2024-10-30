<style>
    .qrcode-img {
        display: inline-block;
        vertical-align: middle;
        width: 120px;
        padding-right: 5px;
        overflow: hidden;
    }
    .text {
        display: inline-block;
        vertical-align: middle;
        overflow: hidden;
        float: right;
        flex: 1;
    }

    .qr-container {
        max-width: 500px;
        padding: 10px;
    }

    .logo {
        float: right;
        max-width: 100px !important;
    }
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid lightgray;
        border-radius: 15px;
    }
</style>
<br/>
<div style="width: 100%">
    <div class="qr-container center">
        <img class="qrcode-img" src="<?php echo wp_kses_post( $qr_code_url ); ?>" alt="joyn-loyaly-points-qrcode"/>
        <div class="text">
            <p><?php printf(esc_html( _n( 'Scan with the Joyn-app and earn %d point.', 'Scan with the Joyn-app and earn %d points.', $points, wp_joyn_wc_txt_domain()  )), $points ) ?></p>
            <?php printf(
                '<img src="%1$s" alt="Joyn logo" class="logo"/>',
                plugins_url( wp_joyn_wc_txt_domain() . '/assets/joyn-logo.png')
            ); ?>
        </div>
    </div>
</div>
<br/>