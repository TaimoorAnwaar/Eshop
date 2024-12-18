<div id="bannerCarousel" class="carousel slide banner-container" data-bs-ride="carousel" data-bs-interval="3000">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

  
    <div class="carousel-inner">
      
        <div class="carousel-item active">
            <img src="{{ asset('images/back.jpg') }}" class="d-block w-100 banner-image" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block banner-overlay">
                <h1 class="banner-title">Welcome to Our Website</h1>
                <p class="banner-subtitle">Discover the best products for you.</p>
            </div>
        </div>
      
        <div class="carousel-item">
            <img src="{{ asset('images/backg.jpg') }}" class="d-block w-100 banner-image" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block banner-overlay">
                <h1 class="banner-title">Amazing Deals</h1>
                <p class="banner-subtitle">Get the best discounts now.</p>
            </div>
        </div>
       
        <div class="carousel-item">
            <img src="{{ asset('images/abc.png') }}" class="d-block w-100 banner-image" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block banner-overlay">
                <h1 class="banner-title">Shop With Confidence</h1>
                <p class="banner-subtitle">Your satisfaction is our priority.</p>
            </div>
        </div>
    </div>

    
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
.banner-container {
    position: relative;
    height: 300px; 
    margin: 0;
    z-index: 0; */
}

.carousel-inner {
    z-index: 1;
}

.banner-image {
    width: 100%;
    height: 300px; 
    object-fit: cover; 
    filter: brightness(75%);
}

.carousel-caption {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
}

body {
    margin: 0;
    padding: 0;
}

.navbar + .banner-container {
    margin-top: 0; 
}

.hero-section {
    margin-top: 20px; 
}
</style>
