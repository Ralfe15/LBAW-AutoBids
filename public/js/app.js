function toggleFavorite(id, isfav) {
    var rawBody = {
        "id": id,
    }
    let token = document.querySelector("#token")
    if (isfav == 'false') {
        fetch('/actions/follow', {
            method: "POST",
            headers: {
                "Content-type": "application/json",
                'X-CSRF-Token': token.getAttribute("content")
            },
            body: JSON.stringify(rawBody),
        }).then(response => response.json()
        ).then((response) => {
            if (response.success) {
                const button = document.querySelectorAll("#toggle" + id)
                const icon = document.querySelectorAll("#heart-icon" + id)
                for (var i = 0; i < button.length; i++) {
                    icon[i].className = "fa fa-heart"
                    button[i].textContent = "Remove from favorites: "
                    button[i].append(icon[i])
                    button[i].setAttribute("onclick", "toggleFavorite(" + id + ", 'true')")
                }

            } else {
                throw new Error(response.message);
            }
        });
    }
    if (isfav == 'true') {
        fetch('/actions/unfollow', {
            method: "POST",
            headers: {
                "Content-type": "application/json",
                'X-CSRF-Token': token.getAttribute("content")
            },
            body: JSON.stringify(rawBody),
        }).then(response => response.json()
        ).then((response) => {
            if (response.success) {
                const button = document.querySelectorAll("#toggle" + id)
                const icon = document.querySelectorAll("#heart-icon" + id)
                for (var i = 0; i < button.length; i++) {
                    icon[i].className = "fa fa-heart-o"
                    button[i].textContent = "Add to favorites: "
                    button[i].append(icon[i])
                    button[i].setAttribute("onclick", "toggleFavorite(" + id + ", 'false')")
                }
            } else {
                throw new Error(response.message);
            }
        });
    }
}

setInterval(function () {
    const elements1 = document.querySelectorAll(`[id$="-count"]`);
    if (elements1 != null) {
        for (var i = 0; i < elements1.length; i++) {
            var content = elements1[i].textContent.split(" ");
            if (content.length === 2) {
                if ((content[0] === "0") || content[0] === "Auction") {
                    elements1[i].textContent = "Auction ended!"
                } else {
                    let newtime = parseInt(content[0]) - 1
                    elements1[i].textContent = newtime + " seconds"
                }

            } else {
                if ((content[0] === "0" && content[2] === "0") || content[0] === "Auction") {
                    elements1[i].textContent = "Auction ended!"
                } else {
                    let newtime = (parseInt(content[0]) * 60) + parseInt(content[2]) - 1
                    let minutes = Math.floor(newtime / 60)
                    elements1[i].textContent = minutes + " minutes " + (newtime - (minutes * 60)) + " seconds"
                }
            }

        }
    }
    const element2 = document.getElementById('countdown')
    if (element2 != null) {
        var content = element2.textContent.split(" ");
        console.log(content)
        if (content[3] !== "Auction") {
            var d = parseInt(content[3])
            var h = parseInt(content[5])
            var m = parseInt(content[7])
            var s = parseInt(content[9])
            var seconds_total = (d) * 86400 + (h) * 3600 + (m) * 60 + (s) - 1
            var d = Math.floor(seconds_total / (3600 * 24));
            var h = Math.floor(seconds_total % (3600 * 24) / 3600);
            var m = Math.floor(seconds_total % 3600 / 60);
            var s = Math.floor(seconds_total % 60);
            if (d === 0 && h === 0 && m === 0 && s === 0) {
                window.location.href = '/home';
            }

            element2.innerHTML = "<b>Time Left:  </b>" + d + " days " + h + " hours " + m + " minutes " + s + " seconds"
        }
    }

}, 1000);

