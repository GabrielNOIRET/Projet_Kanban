function ajoutTache(e){
    e.preventDefault();
    var new_tache = form.elements['tache'].value;
    d = document.getElementById("noms_projet").value;
    if (d == "Gabriel"){
        document.getElementById('todo').innerHTML += "<li id='tache' href='#' style='color: blue;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else if (d == "Guillaume"){
        document.getElementById('todo').innerHTML += "<li href='#' style='color: maroon;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else if (d == "Ismaël"){
        document.getElementById('todo').innerHTML += "<li href='#' style='color: green;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else if (d == "Quentin"){
        document.getElementById('todo').innerHTML += "<li href='#' style='color: purple;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else{
        document.getElementById('todo').innerHTML += "<li href='#' style='color: teal;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }
}

/*function increment(){
    for(var i = 0, li.length, i++){
        
    }
}*/

function allowDrop(e) {
    e.preventDefault();
}

function drag(e) {
    e.dataTransfer.setData("text", e.target.id);
}

function drop(e) {
    e.preventDefault();
    var data = e.dataTransfer.getData("text");
    e.target.appendChild(document.getElementById(data));
}

var form = document.getElementById('form');
form.addEventListener('submit', ajoutTache);