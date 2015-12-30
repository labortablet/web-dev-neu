window.uploadImageEntry = function(url, maxSize) {

	alert(123);
	var files = document.getElementById("imageEntryFiles").files;

	if (files.length >= 1) {
		performImageEntryUpload(files[0], url, maxSize);
	}
	/*
	 * for (i = 0; i < files.length; ++i) { performImageEntryUpload(files[i],
	 * url, maxSize); }
	 */

};

var performImageEntryUpload = function(file, url, maxSize) {
	if (file.type.match(/image.*/)) {

		// Load
		var reader = new FileReader();
		reader.onload = function(readerEvent) {
			var image = new Image();
			image.onload = function(imageEvent) {

				// Resize
				var canvas = document.createElement('canvas'), max_size = maxSize, width = image.width, height = image.height;
				if (width > height) {
					if (width > max_size) {
						height *= max_size / width;
						width = max_size;
					}
				} else {
					if (height > max_size) {
						width *= max_size / height;
						height = max_size;
					}
				}
				canvas.width = width;
				canvas.height = height;
				canvas.getContext('2d').drawImage(image, 0, 0, width, height);
				var dataUrl = canvas.toDataURL('image/png');
				// $("#display").attr("src", dataUrl);

				$.event.trigger({
					type : "imageEntryReady",
					blob : dataUrl,
					fileName : file.name,
					url : url
				});

			}
			image.src = readerEvent.target.result;
		}
		reader.readAsDataURL(file);
	}
}

$(document).on(
		"imageEntryReady",
		function(event) {
			var data = new FormData($("form[id*='uploadImageForm']")[0]);

			if (event.blob && event.url) {

				data.append('action', "createEntryImage");
				data.append('entryImageData', event.blob);
				data.append('entryImageName', event.fileName);
				data.append('entryTitle', document
						.getElementById("imageEntryTitle").value);

				// Request
				$.ajax({
					url : event.url,
					data : data,
					cache : false,
					contentType : false,
					processData : false,
					type : 'POST',
					success : function(data) {
						window.location.reload();
					}
				});
			}
		});