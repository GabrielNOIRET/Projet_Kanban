function ajoutTache(e){
    e.preventDefault();
    var new_tache = form.elements['tache'].value;
    var d = document.getElementById("noms_projet"), d_value = d.value;
    //var id_noms = form.elements['noms_projet'].id;
    /*document.getElementById('todo').innerHTML += "<li id='"+id_noms+"' href='#' style='color: blue;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache_value+"</li>";*/
    if (d_value == "Gabriel"){
        document.getElementById('todo').innerHTML += "<li id='test1' href='#' style='color: blue;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else if (d_value == "Guillaume"){
        document.getElementById('todo').innerHTML += "<li id='test2' href='#' style='color: maroon;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else if (d_value == "Ismael"){
        document.getElementById('todo').innerHTML += "<li id='test3' href='#' style='color: green;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else if (d_value == "Quentin"){
        document.getElementById('todo').innerHTML += "<li id='test4' href='#' style='color: purple;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }else{
        document.getElementById('todo').innerHTML += "<li id='test5' href='#' style='color: teal;' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>* "+new_tache+"</li>";
    }
}

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