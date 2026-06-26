// resources/js/auth.js

async function handleOAuthLogin(provider) {
    const errorContainer = document.getElementById("error-container");
    const errorMessage = document.getElementById("error-message");
    const loadingState = document.getElementById("loading-state");

    // Reset UI state
    errorContainer.classList.add("hidden");
    loadingState.classList.remove("hidden");

    try {
        const response = await fetch(`/auth/${provider}/redirect`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error(`Failed to fetch redirect URL for ${provider}`);
        }

        const data = await response.json();

        if (data.url) {
            // Redirect ke provider (GitHub/Google)
            window.location.href = data.url;
        } else {
            throw new Error("Redirect URL not found in response.");
        }
    } catch (error) {
        // Tampilkan error ala terminal
        loadingState.classList.add("hidden");
        errorMessage.textContent = error.message;
        errorContainer.classList.remove("hidden");
    }
}

// Daftarkan fungsi ke object window agar bisa dipanggil dari atribut onclick di HTML
window.handleOAuthLogin = handleOAuthLogin;
