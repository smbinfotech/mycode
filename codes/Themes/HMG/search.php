<?php
if(isset($_GET['search-type'])) {
    $type = $_GET['search-type'];
    if($type == 'fullsite') {
        load_template(TEMPLATEPATH . '/site-search.php');
    } elseif($type == 'blog') {
        load_template(TEMPLATEPATH . '/blog-search.php');
    }
}
?>
