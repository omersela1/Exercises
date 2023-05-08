var form = document.getElementById('Form');
var nameValidation = "0";
var passValidation = "0";
var phoneValidation = "0";
var checkboxValidation = "0";

form.addEventListener('submit', function(event) {
    event.preventDefault();
    var name = form.getElementById('Name');
    if (name.includes(" ") == true) {
        nameValidation = "1";
    }

    var pass = form.getElementById('Password');
    if (pass.match(/\d/g).length >= 3) {
        passValidation = "1";
    }
    var phone = form.getElementById('Phone');
    if (phone.match(/\d/g).length < 9 || phone.match(/\d/g).length > 10 || /\D/.test(phone)) {
        phoneValidation = "0";
    }
    else {
        phoneValidation = "1";
    }
    var count = 0;

    var checkboxes = document.querySelectorAll('input[type="checkbox"][name="option"]');
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            count++;
        }
    });
    if (count >= 3) {
        checkboxValidation = "1";
    }
}
);
if (nameValidation == "1" && passValidation == "1" && phoneValidation == "1" && checkboxValidation == "1")
    form.submit();
else {
    var message = document.createElement('div');
    message.textContent = 'Some illegal inputs detected!';
    message.style.backgroundColor = 'yellow';
    message.style.color = '#666';
    message.style.display = 'block';
    message.style.padding = '20px';
    
    document.body.appendChild(message);
}