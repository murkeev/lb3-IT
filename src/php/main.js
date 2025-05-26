function loadHTML() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "queries/getDataHtml.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("result").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function loadXML() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "queries/getDataXml.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const xml = xhr.responseXML;
            if (!xml) {
                document.getElementById("result").innerText = "Помилка: XML не зчитано.";
                return;
            }

            const nurses = xml.getElementsByTagName("nurse");
            let output = "<ul>";

            for (let i = 0; i < nurses.length; i++) {
                const name = nurses[i].getElementsByTagName("name")[0].textContent;
                const date = nurses[i].getElementsByTagName("date")[0].textContent;
                const department = nurses[i].getElementsByTagName("department")[0].textContent;
                const shift = nurses[i].getElementsByTagName("shift")[0].textContent;

                output += `<li><strong>${name}</strong>: ${date}, відділення ${department}, зміна ${shift}</li>`;
            }

            output += "</ul>";
            document.getElementById("result").innerHTML = output;
        }
    };
    xhr.send();
}

function loadJSON() {

    logRequest();

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "queries/getDataJson.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            let output = "<ul>";

            data.forEach(item => {
                const name = item.name;
                const department = item.department;

                output += `<li>${name} — палата ${department}</li>`;
            });

            output += "</ul>";
            document.getElementById("result").innerHTML = output;
        }
    };
    xhr.send();
}

function logRequest() {
    if (!navigator.geolocation) {
        sendLog(null, null);
        return;
    }

    navigator.geolocation.getCurrentPosition(
        position => {
            sendLog(position.coords.latitude, position.coords.longitude);
        },
        () => {
            sendLog(null, null);
        }
    );
}

function sendLog(lat, lon) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "queries/logRequest.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    const browser = navigator.userAgent;
    const time = new Date().toISOString();

    const params = `timestamp=${encodeURIComponent(time)}&browser=${encodeURIComponent(browser)}&lat=${lat}&lon=${lon}`;
    xhr.send(params);
}
