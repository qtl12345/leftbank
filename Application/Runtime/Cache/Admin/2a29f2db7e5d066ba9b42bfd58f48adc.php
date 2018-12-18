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
            <a href="#" class="easyui-linkbutton" iconCls="icon-reload" onclick="reload()" plain="true">刷新</a>
        </div>
        <div class="wu-toolbar-search">
            <label>姓名：</label><input id="text" class="wu-text" style="width:100px">
            <a href="#" onclick="openSelect()" class="easyui-linkbutton" iconCls="icon-search">开始检索</a>
        </div>
    </div>
    <!-- End of toolbar -->
    <table id="wu-datagrid-2" class="easyui-datagrid" toolbar="#wu-toolbar-2"></table>
</div>
<!-- End of easyui-dialog -->
<script type="text/javascript">

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
            pageList: [10, 20, 30], //设置每页记录条数的列表
            columns: [[
                {field: 'id', title: '编号', width: '10%', align: 'center'},
                {field: 'username', title: '姓名', width: '10%', align: 'center'},
                {field: 'password', title: '密码', width: '10%', align: 'center'},
                {field: 'telphone', title: '电话号码', width: '10%', align: 'center'},
                {field: 'address', title: '地址', width: '20%', align: 'center'},
                {field: 'email', title: '邮箱', width: '10%', align: 'center'},
                {field: 'state', title: '状态', width: '10%', align: 'center'},
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

        return "<a href='#' id='update' onclick='opendd(" + index + ")' class='easyui-linkbutton' name='disDorm'>加入黑名单</a>&nbsp;&nbsp;" +
            "<a href='#' id='delete' onclick='removedd(" + index + ")' class='easyui-linkbutton' name='disDorm'>加入白名单</a>";
    }

    /**
     * Name 加入黑名单
     */
    function opendd(index) {
        $("#wu-datagrid-2").datagrid("checkRow", index);
        var row = $('#wu-datagrid-2').datagrid('getSelected');
        id = row['id'];
        $.ajax({
            url: "<?php echo U('User/add','','');?>",
            data: {'id': id},
            type: 'post',
            dataType: 'json',
            success: function (data_msg) {
                $.messager.alert('信息提示', data_msg, 'info', function () {
                    location.reload();//刷新页面
                });
            }
        })
    }

    /**
     * Name 移除黑名单
     */
    function removedd(index) {
        $("#wu-datagrid-2").datagrid("checkRow", index);
        var row = $('#wu-datagrid-2').datagrid('getSelected');
        id= row['id'];
        $.ajax({
            url: "<?php echo U('User/remove','','');?>",
            data: {'id': id},
            type: 'post',
            dataType: 'json',
            success: function (data_msg) {
                $.messager.alert('信息提示', data_msg, 'info', function () {
                    location.reload();//刷新页面
                });
            }
        })
    }

    /*
    * 关键字搜索
    * */
    function openSelect() {
        var fname = $('#text').val();
        $.ajax({
            url: "<?php echo U('User/select','','');?>",
            data: {'lb': fname, 'datatype': 'fl'},
            type: 'post',
            success: function (data) {
                console.log(data);
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