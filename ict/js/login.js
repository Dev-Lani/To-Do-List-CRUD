document
	.getElementById("showPasswordCheckbox")
	.addEventListener("change", function () {
		var passwordField = document.getElementById("floatingPasswordGrid");

		if (this.checked) {
			passwordField.type = "text";
		} else {
			passwordField.type = "password";
		}
	});
