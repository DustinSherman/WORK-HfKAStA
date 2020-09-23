<?php
ob_start();
?>
<script>
    /* Copyright 2014 Mozilla Foundation
     *
     * Licensed under the Apache License, Version 2.0 (the "License");
     * you may not use this file except in compliance with the License.
     * You may obtain a copy of the License at
     *
     *     http://www.apache.org/licenses/LICENSE-2.0
     *
     * Unless required by applicable law or agreed to in writing, software
     * distributed under the License is distributed on an "AS IS" BASIS,
     * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
     * See the License for the specific language governing permissions and
     * limitations under the License.
     */

    "use strict";

    if (!pdfjsLib.getDocument || !pdfjsViewer.PDFPageView) {
        alert("Please build the pdfjs-dist library using\n  `gulp dist-install`");
    }

    // The workerSrc property shall be specified.
    //
    pdfjsLib.GlobalWorkerOptions.workerSrc =
        "<?php echo get_template_directory_uri() ?>/assets/organigramm/vendor/pdfjs-dist/build/pdf.worker.js";

    // Some PDFs need external cmaps.
    //
    var CMAP_URL = "<?php echo get_template_directory_uri() ?>/assets/organigramm/vendor/pdfjs-dist/cmaps/";
    var CMAP_PACKED = true;

    var PAGE_TO_VIEW = 1;
    var DEFAULT_SCALE = 1.0;
    var CSS_UNITS = 96/72;

    var container = document.getElementById("pdf-container");

    var eventBus = new pdfjsViewer.EventBus();

    // Loading document.
    var loadingTask = pdfjsLib.getDocument({
      url: DEFAULT_URL,
      cMapUrl: CMAP_URL,
      cMapPacked: CMAP_PACKED,
    });

    loadingTask.promise.then(function (pdfDocument) {
        // Document loaded, retrieving the page.
        return pdfDocument.getPage(PAGE_TO_VIEW).then(function (pdfPage) {
            var viewport = pdfPage.getViewport({scale: DEFAULT_SCALE});
            var scale = container.clientWidth / (viewport.width * CSS_UNITS);
            // Creating the page view with default parameters.
            var pdfPageView = new pdfjsViewer.PDFPageView({
              container: container,
              id: PAGE_TO_VIEW,
              scale: scale,
              //defaultScaleValue = "page-width";
              defaultViewport: pdfPage.getViewport({ scale: scale }),
              eventBus: eventBus,
              // We can enable text/annotations layers, if needed
              textLayerFactory: new pdfjsViewer.DefaultTextLayerFactory(),
              annotationLayerFactory: new pdfjsViewer.DefaultAnnotationLayerFactory(),
            });
            // Associates the actual page with the view, and drawing it
            pdfPageView.setPdfPage(pdfPage);
            return pdfPageView.draw();
      });
    });

</script>
<?php
$pageviewer_js = ob_get_clean();

class HfK_Organigramm {
    static $pageviewer_js;
    static function init($pageviewer_js) {
        self::$pageviewer_js = $pageviewer_js;
        add_shortcode('organigramm', array(__CLASS__, 'handle_shortcode'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'register_script'));
    }
    static function handle_shortcode($atts) {
        if(empty($atts['pdf'])){
            return "<p><i>File missing. Use [organigramm pdf='http://..../name.pdf']</i></p>";
        }
        ob_start();
        get_template_part('template-parts/organigramm-viewer');
        echo "<script>var DEFAULT_URL = '" . $atts['pdf'] . "'</script>";
        return ob_get_clean() . self::$pageviewer_js;
    }
    static function register_script() {
        wp_enqueue_style('pdfjs-pageviewer-css', get_template_directory_uri() . '/assets/organigramm/css/pdf_viewer.css', $deps = array(), '1.0');
        wp_enqueue_script('pdfjs', get_template_directory_uri() . '/assets/organigramm/vendor/pdfjs-dist/build/pdf.js', $deps = array(), '1.0');
        wp_enqueue_script('pdfjs-viewer', get_template_directory_uri() . '/assets/organigramm/js/pdf_viewer.js', $deps = array(), '1.0');
    }
}
HfK_Organigramm::init($pageviewer_js);