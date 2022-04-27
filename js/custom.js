$(document).ready(function(){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function(){

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

//Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
        next_fs.show();
//hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
// for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

//Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
        previous_fs.show();

//hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
// for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function(){
        return false;
    })

});
/////////////////////////////////
// function ChangeClass(){
//     $('#online').toggleClass('selectDiv');
// }
function backWelcome(){
    $('#welcome').show();
    $('#c_campus').hide();
    $('#d_field').hide();
    $('#c_field').hide();
    $('#a_field').hide();
    $('#s_field').hide();
}
function nextWelcome(){
        $('#welcome').hide();
        $('#d_field').hide();
        $('#c_field').hide();
        $('#a_field').hide();
        $('#s_field').hide();
        $('#c_campus').show();
}
function nextCampus(){
    $('#welcome').hide();
    $('#c_campus').hide();
    $('#c_field').hide();
    $('#a_field').hide();
    $('#s_field').hide();
    $('#d_field').show();
}
function nextGroup(){
    $('#welcome').hide();
    $('#d_field').hide();
    $('#c_campus').hide();
    $('#a_field').hide();
    $('#s_field').hide();
    $('#c_field').show();

}
function nextCourse(){
    $('#welcome').hide();
    $('#c_campus').hide();
    $('#c_field').hide();
    $('#a_field').hide();
    $('#s_field').show();
    $('#d_field').hide();
}
function nextSession(){
    $('#welcome').hide();
    $('#c_campus').hide();
    $('#c_field').hide();
    $('#a_field').show();
    $('#s_field').hide();
    $('#d_field').hide();
}

function get_campuses(i) {
    if(i==3) {
        $('.on-campus').toggleClass('selectDiv');
        $('.online').removeClass('selectDiv');
        $('.first_tab').removeAttr("disabled");
        $('#city').show();
        $('#city_id').val('');
    }
    if(i==2){
        $('.on-campus').toggleClass('selectDiv');
        $('.online').removeClass('selectDiv');
        var city_id = $('#city_id').val();
        var institute_id = 3;
        if ($.isNumeric(parseInt(institute_id))) {
            $.post(
                './get_campuses.php',
                {
                    institute_id: institute_id,
                    cityID: city_id
                },
                function (data) {
                    if (data) {
                        var jsonObj = JSON.parse(data);
                        $('#campuses').html(jsonObj['campuses']);
                        $('#campuses').prop('disabled', false);
                    }
                }
            );
        } else {
            clear_fields('campuses', 'Select a Campus');
        }
        $('.first_tab').removeAttr("disabled");
    }

    if(i==1) {
        $('.online').toggleClass('selectDiv');
        $('.on-campus').removeClass('selectDiv');
        $('#city').hide();
        $('#city_id').val('');

    var institute_id = 3;
    if ($.isNumeric(parseInt(institute_id))) {
        $.post(
            './get_campuses.php',
            {
                institute_id: institute_id
            },
            function (data) {
                if (data) {
                    var jsonObj = JSON.parse(data);
                    $('#campuses').html(jsonObj['campuses']);
                    $('#campuses').prop('disabled', false);
                }
            }
        );
    } else {
        clear_fields('campuses', 'Select a Campus');
    }
        $('.first_tab').removeAttr("disabled");
    }

}
function copyToClipboard(text) {
    var sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text; //save main text in it
    sampleTextarea.select(); //select textarea contenrs
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);

}
function copyVoucher(){
    var copyText = document.getElementById("voucherNumber");
    copyToClipboard(copyText.value);
    $(".copyIcon").addClass('text-red');
}

function get_class() {
    var instituteID = 3;
    var campusCode = $('#campuses').val();
    var class_field = $('input[name="class_field"]:checked').val();
    if (($.isNumeric(parseInt(instituteID)))) {
        $.post(
            './get_classes.php',
            {
                instituteID: instituteID,
                campusCode: campusCode,
                class_field: class_field
            },
            function (data) {
                var jsonObj = JSON.parse(data);
                $('#classes').html(jsonObj['classes']);
                $('#classe_button').removeAttr("disabled");
                /*$('#classes').prop('disabled', false);
                removeOptions(document.getElementById('sessions'));
                removeOptions(document.getElementById('groups'));*/

            }
        );
    } else {
        clear_fields('classes', 'Select a Class');
        removeOptions(document.getElementById('classes'));

    }

}

function get_sessions(e) {

    $("."+e.className+".selectedClass").removeClass("selectedClass");
    $("#"+e.id).addClass("selectedClass");

    var campusCode = $('#campuses').val();
    var campusClassID = $('input[name="classes"]:checked').attr("campus_class_id");
    var classID = $('input[name="classes"]:checked').val();
    if ($.isNumeric(parseInt(classID)) && campusCode) {
        $.post(
            './get_sessions.php',
            {
                campusCode: campusCode,
                campusClassID: campusClassID,
                classID: classID
            },
            function (data) {
                var jsonObj = JSON.parse(data);
                $('#sessions').html(jsonObj['sessions']);
                $("#sessions").prop('disabled', false);
                $('#check_group').removeAttr("disabled");
               /// removeOptions(document.getElementById('groups'));
            }
        );
    } else {
        $('#classes').change();
    }

}
function get_group() {
    //get_sos_detail();
    var classID = $('input[name="classes"]:checked').val();
    $('#test_categories').change();
    if ($.isNumeric(parseInt(classID))) {
        $.post(
            './get_group.php',
            {
                ClassID: classID
            },
            function (data) {
                var jsonObj = JSON.parse(data);
                $('#groups').html(jsonObj['groups']);
                ///$("#groups").prop('disabled', false);
            }
        );
    } else {


    }

}
function check_group(e) {

    $("."+e.className+".selectedClass").removeClass("selectedClass");
    $("#"+e.id).addClass("selectedClass");

}


function validatenumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 8 || event.keyCode == 46
        || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9 || event.key === "Backspace") {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else return true;
}

function validatechar() {
    var firstname = document.getElementById("student_name");
    var alpha = /^[a-zA-Z\s-, ]+$/;
    if (firstname.value == "") {
        alert('Please enter Name');
        return false;
    } else if (!firstname.value.match(alpha)) {
        alert('Invalid ');
        return false;
    } else {
        return true;
    }
}