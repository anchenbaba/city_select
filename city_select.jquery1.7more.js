/*! citySelect v2.4 | (c) 2013, 2014 jQuery 省市区联动插件. | www.anchen8.net/license */
(function($) {
    $.fn.citySelect = function(options) {
        var opts = $.extend({}, $.fn.citySelect.defaults, options);
        var obj = $(this);
        var objClass = '.'+obj.attr('class');
        var objSelector = 'select'+objClass;
        var ajaxType = opts.type.toUpperCase();
        if((ajaxType != 'POST')){
            ajaxType = 'GET';
        }
        obj.each(function() {
            var oc = $(this);
            var init = oc.attr('init');
            var pid = oc.attr('pid');

            if(undefined != pid && '' != pid){
                $.ajax({
                    type: ajaxType,
                    url: opts.url ,
                    data: {pid:pid},
                    dataType:'json',
                    beforeSend: function(){
                        //showLoading();
                    },
                    success: function(msg){
                        //hideLoading();
                        var myjson=[];
                        //if(undefined == init)
                             myjson.push("<option value='' acid=''>请选择</option>");
                        if(msg.data != null) {
                            $.each(msg.data, function(i, item){
                                if(opts.field == 1){
                                    if(init == item[opts.value]){
                                        myjson.push("<option value='"+item[opts.value]+"' acid='"+item[opts.id]+"' selected='selected'>"+item[opts.text]+"</option>");
                                    }else{
                                        myjson.push("<option value='"+item[opts.value]+"' acid='"+item[opts.id]+"'>"+item[opts.text]+"</option>");
                                    }
                                }else{
                                    if(init == item[opts.value] || init == item[opts.text]){
                                        myjson.push("<option value='"+item[opts.value]+":"+item[opts.text]+"' acid='"+item[opts.id]+"' selected='selected'>"+item[opts.text]+"</option>");
                                    }else{
                                        myjson.push("<option value='"+item[opts.value]+":"+item[opts.text]+"' acid='"+item[opts.id]+"'>"+item[opts.text]+"</option>");
                                    }
                                }
                            });
                        }
                        oc.html(myjson.join(''));
                    }
                });
            }else{
                oc.html("<option value='' acid=''>请选择</option>");
                //return false;
            }
        });
        // obj.parent().on('change',objClass,function(){
        $('body').on('change',objSelector,function(){
            var o = $(this);
            var index = o.index(objSelector); //递一个选择器，返回o在所有objSelector中的索引位置
            var acid = o.find("option:selected").attr('acid');
            if(opts.callback != '' && opts.callback != null) opts.callback(o);
            if(undefined != acid && '' != acid){
                $.ajax({
                    type: ajaxType,
                    url: opts.url ,
                    data: {pid:acid},
                    dataType:'json',
                    beforeSend: function(){
                        switch(opts.mode){
                            case 1: o.nextAll().remove(); break;
                            // default:o.nextAll('.'+o.attr('class')).html("<option value='' acid=''>请选择</option>");break;
                            default:$(objSelector+':gt('+index+')').html("<option value='' acid=''>请选择</option>");break;
                        }
                        //showLoading();
                    },
                    success: function(msg){
                        //hideLoading();
                        var myjson=[];
                        var name = o.attr('name');
                        if(msg.name != null) name = msg.name;
                        if(msg.data != null && msg.data != '') {
                            myjson.push("<option value='' acid=''>请选择</option>");
                            $.each(msg.data, function(i, item){
                                if(opts.field == 1)
                                    myjson.push("<option value='"+item[opts.value]+"' acid='"+item[opts.id]+"'>"+item[opts.text]+"</option>");
                                else
                                    myjson.push("<option value='"+item[opts.value]+":"+item[opts.text]+"' acid='"+item[opts.id]+"'>"+item[opts.text]+"</option>");
                            });

                            switch(opts.mode){
                                case 1: o.after($("<select>",{
                                            name: name,
                                            "class": o.attr('class'),
                                            html: myjson.join('')
                                        }));
                                    break;
                                // default:o.next('.'+o.attr('class')).html(myjson.join(''));break;
                                default:obj.eq(index+1).html(myjson.join(''));break;
                            }
                        }
                    }
                });
            }else{
                // o.nextAll(objSelector).html("<option value='' acid=''>请选择</option>");
                $(objSelector+':gt('+index+')').html("<option value='' acid=''>请选择</option>");
            }
        })
    };
    $.fn.citySelect.defaults = {
        url : '',
        type: 'POST',
        field: 1, // 提交后 value的是数字id 还是选择的文本值value 否则两者合并以/间隔
        mode: 1 ,
        id:'id',
        value:'region_id',
        text:'region_name',
        callback:null
    };
})(jQuery);