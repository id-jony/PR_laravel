const link = 'http://127.0.0.1:8000/account/consumer/wheel/json/';

var getJSON = function (url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'json';
  xhr.onload = function () {
    var status = xhr.status;
    if (status === 200) {
      callback(null, xhr.response);
    } else {
      callback(status, xhr.response);
    }
  };
  xhr.send();
};

getJSON(link, (err, data) => {
  if (err !== null) {
    alert('Something went wrong: ' + err);
  } else {

    const prizes = data;
    console.log(prizes);

    // создаём переменные для быстрого доступа ко всем объектам на странице — блоку в целом, колесу, кнопке и язычку
    const wheel = document.querySelector(".deal-wheel");
    const spinner = wheel.querySelector(".spinner");
    const trigger = wheel.querySelector("#btn-spin");
    const ticker = wheel.querySelector(".ticker");
    // const light = wheel.querySelector(".light");

    // на сколько секторов нарезаем круг
    const prizeSlice = 360 / prizes.length;
    // на какое расстояние смещаем сектора друг относительно друга
    const prizeOffset = Math.floor(180 / prizes.length);
    // прописываем CSS-классы, которые будем добавлять и убирать из стилей
    const spinClass = "is-spinning";
    const selectedClass = "selected";
    // получаем все значения параметров стилей у секторов
    const spinnerStyles = window.getComputedStyle(spinner);

    // переменная для анимации
    let tickerAnim;
    // угол вращения
    let rotation = 0;
    // текущий сектор
    let currentSlice = 1;
    // переменная для текстовых подписей
    let prizeNodes;

    // расставляем текст по секторам
    const createPrizeNodes = () => {
      // обрабатываем каждую подпись
      prizes.forEach(({id, text, color, image, reaction }, i) => {
        // prizes.forEach(({ text, color, reaction }, i) => {

        // каждой из них назначаем свой угол поворота
        const rotation = ((prizeSlice * i) * -1) - prizeOffset;
        // добавляем код с размещением текста на страницу в конец блока spinner
        spinner.insertAdjacentHTML(
          "beforeend",
          // текст при этом уже оформлен нужными стилями
          `<li class="prize" data-reaction=${reaction} style="--rotate: ${rotation}deg">
          <img src="${image}" width="72px" alt="${id}">
          ${text}
      </li>`
        );
      });
    };

    // рисуем разноцветные секторы
    const createConicGradient = () => {
      // устанавливаем нужное значение стиля у элемента spinner
      spinner.setAttribute(
        "style",
        `background: conic-gradient(
          from -90deg,
          ${prizes
            // получаем цвет текущего сектора
            .map(({ color }, i) => `${color} 0 ${(100 / prizes.length) * (prizes.length - i)}%`)
            .reverse()
          }
        );
        
        `
      );
    };

    // создаём функцию, которая нарисует колесо в сборе
    const setupWheel = () => {
      // сначала секторы
      createConicGradient();
      // потом текст
      createPrizeNodes();
      // а потом мы получим список всех призов на странице, чтобы работать с ними как с объектами
      prizeNodes = wheel.querySelectorAll(".prize");
    };

    // определяем количество оборотов, которое сделает наше колесо
    const spinertia = (min, max) => {
      min = Math.ceil(min);
      max = Math.floor(max);
      return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    // функция запуска вращения с плавной остановкой
    const runTickerAnimation = () => {
      // взяли код анимации отсюда: https://css-tricks.com/get-value-of-css-rotation-through-javascript/
      const values = spinnerStyles.transform.split("(")[1].split(")")[0].split(",");
      const a = values[0];
      const b = values[1];
      let rad = Math.atan2(b, a);

      if (rad < 0) rad += (2 * Math.PI);

      const angle = Math.round(rad * (180 / Math.PI));
      const slice = Math.floor(angle / prizeSlice);

      // анимация язычка, когда его задевает колесо при вращении
      // если появился новый сектор
      if (currentSlice !== slice) {
        // убираем анимацию язычка
        ticker.style.animation = "none";
        // и через 10 миллисекунд отменяем это, чтобы он вернулся в первоначальное положение
        setTimeout(() => ticker.style.animation = null, 10);
        // после того, как язычок прошёл сектор - делаем его текущим
        currentSlice = slice;
      }
      // запускаем анимацию
      tickerAnim = requestAnimationFrame(runTickerAnimation);
    };

    // функция выбора призового сектора
    const selectPrize = () => {
      const selected = Math.floor(rotation / prizeSlice);
      prizeNodes[selected].classList.add(selectedClass);
      var txt = prizeNodes[selected].textContent || prizeNodes[selected].innerText;
      var image = document.querySelector(".selected img").src;
      var select_id = document.querySelector(".selected img").getAttribute('alt');

      // console.log(image);

      const link_ajax = 'http://127.0.0.1:8000/account/consumer/wheel/json/';

      $.ajax(link_ajax, {
        method: 'POST',
        data: {prize_id: select_id},
        beforeSend: function () {
        },
        error: function (data) {
          // $("#error .lds-ellipsis").addClass("d-none")
          // $("#error .btn").removeClass("d-none")
          // $("#error .modal-title").html('Упс..Ошибка!')
          // $("#error .modal-body p").html(data.responseJSON.msg || data.responseJSON.message)
          // e.prop('disabled', false)
        },
        success: function (data) {
        },
        complete: function () {
        }
      });


        $("#error .modal-title").html(wheel_title_success)
        $("#error .modal-body").html('<p></p><img src="'+ image +'" width="80px" alt="">')
        $("#error .modal-body p").html(txt)
        $("#error .modal-footer a").html(wheel_btn_exit)
        $('#error').modal('show')
     

    };

    // отслеживаем нажатие на кнопку
    trigger.addEventListener("click", () => {

      // light.setAttribute("style",`background-image: url(../img/wheel/light_1.gif);`);
      // spinner.style.animation = "none";

      // делаем её недоступной для нажатия
      trigger.disabled = true;
      // задаём начальное вращение колеса
      rotation = Math.floor(Math.random() * 360 + spinertia(2000, 5000));
      // убираем прошлый приз
      prizeNodes.forEach((prize) => prize.classList.remove(selectedClass));
      // добавляем колесу класс is-spinning, с помощью которого реализуем нужную отрисовку
      wheel.classList.add(spinClass);
      // через CSS говорим секторам, как им повернуться
      spinner.style.setProperty("--rotate", rotation);
      // возвращаем язычок в горизонтальную позицию
      ticker.style.animation = "none";
      // запускаем анимацию вращение
      runTickerAnimation();
    });

    // отслеживаем, когда закончилась анимация вращения колеса
    spinner.addEventListener("transitionend", () => {
      // spinner.style.animation = "spin_off 25s linear 0s infinite normal none";

      // light.setAttribute("style",`background-image: url(../img/wheel/light_2.gif);`);
      // останавливаем отрисовку вращения
      cancelAnimationFrame(tickerAnim);
      // получаем текущее значение поворота колеса
      rotation %= 360;
      // выбираем приз
      selectPrize();
      // убираем класс, который отвечает за вращение
      wheel.classList.remove(spinClass);
      // отправляем в CSS новое положение поворота колеса
      spinner.style.setProperty("--rotate", rotation);
      // делаем кнопку снова активной
      trigger.disabled = false;
    });

    // подготавливаем всё к первому запуску
    setupWheel();

  }
});