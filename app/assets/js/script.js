// ---------------
// Save, pop up with database answer
// ---------------

if (typeof message !== 'undefined') {
    var table = document.getElementsByTagName('table')[0];
    

    div = document.createElement('div');
    if (message == '') {
        div.setAttribute('class','pop-up bg-success');
        div.innerHTML = '<i class="far fa-check-circle mr-3"></i>Sikeres mentés!';
    } else {
        div.setAttribute('class','pop-up bg-danger');
        div.innerHTML = '<i class="far fa-times-circle mr-3"></i>'+message;
    }
    table.appendChild(div);
}