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

$.sceditor.plugins.bbcode.bbcode.set("preview", {
    tags: {
        "div": {
            "class": ["img-preview"],
        },
    },
    format: (element, content) => {
        let img = element[0].childNodes[0].childNodes[0];
        let text = element[0].childNodes[0].childNodes[1];
        if(text.value !== "") {
            return `[preview=${img.src}]${text.value}[/preview]`;
        } else {
            return `[preview]${img.src}[/preview]`;
        }
    },
    html: (token, attrs, content) => {
        return '<div class="img-preview"><span class="container">' +
            (attrs.defaultattr ?
                `<img title="${content}" src="${attrs.defaultattr}"/><input placeholder="Введите описание" value="${content}" class="description"></input>`
                :
                `<img src="${content}"/><input placeholder="Введите описание" value="" class="description"></input>`) +
        '</span></div>';
    },
    isInline: false,
    isHtmlInline: true,
});