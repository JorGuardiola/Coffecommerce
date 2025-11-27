<?php
// frontend/index.php
session_start();
require_once __DIR__ . '/../db/connection.php';
?>
<?php include __DIR__ . '/templates/header.php'; ?>

<main>

  <!-- HERO -->
  <section class="header">
    <div class="container">
      <div class="hero-text-block">
        <h1>Descubre el café de especialidad que mereces</h1>
        <p>Selección cuidada, tostado reciente y envío rápido a tu puerta.</p>
      </div>
    </div>
  </section>

  <!-- CARRUSEL -->
  <section class="container" style="margin-top:4rem;">
    <div class="carousel-header">
      <h2>Nuestros cafés</h2>
      <div class="carousel-controls">
        <button class="carousel-btn" id="prevBtn">&lt;</button>
        <button class="carousel-btn" id="nextBtn">&gt;</button>
      </div>
    </div>

    <div class="tag-carousel">
      <div class="carousel-track">
        <article class="tag-card tag-card--1">
          <span class="tag-more">Origen único</span>
          <h3>Etiopía Sidamo</h3>
        </article>

        <article class="tag-card tag-card--2">
          <span class="tag-more">Blend casa</span>
          <h3>House Espresso</h3>
        </article>

        <article class="tag-card tag-card--3">
          <span class="tag-more">Descafeinado</span>
          <h3>Decaf Colombia</h3>
        </article>
      </div>
    </div>
  </section>

  <!-- NUESTROS VALORES -->
  <section class="container" style="margin:6rem auto;">
    <h2 class="center-text">Nuestros valores</h2>

    <div class="valores-grid">
      <article class="valor-card">
        <h3>Sostenibilidad</h3>
        <p>Sostenibilidad en cada grano, respeto en cada sorbo.</p>
      </article>

      <article class="valor-card">
        <h3>Innovación</h3>
        <p>Innovación constante para una experiencia excepcional.</p>
      </article>

      <article class="valor-card">
        <h3>Experiencia</h3>
        <p>Un mundo de sabores fresco y tostado para disfrutar.</p>
      </article>

      <article class="valor-card">
        <h3>Cercanía</h3>
        <p>Conectando con cada taza, cerca de ti.</p>
      </article>

      <article class="valor-card">
        <h3>Respeto</h3>
        <p>Café ético, sabor extraordinario.</p>
      </article>
    </div>
  </section>

  <!-- PRODUCTOS DESDE BD -->
  <section class="container" style="margin-bottom:6rem;">
    <h2 class="center-text">Cafés destacados</h2>

    <div class="productos-grid">
      <?php
      $stmt = $pdo->query("SELECT id, name, price, image FROM products LIMIT 6");
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <article class="producto-card">
          <?php if (!empty($row['image'])): ?>
            <img src="../assets/img/<?php echo htmlspecialchars($row['image']); ?>"
                 alt="<?php echo htmlspecialchars($row['name']); ?>">
          <?php endif; ?>

          <h3><?php echo htmlspecialchars($row['name']); ?></h3>
          <p class="precio"><?php echo number_format($row['price'], 2); ?> €</p>

          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo (int)$row['id']; ?>">
            <button type="submit" class="btn-add-cart">Añadir al carrito</button>
          </form>
        </article>
      <?php endwhile; ?>
    </div>
  </section>

</main>

<?php include __DIR__ . '/templates/footer.php'; ?>
