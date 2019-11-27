var table = document.getElementsByTagName('table');
for (var i = 0; i < table.length; i++) {
    var links = table[i].getElementsByTagName('a');
    for (var j = 0; j < links.length; j++) {
        if (links[j].innerHTML === "show") {
            links[j].style.backgroundColor = "green";
        } else if (links[j].innerHTML === "edit") {
            links[j].style.backgroundColor = "orange";
        }
    }
}
