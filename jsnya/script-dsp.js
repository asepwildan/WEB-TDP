function myFunction() {
  var x = document.getElementById("nyumput");
  var y = document.querySelector('.burger-icon input');
  var z = document.getElementById("satsat");
  var sat2 = document.getElementById("satsat2");
  if (y.checked == true) {
    x.style.transform = "translateX(0)";
    z.style.transform = "translateX(0)";
    sat2.style.transform = "translateX(0)";
  } else {
    x.style.transform = "translateX(100%)";
    z.style.transform = "translateX(110%)";
    sat2.style.transform = "translateX(500%)";
  }
}

function linkTopi() {
  myWindow = window.open('latihan2.php?id=1')
}

// nav hide
var prevScrollpos = window.pageYOffset;


window.onscroll = function () {

  var currentScrollPos = window.pageYOffset;
  var tekno = document.querySelector(".dropdown-produk div");
  const mq = window.matchMedia("(max-width: 768px)");

  if (mq.matches) {
    return;
  } else {
    if (prevScrollpos > currentScrollPos) {
      document.getElementById("nav-scrl").style.top = "0";
      if (prevScrollpos > 400) {
        document.getElementById("nav-scrl").style.backgroundColor = "rgba(255,255,255,0.9)";
        tekno.style.backgroundColor = "rgba(255,255,255,0.9)";

      } else {
        document.getElementById("nav-scrl").style.backgroundColor = "rgba(204, 204, 204, 0.2)";
        tekno.style.backgroundColor = "rgba(204, 204, 204, 0.2)";
      }
    } else {
      document.getElementById("nav-scrl").style.top = "-65px";

    }
    prevScrollpos = currentScrollPos;
  }
}

function popLgn() {
  var cekPop = document.getElementById("cek-popup");
  var PopCon = document.getElementById("popup-login");
  var hideKonten = document.getElementById("hide-konten");
  var bodi = document.querySelector("body");

  if (cekPop.checked === true) {
    PopCon.style.transform = "translateX(0)";
    hideKonten.style.display = "block";
    bodi.classList.toggle("body-overflow");
  } else {
    PopCon.style.transform = "translateX(100%)";
    hideKonten.style.display = "none";
    bodi.classList.remove("body-overflow");
  }
}

function clsPop() {
  var logBox = document.getElementById("box-login");
  var signBox = document.getElementById("signup-box");
  var PopCon = document.getElementById("popup-login");
  var cekPop = document.getElementById("cek-popup");
  var hideKonten = document.getElementById("hide-konten");
  var bodi = document.querySelector("body");
  PopCon.style.transform = "translateX(100%)";
  cekPop.checked = false;
  logBox.style.display = "block";
  signBox.style.display = "none";
  hideKonten.style.display = "none";
  bodi.classList.remove("body-overflow");
}

function clsPops() {

  var hideKonten = document.getElementById("hide-konten");
  var PopCon = document.getElementById("popup-login");
  var cekPop = document.getElementById("cek-popup");
  var bodi = document.querySelector("body");
  PopCon.style.transform = "translateX(100%)";
  cekPop.checked = false;
  hideKonten.style.display = "none";
  bodi.classList.remove("body-overflow");
}



function PopSign() {
  var logBox = document.getElementById("box-login");
  var signBox = document.getElementById("signup-box");

  logBox.style.display = "none";
  signBox.style.display = "block";

}

document.addEventListener('mouseup', function(a) {
  var hideLogin = document.getElementById('popup-login');
  var hideKonten = document.getElementById("hide-konten");
  var cekPop = document.getElementById("cek-popup");
  var bodi = document.querySelector("body");
  if (!hideLogin.contains(a.target)) {
      hideLogin.style.transform = "translateX(100%)";
      cekPop.checked = false;
      hideKonten.style.display = "none";
      bodi.classList.remove("body-overflow");
  }
  });

