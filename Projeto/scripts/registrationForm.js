function loadFile(event) {
    var image = document.getElementById('imgRegProfilePic');
    image.src = URL.createObjectURL(event.target.files[0]);
}
