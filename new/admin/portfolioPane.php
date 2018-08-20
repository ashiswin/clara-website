<div class="pane" id="portfolioPane" style="font-family: 'Raleway', Arial, sans-serif">
	<div class="row" style="margin-top: 2vh">
		<div class="col-md-8">
			<h1>Albums</h1>
		</div>
		<div class="col-md-4">
			<button class="btn btn-primary float-right" id="btnAddAlbum" style="margin-right: 2vh"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add</button>
		</div>
	</div>
	<div class="container" style="margin-top: 2vh">
		<table class="table">
			<colgroup>
				<col span="1" style="width: 5%;">
				<col span="1" style="width: 20%;">
				<col span="1" style="width: 10%;">
				<col span="1" style="width: 40%;">
				<col span="1" style="width: 10%;">
				<col span="1" style="width: 5%;">
				<col span="1" style="width: 5%;">
				<col span="1" style="width: 5%;">
			</colgroup>
			<thead>
				<tr>
					<th>#</th>
					<th>Cover Image</th>
					<th>Album Name</th>
					<th>Description</th>
					<th>Category</th>
					<th><i class="fa fa-picture-o" aria-hidden="true"></i></th>
					<th><i class="fa fa-pencil" aria-hidden="true"></i></th>
					<th><i class="fa fa-trash" aria-hidden="true"></i></th>
				</tr>
			</thead>
			<tbody id="tblAlbums">
			</tbody>
		</table>
	</div>
	<input type="file" id="albumImageUpload" style="position: absolute; top: -10000vh;" accept="image/*" multiple>
	
	<!-- Begin modals -->
	<div class="modal" id="mdlDeleteAlbumImage">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete Album Image</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Would you like to delete this image?</p>
					<input type="hidden" id="albumImageDelete">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteAlbumImage">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="mdlAddCategory">
		<div class="modal-lg modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add category</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addCategoryForm">
						<div class="row">
							<div class="col-md-2">
								<label for="txtCategory">Category:</label>
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" id="txtCategory">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtCategory">Description:</label>
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" id="txtDescription">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtCategory">Cover Image:</label>
							</div>
							<div class="col-md-10">
								<input type="file" class="form-control" id="categoryCoverImageUpload">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnSaveCategory">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="mdlEditCategory">
		<div class="modal-lg modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit category</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editCategoryForm">
						<div class="row">
							<div class="col-md-2">
								<label for="txtEditCategory">Category:</label>
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" id="txtEditCategory">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtEditCategory">Description:</label>
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" id="txtEditDescription">
							</div>
						</div>
						<input type="hidden" id="categoryEditId">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnEditCategory">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="mdlDeleteCategory">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete category</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Would you like to delete this category?</p>
					<input type="hidden" id="categoryDeleteId">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteCategory">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlAddAlbum">
		<div class="modal-lg modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add album</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addAlbumForm">
						<div class="row">
							<div class="col-md-2">
								<label for="txtCategory">Name:</label>
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" id="txtAlbumName">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtDescription">Category:</label>
							</div>
							<div class="col-md-10">
								<select class="form-control" id="slcCategory"></select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtDescription">Description:</label>
							</div>
							<div class="col-md-10">
								<textarea class="form-control" id="txtAlbumDescription" rows="10"></textarea>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtDescription">Cover Image:</label>
							</div>
							<div class="col-md-10">
								<input type="file" class="form-control" id="albumCoverUpload">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnSaveAlbum">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="mdlEditAlbum">
		<div class="modal-lg modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Album</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editAlbumForm">
						<div class="row">
							<div class="col-md-2">
								<label for="txtEditAlbumName">Name:</label>
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" id="txtEditAlbumName">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtEditDescription">Category:</label>
							</div>
							<div class="col-md-10">
								<select class="form-control" id="slcEditCategory"></select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label for="txtEditDescription">Description:</label>
							</div>
							<div class="col-md-10">
								<textarea class="form-control" id="txtEditAlbumDescription" rows="10"></textarea>
							</div>
						</div>
						<input type="hidden" id="albumEditId">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnEditAlbum">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="mdlDeleteAlbum">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete album</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Would you like to delete this album?</p>
					<input type="hidden" id="albumDeleteId">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteAlbum">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="mdlAlbumImages">
		<div class="modal-dialog" role="document" id="albumImagesDialog" style="position: fixed; width: 100%; max-width: 100%; height: 100%; margin: 0; padding: 0; overflow-y: auto !important;">
			<div class="modal-content" style="height: auto; min-height: 100%; border-radius: 0">
				<div class="modal-header">
					<h3 class="modal-title">Manage Album Images</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row" id="albumImages">
					</div>
					<input type="hidden" id="albumImagesId">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
