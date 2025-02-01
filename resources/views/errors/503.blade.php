<html>
<head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    .maintenance {
        background-image: url('../../assets/images/main-1.jpg');
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: scroll;
        background-size: cover;
    }

    .maintenance {
        width: 100%;
        height: 100%;
        min-height: 100vh;
    }

    .maintenance {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
    }

    .maintenance_contain {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 15px;
    }

    .maintenance_contain img {
        width: auto;
        max-width: 100%;
    }

    .pp-infobox-title-prefix {
        font-weight: 500;
        font-size: 20px;
        color: #000000;
        margin-top: 30px;
        text-align: center;
    }

    .pp-infobox-title-prefix {
        font-family: sans-serif;
    }

    .pp-infobox-title {
        color: #000000;
        font-family: sans-serif;
        font-weight: 700;
        font-size: 40px;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
        display: block;
        word-break: break-word;
    }

    .pp-infobox-description {
        color: #000000;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-size: 18px;
        margin-top: 0px;
        margin-bottom: 0px;
        text-align: center;
    }
 
    .pp-infobox-description p {
        margin: 0;
    }

    .title-text.pp-primary-title {
        color: #000000;
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        padding-right: 0px;
        font-family: sans-serif;
        font-weight: 500;
        font-size: 18px;
        line-height: 1.4;
        margin-top: 50px;
        margin-bottom: 0px;
    }
</style>
</head>
<body>
    <div class="maintenance">
        <div class="maintenance_contain">
            <img src="{{url('assets/images/main-vector.png')}}" alt="maintenance">
            <span class="pp-infobox-title-prefix">WE ARE COMING SOON</span>
            <div class="pp-infobox-title-wrapper">
                <h3 class="pp-infobox-title">The website under maintenance!</h3>
            </div>
            <div class="pp-infobox-description">
                <p>Someone has kidnapped our site. We are negotiation ransom and<br>will resolve this issue in 24/7
                    hours</p>
            </div>


        </div>
    </div>
</body>
</html>