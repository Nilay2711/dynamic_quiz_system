import 'bootstrap';

import jQuery from 'jquery';

window.$ = jQuery;
window.jQuery = jQuery;

/*
|--------------------------------------------------------------------------
| Question Dynamic UI
|--------------------------------------------------------------------------
*/

$(document).ready(function () {

    let optionIndex = 0;

    /*
    |--------------------------------------------------------------------------
    | Handle Question Type Change
    |--------------------------------------------------------------------------
    */

    $('#questionType').on('change', function () {

        let type = $(this).val();

        /*
        Show options only for MCQ types
        */

        if (
            type === 'single_choice' ||
            type === 'multiple_choice'
        ) {

            $('#optionsContainer').show();

            $('#correctAnswerContainer').hide();

        } else {

            $('#optionsContainer').hide();

            $('#correctAnswerContainer').show();

            $('#optionsWrapper').html('');
        }

        /*
        Auto fill binary answer
        */

        if (type === 'binary') {

            $('input[name="correct_answer"]')
                .val('yes');
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Add Option Dynamically
    |--------------------------------------------------------------------------
    */

    $('#addOptionBtn').on('click', function () {

        let type = $('#questionType').val();

        let inputType =
            type === 'multiple_choice'
                ? 'checkbox'
                : 'radio';

        let inputName =
            type === 'multiple_choice'
                ? `options[${optionIndex}][is_correct]`
                : `correct_option`;

        let html = `

            <div class="card p-3 mb-3 option-item">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <input type="text"
                               name="options[${optionIndex}][text]"
                               class="form-control"
                               placeholder="Option Text"
                               required>

                    </div>

                    <div class="col-md-2">

                        <div class="form-check">

                            <input class="form-check-input"
                                   type="${inputType}"
                                   name="${inputName}"
                                   value="${optionIndex}">

                            <label class="form-check-label">

                                Correct

                            </label>

                        </div>

                    </div>

                    <div class="col-md-2">

                        <button type="button"
                                class="btn btn-danger btn-sm removeOptionBtn">

                            Remove

                        </button>

                    </div>

                </div>

            </div>
        `;

        $('#optionsWrapper').append(html);

        optionIndex++;
    });

    /*
    |--------------------------------------------------------------------------
    | Remove Option
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.removeOptionBtn',
        function () {

            $(this)
                .closest('.option-item')
                .remove();
        }
    );

});