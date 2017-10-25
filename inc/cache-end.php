<?php
$fp = fopen( $cachefile, 'w' );
fwrite( $fp, sanitize_output( ob_get_contents() ) );
fclose( $fp );
ob_end_flush();
