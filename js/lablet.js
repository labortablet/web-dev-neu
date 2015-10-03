$(document).ready(function() {

	$('.rowlink td, .rowlink th').click(function() {
		var redirect = !$(this).hasClass("rowlink-skip");
		console.log(redirect);

		if (redirect) {
			var href = $(this).parent().attr("href");
			if (href) {
				window.location = href;
			}
		}
	});
});

document.prepareEntryTableForm.onsubmit = function() {
	prepareTableEntryContent();
	return false;
};

function prepareTableEntryContent() {
	var rows = document.getElementById("createTableRows").value;
	var cols = document.getElementById("createTableColumns").value;

	makeRequest("../models/experiment/genericTable.php?r=" + rows + "&c="
			+ cols);
}

function createHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
			}
		}
	}
}

function makeRequest(url) {
	httpRequest = createHttpRequestObject();

	httpRequest.onreadystatechange = function() {
		$("#prepareModalEntryTable").modal("hide");
		if (httpRequest.readyState === 4) {
			if (httpRequest.status === 200) {
				var bodyElement = document.getElementById("entryTableBody");
				bodyElement.innerHTML = httpRequest.responseText;
				console.log("asd");
				$("#createEntryTable").modal("show");
			}
		}
		;

	};
	httpRequest.open('GET', url);
	httpRequest.send();
};