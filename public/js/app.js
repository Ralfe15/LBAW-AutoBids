function toggleFavorite(id, isfav){
    var rawBody = {
        "id": id,
    }
    console.log(isfav)
    if(isfav == 'false'){
        // fetch('../actions/action_add_favorite.php', {
            method: "POST",
            headers: { "Content-type": "application/json" },
            body: JSON.stringify(rawBody),
        }).then(response => response.json()
        ).then((response) => {
            if (response.success) {
                const button = document.querySelector("#toggle"+id)
                const icon = document.querySelector("#heart-icon"+id)
                icon.className = "fa fa-heart"
                button.textContent = "Remove from favorites: "
                button.append(icon)
                button.setAttribute("onclick", "toggleFavorite("+id+", 'true')")
            } else {
                throw new Error(response.message);
            }
        });
    }
    if(isfav == 'true'){
        // fetch('../actions/action_remove_favorite.php', {
            method: "POST",
            headers: { "Content-type": "application/json" },
            body: JSON.stringify(rawBody),
        }).then(response => response.json()
        ).then((response) => {
            if (response.success) {
                const button = document.querySelector("#toggle"+id)
                const icon = document.querySelector("#heart-icon"+id)
                icon.className = "fa fa-heart-o"
                button.textContent = "Add to favorites: "
                button.append(icon)
                button.setAttribute("onclick", "toggleFavorite("+id+", 'false')")
            } else {
                throw new Error(response.message);
            }
        });
    }
}
