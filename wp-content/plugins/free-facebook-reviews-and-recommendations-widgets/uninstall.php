<?php
require_once plugin_dir_path( __FILE__ ) . 'plugin-load.php';
$trustindex_pm_facebook = new TrustindexPlugin("facebook", __FILE__, "7.1", "Widgets for Social Reviews & Recommendations", "Facebook");
$trustindex_pm_facebook->uninstall();
?>