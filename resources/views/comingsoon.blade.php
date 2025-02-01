<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'White Hat Realty')</title>

    <link rel="stylesheet" href="{{url('/assets/libraries/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{url('/assets/libraries/css/fonts.css')}}" rel="stylesheet">
    <script src="{{url('/assets/libraries/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('/assets/customs/css/style.css')}}">
    
    <script src="{{url('/assets/libraries/js/jquery.js')}}"></script>
    <script src="{{url('/assets/libraries/js/fontsawesome.js')}}"></script>
    <script src="{{url('/assets/libraries/js/particles.js')}}"></script>
    <link rel="stylesheet" href="{{url('/assets/customs/css/comingsoon.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7XW3V1Z0LT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7XW3V1Z0LT');
</script>
<body>
    <div class="preLoader">
        <div class="up"> <img src="{{url('/assets/images/logo.png')}}" alt="" srcset=""></div>
        <div class="down"><img src="{{url('/assets/images/logo.png')}}" alt="" srcset=""></div>
    </div>
    <div class="postLoader">
        <div class="main-div">
            <div id="particles_effect" class="particles-effect"></div>
            <div class="ripple-background">
                <div class="circle medium shade2"></div>
                <div class="circle large shade3"></div>
            </div>
            <div class="sections">
                <section id="W">
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">W</span>isdom:</span>
                    </div>
                    <div class="content" style="background-image: url('/assets/images/shadows/w-01.png')">
                        <p>
                            We navigate with wisdom, leveraging our knowledge and experience to steer through the twists
                            and
                            turns
                            of the market.
                        </p>
                    </div>
                </section>
                <div class="container">
                    <span class="line"></span>
                </div>
                <section id="H1">
                    <div class="content" style="background-image: url('/assets/images/shadows/h-02.png')">
                        <p>
                            Transparency is our cornerstone in the real estate sphere. We believe in open dialogue and
                            integrity in
                            every
                            transaction, fostering trust with our clients and partners.
                        </p>
                    </div>
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">H</span>onesty:</span>
                    </div>

                </section>
                <div class="container">
                    <span class="line" style="transform: rotateX(180deg);"></span>
                </div>
                <section id="I">

                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">I</span>nnovation:</span>
                    </div>
                    <div class="content" style="background-image: url('/assets/images/shadows/i-02.png')">

                        <p>
                            At the heart of our real estate philosophy lies innovation. We embrace cutting-edge
                            technologies
                            and
                            imaginative
                            solutions to elevate the real estate experience for our clients. Staying ahead of the curve
                            is
                            not just
                            a goal; it's our
                            way of ensuring excellence in every property venture.
                        </p>

                    </div>
                </section>
                <div class="container">
                    <span class="line"></span>
                </div>
                <section id="T1">
                    <div class="content" style="background-image: url('/assets/images/shadows/t-02.png')">
                        <p>
                            Real estate is a team sport, and we thrive on collaboration.
                            Each member of our team brings a unique set of skills to the table, creating a tapestry of
                            expertise
                            that ensures
                            success in every endeavor.
                        </p>
                    </div>
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">T</span>eamwork:</span>
                    </div>
                </section>
                <div class="container">
                    <span class="line" style="transform: rotateX(180deg);"></span>
                </div>
                <section id="E">
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">E</span>xcellence:</span>
                    </div>
                    <div class="content" style="background-image: url('/assets/images/shadows/e-02.png')">
                        <p>
                            We set the bar high and strive for excellence in every aspect of our business,
                            from impeccable client service to stellar property representation. It's not just about
                            meeting
                            expectations; it's about
                            exceeding them at every turn.
                        </p>
                    </div>
                </section>
                <div class="container">
                    <span class="line"></span>
                </div>
                <section id="H2">
                    <div class="content" style="background-image: url('/assets/images/shadows/h-02.png')">
                        <p>
                            Beyond the bricks and mortar, real estate is about people.
                            We understand the emotional journey involved in property transactions and approach each
                            interaction with
                            empathy and
                            compassion.
                            Community is at the heart of what we do, and we're dedicated to making a positive impact
                            wherever we go.
                        </p>
                    </div>
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">H</span>umanity:</span>
                    </div>
                </section>
                <div class="container">
                    <span class="line" style="transform: rotateX(180deg);"></span>
                </div>
                <section id="A">
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">A</span>daptability:</span>
                    </div>
                    <div class="content" style="background-image: url('/assets/images/shadows/a-01.png')">
                        <p>
                            In the ever-shifting landscape of real estate, adaptability is key.
                            We embrace change as an opportunity for growth, constantly evolving to meet the demands of
                            the
                            market
                            and provide
                            innovative solutions to our clients.
                        </p>

                    </div>
                </section>
                <div class="container">
                    <span class="line"></span>
                </div>
                <section id="T2">
                    <div class="content" style="background-image: url('/assets/images/shadows/t-02.png')">
                        <p>
                            In real estate, trust is everything.
                            We honor our commitments and uphold our promises,
                            building a reputation for reliability and integrity that's as solid as the foundations we
                            represent.
                        </p>
                    </div>
                    <div class="d-flex align-items-end customHeads ">
                        <span class="seven-headers"><span class="initials">T</span>rustworthiness:</span>
                    </div>
                </section>
            </div>

            <div class="fixed-content" id="fixed">
                <div><img class="imgs" src="{{url('/assets/images/w-01.png')}}"></div>
                <div><img src="{{url('/assets/images/h-01.png')}}"></div>
                <div><img src="{{url('/assets/images/i-01.png')}}"></div>
                <div><img src="{{url('/assets/images/t-01.png')}}"></div>
                <div><img class="imgs" src="{{url('/assets/images/e-01.png')}}"></div>
                <div><img class="sign" src="{{url('/assets/images/sign-01f.png')}}"></div>
                <div><img class="imgs" src="{{url('/assets/images/a-01.png')}}"></div>
                <div><img src="{{url('/assets/images/t-01.png')}}"></div>
            </div>
        </div>
        <section class="section-typing_text">
            <div class="typing_text-heading" id="typing">
                <span class="typing_text">For us, it's not about transactions; it's about transformation. We believe in empowering every home buyer or seeker with knowledge and guidance, to enable them to make well informed decisions. Our commitment goes beyond profits; it's about making a profound impact on lives and their house hunting journey. Through our YouTube channel and upcoming innovative solutions, we 're foreseeing a new era in real estate. Join us as we unravel the possibilities, because at WhiteHat Realty, the future isn't just a destination; it's a journey towards serving your real estate related needs better. Stay tuned for more updates, as the best of us is yet to come. In the meantime, explore our YouTube channel</span><span class="cursor">_</span>
            </div>
        </section>
        <section>
            <div id="youtube">
            </div>
            <div class="text-center m-5">
                <button class="btn btn-warning" id="loadMore" page_id="1">Load More</button>

            </div>
        </section>
        <section style="background:#e3e3e3">
            <div class="contactSection">
                <div class="locationSection d-flex justify-content-center  flex-column ">
                    <div class="mb-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.727647371316!2d77.37755177535519!3d28.54790487571097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cef5539495d45%3A0x23d2d99e54374ec8!2sChandra%20Heights!5e0!3m2!1sen!2sin!4v1714811678373!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <span class="d-flex align-items-center ">
                            <span class="gif">
                                <img src="{{url('/assets/images/location.gif')}}" alt="" srcset="">
                            </span>
                            <span class="p-3 ml-5">Chandra Heights, Sector 107, Noida, Uttar Pradesh</span>
                        </span>
                        <span class="d-flex align-items-center ">
                            <span class="gif">
                                <img src="{{url('/assets/images/phone.gif')}}" alt="" srcset="">
                            </span>
                            <span class="p-3 ml-5">+91 9873353353</span>
                        </span>
                    </div>
                </div>
                <div class="card formSection bg-light">
                    <div class="card-body ">
                        <form class="p-5" action="{{ route('contact-mail') }}" method="POST" id="myForm">
                            @csrf
                            <h3>Let's Chat!</h3>
                            <p>
                                Ready to find your dream home? Chat with WhiteHat Realty! Our friendly experts will guide you on your house hunting journey.
                            </p>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white">
                                        <span class="material-symbols-outlined">person</span>
                                    </span>
                                </div>
                                <input type="text" class="form-control inputfield" id="name" placeholder="Enter Full Name*" name="name" required>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white">
                                        <span class="material-symbols-outlined">phone</span>
                                    </span>
                                </div>
                                <input type="text" class="form-control inputfield" id="mobile" placeholder="Enter Mobile Number*" name="mobile" required>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white">
                                        <span class="material-symbols-outlined">mail</span>
                                    </span>
                                </div>
                                <input type="email" class="form-control inputfield" id="email" placeholder="Enter Email Address*" name="email" required>
                            </div>


                            <div class="input-group mb-4">
                                <label for="message"></label>
                                <textarea name="message" id="message" rows="5" placeholder="Enter Message" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Send Message</button>
                        </form>

                    </div>

                </div>
            </div>
        </section>
    </div>
    <script src="{{url('/assets/customs/js/comingsoon.js')}}">
    </script>
    <script src="{{url('/assets/libraries/js/gsap.min.js')}}"></script>
    <script src="{{url('/assets/libraries/js/scrolltrigger.min.js')}}"></script>
    <script src="{{url('/assets/libraries/js/sweetalert.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    <script>
        var textHeight = $(".typing_text").height();
        $(".typing_text").css("height", `${textHeight+64}px`)
        $(".typing_text").html("");
        console.log(textHeight)
        var animation;

        gsap.registerPlugin(ScrollTrigger, TextPlugin);
        gsap.defaults({
            ease: "none"
        });
        $(window).resize(function() { 
            // ScrollTrigger.refresh();
        })
        if ($(document).width() < 768) {
            const images = document.querySelectorAll('.fixed-content img');
            $(".sections section").each(function(i) {
                gsap.from(images[i], {
                    scrollTrigger: {
                        trigger: this,
                        start: "=+200px center",
                        end: "=+200px center",
                        scrub: true,
                    },
                    x: 100
                })
            })
        } else {
            const images = document.querySelectorAll('.fixed-content img');
            $(".sections section").each(function(i) {
                gsap.from(images[i], {
                    scrollTrigger: {
                        trigger: this,
                        start: "center center",
                        end: "center center",
                        scrub: true,
                    },
                    y: 100
                })
            })
        }

        $(document).on('click', '#loadMore', function() {
            $(this).html('Loading....')
            let page = parseInt($(this).attr('page_id'));
            $.ajax({
                url: '{{route("load-video")}}?page=' + page,
                method: 'GET',
                success: function(data) {
                    if (data.data.next_page_url == null) {
                        $('#loadMore').remove()
                    };
                    page++;
                    $("#loadMore").html('Load More')
                    $("#loadMore").attr('page_id', page);
                    $.each(data.data.data, function(index, data) {
                        let html = `<div class="slide2 f2" style="background-image:url('/storage/${data.thumbnail}')">
                            <iframe class="iframe" src="${data.video_source}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div>
                                <h5>${data.title}</h5>
                                <p class='text-light'>${data.description}</p>
                                <h4>${data.fomatedDate}</h4>
                            </div>
                        </div>`;
                        $("#youtube").append(html)
                    });
                }
            });
        })
    </script>
    <script>
        gsap.to(".typing_text", {
            text: {
                value: "For us, it's not about transactions; it's about transformation. We believe in empowering every home buyer or seeker with knowledge and guidance, to enable them to make well informed decisions. Our commitment goes beyond profits; it's about making a profound impact on lives and their house hunting journey. Through our YouTube channel and upcoming innovative solutions,   we're foreseeing a new era in real estate. Join us as we unravel the possibilities, because at WhiteHat Realty, the future isn't just a destination; it's a journey towards serving your real estate related needs better. Stay tuned for more updates, as the best of us is yet to come. In the meantime, explore our YouTube channel."
            },
            scrollTrigger: {
                trigger: ".typing_text-heading",
                pin: ".typing_text-heading",
                start: () => {
                    var h = $(window).height()-textHeight-64
                        return `top =+${h}px`;                
                },
                end: "bottom top",
                scrub: true,
                anticipatePin: 1,
                onEnter: function() {
                    // When the trigger enters the viewport
                    document.querySelector("#fixed").classList.remove("fixing3");
                    document.querySelector("#fixed").classList.add("fixing");
                    document.querySelector("#fixed").classList.add("fixing2");
                    $("#fixed").css("height", $(window).height()-textHeight-64)
                    // document.querySelector("#fixed").classList.remove("fixed-content");
                },
                onEnterBack: function() {
                    // When the trigger enters the viewport
                    document.querySelector("#fixed").classList.remove("fixing3");
                    document.querySelector("#fixed").classList.add("fixing");
                    document.querySelector("#fixed").classList.add("fixing2");
                },
                onLeaveBack: function() {
                    // When the trigger leaves the viewport
                    document.querySelector("#fixed").classList.remove("fixing");
                    document.querySelector("#fixed").classList.remove("fixing3");
                    document.querySelector("#fixed").classList.remove("fixing2");
                    $("#fixed").css("height", 'auto')
                    if($(window).width()<768){
                        $("#fixed").css("height", '100vh')

                    }
                },
                onLeave: function() {
                    // When the trigger leaves the viewport
                    document.querySelector("#fixed").classList.remove("fixing2");
                    document.querySelector("#fixed").classList.add("fixing3");

                }
            }
        });

        $("#submitBtn").on('click', function(e) {
            e.preventDefault();
            $(this).html('Please Wait..');
            $('.invalid-feedback').remove();
            let formData = $('#myForm').serialize();
            $.ajax({
                url: '{{route("contact-mail")}}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.close();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        backdrop: true
                    });
                    $('#submitBtn').html('Send Message');
                    $('#myForm')[0].reset();

                },
                error: function(xhr, status, error) {
                    $('#submitBtn').html('Send Message');
                    Swal.close();
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            var error = '<div class="invalid-feedback">' + value + '</div>';
                            $('#' + key).closest('.input-group').append(error);
                            $('.invalid-feedback').addClass('bounce');
                        });
                    } else {
                        console.error(error);
                    }
                }
            });
        })
    </script>
</body>

</html>