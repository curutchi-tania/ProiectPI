const editButtons = document.querySelectorAll(".smth");
console.log(editButtons);

const table = document.querySelector("table");
let rows = table.rows;

let values1 = [];
for (let i = 1; i < rows.length; i++){
    values1.push(rows[i].cells[1].firstChild.value);
}

let values2 = [];
for (let i = 1; i < rows.length; i++){
    values2.push(rows[i].cells[2].firstChild.value);
}

let values3 = [];
for (let i = 1; i < rows.length; i++){
    values3.push(rows[i].cells[3].firstChild.value);
}

let values4 = [];
for (let i = 1; i < rows.length; i++){
    values4.push(rows[i].cells[4].firstChild.value);
}

let values5 = [];
for (let i = 1; i < rows.length; i++){
    values5.push(rows[i].cells[5].firstChild.value);
}

let values6 = [];
for (let i = 1; i < rows.length; i++){
    values6.push(rows[i].cells[6].firstChild.value);
}

console.log(values1, values2, values3, values4, values5, values6);

editButtons.forEach((button, index) => {
    
    console.log(button, index);
    button.addEventListener("click", (event) => {
        
        for (let i = 1; i < rows.length; i++){
            rows[i].cells[0].firstChild.removeAttribute("name");
            
            rows[i].cells[1].firstChild.removeAttribute("name");
            rows[i].cells[1].firstChild.setAttribute("readonly","");
            rows[i].cells[1].firstChild.value = values1[i-1];

            rows[i].cells[2].firstChild.removeAttribute("name");
            rows[i].cells[2].firstChild.setAttribute("readonly","");
            rows[i].cells[2].firstChild.value = values2[i-1];

            rows[i].cells[3].firstChild.removeAttribute("name");
            rows[i].cells[3].firstChild.setAttribute("readonly","");
            rows[i].cells[3].firstChild.value = values3[i-1];

            rows[i].cells[4].firstChild.removeAttribute("name");
            rows[i].cells[4].firstChild.setAttribute("readonly","");
            rows[i].cells[4].firstChild.value = values4[i-1];

            rows[i].cells[5].firstChild.removeAttribute("name");
            rows[i].cells[5].firstChild.setAttribute("readonly","");
            rows[i].cells[5].firstChild.value = values5[i-1];

            rows[i].cells[6].firstChild.removeAttribute("name");
            rows[i].cells[6].firstChild.setAttribute("readonly","");
            rows[i].cells[6].firstChild.value = values6[i-1];

            rows[i].cells[7].innerHTML = "<button href='#edit' class='btn edit z-depth-0'><i class='material-icons'>edit</i></button>";

            rows[i].cells[8].firstChild.classList.add("disabled");
            rows[i].cells[8].firstChild.removeAttribute("name");

            rows[i].cells[9].firstChild.classList.add("hide");
            rows[i].cells[9].firstChild.removeAttribute("name");
        }

        event.preventDefault();
        rows[index+1].cells[0].firstChild.setAttribute("name", "ID");

        rows[index+1].cells[1].firstChild.removeAttribute("readonly");
        rows[index+1].cells[1].firstChild.setAttribute("name", "firstName");

        rows[index+1].cells[2].firstChild.removeAttribute("readonly");
        rows[index+1].cells[2].firstChild.setAttribute("name", "lastName");

        rows[index+1].cells[3].firstChild.removeAttribute("readonly");
        rows[index+1].cells[3].firstChild.setAttribute("name", "email");

        rows[index+1].cells[4].firstChild.removeAttribute("readonly");
        rows[index+1].cells[4].firstChild.setAttribute("name", "age");

        rows[index+1].cells[5].firstChild.removeAttribute("readonly");
        rows[index+1].cells[5].firstChild.setAttribute("name", "phoneNumber");

        rows[index+1].cells[6].firstChild.removeAttribute("readonly");
        rows[index+1].cells[6].firstChild.setAttribute("name", "instrument");

        rows[index+1].cells[8].firstChild.classList.remove("disabled");
        rows[index+1].cells[8].firstChild.setAttribute("name", "submit");

        rows[index+1].cells[9].firstChild.classList.remove("hide");
        rows[index+1].cells[9].firstChild.setAttribute("name", "delete");
    });
})