<div class="container-fluid px-0">
    <div class="row mx-0">
        <div id="carouselExampleDark" class="carousel carousel-dark slide p-0 pb-2 hovered shadow carousel-fade" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators" id="carouselIndicators"></div>

            <!-- Carousel Items -->
            <div class="carousel-inner" id="sliders"></div>

            <!-- Navigation Buttons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    {{-- <hr class="my-3"> --}}
    <div class="container" id="homeAbout">

    </div>
</div>

<script>
    getSlider();

    async function getSlider() {
        try {
            let res = await axios.get('/slider-show');
            let resAbout = await axios.get('/home-about-show');
            console.log(resAbout);

            let indicators = $("#carouselIndicators");
            let sliders = $("#sliders");

            indicators.empty();
            sliders.empty();

            res.data.forEach((item, index) => {
                let activeClass = index === 0 ? "active" : "";

                // Add Indicator
                let indicator = `<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="${index}" class="${activeClass}" aria-label="Slide ${index + 1}"></button>`;
                indicators.append(indicator);

                // Add Slide Item
                let slide = `
                    <div class="carousel-item ${activeClass}" data-bs-interval="5000">
                        <img src="${item.image}" class="d-block w-100 img img-resposive rounded-2 opacity-50" style="height:100vh;" alt="${item.title}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>${item.title}</h5>
                            <p>${item.short_des}</p>
                        </div>
                    </div>
                `;
                sliders.append(slide);
            });
            let homeAbout = $("#homeAbout");

            homeAbout.empty();

            resAbout.data.forEach((item, index) => {
                let activeClass = index === 0 ? "active" : "";
                // Add resAbout Item
                let div = `
                    <div class="">
                        <img src="${item.image}" alt="${item.title}" class="d-block w-100 h-100 img img-resposive rounded-3">
                    </div>
                `;
                homeAbout.append(div);
            });
        } catch (error) {
            console.error("Error fetching sliders:", error);
        }
    }
</script>
