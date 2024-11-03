var body = document.querySelector("body");

document.querySelector('[data-bs-toggle="minimize"]').onclick = function () {
    if ((body.classList.contains('sidebar-toggle-display')) || (body.classList.contains('sidebar-absolute'))) {
        body.classList.toggle('sidebar-hidden');
    } else {
        body.classList.toggle('sidebar-icon-only');
    }
}

document.querySelector('[data-bs-toggle="offcanvas"]').onclick = function () {
    document.querySelector('.sidebar-offcanvas').classList.toggle('active');
}

var checkbox = document.querySelectorAll('table tbody input[type="checkbox"]:not(.outstanding)');
var selectAll = document.querySelector("#selectAll");
var deleteButton = document.getElementById("deleteButton");
deleteButton.disabled = true;

checkbox.forEach(function (item) {
    item.onclick = function () {
        var isSelectAll = true;
        var isDisabled = true;
        checkbox.forEach(function (item) {
            if(!item.checked) {
                isSelectAll = false;
            } else {
                isDisabled = false;
            }
        })
        selectAll.checked = isSelectAll;
        deleteButton.disabled = isDisabled;
    }
})
selectAll.onclick = function () {
    if (this.checked) {
        checkbox.forEach(function (item) {
            item.checked = true;
            deleteButton.disabled = false;
        });
    } else {
        checkbox.forEach(function (item) {
            item.checked = false;
            deleteButton.disabled = true;
        });
    }
}

function openFullScreen(image) {
    const fullScreenModal = document.getElementById('fullScreenModal');
    const fullScreenImage = document.getElementById('fullScreenImage');
    fullScreenImage.src = image.src;
    fullScreenModal.classList.add('show');
}

function closeFullScreen() {
    document.getElementById('fullScreenModal').classList.remove('show');
}
