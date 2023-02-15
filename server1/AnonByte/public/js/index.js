var input = document.querySelector('#pass')

var eye = document.querySelector('.eye')
var eyeclosed = document.querySelector('.eyeclosed')

function password() {
    if (input.type === 'password') {
        input.type = 'text'
        eyeclosed.style.display = 'none'
        eye.style.display = 'block'
    }
    else {
        input.type = 'password'
        eyeclosed.style.display = 'block'
        eye.style.display = 'none'
    }
}

var input2 = document.querySelector('#pass2')

var eye2 = document.querySelector('.eye2')
var eyeclosed2 = document.querySelector('.eyeclosed2')

function password2() {
    if (input2.type === 'password') {
        input2.type = 'text'
        eyeclosed2.style.display = 'none'
        eye2.style.display = 'block'
    }
    else {
        input2.type = 'password'
        eyeclosed2.style.display = 'block'
        eye2.style.display = 'none'
    }
}

// footer
const year = document.querySelector("#current-year")

year.innerHTML = new Date().getFullYear()
