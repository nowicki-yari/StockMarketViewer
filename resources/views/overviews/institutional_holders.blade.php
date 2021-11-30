<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/institutional_holders')
        .then(response => response.json())
        .then(data => {
            let institutional_holders = JSON.parse(data)
            document.getElementById("institutional_holders").innerText = "The top 5 holders are: \n" +
                institutional_holders['Holder'][0] + "\n" +
                institutional_holders['Holder'][1] + "\n" +
                institutional_holders['Holder'][2] + "\n" +
                institutional_holders['Holder'][3] + "\n" +
                institutional_holders['Holder'][4] + "\n"

        })
        .catch(console.error);
    });
</script>
<div id="institutional_holders">

</div>
