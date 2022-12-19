function toggleFavorite(id, isfav) {
    var rawBody = {
        "id": id,
    }
    let token = document.querySelector("#token")
    console.log(isfav)
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
