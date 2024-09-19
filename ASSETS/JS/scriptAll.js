let BoxTask = document.querySelector(".box--task");

let ButtonTask = document.querySelector(".box--task .box__button");

let BoxCalendar = document.querySelector(".box__calendar");
let BoxCalendarMesses = document.querySelectorAll(".box__calendar .box__mes");
let BoxCalendar1 = document.querySelector(".box__calendar--1");
let BoxDaysCalendar = document.querySelectorAll(".box__day");

let BoxCalendar1Mes = document.querySelectorAll(".box__calendar--1 .box__mes");
let BoxCalendar2Mes = document.querySelectorAll(".box__calendar--2 .box__contains");

let TitleTask = document.querySelectorAll(".box--task .box__head .box__data");

let ButtonForms = document.querySelector(".box--forms > .box__button");

let Forms = document.querySelectorAll(".box__form ");
let FormsContainer = document.querySelector(".box--forms .box__container");
let FormTarefa = document.querySelector(".box--forms .box__form--tarefa");
let FormLogin = document.querySelector(".box--forms .box__form--login");
let FormCadastro = document.querySelector(".box--forms .box__form--cadastro");

//Verifica se o mes tem mais de 35 dias, se tiver, adiciona mais 7 elementos HTML ao final do mes
BoxCalendar1Mes.forEach(element => {
    let BoxAllDays = element.querySelectorAll(".box__day");

    if(BoxAllDays.length <= 35){
        for(let c = 7; c > 0; c --){
            element.innerHTML += "<div class='box__day box__day--prev'><div>"
        }
    }
});

//Faz com que os finais de semana fique em destaque
BoxCalendarMesses.forEach(element => {

    let box__day = element.querySelectorAll(".box__day");

    let box__dayLength = box__day.length;

    box__day.forEach(e => {

        for(box__dayLength; box__dayLength >= 0; box__dayLength --){

            if(box__dayLength % 7 == 0 && box__day[box__dayLength] != undefined){
                box__day[box__dayLength].classList.add("box__fds");

                if(box__dayLength != 0){
                    box__day[box__dayLength - 1].classList.add("box__fds");
                }
            }

        }

    });

})

//Verificação para a cada 3 messes, uma imagem de fundo diferente é aplicada
for(let c = 11; c >= 0; c--){
    if(c >= 0 && c < 3){
        BoxCalendar2Mes[c].classList.add("box__verao");
    }
    if(c >= 3 && c < 6){
        BoxCalendar2Mes[c].classList.add("box__outono");
    }
    if(c >= 6 && c < 9){
        BoxCalendar2Mes[c].classList.add("box__inverno");
    }
    if(c >= 9){
        BoxCalendar2Mes[c].classList.add("box__primavera");
    }
}

//
let BoxDaysCalendarLength = BoxDaysCalendar.length - 1

for(BoxDaysCalendarLength; BoxDaysCalendarLength >= 0; BoxDaysCalendarLength --){

    TitleTask.forEach(element => {
        let textContent = element.textContent;
        if(BoxDaysCalendar[BoxDaysCalendarLength].classList.item(1) == textContent){
           BoxDaysCalendar[BoxDaysCalendarLength].classList.add("box__active");
           BoxDaysCalendar[BoxDaysCalendarLength].classList.add("box__active");
        }
    });

}

let a = document.getElementsByClassName("box__calendar")[0];
let b = a.getElementsByClassName("box__day");

let bL = b.length - 1;

for(bL; bL >= 0; bL --){

    TitleTask.forEach(element => {
        let textContent = element.textContent;

        if(b[bL].classList.item(1) == textContent){
            b[bL].classList.add("box__active")
        }        
    });

}

BoxDaysCalendar.forEach(element => {
    
    element.addEventListener("click", () => {
        let target = event.target;
        let targetClass = target.classList.item(1);

        TitleTask.forEach(elementt => {

            elementt.parentNode.parentNode.parentNode.classList.remove("display__block")
            
            if(elementt.textContent == targetClass){

                elementt.parentNode.parentNode.parentNode.classList.add("display__block")

            }
        });
    })
});

//Função para tornar visivél o botão de fechar o formulário
function openButtonForms(){

    ButtonForms.classList.add("display__block");

}

//Função para tornar invisivél o botão de fechar o formulário
function removeButtonForms(){

    ButtonForms.classList.remove("display__block");

}

//Função para tornar invisivél todos os formulários no 'box--forms'
function closeAllForms(){

    removeButtonForms();
    Forms.forEach(element => {
        element.classList.remove("display__block", "display__flex", "desplay__grid")
    })
    closeFormContainer();
    closeTasks();

}

//Função para visualizar o formulário de login
function openFormContainer(){

    FormsContainer.classList.add("display__flex");

}

//Função para visualizar o formulário de login
function closeFormContainer(){

    FormsContainer.classList.remove("display__flex");

}

//Função para visualizar o formulário de login
function openFormCadastroLogin(){

    closeAllForms();

    openFormContainer();
    openButtonForms();
    FormLogin.classList.add("display__block");

}

//Função para visualizar o formulário de cadastro de usuários
function openFormCadastroUser(){

    closeAllForms();
    
    openFormContainer();
    openButtonForms();
    FormCadastro.classList.add("display__block");

}

//Função para visualizar o formulário de cadastro de tarefas
function openFormTarefa(d, m, y){
    
    closeAllForms();
    
    openFormContainer();
    openButtonForms();
    openTasks();
    FormTarefa.classList.add("display__block");

    let DATAATUAL = `${d}-${m}-${y}`;

    let inputData = document.querySelector(".box__input--date");
    inputData.value = DATAATUAL;

}

//função para "abrir" a visualização das tarefas 
function openTasks(){

    BoxTask.classList.add("display__block");

}

//
function closeTasks(){

    BoxTask.classList.remove("display__block");

}

function openTarefas(){

    console.log(event);

}

//Função para visualizar o mês clicado
function openMonth(n){

    BoxCalendar1.classList.add("display__none");

    BoxCalendar2Mes[n].classList.add("display__grid");

}