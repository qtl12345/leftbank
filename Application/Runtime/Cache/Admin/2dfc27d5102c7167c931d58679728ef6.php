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
                <option value="0">已满</option>
                <option value="1">未满</option>

            </select>
            <a href="#" onclick="openSelect()" class="easyui-linkbutton" iconCls="icon-search">开始检索</a>
        </div>
    </div>
    <!-- End of toolbar-->
    <table id="wu-datagrid-2" class="easyui-datagrid" toolbar="#wu-toolbar-2"  ></table>
    <!--<table id="wu-datagrid-2" class="easyui-datagrid" class="easyui-datagrid" toolbar="#wu-toolbar-2"
           data-options="onClickRow: onClickRow">-->

    </table>

</div>

<div id="wu-dialog-2" class="easyui-dialog" data-options="closed:true,iconCls:'icon-save'"
style="width:400px; padding:10px;">
<form id="wu-form-2" method="post" name="registrationForm">
    <label width="20%">状态：</label>
    <select id="state" class="easyui-combobox" panelHeight="auto" style="width:100px" name="state">
        <option value="-1">请选择</option>
        <option value="0">已满</option>
        <option value="1">未满</option>
    </select>
</form>
</div>
<div id="wu-dialog-3" class="easyui-dialog" data-options="closed:true,iconCls:'icon-save'"
     style="width:400px; padding:10px;">
    <form id="wu-form-3" method="post" name="Form">
       <!-- <tr><label width="30%">餐桌总数：</label></tr>
        <td><input type="text" id="number" name="number" class="wu-text"/></td><br/>
        <br/>-->
        <tr><label width="30%">餐桌号：</label></tr>
        <td><input type="text" id="work" name="work" class="wu-text"/></td><br/>
        <label width="20%">状态：</label>
        <select id="state3" class="easyui-combobox" panelHeight="auto" style="width:100px" name="state">
            <option value="-1">请选择</option>
            <option value="0">已满</option>
            <option value="1">未满</option>
        </select>
    </form>
</div>
<!-- End of easyui-dialog -->
<script type="text/javascript">
    var id="";
    /**
     * Name 打开添加窗口
     */
    function openAdd() {
        $('#wu-form-2').form('clear');
        $('#state').combobox("setValue", '请选择');
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
     * Name 添加记录
     */
    function add() {
        $('#wu-form-2').form('submit', {
            url: "<?php echo U('Seat/add','','');?>",
            onSubmit: function(param){
                //param.id = id;
            },
            success: function (data) {
                console.log(data);
                $.messager.alert('信息提示', JSON.parse(data), 'info', function () {

                    location.reload();//刷新页面
                });

            },
            rror:function(){
                alert('出错了！')
            }
        });
    }



    /**
     * Name 打开修改窗口
     */
    function openEdit(index) {
        $("#wu-datagrid-2").datagrid("checkRow",index);
        $('#wu-form-3').form('clear');
        var row = $('#wu-datagrid-2').datagrid('getSelected');
        //document.getElementById("number").value=row.number;
        document.getElementById("work").value=row.id;
        $('#state3').combobox("setValue", row.state);
        id=row['id'];
        //console.log(row);

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
                    $('#wu-dialog-2').dialog('close');
                }
            }]
        });
    }
    /**
     * Name 修改记录
     */
    function edit(index) {
        $("#wu-datagrid-3").datagrid("checkRow",index);
        //alert(id);
        $('#wu-form-3').form('submit', {
            url: "<?php echo U('Seat/edit','','');?>",
            onSubmit: function(param){
                param.id = id;
            },
            success: function (data) {
                console.log(data);
                $.messager.alert('信息提示', JSON.parse(data), 'info', function () {
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
        //console.log(row.f_picture);
        $.messager.confirm('信息提示', '确定要删除该记录？', function (result) {

            if (result) {
                var items = $('#wu-datagrid-2').datagrid('getSelections');

                $.ajax({
                    url: "<?php echo U('Seat/del','','');?>",
                    data: {'id': row.id, 'face': row.f_picture},
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




    /**
     * Name 载入数据
     */
    $(function(){
        $('#wu-datagrid-2').datagrid({
            url: 'select',
            rownumbers: true,//行号
            pagination: true,     //开启分页
            pageSize: 10,         //分页大小
            pageNumber:1,         //第几页显示（默认第一页，可以省略）
            pageList: [10, 20, 30], //设置每页记录条数的列表
            columns: [[
                {field: 'id', title: '餐位', width: '35%', align: 'center'},
                {field: 'state', title: '状态', width: '30%', align: 'center'},
                {field: 'operation', title: '操作', width: '35%', align: 'center', formatter: caozuo}

            ]]

        });
        // datagrid数据表格ID
        var datagridId = 'wu-datagrid-2';

        // 第一次加载时自动变化大小
        $('#' + datagridId).resizeDataGrid(0, 0, 0, 0);

        // 当窗口大小发生变化时，调整DataGrid的大小
        $(window).resize(function() {
            $('#' + datagridId).resizeDataGrid(0, 0, 0, 0);
        });

    })
    //easyui的datagrid宽度自适应扩展方法
    $.fn.extend({
        resizeDataGrid : function(heightMargin, widthMargin, minHeight, minWidth) {
            var height = $(document.body).height() - heightMargin;
            var width = $(document.body).width() - widthMargin;

            height = height < minHeight ? minHeight : height;
            width = width < minWidth ? minWidth : width;

            $('#wu-datagrid-2').datagrid('resize', {
                height : height,
                width : width
            });
        }
    });

    function caozuo(value, row, index) {
        return "<a href='#' id='update' onclick='openEdit(" + index + ")' class='easyui-linkbutton' name='disDorm'>修改</a>&nbsp;&nbsp;"+
            "<a href='#' id='delete' onclick='remove(" + index + ")' class='easyui-linkbutton' name='disDorm'>删除</a>";
    }

    /*
  * 开始搜索
  * */
    function openSelect() {
        var lbs_id = $('#lbs').combobox("getValue");
        $.ajax({
            url: "<?php echo U('Seat/selectLB','','');?>",
            data: { 'lbs_id': lbs_id},
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
    function reload(){
        location.reload();//刷新页面
    }

</script>