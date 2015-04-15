<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>出错了！</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		
		<link rel="stylesheet" type="text/css" href="/assets/errors/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="/assets/errors/css/component.css" />
		<link rel="stylesheet" type="text/css" href="/assets/errors/css/bg-slider.css" />
		<link rel="stylesheet" type="text/css" href="/assets/errors/clock/css/clock.css">
		<link rel="stylesheet" type="text/css" href="/assets/errors/css/main.css">
		<link rel="stylesheet" type="text/css" href="/assets/errors/css/responsive.css">
		<script src="/assets/errors/js/vendor/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
		<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-86951-7']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
			})();
		</script>

		<script type="text/javascript" src="/assets/errors/js/vendor/three.min.js"></script>
		<script type="text/javascript" src="/assets/errors/js/vendor/detector.js"></script>

		<script id="vs" type="x-shader/x-vertex">

			varying vec2 vUv;

			void main() {

			vUv = uv;
			gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );

			}

		</script>

		<script id="fs" type="x-shader/x-fragment">

			uniform sampler2D map;

			uniform vec3 fogColor;
			uniform float fogNear;
			uniform float fogFar;

			varying vec2 vUv;

			void main() {

			float depth = gl_FragCoord.z / gl_FragCoord.w;
			float fogFactor = smoothstep( fogNear, fogFar, depth );

			gl_FragColor = texture2D( map, vUv );
			gl_FragColor.w *= pow( gl_FragCoord.z, 20.0 );
			gl_FragColor = mix( gl_FragColor, vec4( fogColor, gl_FragColor.w ), fogFactor );

			}

		</script>

		<script type="text/javascript">
			if (!Detector.webgl)
				Detector.addGetWebGLMessage();

			var container;
			var camera, scene, renderer;
			var mesh, geometry, material;

			var mouseX = 0, mouseY = 0;
			var start_time = Date.now();

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;

			init();

			function init() {

				container = document.createElement('div');
				container.className = "cloud";
				document.body.appendChild(container);

				// Bg gradient

				var canvas = document.createElement('canvas');
				canvas.width = 32;
				canvas.height = window.innerHeight;

				var context = canvas.getContext('2d');

				var gradient = context.createLinearGradient(0, 0, 0, canvas.height);
				gradient.addColorStop(0, "#1e4877");
				gradient.addColorStop(0.5, "#4584b4");

				context.fillStyle = gradient;
				context.fillRect(0, 0, canvas.width, canvas.height);

				//

				camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 1, 3000);
				camera.position.z = 6000;

				scene = new THREE.Scene();

				geometry = new THREE.Geometry();

