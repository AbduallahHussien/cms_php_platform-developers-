var notification = {
    next_page_notifiction:function(text,type = 'success'){
        localStorage.setItem("notification", JSON.stringify({text:text, type:type}));
    },
    init:function (){
        var notification = localStorage.getItem("notification");
        if(notification){
            notification = JSON.parse(notification);
            new Noty({
                theme: 'mint',
                type: notification.type,
                layout: 'bottomRight',
                text: notification.text,
                timeout: 5000,
                progressBar: true

            }).show();
            localStorage.removeItem('notification');
        }
    },
    show:function(text,type = 'success'){
        new Noty({
            theme: 'mint',
            type: type,
            layout: 'bottomRight',
            text:text,
            timeout: 5000,
            progressBar: true
        }).show();
    }
    ,
    loading:function($element){
        $element.waitMe({ effect : 'bounce', text : 'Processing'});
    },
    stop_loading:function($element){
        $element.waitMe("hide");
    }
}

notification.init();
