<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/zuoan/Public/easyui/themes/default/easyui.css" />
    <link rel="stylesheet" type="text/css" href="/zuoan/Public/css/wu.css" />
    <link rel="stylesheet" type="text/css" href="/zuoan/Public/css/icon.css" />
    <script type="text/javascript" src="/zuoan/Public/js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="/zuoan/Public/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/zuoan/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
</head>

<body>

</body>
</html>
<div class="easyui-layout" data-options="fit:true">
    <!-- Begin of toolbar -->
    <div id="wu-toolbar-2">
        <div class="wu-toolbar-button">
            <a href="#" class="easyui-linkbutton" iconCls="icon-add" onclick="openAdd()" plain="true">添加</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-reload" onclick="reload()" plain="true">刷新</a>
        </div>
        <div class="wu-toolbar-search">
            <label>类别：</label>
            <select id="lbs" class="easyui-combobox" panelHeight="auto" style="width:100px">
                <option value="-1">请选择</option>

            </select>
            <label>关键词：</label><input id="gjz" class="wu-text" style="width:100px">
            <a href="#" onclick="openSelect()" class="easyui-linkbutton" iconCls="icon-search">开始检索</a>
        </div>
    </div>
    <!-- End of toolbar -->
    <table id="wu-datagrid-2" class="easyui-datagrid" toolbar="#wu-toolbar-2"></table>
</div>
<!-- Begin of easyui-dialog -->
<div id="wu-dialog-2" class="easyui-dialog" data-options="closed:true,iconCls:'icon-save' "
     style="width:400px; padding:10px;">
    <form id="wu-form-2" method="post" name="registrationForm">
        <label width="20%">类别：</label>
        <select id="lb" class="easyui-combobox" panelHeight="auto" style="width:100px" name="lb">
            <option value="-1">请选择</option>

        </select>
        <table>
            <tr>
                <td align="right" rowspan="5" width="20%">
                    照片：
                </td>
                <td rowspan="5">
                    <img id="upload_face" src="<?php echo (PUBLIC_PATH); ?>/noface.gif"
                         style="width:108px;height:128px;"/>
                    <input id="face" name="face" type="file" onchange="c()"/>
                    <input id="studentFace" name="studentFace" type="hidden"/>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="20%" align="right">菜名：</td>
                <td><input type="text" id="foodname" name="foodname" class="wu-text"/></td>
            </tr>
            <tr>
                <td width="20%" align="right">价格：</td>
                <td><input type="text" id="price" name="price" class="wu-text"/></td>
            </tr>

        </table>
    </form>
