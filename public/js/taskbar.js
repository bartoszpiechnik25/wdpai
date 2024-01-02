document.addEventListener('DOMContentLoaded', function () {
    const homeTaskbarButton = document.getElementById('home-taskbar');
    const likedTaskbarButton = document.getElementById('liked-taskbar');
    const addTaskbarButton = document.getElementById('add-taskbar');

    homeTaskbarButton.addEventListener('click', function() {
        window.location.href = "/recipes";
    });

    likedTaskbarButton.addEventListener('click', function() {
        window.location.href = "/liked";
    });

    addTaskbarButton.addEventListener('click', function() {
        window.location.href = "/add";
    });
});
