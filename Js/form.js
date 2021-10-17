
const startLoader = () => {
    
    let divP = document.createElement("DIV");
    divP.className = 'w3-modal';
    divP.style.display = 'block';
    divP.id = 'loader-modal';

    divC = document.createElement("DIV");
    divC.className = 'w3-modal-content';
    divC.style = 'width:60px; height:60px; padding-top:8px;';

    let c = document.createElement('CENTER');

    let divL = document.createElement("DIV");
    divL.className = 'loader';

    c.appendChild(divL);
    divC.appendChild(c);
    divP.appendChild(divC);
    document.body.appendChild(divP);

}

const endLoader = () => {

    let loader = document.getElementById('loader-modal');
    while (loader.hasChildNodes()) {
        loader.removeChild(loader.firstChild);
    }
    loader.remove();

}

document.getElementById("register_btn").addEventListener("click", function(evt){
    evt.preventDefault();
    startLoader();
    const f_name = document.getElementById("fname").value;
    const l_name = document.getElementById("lname").value;
    const house_no = document.getElementById("house_no").value;
    const err = document.getElementById("error_field");

    if(f_name.trim() == ""){
        endLoader();
        err.innerText = "Please write your first name";
        document.getElementById("fname").focus();
        return false;
    }
    
    if(l_name.trim() == ""){
        endLoader();
        err.innerText = "Please write your last name";
        document.getElementById("lname").focus();
        return false;
    }
    
    if(house_no.trim() == ""){
        endLoader();
        err.innerText = "Please write house number";
        document.getElementById("house_no").focus();
        return false;
    }

    document.getElementById("fname").name = document.getElementById("fname").id;
    document.getElementById("lname").name = document.getElementById("lname").id;
    document.getElementById("house_no").name = document.getElementById("house_no").id;

    document.getElementById("vals").action = "#qrcode";
    document.getElementById("vals").submit();

});

const divToPdf = (id, file_name) => {
    let result = document.getElementById(id);
    var opt = {
        filename:     file_name,
        image:        { type: 'jpeg', quality: 2.00 },
        html2canvas:  { scale: 4 },
        jsPDF:        { unit: 'pt', format: 'letter', orientation: 'portrait' }
    };
    
    html2pdf(result, opt);
};
