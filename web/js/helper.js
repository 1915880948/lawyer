(function (exports) {
     Helper = {
        //判断是否为对象 中文版
        isObject: function(v){
            return typeof v === 'object';
        },
        asynRequest: function(type, url, data, successCallback, errorCallback){
            if(Helper.isObject(data)){
                data._csrf = $('meta[name="csrf-token"]').attr('content');
            } else {
                data = data + '&_csrf=' + $('meta[name="csrf-token"]').attr('content');
            }
            $.ajax(url, {
                type: type || 'POST', dataType: 'json', cache: false, data: data || {},
                success: successCallback,
                error: errorCallback
            });
        }
    }
})(window);
