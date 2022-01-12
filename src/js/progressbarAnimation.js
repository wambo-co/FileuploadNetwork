let progress = document.querySelector('.progress');
let getProgressEndValue = progress.value;
let progressActualPercent = 0;

//config
let speed = 0.1;
let step = 0.6;

progress.value = 0;

window.setInterval(
    function () {
        if(progressActualPercent <= getProgressEndValue){
            progressActualPercent += step;
            progress.value = progressActualPercent;
        }else{
            clearInterval();
        }
    }, speed);
