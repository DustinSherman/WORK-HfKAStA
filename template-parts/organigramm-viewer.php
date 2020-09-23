<?php
add_action( 'wp_enqueue_scripts', 'pdf_viewer.css' );
add_action( 'wp_enqueue_scripts', 'pdf.js' );
add_action( 'wp_enqueue_scripts', 'pdf_viewer.js' );
add_action( 'wp_enqueue_scripts', 'pageviewer.js' );
?>

<div id="pdf-container" class="pdfViewer singlePageView"></div>