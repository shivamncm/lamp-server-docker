<?php
// =============================
// DATABASE CONNECTION (PDO) - works inside Docker
// =============================
// Use environment variables provided by docker-compose, with sensible defaults
$host = getenv('DB_HOST') ?: 'mysql';
$dbname = getenv('DB_NAME') ?: 'portfolio_db';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("<h3 style='color:red;text-align:center;'>Database Connection Failed: " . $e->getMessage() . "</h3>");
}

// =============================
// FETCH USERS FROM DATABASE
// =============================
try {
    $stmt = $pdo->query("SELECT id, name, email, role FROM users ORDER BY id DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $users = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shivam | Portfolio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body { background-color: #f4f6f8; font-family: 'Segoe UI', sans-serif; }
      .hero { background: linear-gradient(135deg, #0d6efd, #6610f2); color: white; padding: 60px 20px; text-align: center; }
      .hero img { width: 140px; height: 140px; border-radius: 50%; border: 4px solid #fff; margin-bottom: 20px; }
      .section-title { margin-top: 60px; font-weight: 700; color: #333; text-align: center; }
      .project-card, .user-card { border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: 0.3s; }
      .project-card:hover, .user-card:hover { transform: translateY(-5px); }
      .footer { background: #212529; color: #aaa; text-align: center; padding: 20px; margin-top: 80px; }
  </style>
</head>
<body>

  <!-- ===== HERO / INTRO ===== -->
  <section class="hero">
    <img src="https://avatars.githubusercontent.com/u/9919?v=4" alt="Profile">
    <h1>Shivam</h1>
    <h5>💻 IT Desktop Support | ☁️ Aspiring Cloud Engineer | 🐧 Linux Enthusiast</h5>
    <p class="mt-3">Focused on building secure, scalable systems & transitioning towards Cloud/DevOps.</p>
    <a href="#contact" class="btn btn-light btn-sm mt-2">Contact Me</a>
  </section>

  <!-- ===== PROJECTS ===== -->
  <div class="container mt-5">
    <h2 class="section-title">My Projects</h2>
    <div class="row justify-content-center mt-4">
      <div class="col-md-4">
        <div class="card project-card p-3">
          <h5>🧩 LEMP Stack Setup</h5>
          <p>Deployed Nginx + PHP + MySQL on AWS EC2 with automated bash scripts and GitHub integration.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card p-3">
          <h5>🚀 CI/CD Pipeline</h5>
          <p>Built Jenkins pipeline with Docker, Git, and Terraform for infrastructure provisioning and deployment.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card p-3">
          <h5>☁️ AWS Automation</h5>
          <p>Created automated S3 + EC2 + CloudWatch setup with Terraform and AWS CLI scripting.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== USERS FROM DATABASE ===== -->
  <div class="container mt-5">
    <h2 class="section-title">Registered Users</h2>
    <div class="row justify-content-center mt-4">
      <?php if (count($users) > 0): ?>
        <?php foreach ($users as $user): ?>
          <div class="col-md-3 m-2">
            <div class="card user-card p-3">
              <h6 class="mb-1 text-primary fw-bold"><?= htmlspecialchars($user['name']); ?></h6>
              <p class="mb-1"><?= htmlspecialchars($user['email']); ?></p>
              <span class="badge bg-secondary"><?= htmlspecialchars($user['role']); ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-muted">No users found in database.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- ===== CONTACT ===== -->
  <div class="container mt-5" id="contact">
    <h2 class="section-title">Contact Me</h2>
    <div class="text-center mt-4">
      <p>📧 Email: <a href="mailto:shivam@example.com">shivam@example.com</a></p>
      <p>🔗 LinkedIn: <a href="https://linkedin.com/in/shivam" target="_blank">linkedin.com/in/shivam</a></p>
    </div>
  </div>

  <!-- ===== FOOTER ===== -->
  <footer class="footer">
    <p>© <?= date('Y'); ?> Shivam | Designed with ❤️ using PHP + Bootstrap</p>
  </footer>

</body>
</html>
