export async function checkSession() {
  try {
    const userData = localStorage.getItem('userData');
    
    if (userData) {
      return { 
        authenticated: true, 
        loggedIn: true,
        user: JSON.parse(userData)
      };
    }
    
    return { authenticated: false, loggedIn: false };
  } catch (err) {
    console.error("Session check failed:", err);
    return { authenticated: false, loggedIn: false };
  }
}