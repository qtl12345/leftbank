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
    <table id="datagrid" class="easyui-datagrid" toolbar="#wu-toolbar-2"></table>
</div>
<div id="wu-dialog-3" class="easyui-dialog" data-options="closed:true,iconCls:'icon-save'"
     style="width:400px; padding:20px;">
    <form id="wu-form-3" method="post" name="Form">
        <tr><label width="30%">店名：</label></tr>
        <td><input type="text" id="name" name="name" class="wu-text"/></td><br/>
        <tr><label width="30%">联系人：</label></tr>
        <td><input type="text" id="head" name="head" class="wu-text"/></td><br/>
        <tr><label width="30%">密码：</label></tr>
        <td><input type="text" id="password" name="password" class="wu-text"/></td><br/>
        <tr><label width="30%">联系电话：</label></tr>
        <td><input type="text" id="tel" name="tel" class="wu-text"/></td><br/>
        <tr><label width="30%">地址：</label></tr>
        <td><input type="text" id="address" name="address" class="wu-text"/></td><br/>
    </form>
</div>
<!-- End of easyui-dialog -->
<script type="text/javascript">
    var id="";
    /**
     * Name 载入数据
     */
    $(function () {
        $('#datagrid').datagrid({
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
                {field: 'name', title: '店名', width: '20%', align: 'center'},
                {field: 'head', title: '用户名', width: '10%', align: 'center'},
                {field: 'password', title: '密码', width: '10%', align: 'center'},
                {field: 'tel', title: '联系电话', width: '10%', align: 'center'},
                {field: 'address', title: '地址', width: '20%', align: 'center'},
                {field: 'operation', title: '操作', width: '20%', align: 'center', formatter: caozuo}

            ]]

        });
        // datagrid数据表格ID
        var datagridId = 'datagrid';

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

            $('#datagrid').datagrid('resize', {
                height: height,
                width: width
            });
        }
    });

    function caozuo(value, row, index) {
        return "<a href='#' id='update' onclick='openEdit(" + index + ")' class='easyui-linkbutton' name='disDorm'>修改</a>";
    }
    /**
     * Name 打开修改窗口
     */
    function openEdit(index) {
        $("#datagrid").datagrid("checkRow",index);
        $('#wu-form-3').form('clear');
        var row = $('#datagrid').datagrid('getSelected');
        document.getElementById("name").value=row.name;
        document.getElementById("head").value=row.head;
        document.getElementById("password").value=row.password;
        document.getElementById("tel").value=row.tel;
        document.getElementById("address").value=row.address;
        id=row['id'];
        $('#wu-dialog-3').dialog({
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
                    $('#wu-dialog-3').dialog('close');
                }
            }]
        });
    }
    /**
     * Name 修改记录
     */
    function edit() {
        $('#wu-form-3').form('submit', {
            url: "<?php echo U('Merchants/edit','','');?>",
            onSubmit: function(param){
                param.id = id;
            },
            success: function (data) {
                //alert(JSON.parse(data));
                $.messager.alert('信息提示', JSON.parse(data), 'info', function () {
                    location.reload();//刷新页面
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