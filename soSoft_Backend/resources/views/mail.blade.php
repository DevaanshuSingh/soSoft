@php
$data = json_decode($msg, true);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            width: 100vw;
        }

        main {
            display: flex;
            justify-content: start;
            align-items: center;
            flex-direction: column;
            padding: 5% 0 0 0;
        }

        .contents {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* border: 1px solid blue; */
            margin: 2% 0 0 0;
        }

        .heading {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .content {
            font-size: 1.5rem;
            text-align: center;
        }

        .content p {
            margin: 10px 0;
        }
    </style>

</head>

<body>
    <header>
        <h1>Feedback Details:</h1>
    </header>
    <main>
        <!-- <div class="contents">
            <div class="heading">Name <br>
            </div>
            <div class="content">SBSR</div>
        </div>
        <div class="contents">
            <div class="heading">Name <br>
            </div>
            <div class="content">SBSR</div>
        </div> -->
        Message From {{ $data['name'] }}<br>
        <div class="contents">
            Feedback: 
            <div class="content">{{ $data['feedback'] }}</div>
            Feedback At {{ $data['feedbackAt'] }}<br>
    </main>

    <script>
        let fullHeight = document.documentElement.scrollHeight;
        let fullWidth = document.documentElement.scrollWidth;
        header = document.querySelector('header');
        header.style.width = `${fullWidth}px`;
        let remainedHeight = fullHeight - header.offsetHeight;
        let headingHeight = remainedHeight / 10;
        document.querySelector('main').style.height = `${remainedHeight}px`;

        document.querySelectorAll('.contents').forEach(content => {
            content.querySelector('.heading').style.width = `${fullWidth}px`;
            content.querySelector('.content').style.width = `${fullWidth}px`;
        });
    </script>
</body>

</html>