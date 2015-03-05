<?php 
date_default_timezone_set('UTC');
register_shutdown_function( "fatal_handler" );
function fatal_handler() {
  $errfile = "unknown file";
  $errstr  = "shutdown";
  $errno   = E_CORE_ERROR;
  $errline = 0;
  $error = error_get_last();
  if( $error !== NULL) {
    $errno   = $error["type"];
    $errfile = $error["file"];
    $errline = $error["line"];
    $errstr  = $error["message"];
  } else {
      return;
  }
$ignore = E_WARNING | E_NOTICE | E_USER_WARNING | E_USER_NOTICE | E_STRICT | E_DEPRECATED | E_USER_DEPRECATED;
  
  if (($error['type'] & $ignore) == 0) {
     echo( format_error( $errno, $errstr, $errfile, $errline ) );
  }
   exit(1);
}
function format_error( $errno, $errstr, $errfile, $errline ) {
  $trace = print_r( debug_backtrace( false ), true );

  $content  = "<table><thead bgcolor='#c8c8c8'><th>Item</th><th>Description</th></thead><tbody>";
  $content .= "<tr valign='top'><td><b>Error</b></td><td><pre>$errstr</pre></td></tr>";
  $content .= "<tr valign='top'><td><b>Errno</b></td><td><pre>$errno</pre></td></tr>";
  $content .= "<tr valign='top'><td><b>File</b></td><td>$errfile</td></tr>";
  $content .= "<tr valign='top'><td><b>Line</b></td><td>$errline</td></tr>";
  $content .= "<tr valign='top'><td><b>Trace</b></td><td><pre>$trace</pre></td></tr>";
  $content .= '</tbody></table>';

  return $content;
}
?>
