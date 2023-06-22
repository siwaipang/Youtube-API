function tplawesome(e, t) {
    res = e;
    for (var n = 0; n < t.length; n++) {
        res = res.replace(/\{\{(.*?)\}\}/g, function (e, r) {
            return t[n][r]
        });
    };
    return res
};

$(function () {
    $("form").on("submit", function (e) {
        e.preventDefault();
        // zoekresultaten filter
        var request = gapi.client.youtube.search.list({
            part: "snippet",
            type: "video",
            q: encodeURIComponent($("#search").val()).replace(/%20/g, "+"),
            maxResults: 10,
            order: "relevance"
        });

        // laat zien
        request.execute(function (response) {
            var results = response.result;
            $("#results").html("");
            $.each(results.items, function (index, item) {
                $.get("tpl/item.html", function (data) {
                    $("#results").append(tplawesome(data, [{
                        "title": item.snippet.title,
                        "videoid": item.id.videoId,
                        "description": item.snippet.description,
                        "channel": item.snippet.channelTitle,
                        "published": item.snippet.publishedAt
                    }]));
                });
            });
            resetVideoHeight();
        });
    });
});

function resetVideoHeight() {
    $(".video").css("height", $("#results").width() * 9 / 16);
}

function init() {
    //youtube api key
    gapi.client.setApiKey("your API key here");
    gapi.client.load("youtube", "v3", function () {});
}
