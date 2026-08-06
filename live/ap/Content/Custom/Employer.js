$(document).ready(function () {
    ContactUs().init();
});
var frmValdationInstance2 = null;
var ContactUs = function () {

    function OnLoad() {
        if (frmValdationInstance2 == null) {
            frmValdationInstance2 = $('#frmEmployer').parsley({
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
            frmValdationInstance2.validate({ force: true });
            $(this).attr('disabled');
            if (frmValdationInstance2.isValid()) {

                $('#btnSubmit').html('Submitting <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');

                var pData = {
                  
                    CName: $('#txtCName').val(),
                    PName: $('#txtPName').val(),
                    Designation: $('#txtDesignation').val(),
                    ContactNo: $('#txtContactNo').val()
           
                };



                $.ajax({
                    method: "post",
                    url: "/Home/SendMail",
                    data: pData
                }).then(function (data) {
                    if (data) {
                        $('#showMessage').html("<div style='color:#34a853; font-weight:bold;'>THANKS FOR SUBMITTING SUCCESSFUL.</div>");
                     
                        $('#txtCName').val("");
                        $('#txtPName').val("");
                        $('#txtDesignation').val("");
                        $('#txtContactNo').val("");
                     
                       
                    } else {
                        $('#showMessage').html("<div style='color:#ea4335'>Message not sent. Please try again after some time.</div>");
                    }
                    $('#btnSubmit').html("Submit");
                    $(this).removeAttr('disabled');
                }, function (e) {
                    $('#showMessage').html("<div style='color:#ea4335'>Message not sent. Please try again after some time.</div>");
                    console.log(e);
                    $('#btnSubmit').html("Submit");
                    $(this).removeAttr('disabled');
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