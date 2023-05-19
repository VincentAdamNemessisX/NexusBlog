<?php
//session_start();
//session_destroy();?>
<!DOCTYPE html>
<html>
<head>
    <title>美化弹窗</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal-content {
            text-align: center;
        }
    </style>
</head>
<body>


<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">这是一个美观的弹窗</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>这里可以添加一些文本内容或表单等。</p>
            </div>
            <div class="modal-footer">
                <button id="closeModalButton" class="btn btn-secondary" data-dismiss="modal">关闭弹窗</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // 点击按钮打开弹窗
        $("#openModalButton").click(function() {
            $("#myModal").modal("show");
        });

        // 点击关闭按钮或弹窗外部关闭弹窗
        $("#closeModalButton").click(function() {
            $("#myModal").modal("hide");
        });
    });
</script>
</body>
</html>
