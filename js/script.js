var chat = document.getElementById("chat");
chat.scrollTop = chat.scrollHeight;

function showError(error) {
    alert(error);
}
(() => {
    document.addEventListener("keydown", key => {
        if (key.key == "a") {
            var oReq = new XMLHttpRequest(); // New request object
            oReq.onload = function() {
                // This is where you handle what to do with the response.
                // The actual data is found on this.responseText
                document.getElementById("chat").innerHTML = this.responseText;
            };
            oReq.open("get", "utils/getChat.php", true);
            //                               ^ Don't block the rest of the execution.
            //                                 Don't wait until the request finishes to
            //                                 continue.
            oReq.send();
        }
    });
})();