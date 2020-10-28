<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ URL::to('js/tinymce/tinymce.min.js') }}"></script>
<script>
    function image_upload_handler (blobInfo, success, failure, progress) {
        // https://www.tiny.cloud/docs/general-configuration-guide/upload-images/#images_upload_handler
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/images');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

        xhr.upload.onprogress = function (e) {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = function() {
            var json;

            if (xhr.status === 403) {
                failure('HTTP Error: ' + xhr.status, { remove: true });
                return;
            }

            if (xhr.status < 200 || xhr.status>= 300) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.url != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            console.log(json);

            success(json.url);
        };

        xhr.onerror = function () {
            failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        formData = new FormData();
        formData.append('image', blobInfo.blob(), blobInfo.filename());
        formData.append('post_id', {{ $post->id}} );

        xhr.send(formData);
    };

    const tinymce_config = {
        selector: 'textarea',
        plugins: 'advlist autolink lists link image codesample charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        width: '100%',
        image_advtab: true,
        images_upload_url: '/images',
        images_upload_handler: image_upload_handler
    }

    tinymce.init(tinymce_config);
</script>

<?php
// Editors:
// https://alex-d.github.io/Trumbowyg/documentation/
// https://www.tiny.cloud/
// https://github.com/basecamp/trix
//
?>
