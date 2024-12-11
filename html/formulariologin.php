    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <form action="funciones/login.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>";