//				var texture = THREE.ImageUtils.loadTexture('img/cloud.png', null, animate);
//				texture.magFilter = THREE.LinearMipMapLinearFilter;
//				texture.minFilter = THREE.LinearMipMapLinearFilter;

				var fog = new THREE.Fog(0x4584b4, -100, 3000);

				material = new THREE.ShaderMaterial({

					uniforms : {

						"map" : {
							type : "t",
//							value : texture
						},
						"fogColor" : {
							type : "c",
							value : fog.color
						},
						"fogNear" : {
							type : "f",
							value : fog.near
						},
						"fogFar" : {
							type : "f",
							value : fog.far
						},

					},
					vertexShader : document.getElementById('vs').textContent,
					fragmentShader : document.getElementById('fs').textContent,
					depthWrite : false,
					depthTest : false,
					transparent : true

				});

				var plane = new THREE.Mesh(new THREE.PlaneGeometry(64, 64));

				for (var i = 0; i < 8000; i++) {

					plane.position.x = Math.random() * 1000 - 500;
					plane.position.y = -Math.random() * Math.random() * 200 - 15;
					plane.position.z = i;
					plane.rotation.z = Math.random() * Math.PI;
					plane.scale.x = plane.scale.y = Math.random() * Math.random() * 1.5 + 0.5;

					THREE.GeometryUtils.merge(geometry, plane);

				}

				mesh = new THREE.Mesh(geometry, material);
				scene.add(mesh);

				mesh = new THREE.Mesh(geometry, material);
				mesh.position.z = -8000;
				scene.add(mesh);

				renderer = new THREE.WebGLRenderer({
					antialias : false
				});
				renderer.setSize(window.innerWidth, window.innerHeight);
				container.appendChild(renderer.domElement);

			//	document.addEventListener('mousemove', onDocumentMouseMove, false);
				window.addEventListener('resize', onWindowResize, false);

			}

			function onDocumentMouseMove(event) {

				mouseX = (event.clientX - windowHalfX ) * 0.25;
				mouseY = (event.clientY - windowHalfY ) * 0.15;

			}

			function onWindowResize(event) {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize(window.innerWidth, window.innerHeight);

			}

			function animate() {

				requestAnimationFrame(animate);

				position = ((Date.now() - start_time ) * 0.03 ) % 8000;

				camera.position.x += (mouseX - camera.position.x ) * 0.01;
				camera.position.y += (-mouseY - camera.position.y ) * 0.01;
				camera.position.z = -position + 8000;

				renderer.render(scene, camera);

			}

		</script>

		<section class="mainarea">
			<div id="clock" class="active">
				<div class="clock-container">
					<div id="time-container-wrap">
						<div id="time-container">
							<div class="numbers-container"></div>
							<span id="ticker" class="clock-label"><b>LaraBase</b></span>
							<span id="timelable" class="clock-label">//PHP工匠之家</span>
							<span id="timeleft" class="clock-label"></span>
							<figure id="canvas"></figure>
						</div>
					</div>
				</div>
				<h3> 抱歉，亲！您访问的页面不存在或还没有开发好。</h3>
				<form action="#" class="subscribe" id="subscribe">
					<input type="text" value="输入邮箱" class="email requiredField" name="Enter your email" />
					<input type="submit" value="联系" />
				</form>
			</div>
			<div class="mainarea-content">
				<div id="services" data-page="services" class="side-page side-left went-left">
					<div class="container">
						<h2 class="title">What we do</h2>
						<ul class="services">
							<li>
								<img src="/assets/errors/img/icons/promotion-icon.png" alt="" />
								<p>
									Promotion
								</p>
							</li>
							<li>
								<img src="/assets/errors/img/icons/web-desing-icon.png" alt="" />
								<p>
									Web Design
								</p>
							</li>
							<li>
								<img src="/assets/errors/img/icons/photography-icon.png" alt="" />
								<p>
									Photography
								</p>
							</li>
						</ul>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
						</p>
						<p>
							Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <a href="#">Excepteur sint occaecat</a> cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.
						</p>
					</div>
				</div>
				<div id="about" data-page="about" class="side-page active">
					<div class="container">
						<h2 class="title">Who we are</h2>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget nibh at libero fringilla adipiscing nec ut leo. Etiam nec purus arcu. Morbi sollicitudin at risus id malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam sed tincidunt arcu. Donec molestie ante sapien, sed molestie est euismod eget. Maecenas ac metus accumsan, scelerisque massa sed, porta est. Aliquam ut mollis mi. Cras id vulputate purus, ac sollicitudin ante.
						</p>
						<p>
							Integer condimentum eu lectus quis semper. Sed id metus magna. Morbi ultrices magna id euismod hendrerit. Pellentesque nec mattis odio, vitae laoreet metus. Sed eget sollicitudin est, vitae accumsan nisi. Fusce consequat imperdiet venenatis. Integer mollis hendrerit facilisis. Praesent vel mattis enim. Integer fringilla et urna vitae rutrum.
						</p>
					</div>
				</div>
				<div id="contacts" data-page="contacts" class="side-page side-right went-right">
					<div class="container">
						<h2 class="title">Get in touch</h2>
						<p>
							Lexington Avenue · New York, NY
							<br>
							P: (123) - 456 789 · email@domain.com
						</p>
						<form action="#" class="contact-list">
							<div class="field-row">
								<input type="text" id="name" value="Name" />
							</div>
							<div class="field-row">
								<input type="text" id="email" value="E-mail" />
							</div>
							<div class="field-row">
								<input type="text" id="message" value="Message" />
							</div>
							<div class="field-row">
								<input type="submit" value="Send Message" />
							</div>
						</form>
					</div>
				</div>
			</div>
			<a class="close" href="#"><img alt="" src="/assets/errors/img/close.png"></a>
		</section>
		

		<script src="/assets/errors/js/vendor/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/js/vendor/classie.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/js/vendor/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
		<!--<script src="/assets/errors/js/vendor/jquery.tubular.1.0.js" type="text/javascript" charset="utf-8"></script>-->
		<script src="/assets/errors/js/vendor/jquery.cycle.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/js/plugins.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/js/main.min.js" type="text/javascript" charset="utf-8"></script>

		<script src="/assets/errors/clock/js/svg.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/clock/js/svg.easing.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/clock/js/svg.clock.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/clock/js/jquery.timers.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/errors/clock/js/clock.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
