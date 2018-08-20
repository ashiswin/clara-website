<div class="pane" id="homePane" style="font-family: 'Raleway', Arial, sans-serif">
	<div class="row" style="margin-top: 1vh">
		<div class="col-md-10">
			<h1>Banner Settings</h1>
		</div>
		<div class="col-md-2">
			<button class="btn btn-primary float-right" id="btnSave" style="margin-right: 2vh"><i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Save</button>
		</div>
	</div>
	<div class="container" style="margin-top: 2vh">
		<div class="row">
			<div class="col-md-1">
				<label style="font-size: 1.5em" for="txtSubtitle">Subtitle:</label>
			</div>
			<div class="col-md-10">
				<input class="form-control" type="text" name="txtSubtitle" id="txtSubtitle">
			</div>
		</div>
		<div class="row" id="bannerImages" style="border: solid #AAAAAA 1px; padding: 2vh; margin-top: 2vh;">
		</div>
	</div>
	<div class="row" style="margin-top: 2vh">
		<div class="col-md-8">
			<h1>Featured Albums Settings</h1>
		</div>
	</div>
	<input type="file" id="bannerImageUpload" style="position: absolute; top: -10000vh;" accept="image/*" multiple>
	
	<!-- Begin modals -->
	<div class="modal fade" id="mdlDeleteBannerImage">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete banner image</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Would you like to delete this banner image?</p>
					<input type="hidden" id="bannerImageDelete">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteBannerImage">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mdlAddSummary">
		<div class="modal-lg modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add summary</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addSummaryForm">
						<label for="summaryText">Writeup</label>
						<textarea id="summaryText" name="summaryText" class="form-control" width="100%" rows="10"></textarea>
						<br>
						<input type="file" id="summaryImageUpload" class="form-control" accept="image/*">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnSaveSummary">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mdlEditSummary">
		<div class="modal-lg modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit summary</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editSummaryForm">
						<label for="summaryEditText">Writeup</label>
						<textarea id="summaryEditText" name="summaryEditText" class="form-control" width="100%" rows="10"></textarea>
						<br>
						<!--<input type="file" id="summaryImageUpload" class="form-control" accept="image/*">-->
						<input type="hidden" id="summaryEditId">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnEditSummary">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mdlDeleteSummary">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete summary</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Would you like to delete this summary entry?</p>
					<input type="hidden" id="summaryDeleteId">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteSummary">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
