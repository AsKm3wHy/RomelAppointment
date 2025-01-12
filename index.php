<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Romel Photograph</title>

</head>

<body>

    <header>
        <div class="inner">
            <div class="logo"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/wwf-logo.png"></div>
            <div class="burger"></div>
            <nav>
                <a class="active" href="#">Package</a>
                <a href="Appointment.php">Appointment</a>
                <a href="ContactUs.php">Contact Us</a>
                <a href="#">FAQ</a>
            </nav>
            <!-- <a href="#" class="donate-link">Donate</a> -->
        </div>
    </header>

    <main>
        <div id="slider">
            <div class="slider-container">
                <div class="slider-images">
                    <div class="slider-item">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/lion2.jpg" alt="Image 1">
                        <div class="slider-text">
                            <h2>Image 1</h2>
                            <p>Text for Image 1</p>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/tiger2.jpg" alt="Image 2">
                        <div class="slider-text">
                            <h2>Image 2</h2>
                            <p>Text for Image 2</p>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/bear2.jpg" alt="Image 3">
                        <div class="slider-text">
                            <h2>Image 3</h2>
                            <p>Text for Image 3</p>
                        </div>
                    </div>
                </div>
                <!-- Next and Previous buttons -->
                <button class="button prev" onclick="changeSlide(-1)">&#10094;</button>
                <button class="button next" onclick="changeSlide(1)">&#10095;</button>
            </div>
            <!-- <div class="slider-inner">
                <div id="slider-content">
                    <div class="meta">Species</div>
                    <h2 id="slide-title">Amur <br>Leopard</h2>
                    <span data-slide-title="0">Amur <br>Leopard</span>
                    <span data-slide-title="1">Asiatic <br>Lion</span>
                    <span data-slide-title="2">Siberian <br>Tiger</span>
                    <span data-slide-title="3">Brown <br>Bear</span>
                    <div class="meta">Status</div>
                    <div id="slide-status">Critically Endangered</div>
                    <span data-slide-status="0">Critically Endangered</span>
                    <span data-slide-status="1">Endangered</span>
                    <span data-slide-status="2">Endangered</span>
                    <span data-slide-status="3">Least Concern</span>
                </div>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/leopard2.jpg" />
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/lion2.jpg" />
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/tiger2.jpg" />
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/bear2.jpg" />
            </div>



            <div id="pagination">
                <button class="active" data-slide="0"></button>
                <button data-slide="1"></button>
                <button data-slide="2"></button>
                <button data-slide="3"></button>
            </div> -->

        </div>
    </main>

    <script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slider-item');
    const sliderImages = document.querySelector('.slider-images');

    function changeSlide(direction) {
        currentIndex += direction;

        if (currentIndex < 0) {
            currentIndex = slides.length - 1;
        }
        if (currentIndex >= slides.length) {
            currentIndex = 0;
        }

        sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;
    }


    setInterval(() => changeSlide(1), 10000);
    </script>


    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-40525870-5"></script>

    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-40525870-5');
    </script>

    <script>
    class DisplacementSlider {
        constructor(parent, images) {
            this.parent = parent;
            this.images = images;
            this.sliderImages = [];

            this.init();
        }

        init() {
            this.createCanvas();
            this.loadImages();
            this.createShaderMaterial();
            this.createSceneAndCamera();
            this.addEvents();
        }

        createCanvas() {
            const canvas = document.createElement('canvas');
            canvas.width = this.images[0].clientWidth;
            canvas.height = this.images[0].clientHeight;
            this.parent.appendChild(canvas);
            this.renderer = new THREE.WebGLRenderer({
                canvas,
                antialias: false,
                context: canvas.getContext('webgl')
            });
            this.renderer.setSize(canvas.width, canvas.height);
            this.renderer.setClearColor(0x23272A, 1.0);
        }

        loadImages() {
            const loader = new THREE.TextureLoader();
            loader.crossOrigin = "anonymous";
            this.images.forEach((img) => {
                const image = loader.load(img.getAttribute('src') + '?v=' + Date.now());
                image.magFilter = image.minFilter = THREE.LinearFilter;
                image.anisotropy = this.renderer.capabilities.getMaxAnisotropy();
                this.sliderImages.push(image);
            });
        }

        createShaderMaterial() {
            const vertex = `
      varying vec2 vUv;
      void main() {
        vUv = uv;
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
      }
    `;

            const fragment = `
      varying vec2 vUv;

      uniform sampler2D currentImage;
      uniform sampler2D nextImage;

      uniform float dispFactor;

      void main() {
        vec2 uv = vUv;
        vec4 orig1 = texture(currentImage, uv);
        vec4 orig2 = texture(nextImage, uv);

        // Adjust displacement based on image intensity for offset
        float intensity = 0.3;
        vec2 displacement = vec2(0.0, intensity * (orig2.r - orig1.r));

        // Displace the texture coordinates
        vec4 _currentImage = texture(currentImage, uv + displacement * dispFactor);
        vec4 _nextImage = texture(nextImage, uv - displacement * (1.0 - dispFactor));

        // Mix the two textures based on the displacement factor
        vec4 finalTexture = mix(_currentImage, _nextImage, dispFactor);

        gl_FragColor = finalTexture;
      }
    `;

            this.material = new THREE.ShaderMaterial({
                uniforms: {
                    dispFactor: {
                        type: "f",
                        value: 0.0
                    },
                    currentImage: {
                        type: "t",
                        value: this.sliderImages[0]
                    },
                    nextImage: {
                        type: "t",
                        value: this.sliderImages[1]
                    },
                },
                vertexShader: vertex,
                fragmentShader: fragment,
                transparent: true,
                opacity: 1.0
            });
        }

        createSceneAndCamera() {
            const geometry = new THREE.PlaneBufferGeometry(
                this.parent.offsetWidth,
                this.parent.offsetHeight,
                1
            );
            const object = new THREE.Mesh(geometry, this.material);
            object.position.set(0, 0, 0);
            this.scene = new THREE.Scene();
            this.scene.background = new THREE.Color(0x23272A);
            this.camera = new THREE.OrthographicCamera(
                this.parent.offsetWidth / -2,
                this.parent.offsetWidth / 2,
                this.parent.offsetHeight / 2,
                this.parent.offsetHeight / -2,
                1,
                1000
            );
            this.camera.position.z = 1;
            this.scene.add(object);
        }

        addEvents() {
            const pagButtons = Array.from(document.getElementById('pagination').querySelectorAll('button'));
            let isAnimating = false;

            pagButtons.forEach((el) => {
                el.addEventListener('click', () => {
                    if (!isAnimating) {
                        isAnimating = true;

                        document.getElementById('pagination').querySelectorAll('.active')[0]
                            .className = '';
                        el.className = 'active';

                        const slideId = parseInt(el.dataset.slide, 10);

                        this.material.uniforms.nextImage.value = this.sliderImages[slideId];
                        this.material.uniforms.nextImage.needsUpdate = true;

                        TweenLite.to(this.material.uniforms.dispFactor, 1, {
                            value: 1,
                            ease: 'Expo.easeInOut',
                            onComplete: () => {
                                this.material.uniforms.currentImage.value = this
                                    .sliderImages[slideId];
                                this.material.uniforms.currentImage.needsUpdate = true;
                                this.material.uniforms.dispFactor.value = 0.0;
                                isAnimating = false;
                            }
                        });

                        const slideTitleEl = document.getElementById('slide-title');
                        const slideStatusEl = document.getElementById('slide-status');
                        const nextSlideTitle = document.querySelectorAll(
                            `[data-slide-title="${slideId}"]`)[0].innerHTML;
                        const nextSlideStatus = document.querySelectorAll(
                            `[data-slide-status="${slideId}"]`)[0].innerHTML;

                        TweenLite.fromTo(slideTitleEl, 0.5, {
                            autoAlpha: 1,
                            y: 0
                        }, {
                            autoAlpha: 0,
                            y: 20,
                            ease: 'Expo.easeIn',
                            onComplete: () => {
                                slideTitleEl.innerHTML = nextSlideTitle;

                                TweenLite.to(slideTitleEl, 0.5, {
                                    autoAlpha: 1,
                                    y: 0,
                                });
                            }
                        });
                    }
                });
            });
        }
    }

    const sliderParentElement = document.getElementById('slider');
    const imagesElementArray = Array.from(document.querySelectorAll('#slider img'));
    const sliderInstance = new DisplacementSlider(sliderParentElement, imagesElementArray);

    // Optionally remove default event listeners from slider buttons
    // so that only custom event listeners are triggered.
    Array.from(document.querySelectorAll('#pagination button')).forEach((el) => {
        el.removeEventListener('click', () => {});
    });
    </script>
</body>

</html>