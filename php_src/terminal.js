var width, height, container, canvas, ctx, points, target, animateHeader = true;

// function init() {
// initHeader();
// initAnimation();
// addListeners();
// }
//
// function initHeader() {
// width = window.innerWidth;
// height = window.innerHeight;
// target = {
//   x: width / 2,
//   y: height / 2
// };
//
// container = document.getElementById('connecting-dots');
// container.style.height = height + 'px';
//
// canvas = document.getElementById('canvas');
// canvas.width = width;
// canvas.height = height;
// ctx = canvas.getContext('2d');
//
// // create points
// points = [];
// for (var x = 0; x < width; x = x + width / 20) {
//   for (var y = 0; y < height; y = y + height / 20) {
//     var px = x + Math.random() * width / 100;
//     var py = y + Math.random() * height / 100;
//     var p = {
//       x: px,
//       originX: px,
//       y: py,
//       originY: py
//     };
//     points.push(p);
//   }
// }
//
// // for each point find the 5 closest points
// for (var i = 0; i < points.length; i++) {
//   var closest = [];
//   var p1 = points[i];
//   for (var j = 0; j < points.length; j++) {
//     var p2 = points[j]
//     if (!(p1 == p2)) {
//       var placed = false;
//       for (var k = 0; k < 5; k++) {
//         if (!placed) {
//           if (closest[k] == undefined) {
//             closest[k] = p2;
//             placed = true;
//           }
//         }
//       }
//
//       for (var k = 0; k < 5; k++) {
//         if (!placed) {
//           if (getDistance(p1, p2) < getDistance(p1, closest[k])) {
//             closest[k] = p2;
//             placed = true;
//           }
//         }
//       }
//     }
//   }
//   p1.closest = closest;
// }
//
// // assign a circle to each point
// for (var i in points) {
//   var c = new Circle(points[i], 2 + Math.random() * 2, 'rgba(255,255,255,0.9)');
//   points[i].circle = c;
// }
// }

// Event handling
// function addListeners() {
// if (!('ontouchstart' in window)) {
// //  window.addEventListener("mousemove", mouseMove);
// }
// window.addEventListener("resize", resize, true);
// window.addEventListener("scroll", scrollCheck);
// }
//
// function mouseMove(e) {
// var posx = posy = 0;
// if (e.pageX || e.pageY) {
//   posx = e.pageX;
//   posy = e.pageY;
// } else if (e.clientX || e.clientY) {
//   posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
//   posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
// }
// target.x = posx;
// target.y = posy;
// }
//
// function scrollCheck() {
// if (document.body.scrollTop > height) animateHeader = false;
// else animateHeader = true;
// }
//
// function resize() {
// width = window.innerWidth;
// height = window.innerHeight;
// container.style.height = height + 'px';
// ctx.canvas.width = width;
// ctx.canvas.height = height;
// }
//
// // animation
// function initAnimation() {
// animate();
// for (var i in points) {
//   shiftPoint(points[i]);
// }
// }
//
// function animate() {
// if (animateHeader) {
//   ctx.clearRect(0, 0, canvas.width, canvas.height);
//   for (var i in points) {
//     // detect points in range
//     if (Math.abs(getDistance(target, points[i])) < 4000) {
//       points[i].active = 0.3;
//       points[i].circle.active = 0.6;
//     } else if (Math.abs(getDistance(target, points[i])) < 20000) {
//       points[i].active = 0.1;
//       points[i].circle.active = 0.3;
//     } else if (Math.abs(getDistance(target, points[i])) < 40000) {
//       points[i].active = 0.02;
//       points[i].circle.active = 0.1;
//     } else {
//       points[i].active = 0;
//       points[i].circle.active = 0;
//     }
//
//     drawLines(points[i]);
//     points[i].circle.draw();
//   }
// }
// requestAnimationFrame(animate);
// }
//
// function shiftPoint(p) {
// TweenLite.to(p, 1 + 1 * Math.random(), {
//   x: p.originX - 50 + Math.random() * 100,
//   y: p.originY - 50 + Math.random() * 100,
//   ease: Circ.easeInOut,
//   onComplete: function() {
//     shiftPoint(p);
//   }
// });
// }
//
// // Canvas manipulation
// function drawLines(p) {
// if (!p.active) return;
// for (var i in p.closest) {
//   ctx.beginPath();
//   ctx.moveTo(p.x, p.y);
//   ctx.lineTo(p.closest[i].x, p.closest[i].y);
//   ctx.strokeStyle = 'rgba(255,255,255,' + p.active + ')';
//   ctx.stroke();
// }
// }
//
// function Circle(pos, rad, color) {
// var _this = this;
//
// // constructor
// (function() {
//   _this.pos = pos || null;
//   _this.radius = rad || null;
//   _this.color = color || null;
// })();
//
// this.draw = function() {
//   if (!_this.active) return;
//   ctx.beginPath();
//   ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
//   ctx.fillStyle = 'rgba(255,255,255,' + _this.active + ')';
//   ctx.fill();
// };
// }
//
// // Util
// function getDistance(p1, p2) {
// return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
// }

