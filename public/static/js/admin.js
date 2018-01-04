requirejs(['jquery','toastr','inspinia'], function ($,toastr) {
    $(document).ready(function () {
        setTimeout(function () {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 200000000
            };
            toastr.error('请放心使用', '加载完成');
    
        }, 100);
    });
})