$(function () {
    // var root = document.location.hostname;
    // alert(root)
    var defLoc = location.href;
    var loc;
    var pathName;
    var path;
    $.ajax({
        method: 'post',
        url: 'https://ar19981217.github.io/fileManger.github.io/systems/core.php',
        success: function (data) {
            var res = JSON.parse(data);
            var dir = res.main.dir;
            var file = res.main.file;
            path = res.path;
            console.log(res);
            append(dir, file);
            // $('.main .folder-list').html(res);
            // console.log(path);
            dblclick();
        },
        error: function (error) {
            // console.log(error);
        }
    });
    function dblclick() {
        $('.folder-list li').on('dblclick', function () {
            pathName = $(this).text();
            /*if ($(this).hasClass('back')){
                // console.log(path.split)
            }else {
                path = path+'/'+pathName;
            }*/
            path = path+'/'+pathName;

            console.log(path);
            $.ajax({
                method: 'post',
                url: 'https://ar19981217.github.io/fileManger.github.io/systems/core.php',
                data: {path: path},
                success: function (data) {
                    var res = JSON.parse(data);
                    path = res.path;
                    console.log(res);
                    var dir = res.main.dir;
                    var back = res.main.back;
                    var file = res.main.file;
                    append(dir, file, back);
                    dblclick();
                },
                error: function (error) {
                    console.log(error);
                }
            })
        });
    }

    function append(dir  = null ,file = null, back = null) {
        $('.main .folder-list').html('');
        if (back != null)
        $('.main .folder-list').append(back);
        if (dir != null){
            for (let i = 0; i < dir.length; i++) {
                $('.main .folder-list').append(dir[i]);
            }
        }
       if (file != null){
           for (let i = 0; i < file.length; i++) {
               $('.main .folder-list').append(file[i]);
           }
       }

    }
});
