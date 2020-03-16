$(function () {
    // var root = document.location.hostname;
    // alert(root)
    var defLoc = location.href;
    var loc;
    var pathName;
    $.ajax({
        method: 'post',
        url: 'systems/core.php',
        success: function (data) {
            $('.main').html(data);
            dblclick();
        },
        error: function (error) {
            console.log(error);
        }
    });
    function dblclick() {
        $('.folder-list li').on('dblclick', function () {
            pathName = $(this).text();
            /*loc = defLoc;
            if (location.href != defLoc){
                loc = location.href+'/'+pathName;
            }*/

            $.ajax({
                method: 'post',
                url: 'systems/core.php',
                data: {pathName: pathName},
                success: function (data) {
                    $('.main').html(data);
                    // window.history.replaceState("Details", "Title", pathName);
                    dblclick();
                },
                error: function (error) {
                    console.log(error);
                }
            })
        });
        $('.folder-list li.back').on('dblclick', function () {
            var back = $(this).text();
            var loc = location.href;
            var status = 'back';
            $.ajax({
                method: 'post',
                url: 'systems/core.php',
                data: {back: back, status: status},
                success: function (data) {
                    $('.main').html(data);
                    // window.history.replaceState("Details", "Title", pathName);
                    dblclick();
                },
                error: function (error) {
                    console.log(error);
                }
            })
        });
    }

});