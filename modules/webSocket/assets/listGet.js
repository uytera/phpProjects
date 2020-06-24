console.log("I'm fine");

var ws = new WebSocket("ws://localhost:1337/telemetry");
var listSet = document.getElementById("messages");
var input = document.querySelector('input[name=message]');

ws.addEventListener("message", function (e) {
    console.log(e.data);

    let json = JSON.parse(e.data);
    let listItem = document.createElement('li');

    listItem.className = 'delayed';
    listItem.textContent = json["data"];

    listSet.append(listItem);
    while (listSet.children.length > 5) {
        listSet.removeChild(listSet.firstChild);
    }
});

input.addEventListener('keyup', function (e) {
    if (e.keyCode === 13) {
        e.preventDefault();

        if(e.target.value.length < 1){
            alert("Empty value");
            return;
        }

        let json = '{"action":"get", "id":"'+ e.target.value +'"}';

        ws.send(json);
        e.target.value = "";
        e.target.focus();
    }
});
