let $button = document.getElementById("menu-btn")
$button.addEventListener('click', function (e) {
    e.preventDefault();
    if ($button.classList.contains("open")) {
        $button.classList.add("close");
        $button.classList.remove("open");
    } else {
        $button.classList.add("open");
        $button.classList.remove("close");
    }
});
