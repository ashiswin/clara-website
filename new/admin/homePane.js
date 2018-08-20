$.get("../config/bannerSubtitle.txt", function(data) {
	$("#txtSubtitle").val(data);
	
	$("#txtSubtitle").on('change keyup paste', function() {
		$("#btnSave").html("<i class=\"fa fa-save\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Save").addClass('btn-primary').removeClass('btn-success');
	});
	
	$("#btnSave").click(function(e) {
		e.preventDefault();
		var subtitle = $("#txtSubtitle").val();
		
		$(this).html("<i class=\"fa fa-refresh spinning\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Saving").addClass("disabled").attr('disabled', 'true');
		
		$.post("../scripts/SaveSubtitle.php", { subtitle: subtitle }, function(data) {
			response = JSON.parse(data);
			if(response.success) {
				$("#btnSave").html("<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Saved").removeClass("disabled").removeAttr('disabled').addClass('btn-success').removeClass('btn-primary');
			}
		});
	});
});

function loadBannerImages() {
	$.get("../scripts/GetBannerImages.php", function(data) {
		var response = JSON.parse(data);
		if(response.success) {
			var images = response.images;
			var html = "";
			var imageToDelete = "";
		
			for(var i = 0; i < images.length; i++) {
				if(images[i] == "") continue;
				html += "<div class=\"col-md-3 thumbnail\">\n";
				html += "\t<img class=\"thumbnail-image\" src=\"../" + images[i].image + "\">\n";
				html += "\t<a href=\"" + images[i].id + "\" style=\"position: absolute; top: 0; right: 0; z-index: 2; color: white; background-color: black; border-radius: 40px; padding: 2px\" class=\"deleteBannerImage\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>\n";
				html += "</div>\n";
			}
			html += "<div class=\"col-md-3 thumbnail\" style=\"text-align: center\">\n";
			html += "\t<a href=\"#\" id=\"btnAddBannerImage\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>\n";
			html += "</div>";
			$("#bannerImages").html(html);
		
			$(".thumbnail").css('height', $(".thumbnail").width()).css('border', 'solid #fff 10px');
			$(".thumbnail-image").each(function() {
				var $el = $(this);
				var img;
				img = new Image();
				img.onload = function () {
					if(this.width < this.height) {
						$el.addClass('portrait');
					}
				};
				img.src = $el.attr('src');
			});
		
			$("#btnAddBannerImage").parent().css('border', 'solid #AAAAAA 1px').css('padding-top', $(".thumbnail").width() / 8);
			$("#btnAddBannerImage").css('width', $(".thumbnail").width()).css('font-size', $(".thumbnail").width() / 2).css('color', '#999999');
		
			$(".deleteBannerImage").off('click').click(function(e) {
				e.preventDefault();
				$("#mdlDeleteBannerImage").modal();
				$("#bannerImageDelete").val($(this).attr('href'));
			});
			$("#btnDeleteBannerImage").off('click').click(function() {
				$(this).addClass("disabled").attr('disabled', 'true');
				$(this).html("Deleting <i class=\"fa fa-refresh spinning\" aria-hidden=\"true\"></i>");
			
				$.post("../scripts/DeleteImage.php", { image: $("#bannerImageDelete").val() }, function(data) {
					response = JSON.parse(data);
					if(response.success) {
						$("#btnDeleteBannerImage").removeAttr('disabled').removeClass('disabled');
						$("#btnDeleteBannerImage").html("Delete");
						$("#mdlDeleteBannerImage").modal('hide');
						loadBannerImages();
					}
				});
			});
			$("#btnAddBannerImage").off('click').click(function(e) {
				e.preventDefault();
				$("#bannerImageUpload").click();
			});
			$("#bannerImageUpload").off('change').change(function() {
				var form_data = new FormData();
		
				var ins = document.getElementById('bannerImageUpload').files.length;
				
				for (var x = 0; x < ins; x++) {
					form_data.append("bannerImages[]", document.getElementById('bannerImageUpload').files[x]);
				}
				var $el = $('#bannerImageUpload');
				$el.wrap('<form>').closest('form').get(0).reset();
				$el.unwrap();
				// Perform POST request to send file to server
				$.ajax({
					url: '../scripts/UploadImages.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(data){
						response = JSON.parse(data);
						if(response.success) {
							loadBannerImages();
						}
					}
				});
			});
		}
	});
}

