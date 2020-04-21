<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<style>

    @import 'https://fonts.googleapis.com/css?family=Roboto+Mono:100';
    html,
    body {
        font-family: 'Roboto Mono', monospace;
        font-size: 1rem;
        background: #212121;
        height: 100%;
    }
    .container {
        height: 100%;
        width: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
    }
    .text {
        font-weight: 100;
        font-size: 24px;
        color: #fafafa;
    }
    .dud {
        color: #757575;
    }


    @media only screen and (min-device-width : 375px) and (max-device-width : 812px) and (-webkit-device-pixel-ratio : 3) {
        body{
            /*background-color: green;*/
        }
    }
</style>
<body>
<div class="container">
    <div class="text"></div>
</div>
<script>
    // ——————————————————————————————————————————————————
    // TextScramble
    // ——————————————————————————————————————————————————

    class TextScramble {
        constructor(el) {
            this.el = el;
            this.chars = '!<>-_\\/[]{}—=+*^?#________';
            this.update = this.update.bind(this);
        }
        setText(newText) {
            const oldText = this.el.innerText;
            const length = Math.max(oldText.length, newText.length);
            const promise = new Promise(resolve => this.resolve = resolve);
            this.queue = [];
            for (let i = 0; i < length; i++) {
                const from = oldText[i] || '';
                const to = newText[i] || '';
                const start = Math.floor(Math.random() * 40);
                const end = start + Math.floor(Math.random() * 40);
                this.queue.push({ from, to, start, end });
            }
            cancelAnimationFrame(this.frameRequest);
            this.frame = 0;
            this.update();
            return promise;
        }
        update() {
            let output = '';
            let complete = 0;
            for (let i = 0, n = this.queue.length; i < n; i++) {
                let { from, to, start, end, char } = this.queue[i];
                if (this.frame >= end) {
                    complete++;
                    output += to;
                } else if (this.frame >= start) {
                    if (!char || Math.random() < 0.28) {
                        char = this.randomChar();
                        this.queue[i].char = char;
                    }
                    output += `<span class="dud">${char}</span>`;
                } else {
                    output += from;
                }
            }
            this.el.innerHTML = output;
            if (complete === this.queue.length) {
                this.resolve();
            } else {
                this.frameRequest = requestAnimationFrame(this.update);
                this.frame++;
            }
        }
        randomChar() {
            return this.chars[Math.floor(Math.random() * this.chars.length)];
        }
    }


    // ——————————————————————————————————————————————————
    // Example
    // ——————————————————————————————————————————————————

    const phrases = [
        '親愛的,',
        '這是我們在一起的第一百天',
        '時間感覺過很快',
        '也一起做了很多事',
        '也發生了很多事',
        '但一點一滴的時間與事件',
        '讓我越來越愛你',
        ''
    ];


    const el = document.querySelector('.text');
    const fx = new TextScramble(el);

    let counter = 0;

    for( let i = 0; i < phrases.length; i++ ) {
        window.setTimeout(function() {
            fx.setText(phrases[i]);
        }, 2500 * i);
    }
</script>
</body>
</html>
