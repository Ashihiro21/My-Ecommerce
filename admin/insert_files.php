<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" aria-expanded="false" aria-controls="myModal" aria-label="Trigger add new files modal">
    Add New Files
</button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Insert Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>
            <div class="modal-body">
                <form id="fileForm" method="post" action="insert_filing.php">
                    <div class="form-group">
                        <label for="id" class="col-form-label">ID:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="filename" class="col-form-label">File name:</label>
                        <input type="text" class="form-control" id="filename" name="filename">
                    </div>
                    <div class="form-group">
                        <label for="category-id" class="col-form-label">Category ID:</label>
                        <input type="text" class="form-control" id="category-id" name="category_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submit-data" form="fileForm">Submit</button>
            </div>
        </div>
    </div>
</div>