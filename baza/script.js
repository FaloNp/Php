// Funkcja do tworzenia kalendarza
function calendar() {
  var date = new Date();
  var year = date.getFullYear();
  var month = date.getMonth();
  var currentday = date.getDate();
  var dniWMiesiacu = new Date(year, month + 1, 0).getDate();
  var poczatekMiesiaca = new Date(year, month, 1).getDay();
  console.log(dniWMiesiacu)
  console.log(poczatekMiesiaca)
  var table = document.getElementsByClassName("mycalendar")[0];
  var row = table.getElementsByTagName("tr");
  var dayList = ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Niedz'];
  day = 1;
  for (var week = 0; week < row.length; week++) {
    var cells = row[week].getElementsByTagName("td");
    for (var dayinweek = 0; dayinweek < cells.length; dayinweek++) {
      cells[dayinweek].textContent = day;
      if (day < 10) {
        cells[dayinweek].textContent = '0' + day;
      }
      if (day === currentday) {
        cells[dayinweek].style.color = 'white';
      }
      day++;
    }
  }
}
calendar();

// Funkcja do obsługi zdarzenia kliknięcia w pole tabeli
function handleCellClick(event) {
  var date = event.target.textContent;
  if (date) {
    // Tutaj możesz wykonać żądanie do bazy danych, używając wartości `date`
    console.log('Kliknięto w pole z datą:', date);
    // Przykładowe zapytanie AJAX do bazy danych
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          // Tutaj możesz przetworzyć otrzymaną odpowiedź z bazy danych
          console.log('Odpowiedź z bazy danych:', response);
        } else {
          console.error('Wystąpił błąd podczas żądania do bazy danych.');
        }
      }
    };
    // Przykładowe zapytanie GET do pliku PHP obsługującego zapytanie do bazy danych
    xhr.open('GET', 'get_data.php?date=' + date, true);
    xhr.send();
  }
}

// Pobierz wszystkie pola tabeli i dodaj nasłuchiwanie zdarzeń kliknięcia
var cells = document.querySelectorAll('.mycalendar td');
cells.forEach(function (cell) {
  cell.addEventListener('click', handleCellClick);
});



















let Return = document.getElementsByClassName('loginBoxReturn')[0];
let Click = document.getElementsByClassName('loginButton')[0];
let Field = document.getElementsByClassName('loginBox')[0];
Click.addEventListener('click', () => {
  Field.classList.add('activefield');

});

Return.addEventListener('click', () => {
  if (Field.classList.contains('activefield')) {
    Field.classList.remove('activefield');
  }
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