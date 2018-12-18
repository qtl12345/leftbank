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
            <label>关键词：</label><input id="text" class="wu-text" style="width:100px">
            <a href="#" onclick="openSelect()" class="easyui-linkbutton" iconCls="icon-search">开始检索</a>
        </div>
    </div>
    <!-- End of toolbar -->
    <table id="wu-datagrid-2" class="easyui-datagrid" toolbar="#wu-toolbar-2"></table>
</div>
<!-- Begin of easyui-dialog -->
<div id="wu-dialog-2" class="easyui-dialog" data-options="closed:true,iconCls:'icon-save'"
     style="width:400px; padding:10px;">
    <form id="wu-form-2" method="post">
        <table>
            <tr>
                <td width="60" align="right">菜品类别</td>
                <td><input type="text" id="foodname" name="foodname" class="wu-text"/></td>
            </tr>

        </table>
    </form>
</div>

<!-- End of easyui-dialog -->
<script type="text/javascript">
    foodid = "";

    /**
     * Name 添加记录
     */
    function add() {
        var foodname = $('#foodname').val();
        //alert(foodname);
        $.ajax({
            url: "<?php echo U('Sort/add','','');?>",
            data: {'id': foodid, 'foodname': foodname},
            type: "post",
            dataType: "json",
            success: function (data) {
                //alert(data);
                $.messager.alert('信息提示', data, 'info', function () {
                    location.reload();//刷新页面
                });
            },
            error: function () {
                alert('出错了！')
            }
        });
    }

    /**
     * Name 修改记录
     */
    function edit() {
        var name = $('#foodname').val();
        $.ajax({
            url: "<?php echo U('Sort/edit','','');?>",
            data: {'id': foodid, 'name': name},
            type: "post",
            dataType: "json",
            success: function (data) {
                //alert(data);
                $.messager.alert('信息提示', data, 'info', function () {
                    location.reload();//刷新页面
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
        $.messager.confirm('信息提示', '确定要删除该记录？', function (result) {

            if (result) {
                var items = $('#wu-datagrid-2').datagrid('getSelections');

                $.ajax({
                    url: "<?php echo U('Sort/del','','');?>",
                    data: {'id': row.id},
                    type: "post",
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        $.messager.alert('信息提示', data, 'info', function () {
                            location.reload();//刷新页面
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
        $('#wu-dialog-2').dialog({
            closed: false,
            singleSelect: true,
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
        //选中当前行
        $('#wu-datagrid-2').datagrid('checkRow', index);
        //获取表单内容
        $('#wu-form-2').form('clear');

        //获取选中行数据
        var row = $('#wu-datagrid-2').datagrid('getSelected');
        //获取当前行索引
        selectedRowIndex = $('#wu-datagrid-2').datagrid('getRowIndex', $('#wu-datagrid-2').datagrid('getSelected'));

        var rows = $('#wu-datagrid-2').datagrid('getRows');    //获取所有行数据
        var rowa = rows[index];    // 获取index行的值

        $("#foodname").val(rowa.foodname);
        foodid = row.id;
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
        $('#wu-datagrid-2').datagrid({
            url: 'select',
            singleSelect: true,//只能选中一行
            selectOnCheck: true,
            checkOnSelect: true,
            rownumbers: true,//行号
            pagination: true,     //开启分页
            pageSize: 10,         //分页大小
            pageNumber:1,         //第几页显示（默认第一页，可以省略）
            columns: [[
                {field: 'id', title: 'id', width: '30%', align: 'center'},
                {field: 'foodname', title: '类别名称', width: '30%', align: 'center'},
                {field: 'operation', title: '操作', width: '40%', align: 'center', formatter: caozuo}

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
    * 关键字搜索
    * */
    function openSelect() {
        var fname = $('#text').val();
        $.ajax({
            url: "<?php echo U('Sort/select','','');?>",
            data: {'lb': fname, 'datatype': 'lb'},
            type: 'post',
            success: function (data) {
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