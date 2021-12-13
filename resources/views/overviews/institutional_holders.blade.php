<script>
    window.addEventListener("load", function () {
        fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/institutional_holders')
        .then(response => response.json())
        .then(data => {
            let institutional_holders = JSON.parse(data)
            console.log(institutional_holders);
            document.getElementById("institutional_holders").innerText = "The top 5 holders are: \n" +
                institutional_holders['Holder'][0] + " with " + institutional_holders['Shares'][0] + " shares." + "\n" +
                institutional_holders['Holder'][1] + " with " + institutional_holders['Shares'][1] + " shares."+ "\n" +
                institutional_holders['Holder'][2] + " with " + institutional_holders['Shares'][2] + " shares."+ "\n" +
                institutional_holders['Holder'][3] + " with " + institutional_holders['Shares'][3] + " shares."+ "\n" +
                institutional_holders['Holder'][4] + " with " + institutional_holders['Shares'][4] + " shares."+ "\n"

        })
        .catch(console.error);
    });
</script>
<div id="institutional_holders">

</div>
