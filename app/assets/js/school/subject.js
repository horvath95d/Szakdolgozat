var table = document.getElementsByTagName('table')[0];

document.getElementById('insert').onclick = function() {
    let row = table.insertRow(table.rows.length);
    
    let cell0 = row.insertCell(0);
        input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'name[]');
        input.setAttribute('maxlength', '25');
        cell0.appendChild(input);
        input.focus();

    let cell1 = row.insertCell(1);
        input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'short[]');
        input.setAttribute('maxlength', '4');
        cell1.appendChild(input);

    let cell2 = row.insertCell(2);
        input = document.createElement('input');
        input.setAttribute('type', 'range');
        input.setAttribute('class', 'custom-range');
        input.setAttribute('name', 'importance[]');
        input.setAttribute('min', 1);
        input.setAttribute('max', 5);
        input.setAttribute('value', 3);
        cell2.appendChild(input);

    let cell3 = row.insertCell(3);
        input = document.createElement('input');
        input.setAttribute('type', 'color');
        input.setAttribute('name', 'color[]');
        input.setAttribute('value', '#'+Math.floor(Math.random()*16777215).toString(16));
        cell3.appendChild(input);
    
    row.insertCell(4);
    return false;
}