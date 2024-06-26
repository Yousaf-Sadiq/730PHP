(function ($) {
    "use strict";
    // Text editor
    tinymce.init({
        selector: '#tinymce_simple_textarea',
        toolbar: 'undo redo blockquote blocks bold italic alignleft aligncenter alignright outdent indent code anchor link restoredraft charmap codesample ltr rtl emoticons fullscreen help image insertdatetime lists media nonbreaking pagebreak preview save searchreplace visualblocks visualchars wordcount accordion print',
        toolbar_mode: 'wrap',
        plugins: ['code', 'table', 'lists', 'anchor', 'autolink', "autosave", "charmap", "codesample", "directionality", "emoticons", "fullscreen", "help", "image", "importcss", "insertdatetime", "visualblocks", "visualchars", "wordcount", "accordion"],
        link_default_target: '_blank',
        quickbars_insert_toolbar: false,
        height: "300"
    });

})(jQuery);