function loadSummaries() {
	$.get("../scripts/GetSummaries.php", function(data) {
		var response = JSON.parse(data);
		if(response.success) {
			var html = "";
			var validImageUpload = false;
			var deleteId = -1;
			
			for(var i = 0; i < response.summaries.length; i++) {
				html += "<tr>\n";
				html += "\t<td>" + (i + 1) + "</td>\n";
				html += "\t<td><img src=\"../" + response.summaries[i].image + "\" width=\"100%\"></td>\n";
				html += "\t<td>" + response.summaries[i].summary + "</td>\n";
				html += "\t<td><a class=\"edit-summary\" href=\"" + i + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>\n";
				html += "\t<td><a class=\"delete-summary\" href=\"" + response.summaries[i].id + "\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>\n";
				html += "</tr>\n";
			}
			
			$("#tblSummaries").html(html);
			
			$(".edit-summary").off('click').click(function(e) {
				e.preventDefault();
				
				$("#summaryEditId").val($(this).attr('href'));
				$("#summaryEditText").html(response.summaries[$(this).attr('href')].summary);
				$("#mdlEditSummary").modal();
			});
			$("#btnEditSummary").off('click').click(function(e) {
				e.preventDefault();
				
				var summaryText = $("#summaryEditText").val();
				var editIndex = $("#summaryEditId").val();
				$.post("../scripts/UpdateSummary.php", { id: response.summaries[editIndex].id, summary: summaryText }, function(data) {
					var response = JSON.parse(data);
					if(response.success) {
						var $el = $('#summaryEditText');
						$el.wrap('<form>').closest('form').get(0).reset();
						$el.unwrap();
						$("#mdlEditSummary").modal('hide');
						loadSummaries();
					}
				});
			});
			
			$(".delete-summary").off('click').click(function(e) {
				e.preventDefault();
				
				deleteId = $(this).attr('href');
				$("#summaryDeleteId").val(deleteId);
				$("#mdlDeleteSummary").modal();
			});
			$("#btnDeleteSummary").off('click').click(function(e) {
				e.preventDefault();
				
				$.post("../scripts/DeleteSummary.php", { id: $("#summaryDeleteId").val() }, function(data) {
					var response = JSON.parse(data);
					if(response.success) {
						$("#mdlDeleteSummary").modal('hide');
						loadSummaries();
					}
				});
			});
			
			$("#btnSummaryAdd").off('click').click(function(e) {
				e.preventDefault();
				
				$("#mdlAddSummary").modal();
			});
			$("#summaryImageUpload").off('change').change(function() {
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(this.files[0]);
				reader.onload = function (e) {
					var img;
					img = new Image();
					img.onload = function () {
						if(this.width < this.height) {
							$("#summaryImageUpload")[0].setCustomValidity("Portrait images are not allowed");
							$("#summaryImageUpload")[0].reportValidity();
							validImageUpload = false;
						}
						else {
							validImageUpload = true;
						}
					};
					img.src = e.target.result;
				};
			});
			$("#btnSaveSummary").off('click').click(function(e) {
				e.preventDefault();
				
				var summaryText = $("#summaryText").val();
				
				if(!validImageUpload) {
					$("#summaryImageUpload")[0].setCustomValidity("Invalid image selected");
					$("#summaryImageUpload")[0].reportValidity();
					return;
				}
				
				var form_data = new FormData();
				form_data.append("summaryImage", document.getElementById('summaryImageUpload').files[0]);
				form_data.append("summary", summaryText);
				$('#addSummaryForm').get(0).reset();
				// Perform POST request to send file to server
				$.ajax({
					url: '../scripts/AddSummary.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(data){
						response = JSON.parse(data);
						if(response.success) {
							$("#mdlAddSummary").modal('hide');
							loadSummaries();
						}
					}
				});
			});
		}
	});
}

loadBannerImages();
loadSummaries();
