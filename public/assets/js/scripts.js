function openTab(evt, tabName) {
    var i, tabContent, tabLinks;

    // Hide all tab content by default
    tabContent = document.getElementsByClassName("tabContent");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }

    // Remove the active class from all tab links
    tabLinks = document.getElementsByClassName("tabLinks");
    for (i = 0; i < tabLinks.length; i++) {
        tabLinks[i].className = tabLinks[i].className.replace(" active", "");
    }

    // Show the current tab and add an "active" class to the button that opened it
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Set the first tab to be active by default or based on the URL hash
document.addEventListener("DOMContentLoaded", function () {
    var hash = window.location.hash.substring(1); // Get the hash without the '#'
    if (hash && document.getElementById(hash)) {
        // If there's a hash in the URL and it matches a tab, open that tab
        document.getElementById(hash).style.display = "block";
        document.querySelector(
            ".tabLinks[onclick*='" + hash + "']"
        ).className += " active";
    } else {
        // Otherwise, open the first tab by default
        document.querySelector(".tabLinks").click();
    }
});
