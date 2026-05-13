document.getElementById("inscriptionForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let nom = document.getElementById("nom").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let message = document.getElementById("message");

    // Vérifier si les mots de passe correspondent
    if (password !== confirmPassword) {
        message.style.color = "red";
        message.textContent = "❌ Les mots de passe ne correspondent pas";
        return;
    }

    // Vérifier longueur du mot de passe
    if (password.length < 6) {
        message.style.color = "red";
        message.textContent = "❌ Mot de passe trop court (6 caractères minimum)";
        return;
    }

    // Si tout est bon
    message.style.color = "green";
    message.textContent = "✅ Inscription réussie ! Bienvenue " + nom;

    // Reset du formulaire
    document.getElementById("inscriptionForm").reset();
});