<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Learn about Meycauayan College's core values, philosophy, mission, and vision on this page.">
  <!-- logo -->
  <link rel="icon" href="../public/assets/logo.webp" type="image/webp" />
  <title>about-us</title>

  <!-- styles -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./about_styles.css" />
</head>

<body>
  <section class="section">
    <div class="title">
      <h2>Core Values | Philosophy | Mission | Vision</h2>
      <p>” Committed to Excellence, Dedicated to Service… “</p>
    </div>

    <div class="about-center section-center">
      <article class="about-img">
        <img src="./mc-core-values.png" alt="mc-core-values" />
      </article>
      <article class="about">
        <!-- btn container -->
        <div class="btn-container">
          <button class="tab-btn active" data-id="history">philosophy</button>
          <button class="tab-btn" data-id="vision">vision</button>
          <button class="tab-btn" data-id="goals">mission</button>
        </div>
        <div class="about-content">
          <!-- single item -->
          <div class="content active" id="history">
            <h4>philosophy</h4>
            <p>
              Meycauayan College upholds the “Mother and Child” Philosophy. As an institution of learning, it is committed to the formation of well-rounded individuals in the pursuit of their ultimate goal for the betterment of the society.
            </p>
          </div>
          <!-- end of single item -->
          <!-- single item -->
          <div class="content" id="vision">
            <h4>vision</h4>
            <p>
              Meycauayan College envisions itself as a recognized nurturing autonomous college that serves as a beacon of innovation, academic excellence, and social responsibility. It aims to create a learning environment that promotes personal growth and lifelong learning. Its students and employees go PLACES to achieve greater heights.
            </p>
          </div>
          <!-- end of single item -->
          <!-- single item -->
          <div class="content" id="goals">
            <h4>mission</h4>
            <p>
              As a recognized institution, Meycauayan College offers programs responsive to the dynamic society. Its graduates are morally upright LEADERS possessing cross-cultural understanding. The stakeholders embrace diversity and inclusivity contributing to the betterment of the society.
            </p>
          </div>
          <!-- end of single item -->
        </div>
      </article>
    </div>

    <div class="back-to-index">
      <a href="../end-users/users.php">
        <h5>back to Dashboard</h5>
      </a>
    </div>
  </section>
  <!-- javascript -->
  <script>
    const btns = document.querySelectorAll('.tab-btn');
    const about = document.querySelector('.about');
    const articles = document.querySelectorAll('.content');

    about.addEventListener('click', function(e) {
      ;
      const id = e.target.dataset.id;
      if (id) {
        btns.forEach(function(btn) {
          btn.classList.remove('active');
          e.target.classList.add('active');
        })
        articles.forEach(function(article) {
          article.classList.remove('active')
        })
        const element = document.getElementById(id);
        element.classList.add('active');
      }
    });
  </script>
</body>

</html>