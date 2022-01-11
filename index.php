<html>
<head>
    <?php
    include ('elements/header.php');
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
    <style>
        .anim-box
        {
            margin-top:25%;
            clip-path: inset(0px 0px);
            animation: intro;
            opacity: 1;
            animation-duration: 1.5s;
            transform: translateY(-30px);
            animation-fill-mode: forwards;
        }
        #topic
        {
            font-family: lato;
            font-weight: bold;
        }
        @keyframes intro {
            0%{
                opacity:0;
                clip-path: inset(12px 0px)
                transform: translateY(-30px);
            }
            100%{
                opacity: 1;
                clip-path: inset(0px 0px);
                transform: translateY(0px);

            }
        }
    </style>
</head>
<body>
<div class="anim-box">
    <a href="login.php"><h1 id="topic">FileUploadNetwork</h1></a>
</div>
</body>
<script src="src/js/openingAnimation.js"></script>
</html>

