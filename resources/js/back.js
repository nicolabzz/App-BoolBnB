require("./common");

const eleOverlay = document.querySelector(".overlay");

if (eleOverlay) {
    const btnsDelete = document.querySelectorAll(".btn_delete");
    btnsDelete.forEach((btn) => {
        btn.addEventListener("click", function () {
            eleOverlay.classList.remove("d-none");
            baseUrl = "http://localhost:8000/admin/";
            if (
                eleOverlay.querySelector("form").classList.contains("apartment")
            ) {
                baseUrl += "apartments/";
                // } else if (eleOverlay.querySelector('form').classList.contains('category')) {
                //     baseUrl += 'categories/';
                // } else if (eleOverlay.querySelector('form').classList.contains('tag')) {
                //     baseUrl += 'tags/';
            }
            eleOverlay
                .querySelector("form")
                .setAttribute("action", baseUrl + this.dataset.id);
        });
    });

    const eleBtnClose = eleOverlay.querySelector(".btn_close");

    eleBtnClose.addEventListener("click", function () {
        eleOverlay.classList.add("d-none");
    });
}

// // selezioniamo tutte le righe degli appartamenti
// const apartmentRows = document.querySelectorAll('tbody tr');

// // aggiungiamo un event listener alla checkbox di ogni riga
// apartmentRows.forEach((row) => {
//   const visibilityCheckbox = row.querySelector('#visibility');
//   visibilityCheckbox.addEventListener('change', () => {
//     // se la checkbox non è selezionata, nascondiamo la riga dell'appartamento
//     if (!visibilityCheckbox.checked) {
//       row.style.display = 'none';
//     } else {
//       row.style.display = '';
//     }
//   });
// });

// const latitude = document.querySelector('.latitude');
// const longitude = document.querySelector(".longitude");

// let center = [latitude, longitude];
// let center = [9.135752487471335, 45.46166580610122]; //TODO: mettere latitude, longitude come variabili

// const map = tt.map({
//     key: "gMfd6J6PIRqQQaAmyKd2WQbENA4FkXwr",
//     container: "map",
//     center: center,
//     zoom: 17,
// });
// map.on("load", () => {
//     var marker = new tt.Marker().setLngLat(center).addTo(map);
// });