// init();


;(function(window) {

'use strict';

  //FIND IP

  function findIP(onNewIP) { //  onNewIp - your listener function for new IPs
    var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection; //compatibility for firefox and chrome
    var pc = new myPeerConnection({iceServers: []}),
      noop = function() {},
      localIPs = {},
      ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
      key;

    function ipIterate(ip) {
      if (!localIPs[ip]) onNewIP(ip);
      localIPs[ip] = true;
    }
    pc.createDataChannel(""); //create a bogus data channel
    pc.createOffer(function(sdp) {
      sdp.sdp.split('\n').forEach(function(line) {
        if (line.indexOf('candidate') < 0) return;
        line.match(ipRegex).forEach(ipIterate);
      });
      pc.setLocalDescription(sdp, noop, noop);
    }, noop); // create offer and set local description
    pc.onicecandidate = function(ice) { //listen for candidate events
      if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
      ice.candidate.candidate.match(ipRegex).forEach(ipIterate);
    };
  }

function addIP(ip) {
console.log('got ip: ', ip);

var theIp = document.getElementById('ip');
var theConsole = $('span.console');
var texted = ip;

theIp.textContent = ip;



theConsole.html(texted);

}

findIP(addIP);

//FIND LOCATIOn


$.getJSON('https://ipapi.co/'+$(ip).val()+'/json', function(data){

    $('.country').text(data.country);
});


(function() {

  var theConsole = $('span.console');
  var texted = $("#ip").text();

  theConsole.html(texted);
});

var search_form = document.getElementsByClassName('search__form');
console.log(search_form);



function createHome(){

var homeDiv = document.createElement('div');
      homeDiv.innerHTML = '<div class="home_container"><h2>I am hungry</h2><p>Shall we go eat?</p><div class="close_home" href="">x</div></div>';
      homeDiv.setAttribute('class', 'home');
      document.body.appendChild(homeDiv);

      $('.close_home').click(function(){
          $('.home').remove();
          console.log('Home Erased');
      });


}


var navigationLink = $('.terminal__line a');

navigationLink.click(function(e){
if ($(this).hasClass('out')) {
  window.open('http://instagram.com/arcticben.co.uk');
}else
{
createHome();
}
});



$(search_form).submit(function( event ) {
  if ( 'aboutus' === $( "input" ).val() ||  'contact' === $( "input" ).val() || 'gethacked' === $( "input" ).val() || 'blog' === $( "input" ).val() ) {




} else if ( $( "input" ).val() === "home" ) {
      window.open('https://cyberaticrvitm.com/');
    }
    else if ( $( "input" ).val() === "login" ) {
          window.open('https://cyberaticrvitm.com/login');
        }
    else if ( $( "input" ).val() === "blog" ) {
          window.open('https://cyberaticrvitm.com/public');
        }    
    else if ( $( "input" ).val() === "instagram" ) {
        window.open('https://cyberaticrvitm.com/login');
      } else if ($( "input" ).val() === "ipconfig") {

      var binder = $('input').val();
      var terminal_div = document.getElementsByClassName('terminal');
          $('.terminal').addClass("binding");
      var theipagain = $('#ip').html();

      var ipconfig = document.createElement('p');
            $(ipconfig).text('ipconfig: ' + theipagain);
            ipconfig.setAttribute('class', 'terminal__line');
            $(ipconfig).appendTo(terminal_div);
            console.log(ipconfig.length);

    }

  var binder = $('input').val();
  var terminal_div = document.getElementsByClassName('terminal');
      $('.terminal').addClass("binding");

  var commands = document.createElement('p');
        commands.innerHTML = ('Execute: ' + binder);
        commands.setAttribute('class', 'terminal__line');
        $(commands).appendTo(terminal_div);





  event.preventDefault();
});



})(window);




(function () {
		var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
						window.setTimeout(callback, 1000 / 60);
				};
		window.requestAnimationFrame = requestAnimationFrame;
})();

// Terrain stuff.

var background = document.getElementById("bgCanvas"),

		bgCtx = background.getContext("2d"),
		width = window.innerWidth,
		height = document.body.offsetHeight;

(height < 400) ? height = 400 : height;

background.width = width;
background.height = height;

