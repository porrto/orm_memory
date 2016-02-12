$(document).ready(function() {

    console.log(window.location.pathname.split('/'));

    var path = window.location.pathname.split('/');

    for (var i=0; i < path.length; i++){
        switch (path[i]) {
            case "ski" :
                $('.ski').addClass('active');
                break;

            case "pole" :
                $('.pole').addClass('active');
                break;

            case "ski-level" :
                $('.ski-level').addClass('active');
                break;

            case "user" :
                $('.user').addClass('active');
                break;
        }
    }
});
