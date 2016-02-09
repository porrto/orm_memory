$(document).ready(function() {

    $('#ageMax').on('change',function() {
        ageMax = $(this).val();
        sendURL(ageMax);
    });

    function sendURL(ageMax) {
        if(ageMax) {
            window.location.replace("/user/list/" + ageMax);
        }else{
            window.location.replace("/user/list");
        }
    }

});
