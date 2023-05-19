<style>
    #myModal {
        text-align: center;
        color: red;
        font-weight: bolder;
        font-size: x-large;
    }
</style>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/customscript.js"></script>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title" class="modal-title"></h3>
                <button type="button" id="closeModalButton1" onclick="hideMyModal(0)" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal-body"></p>
            </div>
            <div class="modal-footer">
                <button id="closeModalButton" onclick="hideMyModal(0)" class="btn btn-secondary" data-dismiss="modal">
                    我知道了
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function showMyModal(title, msg) {
        $("#modal-title").text(title);
        $("#modal-body").text(msg);
        $("#myModal").modal("show");
    }

    function hideMyModal(x) {
        if(x == 0) {
            $("#myModal").modal("hide");
        }
        if(x == 1) {
            window.history.back();
        }
        if(x == 2) {
            window.location.href = "../views/index.php";
        }
    }
</script>