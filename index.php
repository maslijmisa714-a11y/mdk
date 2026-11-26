<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Юридические услуги</title>
  <link rel="stylesheet" href="style.css">
</head>
<body id="top">
  <div class="site">

    <header class="header">
      <div class="logo" aria-label="Юридическая компания">
        <svg viewBox="0 0 44 38" role="img" aria-hidden="true">
          <rect x="1" y="1" width="42" height="36" rx="3" fill="#d5d5d5"/>
          <path d="M22 5v25M12 10h20M8 31h28M17 31h10" stroke="#111" stroke-width="1.5"/>
          <path d="M12 10l-6 11h12l-6-11zm20 0l-6 11h12l-6-11z"
                fill="none" stroke="#111" stroke-width="1.5"/>
          <path d="M4 22h16M24 22h16" stroke="#111" stroke-width="1.5"/>
        </svg>
      </div>

      <div class="header-right">
        <div class="cart" aria-label="Корзина">
          <svg viewBox="0 0 32 32" aria-hidden="true">
            <path d="M5 7h3l2.5 14h13L27 11H9"
                  fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M12 11v8m4-8v8m4-8v8m4-8v8"
                  stroke="currentColor" stroke-width="1.3"/>
            <circle cx="13" cy="25" r="1.8" fill="currentColor"/>
            <circle cx="23" cy="25" r="1.8" fill="currentColor"/>
          </svg>
        </div>

        <div class="account">
          <?php if (isLoggedIn()): ?>
            <a href="profile.php"
               style="color:inherit;text-decoration:none;font-weight:inherit;">
              <?php echo htmlspecialchars($_SESSION['username']); ?>
            </a>
            <a href="profile.php" aria-label="Профиль"
               style="display:inline-flex;align-items:center;height:90%;">
              <span class="avatar" aria-hidden="true"></span>
            </a>
          <?php else: ?>
            <a href="login.php"
               style="color:inherit;text-decoration:none;font-weight:inherit;">
              Войти
            </a>
          <?php endif; ?>
        </div>
      </div>
    </header>

    <main>
      <div class="search">
        <span>Поиск</span>
        <svg viewBox="0 0 28 28" aria-hidden="true">
          <circle cx="11" cy="11" r="6.5" fill="none"
                  stroke="currentColor" stroke-width="3"/>
          <path d="M16 16l8 8" stroke="currentColor"
                stroke-width="4" stroke-linecap="round"/>
          <circle cx="11" cy="11" r="2.2" fill="currentColor"/>
        </svg>
      </div>

      <section class="hero" aria-label="Навигация по сайту">
        <img class="hero-photo" src="assets/hero-law.jpg" alt="Молоток судьи и документы">

        <nav class="main-nav">
          <a href="#top">Главная</a>
          <a href="#catalog">Каталог</a>
          <a href="#about">О нас</a>
          <a href="#contacts">Контакты</a>
        </nav>
      </section>

      <section class="promo" id="about">
        <img src="assets/promo-law.jpg" alt="Весы правосудия и юридические книги">
        <div class="promo-label">
          <strong>Акция</strong>
          <span>Первая консультация<br>
            бесплатно, а новым<br>
            клиентам скидка 20%
          </span>
        </div>
      </section>

      <section class="categories" aria-label="Категории услуг">
        <div>Разовые услуги</div>
        <div>Абонентское<br>обслуживание</div>
        <div>Долговременные<br>услуги</div>
      </section>

      <section class="products" id="catalog" aria-label="Юридические услуги">
        <article class="card">
          <img src="assets/service-1.jpg" alt="Деловая встреча">
          <h2>Абонентское обслуживание бизнеса</h2>
          <p>Юрист для компании: договоры, налоги, кадры, суды.</p>
          <p class="price">Цена: от 25 000 ₽/мес</p>
          <button type="button">В корзину</button>
        </article>

        <article class="card">
          <img src="assets/service-2.jpg" alt="Консультация юриста">
          <h2>Устная консультация юриста (30 мин)</h2>
          <p>Разбор ситуации и план действий. Без воды.</p>
          <p class="price">Цена: 2 500 ₽</p>
          <button type="button">В корзину</button>
        </article>

        <article class="card">
          <img src="assets/service-3.jpg" alt="Подготовка юридических документов">
          <h2>Досудебная претензия</h2>
          <p>Составим и рассчитаем неустойку. Спор без суда.</p>
          <p class="price">Цена: от 5 000 ₽</p>
          <button type="button">В корзину</button>
        </article>

        <article class="card">
          <img src="assets/service-4.jpg" alt="Зал суда">
          <h2>Исковое заявление в суд</h2>
          <p>Грамотно, с учётом практики. Гарантия принятия.</p>
          <p class="price">Цена: от 7 000 ₽</p>
          <button type="button">В корзину</button>
        </article>
      </section>
    </main>

    <footer class="footer" id="contacts">
      <div class="footer-links">
        <div>Контакт:</div>
        <div>Информация:</div>
        <div>Соц. сети:</div>
      </div>
      <img src="assets/footer-law.jpg" alt="Юридическая команда">
    </footer>

  </div>
</body>
</html>