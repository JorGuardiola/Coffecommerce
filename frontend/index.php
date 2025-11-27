<?php
// frontend/index.php
session_start();
require_once __DIR__ . '/../db/connection.php';
?>
<?php include __DIR__ . '/templates/header.php'; ?>

<main>

  <!-- CARRUSEL DE VALORES (tal como en tu index.html) -->
  <section class="tag-carousel">
    <div class="carousel-header">
      <h2>Nuestros valores</h2>
      <div class="carousel-controls">
        <button id="btn-left" class="carousel-btn">&lt;</button>
        <button id="btn-right" class="carousel-btn">&gt;</button>
      </div>
    </div>

    <div class="carousel-track">
      <div class="tag-card" style="--bg: url('../assets/img/tarjeta1.jpg');">
        <span class="tag-more">SOSTENIBILIDAD</span>
        <h3>Sostenibilidad en cada grano, respeto en cada sorbo</h3>
      </div>

      <div class="tag-card" style="--bg: url('../assets/img/tarjeta2.jpg');">
        <span class="tag-more">INNOVACION</span>
        <h3>Innovación constante para una experiencia excepcional</h3>
      </div>

      <div class="tag-card" style="--bg: url('../assets/img/tarjeta3.jpg');">
        <span class="tag-more">EXPERIENCIA</span>
        <h3>Un mundo de sabores fresco y tostado para disfrutar</h3>
      </div>

      <div class="tag-card" style="--bg: url('../assets/img/tarjeta4.jpg');">
        <span class="tag-more">CERCANIA</span>
        <h3>Conectando con cada taza, cerca de ti</h3>
      </div>

      <div class="tag-card" style="--bg: url('../assets/img/tarjeta5.jpg');">
        <span class="tag-more">RESPETO</span>
        <h3>Café ético, sabor extraordinario</h3>
      </div>
    </div>
  </section>

  <!-- LISTADO DE PRODUCTOS DESDE BD -->
  <section class="container" style="margin:6rem auto;">
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
