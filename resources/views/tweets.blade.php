<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:3000/')
            .then(response => response.json())
            .then(data => {
                let tweets = JSON.parse(JSON.stringify(data));
                console.log(tweets)
                let date = new Date();
                let id;
                for(var i = 0; i < tweets.length; i++) {
                    id = "tweetp" + i;
                    date = new Date(tweets[i].created_at)
                    console.log(date)
                    let text = tweets[i].text.replace(/(?:https?|ftp):\/\/[\n\S]+/g, '');
                    document.getElementById(id).innerText = date.toLocaleTimeString("en-US") + "\n\n" + text;

                }
            })
            .catch(console.error);
    });
</script>
<div id="tweets">
    <blockquote id="tweet0" class="twitter-tweet">
        <p id="tweetp0" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet1" class="twitter-tweet">
        <p id="tweetp1" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet2" class="twitter-tweet">
        <p id="tweetp2" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet3" class="twitter-tweet">
        <p id="tweetp3" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet4" class="twitter-tweet">
        <p id="tweetp4" class="twitter-tweet"></p>
    </blockquote>
    <blockquote id="tweet5" class="twitter-tweet">
        <p id="tweetp5" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet6" class="twitter-tweet">
        <p id="tweetp6" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet7" class="twitter-tweet">
        <p id="tweetp7" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet8" class="twitter-tweet">
        <p id="tweetp8" class="twitter-tweet"></p>
    </blockquote>
    <br>
    <blockquote id="tweet9" class="twitter-tweet">
        <p id="tweetp9" class="twitter-tweet"></p>
    </blockquote>
</div>
