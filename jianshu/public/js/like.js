$('.like-button').click(function (ev) {
    var btn=$(ev.target);
    var like_value=btn.attr('like-value');
    var like_user=btn.attr('like-user');
    var _token=btn.attr('_token');
    if (like_value==1){
        $.post('/user/'+like_user+'/unfan',{'_token':_token},function (data) {
            if (data=='ok'){
                btn.text('关注');
                btn.attr('like-value',0);
                btn.removeClass('btn-default').addClass('btn-primary');
            }else {
                alert('取关失败')
            }

        })
    }else if (like_value==0) {
        $.post('/user/'+like_user+'/fan',{'_token':_token},function (data) {
            if (data=='no'){
                btn.text('取消关注');
                btn.attr('like-value',1);
                btn.removeClass('btn-primary').addClass('btn-default');
            }else {
                alert('取关失败')
            }

        })
    }
})