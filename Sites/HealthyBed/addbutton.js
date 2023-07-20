window.onload = function () {
    var clicks = 0;
    var button = document.getElementById("addButton");
    var form = document.getElementById("addForm");
    var original = button.innerHTML;
    button.onclick = function () {
        clicks = clicks + 1;
        if (clicks % 2) {
            form.style.display = "block";
            button.innerHTML = "Hide Form";
        }
        else {
            form.style.display = "none";
            button.innerHTML = original;
        }
    }
}