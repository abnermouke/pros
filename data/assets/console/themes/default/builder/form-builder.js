$.form_builder = {
    init: function (sign, beforeCallback, afterCallback) {
        //获取表单信息
        let form = $("#pros_form_"+sign);
        //引入必要组件
        this.importModules(form, sign);
        //判断是否存在处理前回调
        if (typeof beforeCallback == 'function') {
            //执行回调
            beforeCallback(form, sign);
        }
        //设置tab触发
        this.setTabTrigger(form, sign);
        //构建表单内容
        this.buildItems(form, sign);
        //设置表单内容项事件
        this.setItemEvents(form, sign);
        //设置表单内容项更改触发
        this.setItemChangeWatcher(form, sign);
        //设置表单工具触发
        this.setToolTriggers(form, sign);
        //设置构建完成`
        form.attr('data-build', 1);
        //重置tooltip
        KTApp.initBootstrapTooltips();
        //debug
        console.log('Pros Form [' + sign + '] build success!');
        //判断是否存在处理完回调
        if (typeof afterCallback == 'function') {
            //执行回调
            afterCallback(form, sign);
        }
    },
    importModules: function (form, sign) {

    },
    containWithModal: function (sign, modal_id) {
        //获取表单信息
        let form = $("#pros_form_"+sign);
        //整理参数
        var modal_object = $("#"+modal_id), title_box = $("#pros_"+sign+"_form_title"), footer_box = $("#pros_"+sign+"_form_footer_box");
        //判断modal是否存在
        if (typeof modal_object !== 'undefined' && modal_object.length > 0) {
            //判断标题是否存在
            if (typeof (title_box) !== 'undefined' && title_box.length > 0) {
                //设置标题
                modal_object.find('.modal-title').empty().text(title_box.text());
                //移除数据
                title_box.remove();
            }
            //删除底部返回按钮
            footer_box.find('#pros_'+sign+'_form_back_button_box').remove();
            //转移底部按钮
            modal_object.find('.modal-footer').empty().html(footer_box.html());
            footer_box.remove();
            //设置绑定modal
            form.attr('data-modal-id', modal_id);
        }
    },
    setTabTrigger: function (form, sign) {
        //获取处理对象
        var tabs_box = $("#pros_form_"+sign+"_tabs"), panels_box = $("#pros_form_"+sign+"_tab_panels");
        //判断对象是否存在
        if (typeof(tabs_box) !== 'undefined' && tabs_box.length > 0) {
            //设置按钮触发
            tabs_box.find('.nav-link').on('click', function () {
                //设置全部不选中
                tabs_box.find('.nav-link').removeClass('active');
                panels_box.find('.tab_panel').removeClass('d-none').addClass('d-none');
                //设置当前选项卡选中
                $(this).addClass('active');
                //设置panels显示
                panels_box.find('#pros_'+sign+'_form_tab_for_'+$(this).attr('data-alias')).removeClass('d-none');
            });
            //设置第一个tab被点击
            tabs_box.find('.nav-link').eq(0).trigger('click');
        } else {
            //设置全部内容展示
            panels_box.find('.tab_panel').removeClass('d-none');
        }
    },
    setItemChangeWatcher: function (form, sign) {
        //循环处理堆绣昂
        form.find('.pros_form_'+sign+'_item_box').each(function () {
            //获取基础数据
            var _this = $(this), type = _this.attr('data-type'), target = _this.attr('data-target'), target_object = $(target), field = _this.attr('data-field'), default_value = _this.attr('data-default-value'), update_tip = $("#pros_form_"+sign+"_item_"+field+"_edited_warning"), target_trigger = function (default_item_value, target_value) {
                //获取当前时间
                var date = new Date(), now_time = (date.getFullYear()+'-'+(date.getMonth() >= 10 ? date.getMonth() : '0'+date.getMonth())+'-'+(date.getDay() >= 10 ? date.getDay() : '0'+date.getDay())+' '+(date.getHours() >= 10 ? date.getHours() : '0'+date.getHours())+':'+(date.getMinutes() >= 10 ? date.getMinutes() : '0'+date.getMinutes())+':'+(date.getSeconds() >= 10 ? date.getSeconds() : '0'+date.getSeconds()))
                //判断值是否一致
                if (default_item_value !== target_value) {
                    //设置显示已更改
                    update_tip.removeClass('d-none').find('span.edited_time').text(now_time);
                } else {
                    //设置不显示已更改
                    update_tip.removeClass('d-none').addClass('d-none');
                }
            }, field_triggers_func = function (triggers, value) {
                //判断有效性
                if (typeof triggers !== 'undefined' && triggers.length > 0) {
                    //获取触发规则
                    triggers = JSON.parse(triggers);
                    //判断不为空
                    if (!$.isEmptyObject(triggers)) {
                        //循环规则
                        $.each(triggers, function (v, rules) {
                            //判断是否为选中值
                            if (checkNumberOrString(v) === value) {
                                //循环字段
                                $.each(rules, function (i, item) {
                                    //显示内容
                                    form.find(".pros_form_"+sign+"_item_box[data-field='"+item+"']").removeClass('d-none');
                                });
                            } else {
                                //循环字段
                                $.each(rules, function (i, item) {
                                    //隐藏内容
                                    form.find(".pros_form_"+sign+"_item_box[data-field='"+item+"']").removeClass('d-none').addClass('d-none');
                                });
                            }
                        });
                    }
                }
            };
            //设置监听
            target_object.on('change', function () {
                //设置触发值
                var target_value;
                //处理默认值
                default_value = checkNumberOrString(default_value);
                //根据类型处理
                switch (type) {
                    case 'radio':
                    case 'normal_radio':
                    case 'image_radio':
                    case 'group_radio':
                        //设置触发结果
                        target_value = checkNumberOrString($(target+":checked").val());
                        //获取触发规则
                        field_triggers_func(_this.attr('data-triggers'), target_value);
                        break;
                    case 'checkbox':
                    case 'normal_checkbox':
                    case 'image_checkbox':
                    case 'group_checkbox':
                        //设置默认值
                        target_value = [];
                        //怒换对象
                        target_object.each(function () {
                            //判断是否选中
                            if ($(this).is(':checked')) {
                                //添加值
                                target_value.push(checkNumberOrString($(this).val()));
                            }
                        });
                        //设置触发结果
                        target_value = JSON.stringify(target_value);
                        break;
                    case 'switch':
                        //判断是否选中
                        if (target_object.is(':checked')) {
                            //设置值
                            target_value = checkNumberOrString($(target).attr('data-on-value'));
                        } else {
                            //设置值
                            target_value = checkNumberOrString($(target).attr('data-off-value'));
                        }
                        //获取触发规则
                        field_triggers_func(_this.attr('data-triggers'), target_value);
                        break;
                    case 'ck_editor':
                    case 'ueditor':
                        //设置默认值
                        default_value = $("#pros_form_"+sign+"_item_"+field+"_default_value_content").html();
                        //获取值
                        target_value = target_object.val();
                        break;
                    case 'tags':
                        //设置默认值
                        target_value = [];
                        //获取值
                        var tags_value = target_object.val();
                        //判断信息
                        if (typeof tags_value !== 'undefined' && tags_value.length > 0) {
                            //循环内容
                            $.each(JSON.parse(tags_value), function (i, item) {
                                //新增字段
                                target_value.push(checkNumberOrString(item.value));
                            });
                        }
                        //获取值
                        target_value = JSON.stringify(target_value);
                        break;
                    default:
                        //设置触发结果
                        target_value = checkNumberOrString(target_object.val());
                        break;
                }
                //判断当前值是否为空
                if (typeof target_value !== 'undefined' &&  target_value.length > 0) {
                    //移除可能存在的验证提示
                    _this.find('.validator_tip').remove();
                }
                //触发判断
                target_trigger(default_value, target_value);
            });
        });
    },
    buildItems: function (form, sign) {
        //获取绑定对象
        var dropdown_modal_id = form.attr('data-modal-id');
        //循环处理对象
        form.find('.pros_form_'+sign+'_item_box').each(function () {
            //获取基础数据
            var _this = $(this), type = _this.attr('data-type'), target = _this.attr('data-target'), target_object = $(target), field = _this.attr('data-field'), default_value = _this.attr('data-default-value');
            //根据类型处理
            switch (type) {
                case 'input':
                    //获取input类型
                    var input_mode = target_object.attr('data-input-mode');
                    //根据价格处理
                    if (input_mode === 'datetime') {
                        //引入日期中文
                        createExtraJs(form.attr('data-source-path')+'/flatpickr/langs/zh-cn.js', window.flatpickr.l10ns.zh, function () {
                            //获取显示格式
                            var filter_date_format = target_object.attr('data-format'), filter_date_params = {
                                locale: "zh",
                                altFormat: filter_date_format,
                                dateFormat: filter_date_format,
                            };
                            //判断是否需要显示时间
                            if (filter_date_format.indexOf('H') >= 0 || filter_date_format.indexOf('h') >= 0 || filter_date_format.indexOf('i') >= 0 || filter_date_format.indexOf('s') >= 0) {
                                //添加小时支持
                                filter_date_params['enableTime'] = filter_date_params['time_24hr'] = true;
                            }
                            //判断是否为range
                            if (typeof target_object.attr('data-date-range') !== 'undefined' && parseInt(target_object.attr('data-date-range')) === 1) {
                                //添加范围支持
                                filter_date_params['mode'] = 'range';
                            }
                            //实例化日期
                            target_object.flatpickr(filter_date_params);
                        });
                    }
                    break;
                case 'tags':
                    //初始化参数
                    var tagify_options = {}, whitelist = JSON.parse(target_object.attr('data-white-list'));
                    //判断白名单
                    if (!$.isEmptyObject(whitelist)) {
                        //设置白名单
                        tagify_options['whitelist'] = whitelist;
                        tagify_options['dropdown'] = {
                            maxItems: 20,
                            classname: "tagify__inline__suggestions",
                            enabled: 0,
                            closeOnSelect: false
                        };
                    }
                    //实例化标签
                    new Tagify(target_object[0], tagify_options);
                    break;
                case 'select':
                    //设置参数
                    var select2_options = {
                        placeholderOption: "first",
                        allowClear: true
                    };
                    //判断是否为modal
                    if (typeof (dropdown_modal_id) !== 'undefined' && dropdown_modal_id.length > 0) {
                        //添加参数
                        select2_options.dropdownParent = $("#"+dropdown_modal_id);
                    }
                    //设置select2
                    target_object.select2(select2_options);
                    break;
                case 'icon':
                    //设置参数
                    var optionFormat = (item) => {
                        //未知项
                        if (!item.id || item.id === '') {
                            //直接返回
                            return item.text;
                        }
                        //创建对象
                        var span = document.createElement('span');
                        //设置内容
                        span.innerHTML = '<i class="fa '+item.text+' me-2"></i> fa '+item.text;
                        //返回对象
                        return $(span);
                    }, icon_options = {
                        templateSelection: optionFormat,
                        templateResult: optionFormat,
                        placeholderOption: "first",
                        allowClear: true
                    };
                    //判断是否为modal
                    if (typeof (dropdown_modal_id) !== 'undefined' && dropdown_modal_id.length > 0) {
                        //添加参数
                        icon_options.dropdownParent = $("#"+dropdown_modal_id);
                    }
                    //设置select2
                    target_object.select2(icon_options);
                    break;
                case 'ck_editor':
                    //引入js
                    createExtraJs(form.attr('data-source-path')+'/ckeditor/ckeditor-classic.bundle.js', $.ClassicEditor, function () {
                        //创建CKEditor
                        ClassicEditor.create(document.querySelector(target), {
                            language: 'zh-cn',
                            content: 'zh-cn',
                            ckfinder: {
                                uploadUrl: _this.attr('data-upload-url')
                            },
                            toolbar: {
                                items: [
                                    'Undo','Redo','SelectAll','RemoveFormat', '|', 'Bold','Italic', '｜', 'NumberedList','BulletedList','|','Outdent','Indent','Blockquote', '|', 'Link','Unlink'
                                ],
                            }
                        }).then(editor => {
                            //设置信息
                            editor.model.document.on('change:data', function () {
                                //设置信息
                                target_object.val(editor.getData()).change();
                            });
                        });
                    });
                    break;
                case 'pictures':
                case 'files':
                    //引入js
                    createExtraJs(form.attr('data-source-path')+'/draggable/draggable.bundle.js', window.Draggable, function () {
                        //获取处理主体
                        var containers = document.querySelectorAll("#pros_form_"+sign+"_item_"+field+"_upload_items");
                        //实例化拖拽对象
                        var swappable = new Sortable.default(containers, {
                            draggable: ".pros_form_"+sign+"_item_"+field+"_upload_item",
                            handle: ".pros_form_"+sign+"_item_"+field+"_upload_item .fa-bars",
                            mirror: {
                                appendTo: "body",
                                constrainDimensions: true
                            }
                        });
                        //监听拖拽结束
                        swappable.on("drag:stop", (e) => {
                            //整理数组
                            var upload_items = [], func = function () {
                                //循环对象
                                $("#pros_form_"+sign+"_item_"+field+"_upload_items").find(".pros_form_"+sign+"_item_"+field+"_upload_item").each(function () {
                                    //判断数据是否存在
                                    if ($.isEmptyObject(upload_items) || $.inArray($(this).attr('data-link'), upload_items) <= -1) {
                                        //追加数据
                                        upload_items.push($(this).attr('data-link'));
                                    }
                                });
                                //设置值
                                target_object.val(JSON.stringify(upload_items)).change();
                            };
                            //延迟设置
                            setTimeout(function () {
                                //设置结果
                                func();
                            }, 500);
                        });
                    });
                    break;
                case 'ueditor':
                    //引入js
                    createExtraJs(form.attr('data-source-path')+'/ueditor/ueditor.config.js', typeof (window.UEDITOR_CONFIG), function () {
                        //设置上传路径
                        window.UEDITOR_CONFIG['serverUrl'] = _this.attr('data-upload-url')
                        window.UEDITOR_CONFIG['UEDITOR_HOME_URL'] = form.attr('data-source-path')+'/ueditor/';
                        //继续引入对象
                        createExtraJs(form.attr('data-source-path')+'/ueditor/ueditor.all.js', typeof (window.UE.dom), function () {
                            //延迟渲染
                            setTimeout(function () {
                                //获取对象
                                var ue = UE.getEditor('pros_form_'+sign+'_item_'+field+'_ueditor_container', {
                                    autoHeight: true,
                                    initialFrameWidth: null,
                                    autoHeightEnabled: true,
                                });
                                //监听实例化完毕
                                ue.ready(function() {
                                    //设置默认高度
                                    ue.setHeight(200);
                                });
                                //设置监听
                                ue.addListener('contentChange', function (editor) {
                                    //设置内容
                                    target_object.val(ue.getContent().trim()).change();
                                });
                            }, (Math.floor(Math.random() * 10) + 1) * 100);
                        });
                    });
                    break;
            }
            //判断是否存在maxlength
            if (typeof target_object.attr('maxlength') !== 'undefined' && parseInt(target_object.attr('maxlength')) > 0) {
                //设置maxlength
                target_object.maxlength({
                    warningClass: "badge badge-warning",
                    limitReachedClass: "badge badge-success"
                });
            }
        });
    },
    setItemEvents: function (form, sign) {
        //循环处理对象
        form.find('.pros_form_'+sign+'_item_box').each(function () {
            //获取基础数据
            var _this = $(this), type = _this.attr('data-type'), target = _this.attr('data-target'), target_object = $(target), field = _this.attr('data-field'), default_value = _this.attr('data-default-value');
            //根据类型处理
            switch (type) {
                case 'group_checkbox':
                    //设置按钮点击
                    $("#pros_form_"+sign+"_item_"+field+"_checkbox_item_button_trigger_select_all").on('click', function () {
                        //设置全部选中
                        target_object.prop('checked', true);
                        target_object.eq(0).change();
                    });
                    $("#pros_form_"+sign+"_item_"+field+"_checkbox_item_button_trigger_select_none").on('click', function () {
                        //设置全部选中
                        target_object.prop('checked', false);
                        target_object.eq(0).change();
                    });
                    break;
                case 'files':
                    //整理信息
                    var box = $('#pros_form_'+sign+'_item_'+field+'_upload_box'), empty_box = $('#pros_form_'+sign+'_item_'+field+'_upload_without_item'), upload_items = $('#pros_form_'+sign+'_item_'+field+'_upload_items'), trigger_btn = $('#pros_form_'+sign+'_item_'+field+'_trigger'), input_uploader = $('#pros_form_'+sign+'_item_'+field+'_uploader'), upload_item_template = '<div class="dropzone-item mx-3 my-3 mt-0 pros_form_'+sign+'_item_'+field+'_upload_item" data-link="__LINK__"><a class="d-block overlay w-100 align-items-center" href="javascript:;"><div class="overlay-wrapper text-gray-800 p-5">__FILE_NAME__</div><div class="overlay-layer card-rounded bg-dark bg-opacity-20 shadow"><i class="fa fa-eye text-primary fs-3 pros_form_'+sign+'_item_'+field+'_upload_item_previewer" data-bs-toggle="tooltip" data-bs-dismiss="click" title="预览/查看文件内容"></i><i class="fa fa-trash-alt text-danger fs-3 ms-5 pros_form_'+sign+'_item_'+field+'_upload_item_remover" data-bs-toggle="tooltip" data-bs-dismiss="click" title="删除当前文件"></i><i class="fa fa-bars text-warning fs-3 ms-5 pros_form_'+sign+'_item_'+field+'_upload_item_mover" data-bs-toggle="tooltip" data-bs-dismiss="click" title="长按拖动排序"></i></div></a></div>', file_input_trigger = function () {
                        //设置信息
                        var files = [];
                        //循环项目
                        upload_items.find('.pros_form_'+sign+'_item_'+field+'_upload_item').each(function () {
                            //添加信息
                            files.push($(this).attr('data-link'));
                        });
                        //判断长度
                        if (files.length > 0) {
                            //隐藏empty
                            empty_box.removeClass('d-none').addClass('d-none');
                        } else {
                            //显示empty
                            empty_box.removeClass('d-none');
                        }
                        //获取值
                        target_object.val(JSON.stringify(files)).change();
                        //重置tooltip
                        KTApp.initBootstrapTooltips();
                    }, remove_trigger = function () {
                        //设置移除触发
                        upload_items.find('.pros_form_'+sign+'_item_'+field+'_upload_item_remover').off().on('click', function () {
                            //设置当前item移除
                            $(this).parents('.pros_form_'+sign+'_item_'+field+'_upload_item').remove();
                            //设置触发
                            file_input_trigger();
                        });
                    }, preview_trigger = function () {
                        //设置预览触发
                        upload_items.find('.pros_form_'+sign+'_item_'+field+'_upload_item_previewer').off().on('click', function () {
                           //新开窗口访问
                            window.open($(this).parents('.pros_form_'+sign+'_item_'+field+'_upload_item').attr('data-link'));
                        });
                    };
                     //判断对象是否存在
                    if (typeof target_object !== 'undefined') {
                        //设置点击触发上传
                        trigger_btn.on('click', function () {
                            //删除默认
                            input_uploader.val('');
                            //设置文件上传触发
                            input_uploader.trigger('click');
                        });
                    }
                    //设置上传触发
                    input_uploader.on('change', function (file) {
                        //整理信息
                        var upload_files = file.target.files;
                        //判断文件信息
                        if (typeof (upload_files) !== 'undefined' && !$.isEmptyObject(upload_files)) {
                            //加载loading
                            var loading = loadingStart(trigger_btn, _this[0], '正在上传文件...');
                            //循环文件信息
                            $.each(upload_files, function (i, item) {
                                //整理上传信息
                                var uploadData = new FormData();
                                //整理信息
                                uploadData.append('file', item);
                                uploadData.append('file_type', 'binary');
                                uploadData.append('dictionary', _this.attr('data-upload-dictionary'));
                                uploadData.append('origin_name', file.target.files[i]['name']);
                                //开始请求上传
                                $.ajax({
                                    type: 'post',
                                    url: _this.attr('data-upload-url'),
                                    data: uploadData,
                                    processData: false,
                                    contentType: false,
                                    success: function (res) {
                                        //判断上传状态
                                        if (res.state) {
                                            //添加内容
                                            upload_items.append(upload_item_template.replaceAll('__LINK__', res.data['link']).replaceAll('__FILE_NAME__', res.data['file_info']['basename']));
                                            //重置结果
                                            file_input_trigger();
                                            remove_trigger();
                                            preview_trigger();
                                        } else {
                                            //提示信息
                                            alertToast(res.msg, 2000, 'error', '文件上传');
                                        }
                                    },
                                    error: function (res) {
                                        //提示信息
                                        alertToast('网络错误，请稍后再试', 2000, 'error', '文件上传');
                                    }
                                });
                            });
                            //关闭弹窗
                            loadingStop(loading, trigger_btn);
                        }
                    });
                    //重置结果
                    file_input_trigger();
                    remove_trigger();
                    preview_trigger();
                    break;
                case 'pictures':
                    //整理信息
                    var modal_object, box = $("#pros_form_"+sign+"_item_"+field+"_upload_box"), empty_box = $("#pros_form_"+sign+"_item_"+field+"_upload_without_item"), upload_items = $("#pros_form_"+sign+"_item_"+field+"_upload_items"), trigger_btn = $("#pros_form_"+sign+"_item_"+field+"_trigger"), input_uploader = $("#pros_form_"+sign+"_item_"+field+"_uploader"), need_copper = parseInt(input_uploader.attr('data-cropper')), modal_html = '<div class="modal fade image_cropper_modal" id="pros_form_'+sign+'_image_cropper_modal_for_'+field+'" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">图片尺寸裁剪</h5><button class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="fa fa-times"></i></button></div><div class="modal-body"><div class="mb-5 w-100"><img id="pros_form_'+sign+'_image_cropper_img_for_'+field+'" class="d-block w-100" src="" style="max-height: 500px;width: 100%" alt=""/></div><div id="pros_form_'+sign+'_image_cropper_buttons_for_'+field+'" class="text-center"><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.zoom(0.1)" data-option="0.1" data-toggle="kt-tooltip" title="Zoom In"><span class="fa fa-search-plus"></span></button><button type="button" class="btn btn-default" data-method="cropper.zoom(-0.1)" data-toggle="kt-tooltip" title="Zoom Out"><span data-toggle="kt-tooltip" title=""><span class="fa fa-search-minus"></span></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.move(-10, 0)" data-toggle="kt-tooltip" title="Move Left"><span class="fa fa-arrow-left"></span></button><button type="button" class="btn btn-default" data-method="cropper.move(10, 0)" data-toggle="kt-tooltip" title="Move Right"><span class="fa fa-arrow-right"></span></button><button type="button" class="btn btn-default" data-method="cropper.move(0, -10)" data-toggle="kt-tooltip" title="Move Up"><span class="fa fa-arrow-up"></span></button><button type="button" class="btn btn-default" data-method="cropper.move(0, 10)" data-toggle="kt-tooltip" title="Move Down"><span class="fa fa-arrow-down"></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.rotate(-45)" data-toggle="kt-tooltip" title="Rotate Left"><span class="fa fa-undo-alt"></span></button><button type="button" class="btn btn-default" data-method="cropper.rotate(45)" data-toggle="kt-tooltip" title="Rotate Right"><span class="fa fa-redo-alt"></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.scaleX(-1)" data-toggle="kt-tooltip" title="Flip Horizontal"><span class="fa fa-arrows-alt-h"></span></button><button type="button" class="btn btn-default" data-method="cropper.scaleY(-1)" data-toggle="kt-tooltip" title="Flip Vertical"><span class="fa fa-arrows-alt-v"></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.reset()" data-toggle="kt-tooltip" title="Reset"><span class="fa fa-sync-alt"></span></button></div></div></div><div class="modal-footer"><button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal" data-bs-target="#pros_form_'+sign+'_image_cropper_modal_for_'+field+'" >取消</button><button type="button" class="btn btn-primary font-weight-bold confirm-to-crop">确认裁剪</button></div></div></div></div>', upload_item_template = '<div class="dropzone-item mx-3 my-3 p-0 mt-0 pros_form_'+sign+'_item_'+field+'_upload_item bg-light-primary" data-link="__LINK__"><a class="d-block overlay" href="javascript:;"><div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover" style="background-image:url(\'__LINK__\');height: '+input_uploader.attr('data-box-height')+'px;width: '+input_uploader.attr('data-box-width')+'px"></div><div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i class="fa fa-trash-alt text-danger fs-2x pros_form_'+sign+'_item_'+field+'_upload_item_remover"></i>'+(parseInt(form.attr('data-mobile')) !== 1 ? '<i class="fa fa-bars text-warning fs-2x ms-5"></i>' : '')+'</div></a></div>', file_input_trigger = function () {
                        //设置信息
                        var files = [];
                        //循环项目
                        upload_items.find('.pros_form_'+sign+'_item_'+field+'_upload_item').each(function () {
                            //添加信息
                            files.push($(this).attr('data-link'));
                        });
                        //判断长度
                        if (files.length > 0) {
                            //隐藏empty
                            empty_box.removeClass('d-none').addClass('d-none');
                        } else {
                            //显示empty
                            empty_box.removeClass('d-none');
                        }
                        //获取值
                        target_object.val(JSON.stringify(files)).change();
                        //重置tooltip
                        KTApp.initBootstrapTooltips();
                    }, remove_trigger = function () {
                        //设置移除触发
                        upload_items.find('.pros_form_'+sign+'_item_'+field+'_upload_item_remover').off().on('click', function () {
                            //设置当前item移除
                            $(this).parents('.pros_form_'+sign+'_item_'+field+'_upload_item').remove();
                            //设置触发
                            file_input_trigger();
                        });
                    };
                    //判断对象是否存在
                    if (typeof target_object !== 'undefined') {
                        //设置点击触发上传
                        trigger_btn.on('click', function () {
                            //删除默认
                            input_uploader.val('');
                            //判断是否需要裁剪
                            if (need_copper === 1) {
                                //创建上传modal
                                $('body').find('.image_cropper_modal').remove().end().append(modal_html);
                            }
                            //设置文件上传触发
                            input_uploader.trigger('click');
                        });
                    }
                    //设置上传触发
                    input_uploader.on('change', function (file) {
                            //判断是否需要裁剪
                            if (need_copper === 1) {
                                //引入文件读取实例
                                var reader = new FileReader(), modal = $("#pros_form_"+sign+"_image_cropper_modal_for_"+field), file_name = file.target.files[0]['name'], uploader_func = function (file_content, type = 'base64') {
                                    //整理基础信息
                                    var uploadData = new FormData(), confirm_crop = modal.find('div.modal-footer button.confirm-to-crop'), loading = loadingStart(confirm_crop, modal[0], '正在上传图片...');
                                    //整理信息
                                    uploadData.append('file', file_content);
                                    uploadData.append('file_type', type);
                                    uploadData.append('dictionary', _this.attr('data-upload-dictionary'));
                                    uploadData.append('origin_name', file.target.files[0]['name']);
                                    //开始请求上传
                                    $.ajax({
                                        type: 'post',
                                        url: _this.attr('data-upload-url'),
                                        data: uploadData,
                                        processData: false,
                                        contentType: false,
                                        success: function (res) {
                                            //判断上传状态
                                            if (res.state) {
                                                //添加内容
                                                upload_items.append(upload_item_template.replaceAll('__LINK__', res.data['link']).replaceAll('__FILE_NAME__', res.data['file_info']['basename']));
                                                //重置结果
                                                file_input_trigger();
                                                remove_trigger();
                                                //隐藏弹窗
                                                modal_object.hide();
                                            } else {
                                                //提示信息
                                                alertToast(res.msg, 2000, 'error', '图片上传');
                                            }
                                        },
                                        error: function (res) {
                                            //提示信息
                                            alertToast('网络错误，请稍后再试', 2000, 'error', '图片上传');
                                        }
                                    });
                                    //关闭弹窗
                                    loadingStop(loading, confirm_crop);
                                };
                                //判断是否需要裁剪
                                if (file_name.toLowerCase().indexOf('.gif') > -1) {
                                    //上传图片
                                    uploader_func(file.target.files[0], 'binary');
                                } else {
                                    //判断是否加载成功
                                    reader.onload = (function (e) {
                                        //引入样式文件
                                        createExtraCss(form.attr('data-source-path')+'/cropper/cropper.bundle.css', function () {
                                            //引入文件信息(JS)
                                            createExtraJs(form.attr('data-source-path')+'/cropper/cropper.bundle.js', typeof (Cropper), function () {
                                                //获取图片实例
                                                var img = modal.find("#pros_form_"+sign+"_image_cropper_img_for_"+field);
                                                //触发时间
                                                modal.on('shown.bs.modal', function () {
                                                    //判断图片是否加载完成
                                                    img[0].onload = function () {
                                                        //实例化cropper
                                                        var cropper = new Cropper(img[0], {
                                                            viewMode: 2,
                                                            dragMode: 'move',
                                                            aspectRatio: parseInt(input_uploader.attr('data-width'))/parseInt(input_uploader.attr('data-height')),
                                                            mouseWheelZoom: false,
                                                            autoCropArea: 0.5,
                                                            dragCrop: false,
                                                            zoomOnWheel: false
                                                        });
                                                        //触发关闭弹窗事件
                                                        modal.on('hidden.bs.modal', function () {
                                                            //销毁信息
                                                            cropper.destroy();
                                                            //删除弹窗
                                                            modal.remove();
                                                        });
                                                        //触发确认裁剪事件
                                                        modal.find('div.modal-footer button.confirm-to-crop').on('click', function () {
                                                            //获取截取数据
                                                            var cropper_base64 = cropper.getCroppedCanvas({
                                                                imageSmoothingQuality: 'high'
                                                            }).toDataURL('image/png');
                                                            //上传图片
                                                            uploader_func(cropper_base64, 'image_base64');
                                                        });
                                                        //设置按钮触发
                                                        modal.find("#pros_form_"+sign+"_image_cropper_buttons_for_"+field+" button").on('click', function () {
                                                            //判断处理方法
                                                            switch ($(this).attr('data-method')) {
                                                                case 'cropper.zoom(0.1)':
                                                                    cropper.zoom(0.1);
                                                                    break;
                                                                case 'cropper.zoom(-0.1)':
                                                                    cropper.zoom(-0.1);
                                                                    break;
                                                                case 'cropper.move(-10, 0)':
                                                                    cropper.move(-10, 0);
                                                                    break;
                                                                case 'cropper.move(10, 0)':
                                                                    cropper.move(10, 0);
                                                                    break;
                                                                case 'cropper.move(0, -10)':
                                                                    cropper.move(0, -10);
                                                                    break;
                                                                case 'cropper.move(0, 10)':
                                                                    cropper.move(0, 10);
                                                                    break;
                                                                case 'cropper.rotate(45)':
                                                                    cropper.rotate(45);
                                                                    break;
                                                                case 'cropper.rotate(-45)':
                                                                    cropper.rotate(-45);
                                                                    break;
                                                                case 'cropper.scaleX(-1)':
                                                                    cropper.scaleX(-1);
                                                                    break;
                                                                case 'cropper.scaleY(-1)':
                                                                    cropper.scaleY(-1);
                                                                    break;
                                                                default:
                                                                    cropper.reset()
                                                                    break;
                                                            }
                                                        });
                                                    };
                                                    //设置cropper
                                                    img.attr('src', e.target.result).attr('alt', file.target.files[0]['name']);
                                                });
                                                //显示弹窗
                                                modal_object = new bootstrap.Modal(modal[0], {backdrop: 'static', keyboard: false});
                                                modal_object.show();
                                            });
                                        });
                                    });
                                    //获取数据流
                                    reader.readAsDataURL(file.target.files[0]);
                                }
                            } else {
                                //整理信息
                                var upload_files = file.target.files;
                                //判断文件信息
                                if (typeof (upload_files) !== 'undefined' && !$.isEmptyObject(upload_files)) {
                                    //加载loading
                                    var loading = loadingStart(trigger_btn, _this[0], '正在上传图片...');
                                    //循环文件信息
                                    $.each(upload_files, function (i, item) {
                                        //整理上传信息
                                        var uploadData = new FormData();
                                        //整理信息
                                        uploadData.append('file', item);
                                        uploadData.append('file_type', 'binary');
                                        uploadData.append('dictionary', _this.attr('data-upload-dictionary'));
                                        uploadData.append('origin_name', file.target.files[i]['name']);
                                        //开始请求上传
                                        $.ajax({
                                            type: 'post',
                                            url: _this.attr('data-upload-url'),
                                            data: uploadData,
                                            processData: false,
                                            contentType: false,
                                            success: function (res) {
                                                //判断上传状态
                                                if (res.state) {
                                                    //添加内容
                                                    upload_items.append(upload_item_template.replaceAll('__LINK__', res.data['link']).replaceAll('__FILE_NAME__', res.data['file_info']['basename']));
                                                    //重置结果
                                                    file_input_trigger();
                                                    remove_trigger();
                                                } else {
                                                    //提示信息
                                                    alertToast(res.msg, 2000, 'error', '文件上传');
                                                }
                                            },
                                            error: function (res) {
                                                //提示信息
                                                alertToast('网络错误，请稍后再试', 2000, 'error', '文件上传');
                                            }
                                        });
                                    });
                                    //关闭弹窗
                                    loadingStop(loading, trigger_btn);
                                }
                            }
                        });
                        //重置结果
                        file_input_trigger();
                        remove_trigger();
                    break;
                case 'image':
                    //整理信息
                    var modal_object, box = $("#pros_form_"+sign+"_item_"+field+"_upload_box"), wrapper = $("#pros_form_"+sign+"_item_"+field+"_wrapper"), trigger_btn = $("#pros_form_"+sign+"_item_"+field+"_trigger"), remover_btn = $("#pros_form_"+sign+"_item_"+field+"_remover"), input_uploader = $("#pros_form_"+sign+"_item_"+field+"_uploader"), need_copper = parseInt(input_uploader.attr('data-cropper')), modal_html = '<div class="modal fade image_cropper_modal" id="pros_form_'+sign+'_image_cropper_modal_for_'+field+'" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">图片尺寸裁剪</h5><button class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="fa fa-times"></i></button></div><div class="modal-body"><div class="mb-5 w-100"><img id="pros_form_'+sign+'_image_cropper_img_for_'+field+'" class="d-block w-100" src="" style="max-height: 500px;width: 100%" alt=""/></div><div id="pros_form_'+sign+'_image_cropper_buttons_for_'+field+'" class="text-center"><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.zoom(0.1)" data-option="0.1" data-toggle="kt-tooltip" title="Zoom In"><span class="fa fa-search-plus"></span></button><button type="button" class="btn btn-default" data-method="cropper.zoom(-0.1)" data-toggle="kt-tooltip" title="Zoom Out"><span data-toggle="kt-tooltip" title=""><span class="fa fa-search-minus"></span></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.move(-10, 0)" data-toggle="kt-tooltip" title="Move Left"><span class="fa fa-arrow-left"></span></button><button type="button" class="btn btn-default" data-method="cropper.move(10, 0)" data-toggle="kt-tooltip" title="Move Right"><span class="fa fa-arrow-right"></span></button><button type="button" class="btn btn-default" data-method="cropper.move(0, -10)" data-toggle="kt-tooltip" title="Move Up"><span class="fa fa-arrow-up"></span></button><button type="button" class="btn btn-default" data-method="cropper.move(0, 10)" data-toggle="kt-tooltip" title="Move Down"><span class="fa fa-arrow-down"></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.rotate(-45)" data-toggle="kt-tooltip" title="Rotate Left"><span class="fa fa-undo-alt"></span></button><button type="button" class="btn btn-default" data-method="cropper.rotate(45)" data-toggle="kt-tooltip" title="Rotate Right"><span class="fa fa-redo-alt"></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.scaleX(-1)" data-toggle="kt-tooltip" title="Flip Horizontal"><span class="fa fa-arrows-alt-h"></span></button><button type="button" class="btn btn-default" data-method="cropper.scaleY(-1)" data-toggle="kt-tooltip" title="Flip Vertical"><span class="fa fa-arrows-alt-v"></span></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-method="cropper.reset()" data-toggle="kt-tooltip" title="Reset"><span class="fa fa-sync-alt"></span></button></div></div></div><div class="modal-footer"><button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal" data-bs-target="#pros_form_'+sign+'_image_cropper_modal_for_'+field+'" >取消</button><button type="button" class="btn btn-primary font-weight-bold confirm-to-crop">确认裁剪</button></div></div></div></div>';;
                    //判断对象是否存在
                    if (typeof target_object !== 'undefined') {
                        //设置点击触发上传
                        trigger_btn.on('click', function () {
                            //删除默认
                            input_uploader.val('');
                            //判断是否需要裁剪
                            if (need_copper === 1) {
                                //创建上传modal
                                $('body').find('.image_cropper_modal').remove().end().append(modal_html);
                            }
                            //设置文件上传触发
                            input_uploader.trigger('click');
                        });
                        //移除图片触发
                        remover_btn.on('click', function () {
                            //清空内容
                            target_object.val('').change();
                            //设置图片地址
                            wrapper.css('background', 'unset');
                        });
                        //设置上传触发
                        input_uploader.on('change', function (file) {
                            //引入文件读取实例
                            var reader = new FileReader(), modal = $("#pros_form_"+sign+"_image_cropper_modal_for_"+field), file_name = file.target.files[0]['name'], uploader_func = function (file_content, type = 'base64') {
                                //整理基础信息
                                var uploadData = new FormData(), loading, confirm_crop = modal.find('div.modal-footer button.confirm-to-crop');
                                //判断是否需要裁剪
                                if (need_copper === 1) {
                                    //设置modal触发
                                    loading = loadingStart(confirm_crop, modal[0], '正在上传图片...');
                                } else {
                                    //设置基本触发
                                    loading = loadingStart(trigger_btn, _this[0], '正在上传图片...')
                                }
                                //整理信息
                                uploadData.append('file', file_content);
                                uploadData.append('file_type', type);
                                uploadData.append('dictionary', _this.attr('data-upload-dictionary'));
                                uploadData.append('origin_name', file.target.files[0]['name']);
                                //开始请求上传
                                $.ajax({
                                    type: 'post',
                                    url: _this.attr('data-upload-url'),
                                    data: uploadData,
                                    processData: false,
                                    contentType: false,
                                    success: function (res) {
                                        //判断上传状态
                                        if (res.state) {
                                            //设置内容
                                            target_object.val(res.data['link']).change();
                                            //设置图片地址
                                            wrapper.css({
                                                'background': 'url('+res.data['link']+')',
                                                'background-size': 'cover',
                                                'background-repeat': 'no-repeat',
                                            });
                                            //判断是否需要裁剪
                                            if (need_copper === 1) {
                                                //隐藏弹窗
                                                modal_object.hide();
                                            }
                                        } else {
                                            //提示信息
                                            alertToast(res.msg, 2000, 'error', '图片上传');
                                        }
                                    },
                                    error: function (res) {
                                        //提示信息
                                        alertToast('网络错误，请稍后再试', 2000, 'error', '图片上传');
                                    }
                                });
                                //判断是否需要裁剪
                                if (need_copper === 1) {
                                    //关闭弹窗
                                    loadingStop(loading, confirm_crop);
                                } else {
                                    //关闭弹窗
                                    loadingStop(loading, trigger_btn);
                                }
                            };
                            //判断是否需要裁剪
                            if (need_copper !== 1 || file_name.toLowerCase().indexOf('.gif') > -1) {
                                //上传图片
                                uploader_func(file.target.files[0], 'binary');
                            } else {
                                //判断是否加载成功
                                reader.onload = (function (e) {
                                    //引入样式文件
                                    createExtraCss(form.attr('data-source-path')+'/cropper/cropper.bundle.css', function () {
                                        //引入文件信息(JS)
                                        createExtraJs(form.attr('data-source-path')+'/cropper/cropper.bundle.js', typeof (Cropper), function () {
                                            //获取图片实例
                                            var img = modal.find("#pros_form_"+sign+"_image_cropper_img_for_"+field);
                                            //触发时间
                                            modal.on('shown.bs.modal', function () {
                                                //判断图片是否加载完成
                                                img[0].onload = function () {
                                                    //实例化cropper
                                                    var cropper = new Cropper(img[0], {
                                                        viewMode: 2,
                                                        dragMode: 'move',
                                                        aspectRatio: parseInt(input_uploader.attr('data-width'))/parseInt(input_uploader.attr('data-height')),
                                                        mouseWheelZoom: false,
                                                        autoCropArea: 0.5,
                                                        dragCrop: false,
                                                        zoomOnWheel: false
                                                    });
                                                    //触发关闭弹窗事件
                                                    modal.on('hidden.bs.modal', function () {
                                                        //销毁信息
                                                        cropper.destroy();
                                                        //删除弹窗
                                                        modal.remove();
                                                    });
                                                    //触发确认裁剪事件
                                                    modal.find('div.modal-footer button.confirm-to-crop').on('click', function () {
                                                        //获取截取数据
                                                        var cropper_base64 = cropper.getCroppedCanvas({
                                                            imageSmoothingQuality: 'high'
                                                        }).toDataURL('image/png');
                                                        //上传图片
                                                        uploader_func(cropper_base64, 'image_base64');
                                                    });
                                                    //设置按钮触发
                                                    modal.find("#pros_form_"+sign+"_image_cropper_buttons_for_"+field+" button").on('click', function () {
                                                        //判断处理方法
                                                        switch ($(this).attr('data-method')) {
                                                            case 'cropper.zoom(0.1)':
                                                                cropper.zoom(0.1);
                                                                break;
                                                            case 'cropper.zoom(-0.1)':
                                                                cropper.zoom(-0.1);
                                                                break;
                                                            case 'cropper.move(-10, 0)':
                                                                cropper.move(-10, 0);
                                                                break;
                                                            case 'cropper.move(10, 0)':
                                                                cropper.move(10, 0);
                                                                break;
                                                            case 'cropper.move(0, -10)':
                                                                cropper.move(0, -10);
                                                                break;
                                                            case 'cropper.move(0, 10)':
                                                                cropper.move(0, 10);
                                                                break;
                                                            case 'cropper.rotate(45)':
                                                                cropper.rotate(45);
                                                                break;
                                                            case 'cropper.rotate(-45)':
                                                                cropper.rotate(-45);
                                                                break;
                                                            case 'cropper.scaleX(-1)':
                                                                cropper.scaleX(-1);
                                                                break;
                                                            case 'cropper.scaleY(-1)':
                                                                cropper.scaleY(-1);
                                                                break;
                                                            default:
                                                                cropper.reset()
                                                                break;
                                                        }
                                                    });
                                                };
                                                //设置cropper
                                                img.attr('src', e.target.result).attr('alt', file.target.files[0]['name']);
                                            });
                                            //显示弹窗
                                            modal_object = new bootstrap.Modal(modal[0], {backdrop: 'static', keyboard: false});
                                            modal_object.show();
                                        });
                                    });
                                });
                                //获取数据流
                                reader.readAsDataURL(file.target.files[0]);
                            }
                        });
                    }
                    break;
            }
        });
    },
    setToolTriggers: function (form, sign) {
        //循环表单中复制操作
        form.find('.pros_'+sign+'_form_item_tool[data-action-type="clipboard"]').each(function () {
            //设置复制
            var _this = $(this);
            //设置复制触发
            new ClipboardJS(_this[0]).on('success', function (e) {
                //获取原文字
                var triggerCaption = _this.html(), target_dom = $(_this.attr('data-clipboard-target'));
                //判断是否已触发
                if (!target_dom.hasClass('bg-success text-inverse-success')) {
                    //设置样式
                    target_dom.addClass('bg-success text-inverse-success');
                    //设置文字
                    _this.text('复制成功！');
                    //设置延迟关闭
                    setTimeout(function () {
                        //还原
                        _this.html(triggerCaption);
                        target_dom.removeClass('bg-success text-inverse-success');
                    }, 2000);
                }
                //停止冒泡
                e.clearSelection();
            })
        });
        //循环表单中链接操作
        form.find('.pros_'+sign+'_form_item_tool[data-action-type="link"]').on('click', function () {
            //设置复制
            var  _this = $(this), target_dom = $(_this.attr('data-link-target')), link_val = target_dom.val();
            //判断信息
            if (typeof link_val !== 'undefined' && link_val.length > 0) {
                //跳转页面
                window.open(link_val);
            } else {
                //提示错误
                alertToast('链接内容不可用，请查看后再试！', 2000, 'info', '中断提示');
            }
        });
        //整理参数
        var __THIS__ = this, modal_id = form.attr('data-modal-id'), submit_btn = $("#pros_"+sign+"_form_submit_button"), back_btn = $("#pros_"+sign+"_form_back_button");
        //判断对象是否存在
        if (typeof back_btn !== 'undefined' && back_btn.length > 0) {
            //设置触发
            back_btn.off().on('click', function () {
                //获取参数
                var _this = $(this), confirm_tip = _this.attr('data-confirm-tip'), params = JSON.parse(_this.attr('data-params')), func = function () {
                    //判断是否新开页面
                    if (params['target']) {
                        //新开页面跳转
                        window.open(params['query_url']);
                    } else {
                        //当前页面刷新
                        window.location.href = params['query_url'];
                    }
                };
                //判断是否提示后触发
                if (typeof confirm_tip !== 'undefined' && confirm_tip.length > 0) {
                    //弹窗触发
                    confirmPopup(confirm_tip, function () {
                        //执行按钮操作
                        func();
                    });
                } else {
                    //执行按钮操作
                    func();
                }
            });
        }
        //判断对象是否存在
        if (typeof submit_btn !== 'undefined' && submit_btn.length > 0) {
            //设置触发
            submit_btn.off().on('click', function () {
                //获取参数
                var _this = $(this), confirm_tip = _this.attr('data-confirm-tip'), params = JSON.parse(_this.attr('data-params')), func = function () {
                    //获取表单参数
                    var form_params = __THIS__.arrangeFormParams(form, sign), submit_func = function (formData) {
                        //判断参数默认是否存在
                        if (typeof (formData) == 'undefined') {
                            //设置默认参数
                            formData = {};
                        }
                        //加载loading
                        var loading = loadingStart(_this, form[0], '正在提交保存...'), modal_object = $("#"+modal_id);
                        //创建请求
                        buildRequest(params['query_url'], formData, params['query_method'], true, function (res) {
                            //判断是否绑定modal
                            if (typeof modal_id !== 'undefined' && modal_id.length > 0 && typeof modal_object !== 'undefined') {
                                //关闭弹窗
                                modal_object.find('#'+modal_id+'_close_icon').trigger('click');
                            } else {
                                //根据配置处理
                                switch (params['after']) {
                                    case 'reload':
                                        //刷新页面
                                        window.location.reload();
                                        break;
                                    default:
                                        //跳转指定链接
                                        window.location.href = params['after'];
                                        break;
                                }
                            }
                        }, function (res) {
                            //提示错误
                            alertToast(res.msg, 2000, 'error');
                        }, function () {
                            //关闭弹窗
                            loadingStop(loading, _this);
                        })
                    };
                    //判断参数
                    if (typeof (form_params) === "object") {
                        //判断是否存在更改
                        if ($.isEmptyObject(form_params)) {
                            //提示错误
                            alertToast('暂无更改项，请更改内容后再试！', 2000, 'warning');
                        } else {
                            submit_func(form_params);
                        }
                    }
                };
                //判断是否提示后触发
                if (typeof confirm_tip !== 'undefined' && confirm_tip.length > 0) {
                    //弹窗触发
                    confirmPopup(confirm_tip, function () {
                        //执行按钮操作
                        func();
                    });
                } else {
                    //执行按钮操作
                    func();
                }
            });
        }
    },
    arrangeFormParams: function (form, sign) {
        //整理参数
        var __THIS__ = this, modal_id = form.attr('data-modal-id'), params = {}, edited = [], validator_trigger = function (this_item, tip) {
            //判断是否为表单整体提示
            if (this_item === form) {
                //滑动到表单顶部
                scrollToObject(form);
                //提示信息
                alertToast(tip, 3000, 'warning');
            } else {
                //获取当前项对应panel
                var panel = this_item.parents('.pros_form_'+sign+'_panel'), panel_alias = panel.attr('data-alias'), tabs_box = $("#pros_form_"+sign+"_tabs");
                //判断tab是否存在
                if (typeof (tabs_box) !== 'undefined' && tabs_box.length > 0) {
                    //触发点击
                    tabs_box.find('.nav-link[data-alias="'+panel_alias+'"]').trigger('click');
                }
                //判断是否为modal
                if (typeof (modal_id) === 'undefined' || modal_id.length <= 0) {
                    //滑动页面
                    scrollToObject(this_item);
                } else {
                    //滑动modal
                    scrollToObject(this_item, $('#'+modal_id).find('.modal-body'))
                }
                //判断提示内容
                if (typeof tip === 'undefined' || tip.length <= 0) {
                    //设置提示
                    tip = '此项为必填项( * )，请更新此项内容后再试';
                }
                //新增提示
                this_item.append('<div class="fs-7 fw-bold text-danger my-2 validator_tip">'+tip+'</div>');
            }
            //跳出循环
            return false;
        };
        //循环所有表单项
        form.find('.pros_form_'+sign+'_item_box').each(function () {
            //获取基础数据
            var _this = $(this), type = _this.attr('data-type'), required = _this.attr('data-required'), target = _this.attr('data-target'), target_object = $(target), field = _this.attr('data-field'), default_value = _this.attr('data-default-value');
            //判断未隐藏并已修改信息
            if (!_this.hasClass('d-none')) {
                //判断是否更改
                if (!$("#pros_form_"+sign+"_item_"+field+"_edited_warning").hasClass('d-none')) {
                    //设置已更改
                    edited.push(field);
                }
                //根据类型处理
                switch (type) {
                    case 'tags':
                        //设置默认值
                        var tag_item_values = [];
                        //获取值
                        var tags_value = target_object.val();
                        //判断信息
                        if (typeof tags_value !== 'undefined' && tags_value.length > 0) {
                            //循环内容
                            $.each(JSON.parse(tags_value), function (i, item) {
                                //新增字段
                                tag_item_values.push(checkNumberOrString(item.value));
                            });
                        }
                        //判断不为空
                        if (parseInt(required) === 1 && $.isEmptyObject(tag_item_values)) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //设置内容
                        params[field] = tag_item_values;
                        break;
                    case 'select':
                    case 'icon':
                        //获取值
                        var select_item_value = checkNumberOrString(target_object.val());
                        //判断信息
                        if (parseInt(required) === 1 && (typeof (select_item_value) === 'undefined' || select_item_value.length <= 0 || select_item_value === '')) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //设置内容
                        params[field] = select_item_value;
                        break;
                    case 'switch':
                        //设置内容
                        params[field] = checkNumberOrString(target_object.is(':checked') ? target_object.attr('data-on-value') :target_object.attr('data-off-value'));
                        break;
                    case 'files':
                    case 'pictures':
                        //设置默认值
                        var file_item_values = target_object.val();
                        //整理信息
                        file_item_values = (typeof (file_item_values) === 'undefined' || file_item_values.length <= 0) ? [] : JSON.parse(file_item_values);
                        //判断信息
                        if (parseInt(required) === 1 && $.isEmptyObject(file_item_values)) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //设置内容
                        params[field] = file_item_values;
                        break;
                    case 'radio':
                    case 'normal_radio':
                    case 'image_radio':
                    case 'group_radio':
                        //获取选中值
                        var radio_item_value = $(target+':checked').val();
                        //判断信息
                        if (parseInt(required) === 1 && (typeof (radio_item_value) === 'undefined' || radio_item_value.length <= 0)) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //设置内容
                        params[field] = checkNumberOrString(radio_item_value);
                        break;
                    case 'checkbox':
                    case 'normal_checkbox':
                    case 'image_checkbox':
                    case 'group_checkbox':
                        //设置默认值
                        var checkbox_item_values = [];
                        //循环对象
                        target_object.each(function () {
                            //判断是否选中
                            if ($(this).is(':checked')) {
                                //添加值
                                checkbox_item_values.push(checkNumberOrString($(this).val()));
                            }
                        });
                        //判断信息
                        if (parseInt(required) === 1 && (typeof (checkbox_item_values) === 'undefined' || $.isEmptyObject(checkbox_item_values) || checkbox_item_values.length <= 0)) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //设置内容
                        params[field] = checkbox_item_values;
                        break;
                    case 'input':
                        //获取值
                        var input_value = checkNumberOrString(target_object.val());
                        //判断信息
                        if (parseInt(required) === 1 && (typeof (input_value) === 'undefined' || input_value.length <= 0)) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //获取input类型
                        switch (target_object.attr('data-input-mode')) {
                            case 'price':
                                //判断是否存在价格系数
                                var price_ratio = target_object.attr('data-price-ratio');
                                //判断状态
                                if (typeof input_value == 'number' && typeof (price_ratio) !== 'undefined' && price_ratio.length > 0 && parseInt(price_ratio) > 0) {
                                    //计算值
                                    input_value = parseInt(parseFloat(input_value) * parseInt(price_ratio));
                                } else {
                                    input_value = 0;
                                }
                                break;
                        }
                        //设置内容
                        params[field] = input_value;
                        break;
                    default:
                        //获取值
                        var item_value = target_object.val();
                        //判断信息
                        if (parseInt(required) === 1 && (typeof (item_value) === 'undefined' || item_value.length <= 0)) {
                            //验证提示
                            return (params = validator_trigger(_this));
                        }
                        //设置内容
                        params[field] = item_value;
                        break;
                }
            }
        });
        //判断是否存在更改
        if (params && $.isEmptyObject(edited)) {
            //验证提示
            return (params = validator_trigger(form, '信息无更新'));
        }
        //返回参数
        return params ? {'__data__': params, '__edited__': edited} : false;
    }
}
