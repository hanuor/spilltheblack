$(document).ready(function () {

    readTextFile("https://raw.githubusercontent.com/hanuor/spilltheblack/master/uploader/data.html");

});

function readTextFile(file) {
    var fetchedString = "";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            var masterString = xhr.responseText;
            var head = masterString.match(/<head[^>]*>[\s\S]*<\/head>/gi);
            var body = masterString.match(/<article[^>]*>[\s\S]*<\/article>/gi);
            var style = masterString.match(/<style[^>]*>[\s\S]*<\/style>/gi);
            $(style[0]).appendTo('body');
            $(body[0]).appendTo('#showcase_content');

        }
    };
    xhr.open('GET', file, true);
    xhr.send(null);
    // if (fetchedString.length !== 0) {
    //     return fetchedString;
    // }
}