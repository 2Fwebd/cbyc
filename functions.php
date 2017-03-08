<?php
Class CbyC
{

    /**
     * @var string
     */
    static $facebook_slug = "kdiamondk";

    /**
     * CbyC constructor.
     */
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_assets') );
        add_filter( 'comments_open',  array($this, 'deactivate_comment') );
    }

    /**
     * Enqueue Stylesheet
     */
    public function enqueue_assets() {

        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_script( 'customScrollbar', get_stylesheet_directory_uri() . '/js/customScrollbar.js', array ( 'jquery' ), 1.1, true);

    }

    /**
     * Deactivate the comments to let the Facebook comments
     */
    public function deactivate_comment(){

        if(is_singular('post')) {
            return false;
        }

    }

    /**
     * Render Logo
     */
    static function renderLogo() {

        ?>

        <div class="site-branding">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.jpg" alt="<?php _e('Logo CbyC', 'cbyc'); ?>">
            </a>
        </div>

        <?php

    }

    /**
     * Render Facebook script after body tag opening
     */
    static function renderFacebookScript() {

        ?>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=759527620890146";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <?php

    }

    /**
     * Render Facebook Module
     *
     * @link https://developers.facebook.com/docs/plugins/page-plugin
     */
    static function renderFacebook() {

        ?>

        <div class="fb-page"
             data-href="https://www.facebook.com/<?php echo self::$facebook_slug; ?>/"
             data-width="300" data-small-header="true"
             data-adapt-container-width="true"
             data-hide-cover="false"
             data-show-facepile="false">
            <blockquote cite="https://www.facebook.com/<?php echo self::$facebook_slug; ?>/" class="fb-xfbml-parse-ignore">
                <a href="https://www.facebook.com/<?php echo self::$facebook_slug; ?>/">
                    <?php echo get_bloginfo('name'); ?>
                </a>
            </blockquote>
        </div>

        <?php

    }


}
new CbyC();
