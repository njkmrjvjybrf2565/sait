var canvas = document.getElementById('elwyn');
var kist = canvas.getContext('2d');
var balls = [];

function move(ball) {
    if (ball.x >= canvas.width) {
        ball.x_vel = ball.x_vel * -1;
        ball.otskok++;
    }
    if (ball.y >= canvas.height) {
        ball.y_vel = ball.y_vel * -1;
        ball.otskok++;
    }
    if (ball.x <= 0) {
        ball.x_vel = ball.x_vel * -1;
        ball.otskok++;
    }
    if (ball.y <= 0) {
        ball.y_vel = ball.y_vel * -1;
        ball.otskok++;
    }
    ball.x += ball.x_vel;
    ball.y += ball.y_vel;
    
}

function draw(ball) {
    kist.beginPath(); // начать рисование
    kist.arc(ball.x, ball.y, ball.radius, 0, Math.PI * 2, false); // arc - кружок, 5 - это радиус
    kist.fillStyle = ball.color; // fillStyle - выбор цвета
    kist.fill(); // fill - залить цветом
    kist.closePath(); // кончить рисование
}

function add() {
    balls.push({ // push - добавить 
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        x_vel: Math.random(),
        y_vel: Math.random(),
        color: rnd_clr(),
        otskok: 0,
        radius: Math.random() * 10
    })
}
function rnd_clr() {
    var letters = '123456789ABCDE';
    var color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * letters.length)]   
    }
    return color;
}
function onload(params) {
    add();
    console.log('zagruzilos');
    console.log(balls);

    setInterval(function () { // ф-ия, которая выполняет все до запятой, а после задрежка в милисекундах
        kist.clearRect(0, 0, canvas.width, canvas.height); // очищение холста
        for (let i = 0; i < balls.length; i++) {
            if (balls[i].otskok < 5){
                draw(balls[i]);
                move(balls[i]);
            }
            
        }
    }, 5)
}

