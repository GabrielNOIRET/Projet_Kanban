function toggleCP(){
  var cp = document.getElementById("cp");
  var cpBtn = document.getElementById("cpBtn")
    if(cp.style.opacity == 1)
    {
      cp.style.opacity = 0;
      cp.style.right = "-260px";
      cpBtn.style.right="20px"
    }
    else
    {
      cp.style.right = "0px";
      cp.style.opacity = 1;
      cpBtn.style.right="270px"
    }
}