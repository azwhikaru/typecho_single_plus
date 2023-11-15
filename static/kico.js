/* ----

# Kico Style 1.0
# By: Dreamer-Paul
# Last Update: 2020.4.10

一个可口的极简响应式前端框架。

本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

Array.prototype.remove = function (value) {
    var index = this.indexOf(value);
    if(index > -1) this.splice(index, 1);
};

(function (global, setting) {
    var KStyle = function (a, b) {
        return KStyle.fn.init(a, b);
    };

    KStyle.fn = KStyle.prototype = {
        construtor: KStyle,
        init: function (a, b) {
            a = KStyle.selectAll(a);

            a.each = function (fn){
                return KStyle.each(a, fn);
            };

            a.image = function () {
                return KStyle.image(a);
            };

            a.lazy = function (bg) {
                return KStyle.lazy(a, bg);
            };

            a.scrollTo = function (offset) {
                return KStyle.scrollTo(a, offset);
            };

            a.empty = function () {
                return KStyle.each(a, function (item) { KStyle.empty(item); });
            }

            return a;
        }
    };

    // 批量处理
    KStyle.each = function (data, fn) {
        for(var i = 0; i < data.length; i++){
            fn(data[i], i, data);
        }
    };

    // 创建对象
    KStyle.create = function (tag, prop) {
        var obj = document.createElement(tag);

        if(prop){
            if(prop.id)    obj.id = prop.id;
            if(prop.src)   obj.src = prop.src;
            if(prop.href)  obj.href = prop.href;
            if(prop.class) obj.className = prop.class;
            if(prop.text)  obj.innerText = prop.text;
            if(prop.html)  obj.innerHTML = prop.html;

            if(prop.child){
                if(prop.child.constructor === Array){
                    KStyle.each(prop.child, (i) => {
                        obj.appendChild(i);
                    });
                }
                else{
                    obj.appendChild(prop.child);
                }
            }

            if(prop.attr){
                if(prop.attr.constructor === Array){
                    KStyle.each(prop.attr, (i) => {
                        obj.setAttribute(i.name, i.value);
                    });
                }
                else if(prop.attr.constructor === Object){
                    obj.setAttribute(prop.attr.name, prop.attr.value);
                }
            }

            if(prop.parent) prop.parent.appendChild(obj);
        }

        return obj;
    };

    // 选择对象
    KStyle.select = function (obj) {
        switch(typeof obj){
            case "object": return obj; break;
            case "string": return document.querySelector(obj); break;
        }
    };

    KStyle.selectAll = function (obj) {
        switch(typeof obj){
            case "object": return obj; break;
            case "string": return document.querySelectorAll(obj); break;
        }
    };

    // 清空子元素
    KStyle.empty = function (obj) {
        while(obj.firstChild){
            obj.removeChild(obj.firstChild);
        }
    }

    // 弹窗
    var notice = {
        wrap: KStyle.create("notice"),
        list: []
    };

    KStyle.notice = function (content, attr) {
        var item = KStyle.create("div", {class: "ks-notice", html: "<span class='content'>" + content + "</span>", parent: notice.wrap});

        notice.list.push(item);

        if(!document.querySelector("body > notice")) document.body.appendChild(notice.wrap);

        if(attr && attr.time){
            setTimeout(notice_remove, attr.time);
        }
        else{
            var close = KStyle.create("span", {class: "close", parent: item});

            close.onclick = notice_remove;
        }

        if(attr && attr.color){
            item.classList.add(attr.color);
        }

        function notice_remove() {
            item.classList.add("remove");
            notice.list.remove(item);

            setTimeout(function () {
                try{
                    notice.wrap.removeChild(item);
                    item = null;
                }
                catch(err) {}

                if(document.querySelector("body > notice") && notice.list.length === 0){
                    document.body.removeChild(notice.wrap);
                }
            }, 300);
        }
    };

    // 懒加载
    KStyle.lazy = function (elements, bg) {
        //elements = Array.from(KStyle.selectAll(elements));
        elements = KStyle.selectAll(elements);

        var list = [];

        var action = {
            setFront: function (item) {
                if(item.intersectionRatio > 0) {
                    item.target.src = item.target.link;
                    item.target.setAttribute("ks-lazy", "finished");
                    obs.unobserve(item.target);
                }
            },
            setBack: function (item) {
                if(item.boundingClientRect.top <= window.innerHeight + 100) {
                    var img = new Image();
                    img.src = item.target.link;

                    img.onload = function () {
                        item.target.setAttribute("ks-lazy", "finished");
                        item.target.style.backgroundImage = "url(" + item.target.link + ")";
                    };

                    obs.unobserve(item.target);
                }
            }
        };

        // 是否支持 OBS
        if(global.IntersectionObserver){
            var obs = new IntersectionObserver(function (changes) {
                if (bg) {
                    changes.forEach(function (t) {
                        action.setBack(t);
                    });
                }
                else {
                    changes.forEach(function (t) {
                        action.setFront(t);
                    });
                }
            });

            KStyle.each(elements, function (item) {
                item.link = item.getAttribute("ks-thumb") || item.getAttribute("ks-original");

                if(!item.getAttribute("ks-lazy")) obs.observe(item);
            })
        }
        else{
            function back() {
                KStyle.each(list, function (item) {
                    var check = item.el.getBoundingClientRect().top <= window.innerHeight;

                    if(check && !item.showed){
                        action.setBack(item.el);
                        list.remove(item);
                    }
                });
            }

            function front() {
                KStyle.each(list, function (item) {
                    var check = item.el.getBoundingClientRect().top <= window.innerHeight;

                    if(check && !item.showed){
                        action.setFront(item.el);
                        list.remove(item);
                    }
                });
            }

            KStyle.each(elements, function (item) {
                item.link = item.getAttribute("ks-thumb") || item.getAttribute("ks-original");

                if(!item.getAttribute("ks-lazy")) list.push({el: item, link: item.link});
            });

            bg ? back() : front();
            bg ? document.addEventListener("scroll", back) : document.addEventListener("scroll", front);
        }
    };

    // AJAX
    KStyle.ajax = function (prop) {
        if(!prop.url) prop.url = document.location.href;
        if(!prop.method) prop.method = "GET";

        if(prop.method === "POST"){
            var data = new FormData();

            for(var d in prop.data){
                data.append(d, prop.data[d]);
            }
        }
        else if(prop.method === "GET"){
            var url = prop.url + "?";

            for(var d in prop.data){
                url += d + "=" + prop.data[d] + "&";
            }

            prop.url = url.substr(0, url.length - 1);
        }

        var request = new XMLHttpRequest();
        request.open(prop.method, prop.url);
        if(prop.crossDomain){ request.setRequestHeader("X-Requested-With", "XMLHttpRequest"); }

        if(prop.header){
            for(var i in prop.header){
                request.setRequestHeader(prop.header[i][0], prop.header[i][1]);
            }
        }

        request.send(data);

        request.onreadystatechange = function () {
            if(request.readyState === 4){
                if(request.status === 200 || request.status === 304){
                    if(prop.type){
                        switch(prop.type){
                            case "text": prop.success(request.responseText); break;
                            case "json": prop.success(JSON.parse(request.response)); break;
                        }
                    }
                    else{
                        prop.success ? prop.success(request) : console.log(prop.method + " 请求发送成功");
                    }
                }
                else{
                    prop.failed ? prop.failed(request) : console.log(prop.method + " 请求发送失败");
                }

                request = null;
            }
        };

        return request;
    };

    // 平滑滚动
    KStyle.scrollTo = function (el, offset) {
        el = KStyle.selectAll(el);

        el.forEach(function (t) {
            t.onclick = function (e) {
                var l = e.target.pathname;
                var c = window.location.pathname;

                var t = e.target.href.match(/#[\s\S]+/);
                if(t) t = ks.select(t[0]);

                if(c === l){
                    e.preventDefault();

                    var top = t ? (offset ? t.offsetTop - offset : t.offsetTop) : 0;

                    "scrollBehavior" in document.documentElement.style ? global.scrollTo({top: top, left: 0, behavior: "smooth"}) : global.scrollTo(0, top);
                }
                else{
                    console.log(c, l);
                }
            }
        })
    };

    global.ks = KStyle;

    console.log("%c Kico Style %c https://paugram.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #3498db;","margin: 1em 0; padding: 5px 0; background: #efefef;");
})(window);