function Terrain(options) {
		options = options || {};
		this.terrain = document.createElement("canvas");
		this.terCtx = this.terrain.getContext("2d");
		this.scrollDelay = options.scrollDelay || 90;
		this.lastScroll = new Date().getTime();

		this.terrain.width = width;
		this.terrain.height = height;
		this.fillStyle = options.fillStyle || "#191D4C";
		this.mHeight = options.mHeight || height;

		// generate
		this.points = [];

		var displacement = options.displacement || 140,
				power = Math.pow(2, Math.ceil(Math.log(width) / (Math.log(2))));

		// set the start height and end height for the terrain
		this.points[0] = this.mHeight;//(this.mHeight - (Math.random() * this.mHeight / 2)) - displacement;
		this.points[power] = this.points[0];

		// create the rest of the points
		for (var i = 1; i < power; i *= 2) {
				for (var j = (power / i) / 2; j < power; j += power / i) {
						this.points[j] = ((this.points[j - (power / i) / 2] + this.points[j + (power / i) / 2]) / 2) + Math.floor(Math.random() * -displacement + displacement);
				}
				displacement *= 0.6;
		}

		document.body.appendChild(this.terrain);
}

Terrain.prototype.update = function () {
		// draw the terrain
		this.terCtx.clearRect(0, 0, width, height);
		this.terCtx.fillStyle = this.fillStyle;

		if (new Date().getTime() > this.lastScroll + this.scrollDelay) {
				this.lastScroll = new Date().getTime();
				this.points.push(this.points.shift());
		}

		this.terCtx.beginPath();
		for (var i = 0; i <= width; i++) {
				if (i === 0) {
						this.terCtx.moveTo(0, this.points[0]);
				} else if (this.points[i] !== undefined) {
						this.terCtx.lineTo(i, this.points[i]);
				}
		}

		this.terCtx.lineTo(width, this.terrain.height);
		this.terCtx.lineTo(0, this.terrain.height);
		this.terCtx.lineTo(0, this.points[0]);
		this.terCtx.fill();
}


// Second canvas used for the stars
bgCtx.fillStyle = '#05004c';
bgCtx.fillRect(0, 0, width, height);

// stars
function Star(options) {
		this.size = Math.random() * 2;
		this.speed = Math.random() * .05;
		this.x = options.x;
		this.y = options.y;
}

Star.prototype.reset = function () {
		this.size = Math.random() * 2;
		this.speed = Math.random() * .05;
		this.x = width;
		this.y = Math.random() * height;
}

Star.prototype.update = function () {
		this.x -= this.speed;
		if (this.x < 0) {
				this.reset();
		} else {
				bgCtx.fillRect(this.x, this.y, this.size, this.size);
		}
}

function ShootingStar() {
		this.reset();
}

ShootingStar.prototype.reset = function () {
		this.x = Math.random() * width;
		this.y = 0;
		this.len = (Math.random() * 80) + 10;
		this.speed = (Math.random() * 10) + 6;
		this.size = (Math.random() * 1) + 0.1;
		// this is used so the shooting stars arent constant
		this.waitTime = new Date().getTime() + (Math.random() * 3000) + 500;
		this.active = false;
}

ShootingStar.prototype.update = function () {
		if (this.active) {
				this.x -= this.speed;
				this.y += this.speed;
				if (this.x < 0 || this.y >= height) {
						this.reset();
				} else {
						bgCtx.lineWidth = this.size;
						bgCtx.beginPath();
						bgCtx.moveTo(this.x, this.y);
						bgCtx.lineTo(this.x + this.len, this.y - this.len);
						bgCtx.stroke();
				}
		} else {
				if (this.waitTime < new Date().getTime()) {
						this.active = true;
				}
		}
}

var entities = [];

// init the stars
for (var i = 0; i < height; i++) {
		entities.push(new Star({
				x: Math.random() * width,
				y: Math.random() * height
		}));
}

// Add 2 shooting stars that just cycle.
entities.push(new ShootingStar());
entities.push(new ShootingStar());
entities.push(new Terrain({mHeight : (height/2)-120}));
entities.push(new Terrain({displacement : 120, scrollDelay : 50, fillStyle : "rgb(17,20,40)", mHeight : (height/2)-60}));
entities.push(new Terrain({displacement : 100, scrollDelay : 20, fillStyle : "rgb(10,10,5)", mHeight : height/2}));

//animate background
function animate() {
		bgCtx.fillStyle = '#110E19';
		bgCtx.fillRect(0, 0, width, height);
		bgCtx.fillStyle = '#ffffff';
		bgCtx.strokeStyle = '#ffffff';

		var entLen = entities.length;

		while (entLen--) {
				entities[entLen].update();
		}
		requestAnimationFrame(animate);
}
animate();
