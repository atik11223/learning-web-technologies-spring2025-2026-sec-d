document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');

    form.addEventListener('submit', function(event) {
        let isValid = true;
        let errorMessage = "Please fix the following errors:\n\n";

        const name = form.name.value.trim();
        if (name === "") {
            errorMessage += "- Name cannot be empty.\n";
            isValid = false;
        }

        const email = form.email.value.trim();
        if (email === "" || email.indexOf('@') === -1 || email.indexOf('.') === -1) {
            errorMessage += "- Please enter a valid email containing '@' and '.'.\n";
            isValid = false;
        }

        const gender = form.gender.value; 
        if (gender === "") {
            errorMessage += "- Please select a gender.\n";
            isValid = false;
        }

        const dobInputs = form.querySelectorAll('input[maxlength]');
        const day = dobInputs[0].value.trim();
        const month = dobInputs[1].value.trim();
        const year = dobInputs[2].value.trim();

        if (day === "" || month === "" || year === "") {
            errorMessage += "- Please complete your Date of Birth.\n";
            isValid = false;
        } 
        else if (isNaN(day) || isNaN(month) || isNaN(year)) {
            errorMessage += "- Date of Birth must contain numbers only.\n";
            isValid = false;
        }

        const degrees = form.querySelectorAll('input[name="degree"]:checked');
        if (degrees.length === 0) {
            errorMessage += "- Please select at least one degree.\n";
            isValid = false;
        }

        const photo = form.photo.value;
        if (photo === "") {
            errorMessage += "- Please upload a photo.\n";
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); 
            alert(errorMessage);
        } else {
            alert("Form looks good! Submitting now...");
        }
    });
});