$.sceditor.plugins.bbcode.bbcode.set("h", {
    tags: {
        "h1": {
            "default": 1,
        }
    },
    format: function(element, content) {
        console.log(1);
        console.log(element);
        console.log(content);
        return `[h=1]${content}[/h]`;
    },
    html: "<h{defaultattr}>{0}</h{defaultattr}>",
});
$.sceditor.plugins.bbcode.bbcode.set("h1", {
    tags: {
        "h1": null
    },
    format: function(element, content) {
        console.log(1);
        console.log(element);
        console.log(content);
        return `[h=1]${content}[/h]`;
    },
    html: "<h1>{0}</h1>",
});