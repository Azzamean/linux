<?php
echo "Running regenerate thumbnails on Multisite... \n";

if ( ! empty( $_ENV['PANTHEON_ENVIRONMENT'] ) ) {
  switch( $_ENV['PANTHEON_ENVIRONMENT'] ) {
    case 'dev':
	  passthru('terminus wp lfprojects3.dev -- media regenerate --url="dev-lfprojects3.linuxfoundation.org" ');
	  passthru('terminus wp lfprojects3.dev -- media regenerate --url="interuss.dev-lfprojects3.linuxfoundation.org" ');
      break;
  }
}
?>