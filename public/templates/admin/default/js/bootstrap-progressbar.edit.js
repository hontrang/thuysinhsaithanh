$(document).ready(function(){
    if(id_check != undefined)
        var check = setInterval(function(){ check_status(id_check,check) }, 2000);
});
function check_status(id_check,check)
{
    $.ajax({
        type        : 'GET',
        async       : false,
        cache       : false,
        url         : '/admin/cron/status/'+ id_check

    }).done(function(repo) {
        if(repo !== "null")
        {
            var data = JSON.parse(repo);
            if(data['720']['status'] === 100 && data['480']['status'] === 100 && data['360']['status'] === 100)
            {
                $('#status_720_'+ id_check).attr('data-transitiongoal', 100).progressbar({display_text: 'center'});
                $('#status_480_'+ id_check).attr('data-transitiongoal', 100).progressbar({display_text: 'center'});
                $('#status_360_'+ id_check).attr('data-transitiongoal', 100).progressbar({display_text: 'center'});
                console.log("Done");
                clearInterval(check);
                window.location.replace("/admin/video/listall");
            }
            else
            {
                var data_720 = data['720'];
                $('#status_720_'+ id_check).attr('data-transitiongoal', data_720.status).progressbar({display_text: 'center'});
                var data_480 = data['480'];
                $('#status_480_'+ id_check).attr('data-transitiongoal', data_480.status).progressbar({display_text: 'center'});
                var data_360 = data['360'];
                $('#status_360_'+ id_check).attr('data-transitiongoal', data_360.status).progressbar({display_text: 'center'});
            }


        }
        else
        {
            console.log("waiting...");
        }


    });



    return false;
}