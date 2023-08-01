var audioPlayer = document.querySelector('.green-audio-player');
var playPause = audioPlayer.querySelector('.play-pause-icon');
var playpauseBtn = audioPlayer.querySelector('.play-pause-btn');
var progress = audioPlayer.querySelector('.progress');
var sliders = audioPlayer.querySelectorAll('.slider');
var player = audioPlayer.querySelector('audio');
var currentTime = audioPlayer.querySelector('.current-time');
var totalTime = audioPlayer.querySelector('.total-time');

var draggableClasses = ['pin'];
var currentlyDragged = null;

window.addEventListener('mousedown', function (event) {

    if (!isDraggable(event.target)) return false;

    currentlyDragged = event.target;
    let handleMethod = currentlyDragged.dataset.method;

    this.addEventListener('mousemove', window[handleMethod], false);

    window.addEventListener('mouseup', () => {
        currentlyDragged = false;
        window.removeEventListener('mousemove', window[handleMethod], false);
    }, false);
});

playpauseBtn.addEventListener('click', togglePlay);
player.addEventListener('timeupdate', updateProgress);
player.addEventListener('loadedmetadata', () => {
    totalTime.textContent = formatTime(player.duration);
});
player.addEventListener('canplay', makePlay);
player.addEventListener('ended', function () {
    playPause.attributes.d.value = "M18 12L0 24V0";
    player.currentTime = 0;
});


// window.addEventListener('resize', directionAware);

sliders.forEach(slider => {
    let pin = slider.querySelector('.pin');
    slider.addEventListener('click', window[pin.dataset.method]);
});

// directionAware();

function isDraggable(el) {
    let canDrag = false;
    let classes = Array.from(el.classList);
    draggableClasses.forEach(draggable => {
        if (classes.indexOf(draggable) !== -1)
            canDrag = true;
    });
    return canDrag;
}

function inRange(event) {
    let rangeBox = getRangeBox(event);
    let rect = rangeBox.getBoundingClientRect();
    let direction = rangeBox.dataset.direction;
    if (direction == 'horizontal') {
        var min = rangeBox.offsetLeft;
        var max = min + rangeBox.offsetWidth;
        if (event.clientX < min || event.clientX > max) return false;
    } else {
        var min = rect.top;
        var max = min + rangeBox.offsetHeight;
        if (event.clientY < min || event.clientY > max) return false;
    }
    return true;
}

function updateProgress(seek_to = 0) {
    if(seek_to !== 0)
        var current = player.currentTime;
    else
        var current = seek_to;

    var percent = current / player.duration * 100;
    progress.style.width = percent + '%';

    currentTime.textContent = formatTime(current);

    if(percent === 0){
        playPause.attributes.d.value = "M18 12L0 24V0";
    }
    console.log('updateProgress' + percent)
}



function getRangeBox(event) {
    let rangeBox = event.target;
    let el = currentlyDragged;
    if (event.type == 'click' && isDraggable(event.target)) {
        rangeBox = event.target.parentElement.parentElement;
    }
    if (event.type == 'mousemove') {
        rangeBox = el.parentElement.parentElement;
    }
    return rangeBox;
}

function getCoefficient(event) {
    let slider = getRangeBox(event);
    let rect = slider.getBoundingClientRect();
    let K = 0;
    if (slider.dataset.direction == 'horizontal') {

        let offsetX = event.clientX - slider.offsetLeft;
        let width = slider.clientWidth;
        K = offsetX / width;

    } else if (slider.dataset.direction == 'vertical') {

        let height = slider.clientHeight;
        var offsetY = event.clientY - rect.top;
        K = 1 - offsetY / height;

    }
    return K;
}

function rewind(event) {
    if (inRange(event)) {
        player.currentTime = player.duration * getCoefficient(event);

        updateProgress( player.duration * getCoefficient(event))

        /*
        var current = player.duration * getCoefficient(event);
        var percent = parseFloat(current / player.duration * 100);
        progress.style.width = percent + '%';

        currentTime.textContent = formatTime(current);
        player.currentTime = percent;*/

        console.log('rewind' + (player.duration * getCoefficient(event)))
    }
}

function changeVolume(event) {
    if (inRange(event)) {
        player.volume = getCoefficient(event);
    }
}

function formatTime(time) {
    var min = Math.floor(time / 60);
    var sec = Math.floor(time % 60);
    return min + ':' + (sec < 10 ? '0' + sec : sec);
}

function togglePlay() {
    if (player.paused) {
        playPause.attributes.d.value = "M0 0h6v24H0zM12 0h6v24h-6z";
        player.play();
    } else {
        playPause.attributes.d.value = "M18 12L0 24V0";
        player.pause();
    }
}

function makePlay() {
    playpauseBtn.style.display = 'block';
}

