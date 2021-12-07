<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/recommendations/2020-01-01')
        .then(response => response.json())
        .then(data => {
            let recommendations = JSON.parse(data);
            document.getElementById("recommendations").innerText = "The latest recommendation is from " +
                recommendations['Firm'][0] + ": \n\n" +
                recommendations['To Grade'][0];
        })
        .catch(console.error);
    });
</script>
<div id="recommendations">
</div>