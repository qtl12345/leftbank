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
    <div id="wu-toolbar-2">
        <div class="wu-toolbar-button">
            <a href="#" class="easyui-linkbutton" iconCls="icon-reload" onclick="reload()" plain="true">刷新</a>
        </div>

    </div>
    <table id="datagrid3" class="easyui-datagrid" toolbar="#wu-toolbar-2"></table>
</div>

<!-- End of easyui-dialog -->
<script type="text/javascript">
    var id="";
    /**
     * Name 载入数据
     */
    $(function () {
        $('#datagrid3').datagrid({
            url: "select",
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
                {field: 'content', title: '内容', width: '40%', align: 'center'},
                {field: 'leavedata', title: '时间', width: '10%', align: 'center'},
                {field: 'user_id', title: '用户id', width: '10%', align: 'center'},
                {field: 'user_name', title: '用户名', width: '10%', align: 'center'},
                {field: 'operation', title: '操作', width: '20%', align: 'center', formatter: caozuo}

            ]]

        });
        // datagrid数据表格ID
        var datagridId = 'datagrid3';

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

            $('#datagrid3').datagrid('resize', {
                height: height,
                width: width
            });
        }
    });

    function caozuo(value, row, index) {
        return "<a href='#' id='update' onclick='remove(" + index + ")' class='easyui-linkbutton' name='disDorm'>删除</a>";
    }
    /**
     * Name 删除记录
     */
    function remove(index) {
        $("#datagrid3").datagrid("checkRow", index);
        var row = $('#datagrid3').datagrid('getSelected');
        console.log(row);
        $.messager.confirm('信息提示', '确定要删除该记录？', function (result) {

            if (result) {
                $.ajax({
                    url: "<?php echo U('Message/del','','');?>",
                    data: {'id': row.id},
                    type: "post",
                    async: false,
                    dataType: "json",
                    success: function (data) {
                        $.messager.alert('信息提示', data, 'info', function () {
                            window.location.reload();
                            //location.reload();//刷新页面
                        });

                    }
                });
            }
        });
    }


    /*
    * 刷新页面
    */
    function reload() {
        location.reload();//刷新页面
    }

</script>