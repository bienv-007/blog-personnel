<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/classes/Auth.php';

if (Auth::check()) {
    header('Location: ' . BASE_URL . '/admin/dashboard.php');
    exit;
}

$auth = new Auth();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errors[] = 'Veuillez remplir tous les champs.';
    } elseif (!$auth->login($email, $password)) {
        $errors[] = 'Email ou mot de passe incorrect.';
    } else {
        header('Location: ' . BASE_URL . '/admin/dashboard.php');
        exit;
    }
}

$pageTitle = 'Connexion';
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5">
    <div class="card shadow-sm mx-auto form-card">
        <div class="card-body p-4">
            <h1 class="h3 mb-4">Connexion administrateur</h1>

            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?= e($error) ?></div>
            <?php endforeach; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <button class="btn btn-primary" type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
