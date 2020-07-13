var _PageHeight = document.documentElement.clientHeight,
    _PageWidth = document.documentElement.clientWidth;

var _LoadingTop = _PageHeight > 60 ? (_PageHeight-60)/2 : 0,
    _LoadingLeft = _PageWidth > 60 ? (_PageWidth-60)/2 : 0;

var _loadingHtml = '<div id="loadingDiv" style="position:absolute;left:0;width:100%;height:' + _PageHeight + 'px;top:0;background:#f3f8ff;opacity:1;filter:alpha(opacity=80);z-index:10000;">' +
    '<svg viewBox="25 25 50 50" class="circular" style="height: 60px;width: 60px;animation: loading-rotate 2s linear infinite;position: relative;left: '+ _LoadingLeft +'px;top: '+ _LoadingTop +'px">' +
    '<circle cx="50" cy="50" r="20" fill="none" class="path" style="animation: loading-dash 1.5s ease-in-out infinite;\n' +
    'stroke-dasharray: 90,150;' +
    'stroke-dashoffset: 0;' +
    'stroke-width: 2;' +
    'stroke: #409eff;' +
    'stroke-linecap: round;"></circle>' +
    '</svg>' +
    '</div>';

document.write(_loadingHtml);

document.onreadystatechange = completeLoading;

function completeLoading() {
    if(document.readyState === 'complete'){
        var LoadingMask = document.getElementById('loadingDiv');
        LoadingMask.parentNode.removeChild(LoadingMask);
    }
}