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
