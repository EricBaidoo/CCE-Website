<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CCE</title>
    <link rel="icon" href="../assets/image/CCE%20LOGO.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#251A5A',
                        secondary: '#E07A2A',
                        dark: '#110C2A'
                    },
                    fontFamily: {
                        heading: ['Outfit', 'sans-serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-dark text-white font-sans min-h-screen flex">
    
    <!-- Left Side: Image / Branding (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary items-center justify-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="../assets/image/hero/001-w800.webp" alt="CCE Background" class="w-full h-full object-cover mix-blend-overlay opacity-40">
            <div class="absolute inset-0 bg-gradient-to-tr from-primary via-primary/80 to-transparent"></div>
        </div>
        
        <!-- Branding Content -->
        <div class="relative z-10 p-16 max-w-xl">
            <div class="bg-white/10 p-3 rounded-xl backdrop-blur-sm inline-block mb-8 border border-white/20">
                <img src="../assets/image/logo.webp" alt="CCE Logo" class="h-16 w-16 object-contain" onerror="this.style.display='none'">
            </div>
            <h1 class="font-heading text-5xl font-black text-white leading-tight mb-6 uppercase tracking-wider">
                Cross-Cutting<br>
                <span class="text-secondary">Excellence</span>
            </h1>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-24 bg-gray-50 text-gray-900 relative">
        <!-- Decorative accents -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-bl-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-primary/5 rounded-tr-full pointer-events-none"></div>

        <div class="w-full max-w-md relative z-10">
            <!-- Mobile Logo -->
            <div class="lg:hidden flex justify-center mb-8">
                <img src="../assets/image/logo.webp" alt="CCE Logo" class="h-16 w-auto" onerror="this.style.display='none'">
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-heading font-black text-primary uppercase tracking-wider mb-2">Welcome Back</h2>
                <p class="text-gray-500 font-medium text-sm">Please enter your credentials to continue.</p>
            </div>

            <?php if(isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-8 shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="font-medium text-sm"><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="login" class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-primary mb-2 tracking-wide uppercase">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input type="text" name="username" required class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/50 focus:border-secondary outline-none transition-all shadow-sm text-gray-800 font-medium" placeholder="admin">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-primary mb-2 tracking-wide uppercase">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/50 focus:border-secondary outline-none transition-all shadow-sm text-gray-800 font-medium" placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary hover:bg-indigo-900 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 uppercase tracking-widest text-sm flex items-center justify-center gap-2 group">
                        Sign In to Dashboard
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-12 text-center lg:text-left">
                <a href="../" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-secondary font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Return to Public Site
                </a>
            </div>
        </div>
    </div>
</body>
</html>
