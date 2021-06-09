<script src="/ecoweb/js/third-party/jquery.js"></script>

<script>

function sendData(formData, onSuccess, e){
    console.log(formData);
    e.prevent;
    $.ajax({
        type: "POST",
        url: "serverUrl",
        data: formData,
        success: onSuccess,
        dataType: "json",
        contentType : "application/json"
    });
}

</script>