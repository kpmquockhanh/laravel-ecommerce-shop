$('.btn-remove').click(function () {
    const id = $(this).attr('data-id');
    const type = $(this).attr('data-type');
    const tr = $(this).parents('tr');

    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Delete',
        message: 'Are you sure for delete this item ?',
        position: 'center',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                axios.post(`/admin/${type}/remove`, {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            iziToast.success({
                                title: 'Success!',
                                message: 'Delete successfully!',
                                position: 'topCenter'
                            });
                            tr.slideUp("normal", function() { $(this).remove(); } );
                        }
                        else
                        {
                            iziToast.error({
                                title: 'Error',
                                message: 'Error occurred !',
                                position: 'topCenter'
                            });
                        }

                    })
                    .catch(function (err) {
                        console.log(err);
                    });
            }, true],
            ['<button>No</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
    });
});

$('.change-show-status').on('change', function () {
    const button = $(this);
    const id = $(this).attr('data-id');
    const route = $(this).attr('data-route');
    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Display changing',
        message: 'Do you want to change visible status of this products ?',
        position: 'center',
        buttons: [
            ['<button><b>Yes</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                axios.post(`/admin/${route}/change-status`, {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            if (button.prop('checked'))
                            {
                                button.siblings('i').fadeIn();
                                button.parent().addClass('btn-primary');
                            }
                            else
                            {
                                button.siblings('i').fadeOut();
                                button.parent().removeClass('btn-primary');
                            }

                            iziToast.success({
                                title: 'Success!',
                                message: 'Change successfully!',
                                position: 'topCenter'
                            });
                        }
                        else
                        {
                            iziToast.error({
                                title: 'Error',
                                message: 'Error occurred !',
                                position: 'topCenter'
                            });
                        }

                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>No</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                button.prop('checked', !button.prop('checked'));
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
$('.trigger-change-status').click(function () {
   $(this).find('.change-show-status').trigger('click');
});

$('#paginate').on('change', function () {
    $(this).parents('form').trigger('submit');
});

$('#sort').on('change', function () {
    $(this).parents('form').trigger('submit');
});
$('body').on('click','.btn-optimize-image', function () {
    let that = $(this);
    let id = $(this).attr('data-id');
    let tr = $(this).parents('tr');
    let i = $(this).children('i');


    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Tối ưu ảnh',
        message: 'Bạn có muốn tối ưu ảnh này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                i.removeClass('fa-cog');
                i.addClass('fa-spinner');
                that.removeClass('btn-success');
                that.addClass('btn-danger');

                axios.post('/admin/flowers/optimize-image', {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            tr.replaceWith(res.data.data);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Đã tối ưu ảnh thành công!',
                                position: 'topCenter'
                            });

                        }
                        else
                        {
                            console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Tối ưu không thành công',
                                position: 'topCenter'
                            });
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
$('.btn-compress-all').on('click', function () {
    let i = $(this).children('i');
    let that = $(this);
    iziToast.question({
        timeout: 2000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Tối ưu ảnh',
        message: 'Bạn có muốn tối ưu toàn bộ ảnh không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                i.removeClass('fa-cogs');
                i.addClass('fa-spinner fa-spin');
                that.removeClass('btn-success');
                that.addClass('btn-danger');

                axios.post('/admin/flowers/optimize-all-image')
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Đã tối ưu ảnh thành công!',
                                position: 'topCenter'
                            });
                            i.addClass('fa-cogs');
                            i.removeClass('fa-spinner fa-spin');
                            that.addClass('btn-success');
                            that.removeClass('btn-danger');
                        }
                        else
                        {
                            console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Tối ưu không thành công',
                                position: 'topCenter'
                            });
                            i.addClass('fa-cogs');
                            i.removeClass('fa-spinner fa-spin');
                            that.addClass('btn-success');
                            that.removeClass('btn-danger');
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});

$('body').on('click','.btn-download', function (e) {
    e.preventDefault();
    let that = $(this);
    let index = $(this).attr('data-index');
    let tr = $(this).parents('tr');
    let i = $(this).children('i');

    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Crawl',
        message: 'Bạn có muốn crawl link này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                i.removeClass('fa-download');
                i.addClass('fa-spinner fa-spin');
                that.removeClass('btn-success');
                that.addClass('btn-danger');

                axios.post('/admin/crawler/crawl', {index: index})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Crawl thành công!',
                                position: 'topCenter'
                            });

                            tr.replaceWith(res.data.data);
                        }
                        else
                        {
                            // console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Crawl không thành công',
                                position: 'topCenter'
                            });

                            i.addClass('fa-download');
                            i.removeClass('fa-spinner fa-spin');
                            that.addClass('btn-success');
                            that.removeClass('btn-danger');
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});

$('.order-confirm-btn').click(e => {
    e.preventDefault();
    const target = $(e.target);
    const id = target.attr('data-id');
    const action = target.attr('data-action');

    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Xác nhận',
        message: 'Bạn có muốn xác nhận đơn hàng này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                axios.post(action, {id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Xác nhận thành công!',
                                position: 'topCenter'
                            });
                            target.attr('disabled', 'disabled');
                            $('.transaction_status').html(res.data.text);
                            $('.transaction_status').addClass('text-'+res.data.class);
                            $('.transaction_status').removeClass('text-about').removeClass('text-danger').removeClass('text-success');
                        }
                        else
                        {
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Đã xảy ra lỗi!',
                                position: 'topCenter'
                            });
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
