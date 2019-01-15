$(document).ready(function () {

    readTextFile("https://raw.githubusercontent.com/hanuor/spilltheblack/master/uploader/data.html");

});

function readTextFile(file) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            var masterString = xhr.responseText;
            var head = masterString.match(/<head[^>]*>[\s\S]*<\/head>/gi);
            var body = masterString.match(/<article[^>]*>[\s\S]*<\/article>/gi);
            var footer = body[0].match(/<footer[^>]*>[\s\S]*<\/footer>/gi);
            var bodyPrint = body[0].replace(footer[0], '');
            var style = masterString.match(/<style[^>]*>[\s\S]*<\/style>/gi);
            $(style[0]).appendTo('body');
            $(bodyPrint).appendTo('#showcase_content');

        }
    };
    xhr.open('GET', file, true);
    xhr.send(null);
}



