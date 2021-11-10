function aleatorio() {
    document.getElementById('password').value="";
    document.getElementById('password').removeAttribute('required');
    let div = document.getElementsByClassName('password_field')[0];
    div.classList.add('d-none');
}

function definir() {
    document.getElementById('password').setAttribute('required','');
    let div = document.getElementsByClassName('password_field')[0];
    div.classList.remove('d-none');
}