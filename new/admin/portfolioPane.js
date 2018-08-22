var categoriesSelect = "";

function loadCategories() {
	$.get("../scripts/GetCategories.php", function(data) {
		var response = JSON.parse(data);
		if(response.success) {
			var html = "";
			var validImageUpload = false;
			var deleteId = -1;
			
			categories = response.categories;
			
			for(var i = 0; i < response.categories.length; i++) {
				html += "<tr>\n";
				html += "\t<td>" + (i + 1) + "</td>\n";
				html += "\t<td><img class=\"cover-image\" style=\"object-fit: contain\" src=\"../" + response.categories[i].cover + "\" width=\"100%\"></td>\n";
				html += "\t<td>" + response.categories[i].category + "</td>\n";
				html += "\t<td>" + response.categories[i].description + "</td>\n";
				html += "\t<td><a class=\"edit-category\" href=\"" + i + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>\n";
				html += "\t<td><a class=\"delete-category\" href=\"" + response.categories[i].id + "\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>\n";
				html += "</tr>\n";
				
				categoriesSelect += "<option value=\"" + response.categories[i].id + "\">" + response.categories[i].category + "</option>\n";
			}
			
			$("#tblCategories").html(html);
			$(".cover-image").css('height', $(".cover-image").width());
			
			$(".edit-category").off('click').click(function(e) {
				e.preventDefault();
				
				$("#categoryEditId").val($(this).attr('href'));
				$("#txtEditCategory").val(response.categories[$(this).attr('href')].category);
				$("#txtEditDescription").val(response.categories[$(this).attr('href')].description);
				$("#mdlEditCategory").modal();
			});
			$("#btnEditCategory").off('click').click(function(e) {
				e.preventDefault();
				
				var category = $("#txtEditCategory").val();
				var description = $("#txtEditDescription").val();
				var editIndex = $("#categoryEditId").val();
				$.post("../scripts/UpdateCategory.php", { id: response.categories[editIndex].id, category: category, description: description }, function(data) {
					var response = JSON.parse(data);
					if(response.success) {
						$("#editCategoryForm").get(0).reset();
						$("#mdlEditCategory").modal('hide');
						loadCategories();
					}
				});
			});
			
			$(".delete-category").off('click').click(function(e) {
				e.preventDefault();
				
				deleteId = $(this).attr('href');
				$("#categoryDeleteId").val(deleteId);
				$("#mdlDeleteCategory").modal();
			});
			$("#btnDeleteCategory").off('click').click(function(e) {
				e.preventDefault();
				
				$.post("../scripts/DeleteCategory.php", { id: $("#categoryDeleteId").val() }, function(data) {
					var response = JSON.parse(data);
					if(response.success) {
						$("#mdlDeleteCategory").modal('hide');
						loadCategories();
					}
				});
			});
			
			$("#btnCategoryAdd").off('click').click(function(e) {
				e.preventDefault();
				
				$("#mdlAddCategory").modal();
			});
			$("#btnSaveCategory").off('click').click(function(e) {
				e.preventDefault();
				
				var category = $("#txtCategory").val();
				var description = $("#txtDescription").val();
				var form_data = new FormData();
				
				form_data.append("cover", document.getElementById('categoryCoverImageUpload').files[0]);
				form_data.append("category", category);
				form_data.append("description", description);
				
				// Perform POST request to send file to server
				$.ajax({
					url: '../scripts/AddCategory.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(data){
						response = JSON.parse(data);
						if(response.success) {
							$("#mdlAddCategory").modal('hide');
							$("#addCategoryForm").get(0).reset();
							loadCategories();
						}
					}
				});
			});
		}
	});
}

var lastScroll = 0;
function text_truncate(str, length, ending) {
	if (length == null) {
		length = 100;
	}
	if (ending == null) {
		ending = '...';
	}
	if (str.length > length) {
		return str.substring(0, length - ending.length) + ending;
	} else {
		return str;
	}
}

