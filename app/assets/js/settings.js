// ---------------
// Show code
// ---------------
var eye = document.getElementById('eye');
var code = document.getElementById('code');

if (eye && code) {
    eye.onmousedown = function() {
        eye.innerHTML = '<i class="far fa-eye"></i>';
        code.type = 'text';
    }
    
    eye.onmouseup = function() {
        eye.innerHTML = '<i class="far fa-eye-slash"></i>';
        code.type = 'password';
    }
    
    eye.onmouseout = function() {
        eye.innerHTML = '<i class="far fa-eye-slash"></i>';
        code.type = 'password';        
    }
}

// insert time
var insert = document.getElementById('insert');

if (insert) {
    insert.onclick = function() {
        var table = document.getElementsByTagName('table')[0];
        var row = table.insertRow(table.rows.length);
        var cell0 = row.insertCell(0);
            span = document.createElement('span');
            span.innerHTML = table.rows.length-1;
            cell0.appendChild(span);
        
        var cell1 = row.insertCell(1);
            input = document.createElement('input');
            input.setAttribute('type', 'time');
            input.setAttribute('name', 'start[]');
            cell1.appendChild(input);
            input.focus();
        
        var cell2 = row.insertCell(2);
            input = document.createElement('input');
            input.setAttribute('type', 'time');
            input.setAttribute('name', 'end[]');
            cell2.appendChild(input);
        
        row.insertCell(3);
    }
}