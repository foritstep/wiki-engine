$.sceditor.plugins.bbcode.bbcode.set("h", {
    tags: {
        "h1": null,
        "h2": null,
        "h3": null,
        "h4": null,
        "h5": null,
        "h6": null,
    },
    format: (element, content) => `[h=${element[0].nodeName.slice(1)}]${content}[/h]`,
    html: "<h{defaultattr}>{0}</h{defaultattr}>",
    isInline: false,
});

function PageExist(url) {
    let r = '';
    $.ajax({
        url: path_action_exist + url,
        success: function(data) {
            r = JSON.parse(data).exist ? 'page-link' : 'page-doesnt-exist';
        },
        async: false,
    });
    return r;
}

$.sceditor.plugins.bbcode.bbcode.set("page", {
    tags: {
        "a": {
            "class": "page-link",
        },
    },
    format: (element, content) => `[page=${console.log(element[0])}]${content}[/h]`,
    html: (token, attrs, content) => 
            `<a href='${attrs.defaultattr}' class='${PageExist(attrs.defaultattr)}'>${content}</a>`,
});