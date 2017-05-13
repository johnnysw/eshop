$(function () {
    var table = $('#developer-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "developer/developer_mgr",
        "columns": [
            {
                "data": null, "orderable": false, width: "16px", "render": function (data, type, row) {
                return '<input type="checkbox" value="' + row.developer_id + '" class="developer-check"/>'
            }
            },
            {"data": "developer_id"},
            {"data": "logo"},
            {"data": "developer_name"},
            {"data": "address"},
            {"data": "telephone"},
            null
        ],
        "columnDefs": [
            {"orderable": false, "targets": [1,2,5,6]},
            {
                "targets": 2,
                "data": null,
                "render": function (data, type, row) {
                    return "<img style='width: 50px;height: 50px;' src=" + data + ">";
                },
            },
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row) {
                    return '<a href="javascript:;" class="developer-edit">编辑</a>';
                },
            }
        ]
    });


    //增加
    $('#btn-new').on('click', function () {
        $.sidepanel({
            width: 700,
            title: '添加开发商',
            tpl: 'new-developer-tpl',
            callback: function () {
                $(".founding-time").datepicker({
                    format: 'yyyy-mm-dd'
                });
                //实例化编辑器
                UE.delEditor('new-container');
                var ue = UE.getEditor('new-container');
                //用户名是否重复
                var $user_tip = $('#user-tip');
                $('#developer-name').on('blur', function () {
                    var $developernameVal = $(this).val().trim();
                    $.get('developer/developer_check_name', {
                        'developer_name': $developernameVal
                    }, function (res) {
                        if (res === "success") {
                            $user_tip.hide();
                            $('#submit').removeAttr("disabled");
                        } else {
                            $user_tip.show();
                            $('#submit').attr("disabled", "true");
                        }
                    }, 'text');
                });

                //验证组件开始
                $.validator.setDefaults({
                    submitHandler: function () {
                        $('#add-developer-form').submit();
                    }
                });

                $().ready(function () {
                    // validate the comment form when it is submitted
                    $("#add-developer-form").validate({
                        rules: {
                            developer_name: {
                                required: true,
                                rangelength: [2, 30]
                            }
                        },
                        messages: {
                            developer_name: {
                                required: "忘记填写开发商名称啦",
                                rangelength: "标题长度要在1-20个字之间"
                            }
                        }
                    });

                });
                //验证组件结束

                //图片上传代码开始
                var uploader = new plupload.Uploader({ //创建实例的构造方法
                    runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
                    browse_button: 'btn', // 上传按钮
                    url: "img_upload", //远程上传地址
                    filters: {
                        max_file_size: '500kb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                        mime_types: [ //允许文件上传类型
                            {
                                title: "files",
                                extensions: "jpg,png,gif,ico,jpeg"
                            }
                        ]
                    },
                    multi_selection: true, //true:ctrl多文件上传, false 单文件上传
                    init: {
                        FilesAdded: function(up, files) { //文件上传前
                            if ($("#ul_pics").children("li").length > 1) {
                                alert("您上传的图片太多了！");
                                uploader.destroy();
                            } else {
                                var li = '';
                                plupload.each(files, function(file) { //遍历文件
                                    li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                                });
//                                    $("#ul_pics").append(li);
                                $('.house-upload-btn').before(li);
                                uploader.start();
                            }
                        },
                        UploadProgress: function(up, file) { //上传中，显示进度条
                            var percent = file.percent;
                            $("#" + file.id).find('.bar').css({
                                "width": percent + "%"
                            });
                            $("#" + file.id).find(".percent").text(percent + "%");
                        },
                        FileUploaded: function(up, file, info) { //文件上传成功的时候触发
                            var data = eval("(" + info.response + ")");
                            $("#" + file.id).html("<div class='img'><img src='" + data.pic + "'/><a class='del-img upload-del-btn'></a></div><p><input type='hidden' name='upload_img' value='"+ data.pic +"'></p>");
                        },
                        Error: function(up, err) { //上传出错的时候触发
                            alert(err.message);
                        }
                    }
                });
                uploader.init();
                //鼠标滑入div,显示删除按钮
                $('#ul_pics').on('mouseover','div.img',function () {
                    var $delImg = $(this).children('.del-img').show();
                }).on('mouseout','div.img',function () {
                    var $delImg = $(this).children('.del-img').hide();
                });

                //图片删除
                $('#ul_pics').on('click','.del-img',function () {
                    $(this).parents('li').remove();
                });
                //图片上传代码结束
            }
        });
    });

    //编辑
    $('#developer-table tbody').on("click", ".developer-edit", function (e) {

        var dataId = $(this).parent().parent().data('id');
        $.sidepanel({
            width: 700,
            title: '修改开发商',
            tpl: 'edit-developer-tpl',
            dataSource: 'developer/developer_edit',
            data: {
                developerId: dataId
            },
            callback: function () {
                $(".founding-time").datepicker({
                    format: 'yyyy-mm-dd'
                });
                //实例化编辑器
                UE.delEditor('new-container');
                var ue = UE.getEditor('new-container');
                ue.ready(function() {
                    //设置编辑器的内容
                    ue.setContent($('#description').val());
                });

            }
        });
        e.preventDefault();
        e.stopPropagation();
    });

    //详情
    $('#developer-table tbody').css({cursor: 'pointer'})
        .on('click', 'tr', function () {
            var dataId = $(this).data('id');
            $.sidepanel({
                width: 800,
                title: '开发商详情',
                tpl: 'developer-tpl',
                dataSource: 'developer/developer_detail',
                data: {
                    developerId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
                    $('#house-table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "developer/developer_house?developerId=" + dataId,
                        "columns": [
                            {"data": "title"},
                            {"data": "price"},
                            {"data": "area"}
                        ],
                        "pageLength": 2
                    });
                }
            });
        }).on("click", ".developer-check", function (e) {
            e.stopPropagation();
    });

    //全选checkbox
    var $rowsCheckbox;
    $("#check-all").on("click", function () {
        $rowsCheckbox = $("#developer-table .developer-check");
        if (this.checked) {
            $rowsCheckbox.attr("checked", true);
        } else {
            $rowsCheckbox.attr("checked", false);
        }
    });

    //全部删除
    $("#btn-del").on("click", function () {
        if (confirm('是否删除记录，删除后可以在回收站恢复!')) {
            $rowsCheckbox = $("#developer-table .developer-check");
            var ids = "";
            $rowsCheckbox.each(function (index, elem) {
                if (this.checked) {
                    ids += this.value + ",";
                }
            });
            $.get('developer/developer_del_all', {ids: ids}, function (data) {
                if (data == 'success') {
                    table.ajax.reload(null, true);//重新加载数据
                    $.gritter.add({
                        title: '信息提示!',
                        text: '记录删除成功!'
                    });
                }
            }, 'text');
        }
    });

    $('#user-table tbody').on("click", ".send-message", function (e) {
        var dataId = $(this).parent().parent().data('id');
        $.sidepanel({
            width: 700,
            title: '发送消息',
            tpl: 'send-message-tpl',
            dataSource: 'user/user_send_message',
            data: {
                userId: dataId
            },
            callback: function () {
                var that = this;
                $("#send").on("click", function () {
                    $.get("message/message_add", {
                        receiver_id: $("input[name=receiver_id]").val(),
                        content: $("textarea[name=content]").val()
                    }, function (res) {
                        if (res == "success") {
                            $.gritter.add({
                                title: "消息提示!",
                                text: "消息发送成功!"
                            });
                            that.close();
                        } else {
                            $.gritter.add({
                                title: "消息提示!",
                                text: "消息发送失败!"
                            });
                        }
                    });
                });
            }
        });

        e.stopPropagation();
    }).on("click", ".user-check", function (e) {
        e.stopPropagation();
    });

});