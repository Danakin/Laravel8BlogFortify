<script src="{{ URL::to('js/tinymce/tinymce.min.js') }}"></script>
<script>
    const tinymce_config = {
        selector: 'textarea',
        plugins: 'advlist autolink lists link image code charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        width: '100%',
        image_advtab: true,
        images_upload_url: '/imgs',
    }
    tinymce.init(tinymce_config);
</script>

<?php
// Editors:
// https://alex-d.github.io/Trumbowyg/documentation/
// https://www.tiny.cloud/
// https://github.com/basecamp/trix
//
