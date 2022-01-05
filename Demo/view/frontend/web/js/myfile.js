require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'Magento_Ui/js/modal/alert'
    ],
    function(
        $,
        modal,
        alert
    ) {
        $("#Ev-add-form").submit(function(e){
            console.log(33333)
        });

        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            buttons: [{
                text: $.mage.__('提交'),
                class: 'mymodal1',
                click: function () {

                    //method 1 :$("#Ev-add-form").submit();

                    //method 2:
                    var self = $(this);
                    try {

                        $.ajax({
                            url: "/demo/Physicalstore/newev",
                            type: 'POST',
                            dataType: 'json',
                            data:$("#Ev-add-form").serialize(),
                            showLoader: true,
                            success: function (data) {
                               if(data.result){
                                   alert({
                                       title: '操作成功',
                                       content: data.msg,
                                       actions: {
                                           always: function(){
                                           }
                                       }
                                   });

                               }else{
                                   alert({
                                       title: '操作失败',
                                       content: data.msg,
                                       actions: {
                                           always: function(){
                                           }
                                       }
                                   });
                               }
                            }
                        });
                    } catch (e) {

                    }
                    //this.closeModal();
                }
            }]
        };

        var popup = modal(options, $('#popup-modal'));
        $("#addNewEv").on('click',function(){
            $("#popup-modal").modal("openModal");
        });
    }
);