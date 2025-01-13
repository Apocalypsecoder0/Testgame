function updateContent(title, content) {
    const mainContent = document.getElementById('main-content');
    
    // Fade out the content
    mainContent.classList.remove('show'); // Remove the show class to start fading out

    // Wait for the fade-out transition to complete
    setTimeout(() => {
        mainContent.innerHTML = `
            <h2>${title}</h2>
            <p>${content}</p>
        `;
        mainContent.classList.add('show'); // Add the show class to fade in
    }, 500); // Match this duration with the CSS transition duration
}

document.getElementById('resources').addEventListener('click', function(event) {
    event.preventDefault();
    updateContent('Resources', 'Here you can manage your resources.');
});

document.getElementById('fleet').addEventListener('click', function(event) {
    event.preventDefault();
    updateContent('Fleet', 'Manage your fleet here.');
});

document.getElementById('research').addEventListener('click', function(event) {
    event.preventDefault();
    updateContent('Research', 'Conduct research to advance your technology.');
});
