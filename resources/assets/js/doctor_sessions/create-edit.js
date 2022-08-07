'use strict';

$(document).ready(function () {
    if (!isEdit == true) {
        $('.startTimeSlot').prop('disabled', true);
        $('.endTimeSlot').prop('disabled', true);
    }

    $('#selGap').change(function () {
        $('.startTimeSlot').prop('disabled', false);
        $('.endTimeSlot').prop('disabled', false);
    });
});

$(document).on('click', '.add-session-time', function () {
    if (!isEdit == true) {
        if ($('#selGap').val() == '') {
            return false;
        }
    }
    let selectedIndex = 0;
    if ($(this).parent().prev().children('.session-times').find('.timeSlot:last-child').length > 0){
        selectedIndex = $(this).
            parent().
            prev().
            children('.session-times').
            find('.timeSlot:last-child').
            children('.add-slot').
            find('select[name^="endTimes"] option:selected')[0].index;
    }

    let day = $(this).closest('.weekly-content').attr('data-day');
    let $ele = $(this);
    let weeklyEle = $(this).closest('.weekly-content');
    let gap = $('#selGap').val();
    $.ajax({
        url: getSlotByGapUrl,
        data: { gap: gap, day: day },
        success: function (data) {
            weeklyEle.find('.unavailable-time').html('');
            weeklyEle.find('input[name="checked_week_days[]"').
                prop('checked', true).prop('disabled', false);
            $ele.closest('.weekly-content').
                find('.session-times').
                append(data.data);
            weeklyEle.find('select[data-control="select2"]').select2();
            
            let startTimeOptions = $('.add-session-time').
                parent().
                prev().
                children('.session-times').
                find('.timeSlot:last-child').
                children('.add-slot').
                find('select[name^="startTimes"] option');
            startTimeOptions.each(function (index) {
                if (index <= selectedIndex) {
                    $(this).attr('disabled', true);
                }else{
                    $(this).attr('disabled', false);
                }
            });
            
        },
    });
});

$(document).on('click', '.copy-btn', function () {
    $(this).closest('.copy-card').removeClass('show');
    let selectEle = $(this).
        closest('.weekly-content').
        find('.session-times').
        find('select');
    // check for slot is empty
    if (selectEle.length == 0) {
        $(this).
            closest('.menu-content').
            find('.copy-label .form-check-input:checked').
            each(function () {
                let weekEle = $(`.weekly-content[data-day="${$(this).val()}"]`);
                $(weekEle).find('.session-times').html('');
                weekEle.find('.weekly-row').find('.unavailable-time').remove();
                weekEle.find('.weekly-row').
                    append('<div class="unavailable-time">Unavailable</div>');
                let dayChk = $(weekEle).
                    find('.weekly-row').
                    find('input[name="checked_week_days[]"');
                dayChk.prop('checked', false).prop('disabled', true);
            });
    } else {
        selectEle.each(function () {
            $(this).select2('destroy');
        });
        let selects = $(this).
            closest('.weekly-content').
            find('.session-times').
            find('select');
        let $cloneEle = $(this).
            closest('.weekly-content').
            find('.session-times').
            clone();
        $(this).
            closest('.menu-content').
            find('.copy-label .form-check-input:checked').
            each(function () {
                let $cloneEle2 = $cloneEle;
                let currentDay = $(this).val();
                let weekEle = `.weekly-content[data-day="${currentDay}"]`;
                $cloneEle2.find('select[name^="startTimes"]').
                    attr('name', `startTimes[${currentDay}][]`);
                $cloneEle2.find('select[name^="endTimes"]').
                    attr('name', `endTimes[${currentDay}][]`);
                $(weekEle).find('.unavailable-time').html('');
                $cloneEle2.find('.error-msg').html('');
                $(weekEle).find('.session-times').html($cloneEle2.html());
                $(weekEle).find('.session-times select').select2();
                $(weekEle).
                    find('input[name="checked_week_days[]"').
                    prop('disabled', false).prop('checked', true);
                $(selects).each(function (i) {
                    let select = this;
                    $(weekEle).
                        find('.session-times').
                        find('select').
                        eq(i).
                        val($(select).val()).
                        trigger('change');
                });
            });

        $(this).
            closest('.weekly-content').
            find('.session-times').
            find('select').
            each(function () {
                $(this).select2();
            });
        $('.copy-check-input').prop('checked', false);
    }
});

