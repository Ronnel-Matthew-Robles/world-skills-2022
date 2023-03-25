// Get all the links in the page
const links = document.querySelectorAll("a");

// Add click event listener to each link
links.forEach((link) => {
  link.addEventListener("click", (event) => {
    // Prevent the default link behavior
    event.preventDefault();

    // Get the href attribute of the clicked link
    const href = link.getAttribute("href");

    // Use the location object to change the URL without creating a new history state
    location.replace(href);

    // Fetch the new HTML content and replace the body of the page with it
    fetch(href)
      .then((response) => response.text())
      .then((data) => {
        const parser = new DOMParser();
        const newDoc = parser.parseFromString(data, "text/html");
        document.body.innerHTML = newDoc.body.innerHTML;
      })
      .catch((error) => console.error(error));
  });
});
