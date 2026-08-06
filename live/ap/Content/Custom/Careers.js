$(document).ready(function () {
    ContactUs().init();
});
var frmValdationInstance3 = null;
var ContactUs = function () {

    function OnLoad() {
        if (frmValdationInstance3 == null) {
            frmValdationInstance3 = $('#frmCareer').parsley({
                uiEnabled: true,
                errorClass: 'error',
                successClass: 'success',
                errorsWrapper: '<div class="parsley-error-list"></div>',
                errorTemplate: '<label class="error"></li>'
            });
        }
        $('#btnSubmit').click(function (e) {
            e.preventDefault();
            $('#showMessage').html("");
            frmValdationInstance3.validate({ force: true });
            if (frmValdationInstance3.isValid()) {

                $('#btnSubmit').html('Submitting <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');
                var fData = new FormData();
                fData.append('FName', $('#txtFName').val());
                fData.append('Email', $('#txtEmail').val());
                fData.append('ContactNo', $('#txtContactNo').val());           
                fData.append('Designation', $('#txtDesignation').val());
               
                var fResume = $('#fileresume').get(0); 
                if (fResume.files.length > 0) {
                    fData.append('File', fResume.files[0]);
                }

                $.ajax({
                    method: "post",
                    url: "/Careers/SendMailCareer1",
                    data: fData,
                    processData: false,
                    contentType: false,
                    cache: false
                }).then(function (data) {
                    if (data) {
                        $('#showMessage').html("<div style='color:#34a853; font-weight:bold;'>THANKS FOR SUBMITTING SUCCESSFUL.</div>");
                      
                        $('#txtFName').val("");
                        $('#txtEmail').val("");
                        $('#txtContactNo').val("");               
           
                        $('#txtDesignation').val("");
                        var fuResume = $('#fileresume');
                        fuResume.replaceWith(fuResume.val('').clone(true));
                    } else {
                        $('#showMessage').html("<div style='color:#ea4335'>Message not sent. Please try again after some time.</div>");
                    }
                    $('#btnSubmit').html("Submit");
                }, function (e) {
                    $('#showMessage').html("<div style='color:#ea4335'>Message not sent. Please try again after some time.</div>");
                    console.log(e);
                });

            }
        });

    }


    return {
        init: function () {
            OnLoad();
        }
    }
};