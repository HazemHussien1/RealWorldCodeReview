
if ( true == SWP_Utility::debug('load_options') ) {
    if (!is_admin()) {
        wp_die('You do not have authorization to view this page.');
}

$options = file_get_contents($_GET['swp_url'] . '?swp_debug=get_user_options');
$options = str_replace('<pre>', '', $options);
$cutoff = strpos($options, '</pre>');
$options = substr($options, 0, $cutoff);

$array = 'return ' . $options . ';';

try {
    $fetched_options = eval( $array );
}
