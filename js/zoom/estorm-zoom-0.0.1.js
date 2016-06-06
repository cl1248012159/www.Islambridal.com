(function($){
    "use strict";
    $.fn.estormZoom = function(opts){
        var defaults = {
            loading: {
                img: 'images/loading.gif',
                bgcolor: '#ffffff'
            },
            zoom: {
                borderColor: '#888888',
                borderWidth: 5,
                scale: 0.4, //放大镜的比例
                opacity: 0.4
            }
        };
        var options = $.extend(true, {}, defaults, opts || {});
        var objects = this;

        var methods = {
            init: function(object){
                var me = object;
                var item = me.find('.estorm-zoom-gallery li.item');
                var data = me.data('config');
                var ul = me.find('.estorm-zoom-gallery ul');
                var itemHeight = item.eq(0).outerHeight();
                var len = item.length;
                var colsnumber = data.colsnumber;
                ul.data('old', 0);
                me.find('.estorm-zoom-gallery').append(methods.btn());
                item.on('click', 'a', function(event){
                    var li = $(this).parent();
                    var index = item.index(li);
                    var bigurl = $(this).attr('href');
                    var title = $(this).find('img').attr('title');
                    var smallurl = $(this).data('middle') ? $(this).data('middle') : $(this).find('img').attr('src');
                    var stage = $(this).closest('.estorm-zoom-gallery').siblings('div.estorm-zoom-stage');
                    methods.slider(index, ul, len, colsnumber, itemHeight);
                    methods.showArrow(me, index, len);
                    li.addClass('current').siblings('li.item').removeClass('current');

                    var func = function(){
                        stage.find('img').data('bigurl', bigurl).attr('title', title);
                        stage.find('div.estorm-zoom-drag').css('background-image', 'url('+smallurl+')');
                    };
                    methods.loadMiddleimage(stage, smallurl, func);
                    return false;
                });
                var prev = ul.parent().find('a.arrow-prev');
                var next = ul.parent().find('a.arrow-next');
                prev.on('click', function(){
                    var old = ul.data('old');
                    if(old-1>=0){
                        item.eq(old-1).find('a').trigger('click');
                    }
                    methods.showArrow(me, old-1, len);
                    return false;
                });
                next.on('click', function(){
                    var old = ul.data('old');
                    if(old+1<=len-1){
                        item.eq(old+1).find('a').trigger('click');
                    }
                    methods.showArrow(me, old+1, len);
                    return false;
                });
                item.eq(0).find('a').trigger('click');

                //放大镜
                var stage = me.find('div.estorm-zoom-stage');
                var zoomImage = stage.find('img');
                var magnifier = methods.magnifier(zoomImage.width()*options.zoom.scale, zoomImage.height()*options.zoom.scale, zoomImage.attr('src'));
                stage.append(magnifier);

                stage.on('mouseover', function(event){
                    methods.showDrag($(this), data);
                    $('body').on('mousemove', {me: $(this)}, methods.moveEvent);
                }).on('mouseleave', function(event){
                    methods.hideDrag($(this));
                    $('body').off('mousemove');
                });
            },
            moveEvent: function(event){
                var me = event.data.me;
                var scrollLeft = $(document).scrollLeft();
                var scrollTop = $(document).scrollTop();
                var coord = [event.clientX+scrollLeft, event.clientY+scrollTop];
                var drag = me.find('div.estorm-zoom-drag');
                var outline = me.find('.estorm-zoom-outline');
                var offset = me.offset();
                var dragWidth = drag.width(), dragHeight = drag.height();
                var region = [(offset.left+dragWidth/2)-options.zoom.borderWidth, (offset.left+me.width()-dragWidth/2)-options.zoom.borderWidth, (offset.top+dragHeight/2)-options.zoom.borderWidth, (offset.top+me.height()-dragHeight/2)-options.zoom.borderWidth];
                var left = 0, top = 0;

                if(coord[0]<region[0]){
                    left = 0;
                } else if(coord[0]>region[1]) {
                    left = region[1]-region[0];
                } else {
                    left = coord[0]-region[0];
                }
                if(coord[1]<region[2]){
                    top = 0;
                } else if(coord[1]>region[3]) {
                    top = region[3]-region[2];
                } else {
                    top = coord[1]-region[2];
                }
                drag.css({
                    "left": left-options.zoom.borderWidth,
                    "top": top-options.zoom.borderWidth,
                    "background-position": "-"+(left)+"px -"+(top)+"px"
                });
                var r = Number(outline.data('scale'));
                var cLeft = left*r, cTop = top*r;
                outline.css({
                    "background-position": "-"+cLeft+"px -"+cTop+"px"
                });
            },
            loadBigimage: function(imgContainer, src, callback){
                var img = new Image();
                img.src = src;
                if(img.complete || img.width){
                    if(callback && $.isFunction(callback)){
                        callback(img);
                    }
                } else {
                    imgContainer.css({
                        "background": "url("+options.loading.img+") no-repeat center center "+options.loading.bgcolor
                    });
                    $(img).load(function(){
                        imgContainer.css('background', "url("+src+") no-repeat 0 0 "+options.loading.bgcolor);
                        if(callback && $.isFunction(callback)){
                            callback(img);
                        }
                    });
                }
            },
            loadMiddleimage: function(imgContainer, src, callback){
                var img = new Image();
                img.src = src;
                if(img.complete || img.width){
                    imgContainer.find('img').attr('src', src);
                    if(callback && $.isFunction(callback)){
                        callback(img);
                    }
                } else {
                    var b = imgContainer.css('background');
                    imgContainer.css({
                        "background": "url("+options.loading.img+") no-repeat center center "+options.loading.bgcolor
                    });
                    imgContainer.find('img').hide();
                    $(img).load(function(){
                        imgContainer.css({
                            "background": b
                        });
                        imgContainer.find('img').attr('src', src).show();
                        if(callback && $.isFunction(callback)){
                            callback(img);
                        }
                    });
                }
            },
            showDrag: function(me, data){
                me.find('img').stop(true, true).animate({
                    opacity: options.zoom.opacity
                }, 600);
                me.find('div.estorm-zoom-drag').fadeIn(200);
                if(!me.find('.estorm-zoom-outline')[0]){
                    var outlineHtml = methods.outline(0, 0, 0, 0, data.zindex, me.find('img').data('bigurl'));
                    me.append(outlineHtml);
                }
                var outline = me.find('.estorm-zoom-outline');
                var func = function(img){
                    var dragWidth = me.find('div.estorm-zoom-drag').width(), dragHeight = me.find('div.estorm-zoom-drag').height();
                    var cWidth = dragWidth*img.width/me.width();
                    var cHeight = dragHeight*img.height/me.height();
                    var r = img.width/me.width();
                    outline.css({
                        "width": cWidth,
                        "height": cHeight,
                        "left": me.width()+20,
                        "top": 0,
                        "background": "url("+img.src+") no-repeat 0 0"
                    }).show().data('scale', r);
                };
                methods.loadBigimage(outline, me.find('img').data('bigurl'), func);
            },
            hideDrag: function(me){
                me.find('img').stop(true, true).animate({
                    opacity: 1
                }, 200);
                me.find('div.estorm-zoom-drag').fadeOut(200);
                var outline = me.find('.estorm-zoom-outline');
                outline.hide();
            },
            showArrow: function(object, index, len){
                var me = object;
                var prev = me.find('a.arrow-prev');
                var next = me.find('a.arrow-next');
                //if(index<=0){
                //    prev.hide();
                //} else {
                //    prev.show();
                //}
                if(index>=len-1){
                    next.hide();
                } else {
                    next.show();
                }
            },
            slider: function(index, ul, len, colsnumber, itemHeight){
                if(len>colsnumber){
                    var goto = 0;
                    var old = ul.data('old');
                    if(old<index){ //正向
                        if(index>len-colsnumber){
                            goto = len-colsnumber;
                        } else {
                            goto = index;
                        }
                    } else if(old>index){ //逆向
                        if(index<colsnumber){
                            goto = 0;
                        } else {
                            goto = index-(colsnumber-1);
                        }
                    } else { //重复点击
                        var left = -Number(ul.css('left').replace('px',''));
                        if(index<colsnumber-1){
                            goto = 0;
                        } else if(index>len-colsnumber){
                            goto = len-colsnumber;
                        } else {
                            if(left==index*itemHeight){
                                goto = index-(colsnumber-1);
                            } else {
                                goto = index;
                            }
                        }
                    }
                    ul.animate({
                        top: -goto*itemHeight+10,
                        bottom:10
                    }, 100);
                    ul.data('old', index);
                }
            },
            btn: function(){
                var html = '<a href="javascript:;" class="arrow arrow-prev">上一张</a>'+
                    '<a href="javascript:;" class="arrow arrow-next">下一张</a>';
                return html;
            },
            magnifier: function(width, height, src){
                var html = '<div class="estorm-zoom-drag" style="width:'+width+'px; height:'+height+'px; position:absolute; border:'+options.zoom.borderWidth+'px '+options.zoom.borderColor+' solid; box-shadow:0 0 10px rgba(0,0,0,0.3); background:url('+src+') no-repeat 0 0; display:none;"><div>';
                return html;
            },
            outline: function(width, height, left, top, zindex, src){
                var html = '<div class="estorm-zoom-outline" style="width:'+width+'px; height:'+height+'px; position:absolute; overflow:hidden; z-index:'+zindex+'; left:'+left+'px; top:'+top+'px; background:url('+src+') no-repeat 0 0; box-shadow:0 0 15px rgba(0,0,0,0.3); border:1px '+options.zoom.borderColor+' solid; display:none;"></div>';
                return html;
            }
        };

        $.each(objects, function(index){
            var me = $(this);
            methods.init(me);
        });
    };
})(jQuery);