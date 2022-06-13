var el = document.getElementById('graph'); // get canvas

var options = {
  percent: el.getAttribute('data-percent') || 25,
  finish: el.getAttribute('data-finish') || 220,
  size: el.getAttribute('data-size') || (screen.width - 5),
  lineWidth: el.getAttribute('data-line') || 20,
  rotate: el.getAttribute('data-rotate') || 180
}
var canvas = document.createElement('canvas');
var span = document.createElement('span');
span.textContent = 0;

var p = document.createElement('p');
p.textContent = 'ИЗ ' + options.finish;

if (typeof (G_vmlCanvasManager) !== 'undefined') {
  G_vmlCanvasManager.initElement(canvas);
}

var ctx = canvas.getContext('2d');
canvas.width = canvas.height = options.size;



ctx.translate(options.size / 2, options.size / 2); // change center
ctx.rotate((1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

//imd = ctx.getImageData(0, 0, 240, 240);
var radius = (options.size - options.lineWidth) / 2;


var drawCircle = function (color, lineWidth, percent) {

  percent = Math.min(Math.max(0, percent || 1), 1);
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
  ctx.strokeStyle = color;
  ctx.lineCap = 'round'; // butt, round or square
  ctx.lineWidth = lineWidth
  ctx.stroke();
};

el.appendChild(span);
el.appendChild(p);
el.appendChild(canvas);

drawCircle('D8D8D8', options.lineWidth, 100 / 100);

var positionX = 1;
const speed = 12000;

  const animate = () => {
    const value = +options.percent;
    const data = +span.textContent;

    const time = value / speed;
    if (data < value) {
      drawCircle('214EC3', options.lineWidth, Math.ceil(data + time) / options.finish);

      span.textContent = Math.ceil(data + time);
      setTimeout(animate, 8);
    } else {
      span.textContent = value;
    }

  }

  animate();




