var formu = document.getElementById('tacheform')


function verif_form(){
  var nom = document.getElementById('nom')
  var date1 = document.getElementById('date1')
  var date2 = document.getElementById('date2')
  console.log(nom.value)
  console.log(nom.date1)
  console.log(nom.date2)
//bug
}



formu.addEventListener('submit', verif_form, false)
