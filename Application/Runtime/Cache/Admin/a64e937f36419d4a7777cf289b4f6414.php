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
            <label>订单编号：</label><input id="text" class="wu-text" style="width:100px">
            <a href="#" onclick="openSelect()" class="easyui-linkbutton" iconCls="icon-search">开始检索</a>
        </div>
    </div>
    <!-- End of toolbar -->
    <table id="wu-datagrid-5" class="easyui-datagrid" toolbar="#wu-toolbar-2"></table>
</div>
<!-- End of easyui-dialog -->
<script type="text/javascript">
    /**
     * Name 载入数据
     */
    $(function () {
        $('#wu-datagrid-5').datagrid({
            url: 'select',
            singleSelect: true,//只能选中一行
            selectOnCheck: true,
            checkOnSelect: true,
            pagination: true,     //开启分页
            pageSize: 10,         //分页大小
            pageNumber:1,         //第几页显示（默认第一页，可以省略）
            pageList: [10, 20, 30], //设置每页记录条数的列表
            columns: [[
                {field: 'order_id', title: '订单编号', width: '10%', align: 'center'},
                {field: 'order_userid', title: '订单人', width: '10%', align: 'center'},
                {field: 'order_table', title: '餐位', width: '10%', align: 'center'},
                {field: 'order_list', title: '订单清单', width: '10%', align: 'center'},
                {field: 'order_time', title: '订单时间', width: '10%', align: 'center'},
                {field: 'order_money', title: '订单金额', width: '10%', align: 'center'},
                {field: 'order_message', title: '订单留言', width: '10%', align: 'center'},
                {field: 'order_state', title: '订单状态', width: '10%', align: 'center'},
                {field: 'operation', title: '操作', width: '20%', align: 'center', formatter: caozuo}

            ]]

        });
        // datagrid数据表格ID
        var datagridId = 'wu-datagrid-5';

        // 第一次加载时自动变化大小
        $('#' + datagridId).resizeDataGrid(0, 0, 0, 0);

        // 当窗口大小发生变化时，调整DataGrid的大小
        $(window).resize(function () {
            $('#' + datagridId).resizeDataGrid(0, 0, 0, 0);
        });
    })
    /**
     * Name 删除记录
     */
    function remove(index) {
        $("#wu-datagrid-5").datagrid("checkRow",index);
        var row = $('#wu-datagrid-5').datagrid('getSelected');
        //console.log(row.f_picture);
        $.messager.confirm('信息提示', '确定要删除该记录？', function (result) {
            if (result) {
                var items = $('#wu-datagrid-5').datagrid('getSelections');;
                $.ajax({
                    url: "<?php echo U('Order/del','','');?>",
                    data: {'id':row.order_id},
                    type: "post",
                    async : false,
                    dataType: "json",
                    success: function (data) {
                        $.messager.alert('信息提示', data, 'info', function () {
                            location.reload();//刷新页面
                        });

                    }
                });
            }
        });
    }
    //easyui的datagrid宽度自适应扩展方法
    $.fn.extend({
        resizeDataGrid: function (heightMargin, widthMargin, minHeight, minWidth) {
            var height = $(document.body).height() - heightMargin;
            var width = $(document.body).width() - widthMargin;

            height = height < minHeight ? minHeight : height;
            width = width < minWidth ? minWidth : width;

            $('#wu-datagrid-5').datagrid('resize', {
                height: height,
                width: width
            });
        }
    });

    function caozuo(value, row, index) {
        return "<a href='#' id='delete' onclick='remove(" + index + ")' class='easyui-linkbutton' name='disDorm'>删除</a>";
    }

    /*
    * 订单搜索
    * */
    function openSelect() {
        var fname = $('#text').val();
        $.ajax({
            url: "<?php echo U('Order/select','','');?>",
            data: {'lb': fname, 'datatype': 'fl'},
            type: 'post',
            success: function (data) {
                $('#wu-datagrid-5').datagrid('loadData', data);

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