</div>
<!-- End of easyui-dialog -->
<script type="text/javascript">
    var id = "";

    /**
     * Name 添加记录
     */
    function add() {
        //头像上传
        var fd = new FormData();
        fd.append("file", $("#face").get(0).files[0]);
        $.ajax({
            type: 'post',
            url: "<?php echo U('Dishes/savePhoto','','');?>",
            processData: false,
            contentType: false,
            data: fd,
            async: false,
            dataType: 'json',
            success: function (data) {

                //$('#wu-dialog-2').dialog('close');
                //$.messager.alert('信息提示', '添加成功', 'info');

            }
        });
        $('#wu-form-2').form('submit', {
            url: "<?php echo U('Dishes/save','','');?>",
            onSubmit: function () {
                // do some check
                // return false to prevent submit;
            },
            success: function (data) {
                console.log(JSON.parse(data));
                $.messager.alert('信息提示', JSON.parse(data), 'info', function () {
                    $('#wu-dialog-2').dialog('close');
                    window.location.reload();
                    //location.reload();//刷新页面
                });
            }
        });
    }

    /**
     * Name 修改记录
     */
    function edit() {
        //修改头像上传
        var fd = new FormData();
        fd.append("file", $("#face").get(0).files[0]);
        fd.append("id", id);
        $.ajax({
            type: 'post',
            url: "<?php echo U('Dishes/savePhoto','','');?>",
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                // $('#wu-dialog-2').dialog('close');
                //$.messager.alert('信息提示', '添加成功', 'info'，);
            }
        });
        //alert(id);
        $('#wu-form-2').form('submit', {
            url: 'edit',
            onSubmit: function (param) {
                param.id = id;

            },
            success: function (data) {
                //console.log(JSON.parse(data));
                //alert(JSON.parse(data));
                $.messager.alert('信息提示', JSON.parse(data), 'info', function () {
                    $('#wu-dialog-2').dialog('close');
                    window.location.reload();
                    //location.reload();//刷新页面
                });

            }
        });
    }

    /**
     * Name 删除记录
     */
    function remove(index) {
        $("#wu-datagrid-2").datagrid("checkRow", index);
        var row = $('#wu-datagrid-2').datagrid('getSelected');
        //console.log(row.f_picture);
        $.messager.confirm('信息提示', '确定要删除该记录？', function (result) {

            if (result) {
                var items = $('#wu-datagrid-2').datagrid('getSelections');
                ;
                $.ajax({
                    url: "<?php echo U('Dishes/del','','');?>",
                    data: {'id': row.id, 'face': row.f_picture},
                    type: "post",
                    async: false,
                    dataType: "json",
                    success: function (data) {
                            $.messager.alert('信息提示', data, 'info', function () {
                                $('#wu-dialog-2').dialog('close');
                                window.location.reload();
                                //location.reload();//刷新页面
                            });

                    }
                });
            }
        });
    }

    /**
     * Name 打开添加窗口
     */
    function openAdd() {
        $('#wu-form-2').form('clear');
        $('#lb').combobox("setValue", '请选择');
        $('#wu-dialog-2').dialog({
            closed: false,
            modal: true,
            title: "添加信息",
            buttons: [{
                text: '确定',
                iconCls: 'icon-ok',
                handler: add
            }, {
                text: '取消',
                iconCls: 'icon-cancel',
                handler: function () {
                    $('#wu-dialog-2').dialog('close');
                }
            }]
        });
    }

    /**
     * Name 打开修改窗口
     */
    function openEdit(index) {
        $("#wu-datagrid-2").datagrid("checkRow", index)//选中当前行
        var rows = $("#wu-datagrid-2").datagrid("getRows");
        var rowa = rows[index];


        $('#wu-form-2').form('clear');
        var row = $('#wu-datagrid-2').datagrid('getSelected');
        id = row['id'];
        $('#lb').combobox("setValue", row.fs_id);
        $('#upload_face').attr("src", "<?php echo (PUBLIC_PATH); ?>/" + row.f_picture);
        $("input[name=studentFace]").val('<?php echo (PUBLIC_PATH); ?>/' + row.f_picture);
        $("#foodname").val(rowa.f_name);//填充菜名
        $("#price").val(rowa.f_price);//填充价格

        $('#wu-dialog-2').dialog({
            closed: false,
            modal: true,
            title: "修改信息",
            buttons: [{
                text: '确定',
                iconCls: 'icon-ok',
                handler: edit

            }, {
                text: '取消',
                iconCls: 'icon-cancel',
                handler: function () {
                    $('#wu-dialog-2').dialog('close');
                }
            }]
        });
    }


    /**
     * Name 载入数据
     */
    $(function () {
        $.ajax({
            type: "post",
            url: "<?php echo U('Dishes/selectLB','','');?>",
            dataType: "json",
            async: false,
            success: function (data) {

                $('#lbs').combobox({
                    valueField: 'id',
                    textField: 'foodname',
                    data: data,
                });
                $('#lb').combobox({
                    valueField: 'id',
                    textField: 'foodname',
                    data: data,
                });
                $('#lbs').combobox("setValue", '请选择');
            }
        });
        $('#wu-datagrid-2').datagrid({
            url: 'select',
            singleSelect: true,
            rownumbers: true,//行号
            pagination: true,     //开启分页
            pageSize: 10,         //分页大小
            pageNumber: 1,         //第几页显示（默认第一页，可以省略）
            pageList: [10, 20, 30], //设置每页记录条数的列表
            columns: [[

                {field: 'id', title: 'id', width: '10%', align: 'center'},
                {field: 'f_name', title: '菜名', width: '15%', align: 'center'},
                {field: 'f_price', title: '价格', width: '15%', align: 'center'},
                {
                    field: 'f_picture',
                    title: '图片',
                    width: '40%',
                    align: 'center',
                    formatter: function (value, row, index) {
                        //console.log(value,row,index);
                        //如下的写法太复杂了,注意只有数字才这么写.
                        return '<img width="80px" height="40px" border="0" src="<?php echo (PUBLIC_PATH); ?>' + value + '"/>';
                    }
                },
                {field: 'operation', title: '操作', width: '20%', align: 'center', formatter: caozuo}

            ]]

        });
        // datagrid数据表格ID
        var datagridId = 'wu-datagrid-2';

        // 第一次加载时自动变化大小
        $('#' + datagridId).resizeDataGrid(0, 0, 0, 0);

        // 当窗口大小发生变化时，调整DataGrid的大小
        $(window).resize(function () {
            $('#' + datagridId).resizeDataGrid(0, 0, 0, 0);
        });


    })
    //easyui的datagrid宽度自适应扩展方法
    $.fn.extend({
        resizeDataGrid: function (heightMargin, widthMargin, minHeight, minWidth) {
            var height = $(document.body).height() - heightMargin;
            var width = $(document.body).width() - widthMargin;

            height = height < minHeight ? minHeight : height;
            width = width < minWidth ? minWidth : width;

            $('#wu-datagrid-2').datagrid('resize', {
                height: height,
                width: width
            });
        }
    });


    function caozuo(value, row, index) {
        return "<a href='#' id='update' onclick='openEdit(" + index + ")' class='easyui-linkbutton' name='disDorm'>修改</a>&nbsp;&nbsp;" +
            "<a href='#' id='delete' onclick='remove(" + index + ")' class='easyui-linkbutton' name='disDorm'>删除</a>";
    }

    /*
    图片上传预览
    */

    function c() {

        var r = new FileReader();
        f = document.getElementById('face').files[0];
        if (f) {
            r.readAsDataURL(f);
            r.onload = function (e) {
                document.getElementById('upload_face').src = this.result;
            };


        } else {
            $("#upload_face").show();
            var src = "<?php echo (PUBLIC_PATH); ?>/images/noface.gif";
            $("#upload_face").attr("src", src);
        }
    };

    /*
  * 开始搜索
  * */
    function openSelect() {
        var gjz = $('#gjz').val();
        var lbs_id = $('#lbs').combobox("getValue");

        $.ajax({
            url: "<?php echo U('Dishes/selectLB','','');?>",
            data: {'gjz': gjz, 'lbs_id': lbs_id, 'datatype': 'lbs'},
            type: 'post',
            success: function (data) {

                // console.log(data);
                $('#wu-datagrid-2').datagrid('loadData', data);

            }
        })
    }

    /*
  * 刷新页面
  */
    function reload() {
        location.reload();//刷新页面
    }


</script>