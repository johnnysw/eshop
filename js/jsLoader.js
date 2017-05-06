function loadScript(url, callback){
    var script = document.createElement('script');
    script.onload = function () {
        callback && callback();
    };
    script.src = url;
    script.async = 'async';


    document.getElementsByTagName('head')[0].appendChild(script);
}