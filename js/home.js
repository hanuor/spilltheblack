$(document).ready(function () {
    var masterString = readTextFile("https://raw.githubusercontent.com/hanuor/spilltheblack/master/uploader/data.html");
    var head = masterString.match(/<head[^>]*>[\s\S]*<\/head>/gi);
    var body = masterString.match(/<article[^>]*>[\s\S]*<\/article>/gi);
    var style = masterString.match(/<style[^>]*>[\s\S]*<\/style>/gi);
    $(style[0]).appendTo('body');
    $(body[0]).appendTo('#showcase_content');
});

function readTextFile(file) {
    var fetchedString = "";
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
                fetchedString = rawFile.responseText;
            }
        }
    }
    rawFile.send(null);
    if (fetchedString.length != 0) {
        return fetchedString;
    }
}