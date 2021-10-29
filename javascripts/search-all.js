let table = document.querySelector("table");
let rows = table.rows;

rows[1].classList.add("gold");
rows[2].classList.add("gold");
rows[3].classList.add("gold");
rows[4].classList.add("silver");
rows[5].classList.add("silver");
rows[6].classList.add("silver");
rows[7].classList.add("bronze");
rows[8].classList.add("bronze");
rows[9].classList.add("bronze");

document.querySelector(".searchName").addEventListener("keyup", (event) => {
    for (let i = 1; i < rows.length; i = i + 3){
        if (!rows[i].cells[1].textContent.includes(event.target.value) && 
            !rows[i].cells[2].textContent.includes(event.target.value)){
            rows[i].hidden = true;
            rows[i+1].hidden = true;
            rows[i+2].hidden = true;
        } else {
            rows[i].hidden = false;
            rows[i+1].hidden = false;
            rows[i+2].hidden = false;
        }
    }
});