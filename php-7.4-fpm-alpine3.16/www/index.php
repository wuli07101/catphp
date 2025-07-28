<?php
echo "<h1>PHP 7.4 with CAT Monitoring</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server Time: " . date('Y-m-d H:i:s') . "</p>";

// 检查 CAT 扩展是否加载
if (extension_loaded('cat_hook')) {
    echo "<p style='color: green;'>✓ CAT Hook Extension is loaded</p>";
} else {
    echo "<p style='color: red;'>✗ CAT Hook Extension is NOT loaded</p>";
}

// 显示已加载的扩展
echo "<h2>Loaded Extensions:</h2>";
echo "<pre>" . print_r(get_loaded_extensions(), true) . "</pre>";

phpinfo();
?>