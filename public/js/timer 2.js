function startTimer(duration, display) {
  var timer = duration, seconds;
  var btn = document.getElementById('new-code');
  btn.setAttribute("onclick", "");
  btn.classList.add('disable');

  let timerId = setInterval(function () {
    seconds = parseInt(timer % 60, 10);
    seconds = seconds < 10 ? "0" + seconds : seconds;
    display.textContent = seconds;

    if (--timer < 0) {
      clearInterval(timerId);
      btn.setAttribute("onclick", "Timer()");
      btn.classList.remove('disable');
    }
  }, 1000);
}