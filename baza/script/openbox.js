let focus = document.getElementsByClassName('ticketcontainer')[0];
let Click = document.getElementsByClassName('loginButton')[0];
let Field = document.getElementsByClassName('loginBox')[0];
Click.addEventListener('click', () => {
  Field.classList.add('activefield');
});


let returns = document.getElementsByClassName('loginBoxReturn');
Array.from(returns).forEach(returnElement => {
  returnElement.addEventListener('click', () => {
    if (Field.classList.contains('activefield')) {
      Field.classList.remove('activefield');
    }
    if (TicketField.classList.contains('activefield')) {
      TicketField.classList.remove('activefield');
      focus.style.left = '1000%';
    }
  });
});



let Login = document.getElementsByClassName('loginBoxContainer')[0];
let User = document.getElementsByClassName('loginBoxUser')[0];
let User1 = document.getElementsByClassName('loginBoxUser')[1];
let Data = document.getElementsByClassName('userBoxContainer')[0];

User.addEventListener('click', () => {
  Data.style.margin = '0px';
});
User1.addEventListener('click', () => {
  Data.style.margin = '1000px';
});

let TicketField = document.getElementsByClassName('numberofticket')[0];
let tickets = document.getElementsByClassName('rightcollumnrepertuarelementquantity');
Array.from(tickets).forEach(ticketElement => {
  ticketElement.addEventListener('click', () => {
    TicketField.classList.add('activefield');
    TicketToBuy();
  });
});


function TicketToBuy() {
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


  let click = document.getElementsByClassName('buyTicket');
  Array.from(click).forEach(ticketElement => {
    ticketElement.addEventListener('click', () => {
      focus.style.left = '0px';
    });
  });
}