<!-- Button to open the modal -->
<button id="openModalBtn" class="btn btn-primary" onclick="openInsertModal()" aria-controls="insertModal" aria-haspopup="true">Add New Category</button>

<!-- The Modal -->
<div id="insertModal" class="modal fade" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="insertModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="insertModalLabel">Insert New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeInsertModal()">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="insert_category.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="categoryId">Category ID:</label>
                    <input type="text" class="form-control" id="categoryId" name="id" required>
                </div>

                <div class="form-group">
                    <label for="categoryName">Category Name:</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                </div>

                <div class="form-group">
                    <label for="categoryImage">Category Image:</label>
                    <input type="file" class="form-control-file" id="categoryImage" name="categoryImage" accept="img/*" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
// Bootstrap Modal function to show/hide the modal
function openInsertModal() {
    $('#insertModal').modal('show');
    $('#openModalBtn').attr("aria-expanded", "true");
}

function closeInsertModal() {
    $('#insertModal').modal('hide');
    $('#openModalBtn').attr("aria-expanded", "false");
}
</script>