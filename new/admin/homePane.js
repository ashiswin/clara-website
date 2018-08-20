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

loadBannerImages();
