<?php //PWAタグ
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>

<?php if (
  !is_amp() &&
  is_pwa_enable() &&
  file_exists(get_theme_pwa_manifest_json_file()) &&
  file_exists(get_theme_pwa_service_worker_js_file())): ?>
<!-- PWA -->
<link rel="manifest" href="<?php echo get_theme_pwa_manifest_json_url(); ?>">
<script>
	document.addEventListener('DOMContentLoaded', function() {
		if ('serviceWorker' in navigator) {
			window.addEventListener('load', function() {
				navigator.serviceWorker.register('<?php echo get_theme_pwa_service_worker_js_url(); ?>').then(function(registration) {
					// Registration was successful
					console.log('ServiceWorker registration successful with scope: ', registration.scope);
				}, function(err) {
					// registration failed
					console.log('ServiceWorker registration failed: ', err);
				});
			});
		}
	}, false);
</script>
<!-- manifest.jsonのtheme_colorと同じ色を指定します -->
<meta name="theme-color" content="<?php echo get_pwa_theme_color(); ?>"/>

<!-- 以下はiOS用のコードです -->
<!-- ホーム画面に表示されるアプリ名 -->
<meta name="apple-mobile-web-app-title" content="<?php echo esc_attr(mb_substr(get_pwa_short_name(), 0, 12)); ?>">
<!-- URLバーの非表示 -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- ステータスバーのスタイル（default / black / black-translucent） -->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- アイコンの指定 -->
<link rel="apple-touch-icon-precomposed" href="<?php echo get_site_icon_url_l(); ?>" sizes="512x512">
<!-- /PWA -->
<?php endif; ?>
