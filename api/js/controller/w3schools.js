// Tabbed Menu
function openMenu(evt, menuName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("menu");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace("w3-red", "");
    }
    document.getElementById(menuName).style.display = "block";
    if (menuName == "Pizza") {
      now = new Date();
      document.getElementById(menuName).innerHTML = now.getMilliseconds()+'<list-pizzas :list="pizzas"></list-pizzas>';
    }
    evt.currentTarget.firstElementChild.className += " w3-red";
  }
  
//document.addEventListener('touchstart', onTouchStart, {passive: true});
document.getElementById("myLink").click();