$(document).on('click', '.deleteBtn', function () {

    let selectedIndex = 0;
    if ($(this).closest('.timeSlot').prev().length > 0){
        selectedIndex = $(this).
            closest('.timeSlot').
            prev().
            children('.add-slot').
            find('select[name^="endTimes"] option:selected')[0].index;
    }
    
    
    if ($(this).
        closest('.weekly-row').
        find('.session-times').
        find('select').length == 2) {
        let dayChk = $(this).
            closest('.weekly-row').
            find('input[name="checked_week_days[]"');
        dayChk.prop('checked', false).prop('disabled', true);
        $(this).
            closest('.weekly-row').
            append('<div class="unavailable-time">Unavailable</div>');
    }

    let startTimeOptions = $(this).
        closest('.timeSlot').
        next().
        children('.add-slot').
        find('select[name^="startTimes"] option');
    startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        } else {
            $(this).attr('disabled', false);
        }
    });
    
    $(this).parent().siblings('.error-msg').remove();
    $(this).parent().closest('.timeSlot').remove();
    $(this).parent().remove();
});

$(document).on('submit', '#saveForm', function (e) {
    e.preventDefault();
    let checkedDayLength = $('input[name="checked_week_days[]"]:checked').length;
    if(!checkedDayLength){
        displayErrorMessage('Please select any one day');
        return false;
    }
    $(`.weekly-content`).find('.error-msg').text('');
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    location.href = $('#btnBack').attr('href');
                }, 1500);
            }
        },
        error: function (result) {
            let { day,key } = result.responseJSON.message;
            $(`.weekly-content[data-day="${day}"]`).find('.error-msg').text('');
            $(`.weekly-content[data-day="${day}"]`).find('.error-msg').eq(key).text('Slot timing is overlap with other slot timing');
        },
        complete: function () {
        },
    });
});

// $(document).on('change', 'select[name^="startTimes"]', function (e) {
//     let selectedIndex = $(this)[0].selectedIndex;
//     console.log($(this).siblings('select'));
//     $(this).closest('.session-times').find('select').not(this).each(function (){
//         // $(this).find('option').eq(selectedIndex + 1).prop('selected', true).trigger('change');
//         $(this).find('option').each(function (index){
//             if (index <= selectedIndex) {
//                 $(this).attr('disabled', true);
//             }
//         })
//     });
// });

$(document).ready(function () {
    $('select[name^="startTimes"]').each(function () {
        let selectedIndex = $(this)[0].selectedIndex;
        let endSelectedIndex = $(this).
            closest('.add-slot').
            find('select[name^="endTimes"] option:selected')[0].index;
        let endTimeOptions = $(this).
            closest('.add-slot').
            find('select[name^="endTimes"] option');
        if (selectedIndex >= endSelectedIndex) {
            endTimeOptions.eq(selectedIndex + 1).
                prop('selected', true).
                trigger('change');
        }
        endTimeOptions.each(function (index) {
            if (index <= selectedIndex) {
                $(this).attr('disabled', true);
            } else {
                $(this).attr('disabled', false);
            }
        });
    });
});

$(document).on('change', 'select[name^="startTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let endTimeOptions = $(this).closest('.add-slot').find('select[name^="endTimes"] option');
    let endSelectedIndex = $(this).closest('.add-slot').find('select[name^="endTimes"] option:selected')[0].index;
    if(selectedIndex >= endSelectedIndex){
        endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change');
    }
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        }else{
            $(this).attr('disabled', false);
        }
    });
});

$(document).ready(function () {
    $('select[name^="endTimes"]').each(function () {
        let selectedIndex = $(this)[0].selectedIndex;
        let startTimeOptions = $(this).closest('.timeSlot').next().find('select[name^="startTimes"] option');
        startTimeOptions.each(function (index) {
            if (index <= selectedIndex) {
                $(this).attr('disabled', true);
            }else{
                $(this).attr('disabled', false);
            }
        });
    });
});

$(document).on('change', 'select[name^="endTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex;
    let startTimeOptions = $(this).closest('.timeSlot').next().find('select[name^="startTimes"] option');
    startTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true);
        }else{
            $(this).attr('disabled', false);
        }
    });
});
