// resources/js/auth.js

async function handleOAuthLogin(provider, event) {
    // Kunci event agar tidak memicu reload halaman atau terbaca oleh script lain
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }

    const errorContainer = document.getElementById("error-container");
    const errorMessage = document.getElementById("error-message");
    const loadingState = document.getElementById("loading-state");

    if (errorContainer) errorContainer.classList.add("hidden");
    if (loadingState) {
        loadingState.classList.remove("hidden");
        loadingState.innerText = `> INITIATING_OAUTH_FLOW_FOR_${provider.toUpperCase()}...`;
    }

    try {
        const response = await fetch(`/auth/${provider}/redirect`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });

        // Jika response 500 atau 400, baca JSON error-nya terlebih dahulu
        if (!response.ok) {
            const errData = await response.json().catch(() => ({}));
            throw new Error(
                errData.message || `Server returned status ${response.status}`,
            );
        }

        const data = await response.json();

        if (data.url) {
            window.location.href = data.url;
        } else {
            throw new Error("Redirect URL not found in response.");
        }
    } catch (error) {
        if (loadingState) loadingState.classList.add("hidden");
        if (errorContainer && errorMessage) {
            errorMessage.innerText = error.message;
            errorContainer.classList.remove("hidden");
        }
        console.error(error);
    }
}

// Biarkan sisa kode DOMContentLoaded untuk handle credentials-login-form tetap seperti biasa...
window.handleOAuthLogin = handleOAuthLogin;
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("credentials-login-form");
    const errorContainer = document.getElementById("error-container");
    const errorMessage = document.getElementById("error-message");
    const loadingState = document.getElementById("loading-state");

    if (loginForm) {
        loginForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            if (errorContainer) errorContainer.classList.add("hidden");
            if (loadingState) {
                loadingState.classList.remove("hidden");
                loadingState.innerText =
                    "> INITIATING_CONNECTION_TO_AUTH_SERVER...";
            }

            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            try {
                const response = await fetch(
                    "http://localhost:8080/api/auth/login",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({ email, password }),
                    },
                );

                const data = await response.json();

                console.log("Response Auth API:", data);

                // FIXED: Menambahkan pengecekan data.access_token sesuai response asli API Anda
                if (
                    response.ok &&
                    (data.access_token || data.token || data.success)
                ) {
                    if (loadingState) {
                        loadingState.innerText =
                            "> ACCESS_GRANTED. INITIALIZING_SESSION...";
                    }

                    const token = data.access_token || data.token;
                    localStorage.setItem("auth_token", token);

                    try {
                        const sessionResponse = await fetch(
                            "/auth/session-login",
                            {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document
                                        .querySelector(
                                            'meta[name="csrf-token"]',
                                        )
                                        .getAttribute("content"),
                                    Accept: "application/json",
                                },
                                body: JSON.stringify({
                                    email: data.user.email,
                                }),
                            },
                        );

                        if (sessionResponse.ok) {
                            if (loadingState) {
                                loadingState.innerText =
                                    "> SESSION_INITIALIZED. REDIRECTING...";
                            }
                            // 3. Alihkan halaman jika session Laravel sudah terbentuk
                            setTimeout(() => {
                                window.location.href = "/admin";
                            }, 800);
                        } else {
                            throw new Error(
                                "Gagal menyinkronkan session web lokal.",
                            );
                        }
                    } catch (error) {
                        throw new Error(sessionError.message);
                    }
                } else {
                    // Jika feth berhasil tapi status code 401/422, ambil error message dari server
                    throw new Error(
                        data.message ||
                            "AUTHENTICATION_FAILED: Invalid credentials.",
                    );
                }
            } catch (error) {
                if (loadingState) loadingState.classList.add("hidden");
                if (errorMessage && errorContainer) {
                    errorMessage.innerText = error.message;
                    errorContainer.classList.remove("hidden");
                }
                console.error("Auth Error:", error);
            }
        });
    }
});