function loadAlbums() {
	$.get("../scripts/GetAlbums.php", function(data) {
		var response = JSON.parse(data);
		if(response.success) {
			var html = "";
			
			for(var i = 0; i < response.albums.length; i++) {
				html += "<tr>\n";
				html += "\t<td>" + (i + 1) + "</td>\n";
				html += "\t<td><img src=\"" + response.albums[i].cover + "\" width=\"100%\"></td>\n";
				html += "\t<td>" + response.albums[i].name + "</td>\n";
				html += "\t<td>" + text_truncate(response.albums[i].description) + "</td>\n";
				html += "\t<td>" + response.albums[i].categoryName + "</td>\n";
				html += "\t<td><a class=\"album-images\" href=\"" + response.albums[i].id + "\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></a></td>\n";
				html += "\t<td><a class=\"edit-album\" href=\"" + i + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>\n";
				html += "\t<td><a class=\"delete-album\" href=\"" + response.albums[i].id + "\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>\n";
				html += "</tr>\n";
			}
			
			$("#tblAlbums").html(html);
			
			$(".edit-album").off('click').click(function(e) {
				e.preventDefault();
				
				$("#albumEditId").val($(this).attr('href'));
				$("#txtEditAlbumName").val(response.albums[$(this).attr('href')].name);
				$("#slcEditCategory").html(categoriesSelect);
				$("#slcEditCategory").val(response.albums[$(this).attr('href')].category);
				$("#txtEditAlbumDescription").val(response.albums[$(this).attr('href')].description);
				$("#mdlEditAlbum").modal();
			});
			$("#btnEditAlbum").off('click').click(function(e) {
				e.preventDefault();
				
				var name = $("#txtEditAlbumName").val();
				var category = $("#slcEditCategory").val();
				var description = $("#txtEditAlbumDescription").val();
				var editIndex = $("#albumEditId").val();
				$.post("../scripts/UpdateAlbum.php", { id: response.albums[editIndex].id, name: name, category: category, description: description }, function(data) {
					var response = JSON.parse(data);
					if(response.success) {
						$("#editAlbumForm").get(0).reset();
						$("#mdlEditAlbum").modal('hide');
						loadAlbums();
					}
				});
			});
			$(".delete-album").off('click').click(function(e) {
				e.preventDefault();
				
				deleteId = $(this).attr('href');
				$("#albumDeleteId").val(deleteId);
				$("#mdlDeleteAlbum").modal();
			});
			$("#btnDeleteAlbum").off('click').click(function(e) {
				e.preventDefault();
				
				$.post("../scripts/DeleteAlbum.php", { id: $("#albumDeleteId").val() }, function(data) {
					var response = JSON.parse(data);
					if(response.success) {
						$("#mdlDeleteAlbum").modal('hide');
						loadAlbums();
					}
				});
			});
			
			$(".album-images").off('click').click(function(e) {
				e.preventDefault();
				
				$("#mdlAlbumImages").modal();
				$("#albumImagesId").val($(this).attr('href'));
				function loadAlbumImages(albumId) {
					$.get("../scripts/GetAlbumImages.php?id=" + albumId, function(data) {
						var response = JSON.parse(data);
						if(response.success) {
							var images = response.images;
							var html = "";
							var imageToDelete = "";
		
							for(var i = 0; i < images.length; i++) {
								if(images[i] == "") continue;
								html += "<div class=\"col-md-3 thumbnail\" id=\"image-" + images[i].id + "\">\n";
								html += "\t<img class=\"thumbnail-image\" id=\"imageElement-" + i + "\" src=\"../" + images[i].image + "\">\n";
								html += "\t<a href=\"" + images[i].id + "\" style=\"position: absolute; top: 0.5vh; right: 0.5vh; z-index: 2; color: white; text-decoration: none !important;\" class=\"deleteAlbumImage\"><i class=\"fa fa-times\" style=\" background-color: black; font-size: 1em; border-radius: 30px; padding: 5px\" aria-hidden=\"true\"></i></a>\n";
								html += "\t<span style=\"position: absolute; top: 0.5vh; left: 0.5vh; z-index: 2; text-decoration: none !important;\"><a href=\"" + i + "\" class=\"shiftLeftAlbumImage\" style=\"color: white; text-decoration: none !important\"><i class=\"fa fa-chevron-left\" aria-hidden=\"true\" style=\" background-color: black; font-size: 1em; border-radius: 30px; padding: 5px\"></i></a>\n";
								html += "\t<a href=\"" + i + "\" class=\"shiftRightAlbumImage\" style=\"color: white; text-decoration: none !important\"><i class=\"fa fa-chevron-right\" aria-hidden=\"true\" style=\" background-color: black; font-size: 1em; border-radius: 30px; padding: 5px\"></i></a></span>\n";
								html += "</div>\n";
							}
							html += "<div class=\"col-md-3 thumbnail\" style=\"text-align: center\">\n";
							html += "\t<a href=\"#\" id=\"btnAddAlbumImage\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>\n";
							html += "</div>";
							$("#albumImages").html(html);
							
							$(".shiftLeftAlbumImage").off('click').click(function(e) {
								e.preventDefault();
								
								var index = $(this).attr('href');
								
								if(index == 0) return;
								
								var leftSrc = $("#imageElement-" + (index - 1)).attr('src');
								var leftClass = $("#imageElement-" + (index - 1)).attr('class');
								$("#imageElement-" + (index - 1)).attr('src', $("#imageElement-" + index).attr('src'));
								$("#imageElement-" + (index - 1)).attr('class', $("#imageElement-" + index).attr('class'));
								$("#imageElement-" + index).attr('src', leftSrc);
								$("#imageElement-" + index).attr('class', leftClass);
								$.post("../scripts/SwapImages.php", { image1: response.images[index].id, image2: response.images[index - 1].id }, function(data) {
									var response = JSON.parse(data);
								});
							});
							$(".shiftRightAlbumImage").off('click').click(function(e) {
								e.preventDefault();
								
								var index = parseInt($(this).attr('href'));
								var rightIndex = index + 1;
								if(index == response.images.length - 1) return;
								
								var rightSrc = $("#imageElement-" + rightIndex).attr('src');
								var rightClass = $("#imageElement-" + rightIndex).attr('class');
								$("#imageElement-" + rightIndex).attr('src', $("#imageElement-" + index).attr('src'));
								$("#imageElement-" + rightIndex).attr('class', $("#imageElement-" + index).attr('class'));
								$("#imageElement-" + index).attr('src', rightSrc);
								$("#imageElement-" + index).attr('class', rightClass);
								$.post("../scripts/SwapImages.php", { image1: response.images[index].id, image2: response.images[rightIndex].id }, function(data) {
									var response = JSON.parse(data);
								});
							});
											
							$(".thumbnail").css('height', $("#mdlAlbumImages").width() / 4).css('border', 'solid #fff 10px');
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
							$("#btnAddAlbumImage").parent().css('border', 'solid #AAAAAA 1px').css('padding-top', $("#mdlAlbumImages").width() / 4 / 8);
							$("#btnAddAlbumImage").css('width', $("#mdlAlbumImages").width() / 4).css('font-size', $("#mdlAlbumImages").width() / 8).css('color', '#999999');
							$("#btnAddAlbumImage").off('click').click(function(e) {
								e.preventDefault();

								$("#albumImageUpload").click();
							});
							$("#albumImageUpload").off('change').change(function() {
								var ins = document.getElementById('albumImageUpload').files.length;
								
								for(var i = 0; i < ins / 5; i++) {
									console.log("Processing " + (i * 5) + " to " + (i * 5 + 5));
									var form_data = new FormData();
									for (var x = i * 5; x < (i * 5) + 5; x++) {
										form_data.append("albumImages[]", document.getElementById('albumImageUpload').files[x]);
									}
									form_data.append("album", $("#albumImagesId").val());
									// Perform POST request to send file to server
									$.ajax({
										url: '../scripts/UploadAlbumImages.php', // point to server-side PHP script 
										dataType: 'text',  // what to expect back from the PHP script, if anything
										cache: false,
										contentType: false,
										processData: false,
										data: form_data,
										type: 'post',
										success: function(data){
											response = JSON.parse(data);
											if(response.success) {
												loadAlbumImages(albumId);
											}
										}
									});
								}
								if(ins % 5 != 0) {
									console.log("Clearing remainder of " + (ins % 5));
									var form_data = new FormData();
									for (var x = ins - (ins % 5); x < ins; x++) {
										form_data.append("albumImages[]", document.getElementById('albumImageUpload').files[x]);
									}
									form_data.append("album", $("#albumImagesId").val());
									// Perform POST request to send file to server
									$.ajax({
										url: '../scripts/UploadAlbumImages.php', // point to server-side PHP script 
										dataType: 'text',  // what to expect back from the PHP script, if anything
										cache: false,
										contentType: false,
										processData: false,
										data: form_data,
										type: 'post',
										success: function(data){
											response = JSON.parse(data);
											if(response.success) {
												loadAlbumImages(albumId);
											}
										}
									});
								}
								
								var $el = $('#albumImageUpload');
								$el.wrap('<form>').closest('form').get(0).reset();
								$el.unwrap();
							});
							$(".deleteAlbumImage").off('click').click(function(e) {
								e.preventDefault();
								$("#albumImageDelete").val($(this).attr('href'));
								$.post("../scripts/DeleteAlbumImage.php", { image: $("#albumImageDelete").val() }, function(data) {
									response = JSON.parse(data);
									if(response.success) {
										$("#image-" + $("#albumImageDelete").val()).remove();
									}
								});
							});
						}
					});
				}
				loadAlbumImages($(this).attr('href'));
			});
				
			$("#btnAddAlbum").off('click').click(function(e) {
				e.preventDefault();
	
				$("#slcCategory").html(categoriesSelect);
				$("#mdlAddAlbum").modal();
			});

			$("#btnSaveAlbum").off('click').click(function(e) {
				e.preventDefault();
	
				var name = $("#txtAlbumName").val();
				var category = $("#slcCategory").val();
				var description = $("#txtAlbumDescription").val();
	
				var form_data = new FormData();
				form_data.append("coverImage", document.getElementById('albumCoverUpload').files[0]);
				form_data.append("name", name);
				form_data.append("category", category);
				form_data.append("description", description);
	
				$.ajax({
					url: '../scripts/AddAlbum.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(data){
						response = JSON.parse(data);
						if(response.success) {
							$("#mdlAddAlbum").modal('hide');
							$("#addAlbumForm").get(0).reset();
							loadAlbums();
						}
					}
				});
			});
		}
	});
}

loadCategories();
loadAlbums();
