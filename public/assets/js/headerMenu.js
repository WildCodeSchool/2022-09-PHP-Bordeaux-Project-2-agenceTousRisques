let $button = document.getElementById("menu-btn")
let $menu = document.getElementById("menu-list")
$button.addEventListener('click', function (e) {
    e.preventDefault();
    if ($button.classList.contains("open")) {
        $button.classList.add("close");
        $button.classList.remove("open");
        $menu.classList.add("close");
        $menu.classList.remove("open");
    } else {
        $button.classList.add("open");
        $button.classList.remove("close");
        $menu.classList.add("open");
        $menu.classList.remove("close");
    }
});
