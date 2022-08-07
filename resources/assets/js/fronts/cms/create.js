'use strict';

$(document).ready(function () {
    $('#shortDescription').on('keyup', function () {
        $('#shortDescription').attr('maxlength', 800);
    });
    $('#shortDescription').attr('maxlength', 800);

    let quill1 = new Quill('#termConditionId', {
        modules: {
            toolbar: [
                [
                    {
                        header: [1, 2, false],
                    }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block'],
            ],
        },
        placeholder: 'Terms & Conditions',
        theme: 'snow', // or 'bubble'
    });
    quill1.on('text-change', function (delta, oldDelta, source) {
        if (quill1.getText().trim().length === 0) {
            quill1.setContents([{ insert: '' }]);
        }
    });

    let quill2 = new Quill('#privacyPolicyId', {
        modules: {
            toolbar: [
                [
                    {
                        header: [1, 2, false],
                    }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block'],
            ],
        },
        placeholder: 'Privacy Policy',
        theme: 'snow', // or 'bubble'
    });
    quill2.on('text-change', function (delta, oldDelta, source) {
        if (quill2.getText().trim().length === 0) {
            quill2.setContents([{ insert: '' }]);
        }
    });

    let element = document.createElement('textarea');
    element.innerHTML = termConditionData;
    quill1.root.innerHTML = element.value;

    element.innerHTML = privacyPolicyData;
    quill2.root.innerHTML = element.value;

    $(document).on('submit', '#addCMSForm', function () {
        let title = $('#aboutTitleId').val();
        let empty = title.trim().replace(/ \r\n\t/g, '') === '';
        let description = $('#shortDescription').val();
        let empty2 = description.trim().replace(/ \r\n\t/g, '') === '';

        if (empty) {
            displayErrorMessage(
                'About Title field is not contain only white space');
            return false;
        }

        if (empty2) {
            displayErrorMessage(
                'About Short Description field is not contain only white space');
            return false;
        }

        if ($('#aboutExperience').val() === '') {
            displayErrorMessage('About Experience field is required.');
            return false;
        }

        let element = document.createElement('textarea');
        let editor_content_1 = quill1.root.innerHTML;
        element.innerHTML = editor_content_1;
        let editor_content_2 = quill2.root.innerHTML;

        if (quill1.getText().trim().length === 0) {
            displayErrorMessage('The Terms & Conditions is required.');
            return false;
        }

        if (quill2.getText().trim().length === 0) {
            displayErrorMessage('The Privacy Policy is required.');
            return false;
        }

        $('#termData').val(JSON.stringify(editor_content_1));
        $('#privacyData').val(JSON.stringify(editor_content_2));

    });
});
