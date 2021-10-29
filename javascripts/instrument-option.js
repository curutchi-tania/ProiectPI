let buttons = Array.from(document.getElementsByClassName("choice"));
console.log(buttons);

let instrument = document.querySelector(".instrument");
console.log(instrument);

buttons.forEach(button => {
    button.addEventListener('click', event => {
        console.log(event.target.textContent);
        if (event.target.textContent == "Piano"){
            event.target.classList.add("green");
            buttons[1].classList.add("disabled");
            instrument.setAttribute("value", "piano");
        } else{
            event.target.classList.add("green");
            buttons[0].classList.add("disabled");
            instrument.setAttribute("value", "violin");
        }
    });
});
