<?php
// frontend/index.php
session_start();
require_once __DIR__ . '/../db/connection.php';

// Ruta base dinámica (usada para las imágenes del carrusel)
// Asegúrate de que '/lacafetera' sea la subcarpeta de tu proyecto en htdocs.
$base_path = '/lacafetera'; 

// Definición de las tarjetas en PHP para duplicarlas fácilmente
$card_html = [
  1 => '<div class="tag-card" style="--bg: url(\'' . $base_path . '/assets/img/tarjeta1.jpg\');"><span class="tag-more">SOSTENIBILIDAD</span><h3>Sostenibilidad en cada grano, respeto en cada sorbo</h3></div>',
  2 => '<div class="tag-card" style="--bg: url(\'' . $base_path . '/assets/img/tarjeta2.jpg\');"><span class="tag-more">INNOVACION</span><h3>Innovación constante para una experiencia excepcional</h3></div>',
  3 => '<div class="tag-card" style="--bg: url(\'' . $base_path . '/assets/img/tarjeta3.jpg\');"><span class="tag-more">EXPERIENCIA</span><h3>Un mundo de sabores fresco y tostado para disfrutar</h3></div>',
  4 => '<div class="tag-card" style="--bg: url(\'' . $base_path . '/assets/img/tarjeta4.jpg\');"><span class="tag-more">CERCANIA</span><h3>Conectando con cada taza, cerca de ti</h3></div>',
  5 => '<div class="tag-card" style="--bg: url(\'' . $base_path . '/assets/img/tarjeta5.jpg\');"><span class="tag-more">RESPETO</span><h3>Café ético, sabor extraordinario</h3></div>'
];
?>
<?php include __DIR__ . '/templates/header.php'; ?>

<main>

  <section class="tag-carousel">
    <div class="carousel-header">
      <h2>Nuestros valores</h2>
      </div>

    <div class="carousel-track">
      <?php
      // 1. Mostrar el contenido original
      for ($i = 1; $i <= 5; $i++) {
          echo $card_html[$i];
      }
      // 2. Duplicar el contenido para un bucle sin fin (smooth loop)
      for ($i = 1; $i <= 5; $i++) {
          echo $card_html[$i];
      }
      ?>
    </div>
  </section>

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
