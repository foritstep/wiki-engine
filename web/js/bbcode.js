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
            "class": ["page-link", "page-doesnt-exist"],
        },
    },
    format: (element, content) => {
        if(element[0].attributes['content']) {
            return `[page]${element[0].attributes['page'].nodeValue}[/page]`;
        } else {
            return `[page=${element[0].attributes['page'].nodeValue}]${element[0].innerText}[/page]`;
        }
        
    },
    html: (token, attrs, content) => {
        if(attrs.defaultattr) {
            return `<a href='${path_action_view}${attrs.defaultattr}' class='${PageExist(attrs.defaultattr)}' page='${attrs.defaultattr}'>${content}</a>`;
        } else {
            return `<a href='${path_action_view}${content}' class='${PageExist(attrs.defaultattr)}' page='${content}' content>${content}</a>`;
        }
    },
});