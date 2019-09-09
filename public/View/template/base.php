<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="keywords" content="<?= $this->var['keywords']; ?>">
    <meta name="description" content="<?= $this->var['description']; ?>">
    <meta name="author" content="Anthony Lacrabere" />
    <title><?= $this->var['title']; ?></title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost:8888/Adopteunstage-main/public/assets/fontawesome-free-5.9.0-web/css/all.css">
    <link rel="stylesheet" href="http://localhost:8888/Adopteunstage-main/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://localhost:8888/Adopteunstage-main/public/assets/js/cookies.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
</head>
<body>
<?php include 'menu.php'; ?>

<?php echo $content; ?>

<?php include 'footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="http://localhost:8888/Adopteunstage-main/public/assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#97add7",
      "text": "#ffffff"
    },
    "button": {
      "background": "#ffffff",
      "text": "#97add7"
    }
  },
  "theme": "classic",
  "content": {
    "message": "En navigant sur Adopte un stage, vous acceptez que nous utilisions vos informations afin de vous offrir une expérience optimale.",
    "dismiss": "J'accepte",
    "link": " En savoir plus ",
    "href": "http://localhost:8888/Adopteunstage-main/public/home/cookies"
  }
});
</script>
</body>
</html>

