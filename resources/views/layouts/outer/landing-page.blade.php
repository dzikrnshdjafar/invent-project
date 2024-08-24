<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Play | Free Startup and SaaS Landing Page Template by UIdeck</title>

    <!-- Primary Meta Tags -->
<meta name="title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
<meta name="description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://uideck.com/play/">
<meta property="og:title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
<meta property="og:description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">
<meta property="og:image" content="https://uideck.com/wp-content/uploads/2021/09/play-meta-bs.jpg">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://uideck.com/play/">
<meta property="twitter:title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
<meta property="twitter:description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">
<meta property="twitter:image" content="https://uideck.com/wp-content/uploads/2021/09/play-meta-bs.jpg">

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{ asset('landpage') }}/assets/images/favicon.svg"
      type="image/svg"
    />

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ asset('landpage') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('landpage') }}/assets/css/animate.css" />
    <link rel="stylesheet" href="{{ asset('landpage') }}/assets/css/lineicons.css" />
    <link rel="stylesheet" href="{{ asset('landpage') }}/assets/css/ud-styles.css" />
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <header class="ud-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            @include('layouts.outer.navbar')
          </div>
        </div>
      </div>
    </header>
    <!-- ====== Header End ====== -->

    <!-- ====== Hero Start ====== -->
    @include('layouts.outer.hero')
    <!-- ====== Hero End ====== -->

    <!-- ====== Features Start ====== -->
    @include('layouts.outer.features')
    <!-- ====== Features End ====== -->

    {{-- <!-- ====== About Start ====== -->
    @include('layouts.outer.about')
   
    <!-- ====== About End ====== -->

    <!-- ====== Pricing Start ====== -->
     @include('layouts.outer.pricing')
    <!-- ====== Pricing End ====== -->

    <!-- ====== FAQ Start ====== -->
    @include('layouts.outer.faq')
    <!-- ====== FAQ End ====== -->

    <!-- ====== Testimonials Start ====== -->
    @include('layouts.outer.testimonials')
    <!-- ====== Testimonials End ====== -->
    
    <!-- ====== Team Start ====== -->
    @include('layouts.outer.team')
    <!-- ====== Team End ====== -->
    
    <!-- ====== Contact Start ====== -->
    @include('layouts.outer.contact')
    <!-- ====== Contact End ====== --> --}}
    
    <!-- ====== Footer Start ====== -->
    @include('layouts.outer.footer')
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="{{ asset('landpage') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landpage') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('landpage') }}/assets/js/main.js"></script>
    <script>
      // ==== for menu scroll
      const pageLink = document.querySelectorAll(".ud-menu-scroll");

      pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
          e.preventDefault();
          document.querySelector(elem.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
            offsetTop: 1 - 60,
          });
        });
      });

      // section menu active
      function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
          window.pageYOffset ||
          document.documentElement.scrollTop ||
          document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
          const currLink = sections[i];
          const val = currLink.getAttribute("href");
          const refElement = document.querySelector(val);
          const scrollTopMinus = scrollPos + 73;
          if (
            refElement.offsetTop <= scrollTopMinus &&
            refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
          ) {
            document
              .querySelector(".ud-menu-scroll")
              .classList.remove("active");
            currLink.classList.add("active");
          } else {
            currLink.classList.remove("active");
          }
        }
      }

      window.document.addEventListener("scroll", onScroll);
    </script>
  </body>
</html>
