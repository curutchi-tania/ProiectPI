const editButtons = document.querySelectorAll(".smth");
console.log(editButtons);

const table = document.querySelector("table");
let rows = table.rows;

let values1 = [];
for (let i = 1; i < rows.length; i++){
    values1.push(rows[i].cells[5].firstChild.value);
}

console.log(values1);

let values2 = [];
for (let i = 1; i < rows.length; i++){
    values2.push(rows[i].cells[6].firstChild.value);
}

console.log(values2);

let values3 = [];
for (let i = 1; i < rows.length; i++){
    values3.push(rows[i].cells[7].firstChild.value);
}

console.log(values3);

editButtons.forEach((button, index) => {
    
    console.log(button, index);
    button.addEventListener("click", (event) => {
        
        for (let i = 1; i < rows.length; i++){
            rows[i].cells[0].firstChild.removeAttribute("name");
            
            rows[i].cells[5].firstChild.removeAttribute("name");
            rows[i].cells[5].firstChild.setAttribute("readonly","");
            rows[i].cells[5].firstChild.value = values1[i-1];

            rows[i].cells[6].firstChild.removeAttribute("name");
            rows[i].cells[6].firstChild.setAttribute("readonly","");
            rows[i].cells[6].firstChild.value = values2[i-1];

            rows[i].cells[7].firstChild.removeAttribute("name");
            rows[i].cells[7].firstChild.setAttribute("readonly","");
            rows[i].cells[7].firstChild.value = values3[i-1];

            rows[i].cells[9].innerHTML = "<button href='#edit' class='btn edit z-depth-0'><i class='material-icons'>edit</i></button>";

            rows[i].cells[10].firstChild.classList.add("disabled");
            rows[i].cells[10].firstChild.removeAttribute("name");
        }

        event.preventDefault();
        rows[index+1].cells[0].firstChild.setAttribute("name", "pieceID");

        rows[index+1].cells[5].firstChild.removeAttribute("readonly");
        rows[index+1].cells[5].firstChild.setAttribute("name", "intScore");

        rows[index+1].cells[6].firstChild.removeAttribute("readonly");
        rows[index+1].cells[6].firstChild.setAttribute("name", "techScore");

        rows[index+1].cells[7].firstChild.removeAttribute("readonly");
        rows[index+1].cells[7].firstChild.setAttribute("name", "diffScore");

        rows[index+1].cells[10].firstChild.classList.remove("disabled");
        rows[index+1].cells[10].firstChild.setAttribute("name", "submit");
    });
})