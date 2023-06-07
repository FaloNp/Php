let focus = document.getElementsByClassName('ticketcontainer')[0];

let login = document.getElementsByClassName('loginButton')[0];
let user = document.getElementsByClassName('userBoxContainer')[0];
let tickets = document.getElementsByClassName('rightcollumnrepertuarelementbuyticket');

let logintouser = document.getElementsByClassName('loginBoxUser')[0];
let usertologin = document.getElementsByClassName('loginBoxUser')[1];

let returnbutton = document.getElementsByClassName('ReturnButton');

let loginbox= document.getElementsByClassName('loginBox')[0];
let ticketbox = document.getElementsByClassName('ticketBox')[0];

let click = document.getElementsByClassName('buyTicket');

//Zdarzenie aktywujace pole do logowania
login.addEventListener('click', () => {
  loginbox.classList.add('activefield');
});


//Zdarzenie zmieniajace pole do logowania na pole do rejestracji
logintouser.addEventListener('click', () => {
  user.style.margin = '0px';
});
usertologin.addEventListener('click', () => {
  user.style.margin = '1000px';
});


//Zdarzenie aktywujace pole z biletami
Array.from(tickets).forEach(ticketElement => {
  ticketElement.addEventListener('click', () => {
    ticketbox.classList.add('activefield');
    var number = ticketElement.outerHTML;
    number = number.replace(/\D/g, '');
    NotBlocked(number);
  });
});

Array.from(click).forEach(ticketElement => {
  ticketElement.addEventListener('click', () => {
    focus.style.left = '0px';
  });
});

function NotBlocked(number) {
  console.log(number);
  var numbertofind = 5;
  var table = document.getElementsByClassName("locationlist")[0];
  var cells = table.getElementsByTagName("td");
  var cellsLength = cells.length;

  for (var ticket = 0; ticket < cellsLength; ticket++) {
    var number = parseInt(cells[ticket].innerText);
    if (number == (numbertofind - 1)) {
      cells[number].classList.add('buyTicket');
    }
  }
}













/*
let ticket = [];
for (var i=0;i<number;i++){
  ticket[i] = document.getElementsByClassName("rightcollumnrepertuarelementbuyticket")[i];
  if (ticket[i].addEventListener('click', () => {
    console.log(ticket);
  }));
}*/












//Zdarzenie zamykajace wszystkie inne aktywnosci
Array.from(returnbutton).forEach(returnElement => {
  returnElement.addEventListener('click', () => {
    if (loginbox.classList.contains('activefield')) {
      loginbox.classList.remove('activefield');
    }
    if (ticketbox.classList.contains('activefield')) {
      ticketbox.classList.remove('activefield');
      focus.style.left = '1000%';
    }
  });
});