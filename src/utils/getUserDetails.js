const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

/**
 * Get logged-in user's profile
 */
export async function getUserProfile() {
    const userData = localStorage.getItem("userData");

    if (!userData) {
        return null; 
    }

    try {
        // Use POST because sending a JSON body with GET may be ignored by some servers
    const response = await fetch(
            `${API_BASE_URL}/code/profile/getUserProfile.php`,
            {
                method: "POST",
                credentials: "include",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    userId: JSON.parse(localStorage.getItem("userData"))?.id,
                }),
            }
        );

        const data = await response.json();

        if (!response.ok || !data.success) {
            console.error(data.message || "Failed to fetch profile");
            return null;
        }

        return data.profile;
    } catch (error) {
        console.error("Error fetching user profile:", error);
        return null;
    }
}
